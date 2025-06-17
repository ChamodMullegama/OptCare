<?php

namespace domain\Services\AdminArea;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductService
{
    protected $product;
    protected $productImage;

    public function __construct()
    {
        $this->product = new Product();
        $this->productImage = new ProductImage();
    }

    public function all()
    {
        return $this->product->with('category')->get();
    }

    public function store(array $data)
    {
        $data['productId'] = 'PR' . Str::random(6);
        $data['discount'] = $data['discount'] ?? 0; // Default to 0 if not provided
        return $this->product->create($data);
    }

    public function update(array $data, $id)
    {
        $product = $this->product->findOrFail($id);
        $data['discount'] = $data['discount'] ?? 0; // Default to 0 if not provided
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return true;
    }

    public function productImageAdd(array $data)
    {
        $isPrimarySet = false;

        foreach ($data['image'] as $file) {
            $imageData = [
                'productImageId' => 'PI' . Str::random(6),
                'productId' => $data['productId'],
                'image' => $file->store('uploads/products', 'public'),
                'isPrimary' => !$isPrimarySet,
            ];
            if (!$isPrimarySet) {
                $isPrimarySet = true;
                // Deactivate existing primary images for this product
                $this->productImage->where('productId', $data['productId'])->where('isPrimary', true)->update(['isPrimary' => false]);
            }
            $this->productImage->create($imageData);
        }

        return true;
    }

    public function viewProductImageAll($productId)
    {
        return $this->productImage->where('productId', $productId)->get();
    }

    public function viewProductImageDelete($id)
    {
        $productImage = $this->productImage->findOrFail($id);
        if ($productImage->image && file_exists(public_path('uploads/' . $productImage->image))) {
            unlink(public_path('uploads/' . $productImage->image));
        }
        $productImage->delete();
        return true;
    }

    public function isPrimary($id)
    {
        $item = $this->productImage->findOrFail($id);
        if ($item->isPrimary == 0) {
            $this->productImage->where('id', '!=', $id)->where('productId', $item->productId)->update(['isPrimary' => false]);
            $item->isPrimary = true;
        } else {
            $item->isPrimary = false;
        }
        $item->save();
        return $item;
    }
}
