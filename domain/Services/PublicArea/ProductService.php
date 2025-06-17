<?php

namespace domain\Services\PublicArea;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function getFilteredProducts(Request $request)
    {
        $query = $this->product->with(['category', 'images']);

        // Search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('brand_name', 'like', '%' . $search . '%');
            });
        }

        // Category Filter
        if ($category_id = $request->input('category_id')) {
            $query->where('category_id', $category_id);
        }

        // Price Filter
        if ($price_min = $request->input('price_min')) {
            $query->where('price', '>=', $price_min);
        }
        if ($price_max = $request->input('price_max')) {
            $query->where('price', '<=', $price_max);
        }

        // Sorting
        $sort = $request->input('sort', 'popularity');
        switch ($sort) {
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return $query->paginate(12);
    }

    public function getProductDetails($productId)
    {
        return $this->product->with(['category', 'images'])
            ->where('productId', $productId)
            ->firstOrFail();
    }

    public function getRelatedProducts($productId, $categoryId, $limit = 4)
    {
        return $this->product->with(['category', 'images'])
            ->where('category_id', $categoryId)
            ->where('productId', '!=', $productId)
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }

    public function count()
    {
        return $this->product->count();
    }
}
