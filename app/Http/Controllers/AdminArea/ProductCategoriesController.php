<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use domain\Facades\AdminArea\ProductCategoryFacade;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
 public function All()
    {
        try {
            $categories = ProductCategoryFacade::all();
            return view('AdminArea.Pages.shop.addProductCategory', compact('categories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'description' => 'nullable|string',
        ]);

        try {
            ProductCategoryFacade::store($request->all());
            return redirect()->back()->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $request->id,
            'description' => 'nullable|string',
        ]);

        try {
            ProductCategoryFacade::update($request->all(), $request->id);
            return redirect()->back()->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:product_categories,id',
        ]);

        try {
            ProductCategoryFacade::delete($request->id);
            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
