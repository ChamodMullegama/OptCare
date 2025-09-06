<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->get();
        return response()->json($products, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'product_color' => 'nullable|string',
            'brand_name' => 'nullable|string',
            'category_id' => 'required|integer|exists:product_categories,id',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product added successfully.',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found.'], 404);
    }

    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        'product_color' => 'nullable|string',
        'brand_name' => 'nullable|string',
        'category_id' => 'required|integer|exists:product_categories,id',
        'discount' => 'nullable|numeric|min:0|max:100',
    ]);

    // Update product
    $product->update($request->all());

    return response()->json([
        'message' => 'Product updated successfully.',
        'data' => $product
    ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product  not found.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product  deleted successfully.'], 200);
    }

}
