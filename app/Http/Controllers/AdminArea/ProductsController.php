<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function All()
    {
        try {
            $products = Product::with('category')->get();
            $categories = ProductCategory::all();
            return view('AdminArea.Pages.Shop.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'product_color' => 'required|string|max:50',
            'brand_name' => 'required|string|max:100',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        try {
            $data = $request->all();
            $data['productId'] = 'PR' . Str::random(6);

            Product::create($data);
            return back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'product_color' => 'required|string|max:50',
            'brand_name' => 'required|string|max:100',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        try {
            $data = $request->all();
            $product->update($data);
            return redirect()->back()->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:products,id',
            ]);

            $product = Product::findOrFail($request->id);
            // Delete associated images

            $product->delete();

            return back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ProductImageAdd(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,productId',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            $isPrimarySet = false;

            foreach ($request->file('image') as $file) {
                $imageData = [
                    'productImageId' => 'PI' . Str::random(6),
                    'productId' => $data['productId'],
                    'image' => $file->store('uploads/products', 'public'),
                    'isPrimary' => !$isPrimarySet,
                ];
                if (!$isPrimarySet) {
                    $isPrimarySet = true;
                    // Deactivate existing primary images for this product
                    ProductImage::where('productId', $data['productId'])->where('isPrimary', true)->update(['isPrimary' => false]);
                }
                ProductImage::create($imageData);
            }

            return back()->with('success', 'Images added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewProductImageAll($productId)
    {
        try {
            $product_images = ProductImage::where('productId', $productId)->get();
            return view('AdminArea.Pages.shop.viewProductImage', compact('product_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewProductImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:product_images,id',
            ]);

            $productImage = ProductImage::findOrFail($request->id);
             if ($productImage->image && file_exists(public_path('uploads/' . $productImage->image))) {
            unlink(public_path('uploads/' . $productImage->image));
        }
            $productImage->delete();

            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $item = ProductImage::findOrFail($id);

            if ($item->isPrimary == 0) {
                ProductImage::where('id', '!=', $id)->where('productId', $item->productId)->update(['isPrimary' => 0]);
                $item->isPrimary = 1;
            } else {
                $item->isPrimary = 0;
            }

            $item->save();

            $message = $item->isPrimary ? 'Item activated successfully!' : 'Item deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
