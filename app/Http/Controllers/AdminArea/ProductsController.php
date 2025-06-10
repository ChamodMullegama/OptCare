<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use domain\Facades\ProductFacade;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
  public function All()
    {
        try {
            $products = ProductFacade::all();
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
            'category_id' => 'required|exists:product_categories,id',
            'product_color' => 'required|string|max:50',
            'brand_name' => 'required|string|max:100',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            $data = $request->all();
            ProductFacade::store($data);
            return back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $request->id,
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'product_color' => 'required|string|max:50',
            'brand_name' => 'required|string|max:100',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            $data = $request->all();
            ProductFacade::update($data, $request->id);
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

            ProductFacade::delete($request->id);
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
            ProductFacade::productImageAdd($data);
            return back()->with('success', 'Images added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewProductImageAll($productId)
    {
        try {
            $product_images = ProductFacade::viewProductImageAll($productId);
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

            ProductFacade::viewProductImageDelete($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            ProductFacade::isPrimary($id);
            $message = ProductImage::findOrFail($id)->isPrimary ? 'Item activated successfully!' : 'Item deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
