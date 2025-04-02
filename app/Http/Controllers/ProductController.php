<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return Product::all();
    }

    // Get a specific product by ID
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    // Create a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
            'image' => 'nullable|string', // Assuming this is a URL or path
            'status' => 'required|in:active,inactive',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201); // Return the created product with a 201 status
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'image' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $product->update($validated);
        return response()->json($product, 200); // Return the updated product with a 200 status
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->noContent(); // Return a 204 No Content status
    }
}