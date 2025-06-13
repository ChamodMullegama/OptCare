<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use domain\Facades\PublicArea\ProductCategoryFacade;
use domain\Facades\PublicArea\ProductFacade;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
//   public function index(Request $request)
//     {
//         $query = Product::with(['category', 'images']);

//         // Search
//         if ($search = $request->input('search')) {
//             $query->where('name', 'like', '%' . $search . '%')
//                   ->orWhere('description', 'like', '%' . $search . '%')
//                   ->orWhere('brand_name', 'like', '%' . $search . '%');
//         }

//         // Category Filter
//         if ($category_id = $request->input('category_id')) {
//             $query->where('category_id', $category_id);
//         }

//         // Price Filter
//         if ($price_min = $request->input('price_min')) {
//             $query->where('price', '>=', $price_min);
//         }
//         if ($price_max = $request->input('price_max')) {
//             $query->where('price', '<=', $price_max);
//         }

//         // Sorting
//         $sort = $request->input('sort', 'popularity');
//         switch ($sort) {
//             case 'new':
//                 $query->orderBy('created_at', 'desc');
//                 break;
//             case 'price_low':
//                 $query->orderBy('price', 'asc');
//                 break;
//             case 'price_high':
//                 $query->orderBy('price', 'desc');
//                 break;
//             default: // popularity (assuming by quantity sold or views, here using ID as proxy)
//                 $query->orderBy('id', 'desc');
//                 break;
//         }

//         $products = $query->paginate(12);
//         $categories = ProductCategory::all();
//         $totalProducts = Product::count();

//         return view('PublicArea.Pages.Shop.index', compact('products', 'categories', 'totalProducts', 'search'));
//     }

//     public function show($productId)
//     {
//         $product = Product::with(['category', 'images'])->where('productId', $productId)->firstOrFail();
//         $relatedProducts = Product::with(['category', 'images'])
//             ->where('category_id', $product->category_id)
//             ->where('productId', '!=', $productId)
//             ->inRandomOrder()
//             ->take(4)
//             ->get();

//         return view('PublicArea.Pages.Shop.singleProduct', compact('product', 'relatedProducts'));
//     }


 public function index(Request $request)
    {
        try {
            $products = ProductFacade::getFilteredProducts($request);
            $categories = ProductCategoryFacade::all();
            $totalProducts = ProductFacade::count();
            $search = $request->input('search');

            return view('PublicArea.Pages.Shop.index',
                compact('products', 'categories', 'totalProducts', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load products. Please try again.');
        }
    }

    public function show($productId)
    {
        try {
            $product = ProductFacade::getProductDetails($productId);
            $relatedProducts = ProductFacade::getRelatedProducts($productId, $product->category_id);

            return view('PublicArea.Pages.Shop.singleProduct',
                compact('product', 'relatedProducts'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Product not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load product details. Please try again.');
        }
    }
}
