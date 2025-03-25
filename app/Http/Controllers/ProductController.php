<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        // $categories = Category::all();
        $products = Product::with('category')->get(); // Joins products with categories
        // return view('product.index')->with(['products' => $products, 'categories' => $categories]);
        return view('product.index')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create')->with(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('product.create')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $categories = Category::all();

        return view('product.edit')->with(['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric|min:0',
        //     'description' => 'nullable|string',
        // ]);

        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // Update the product data
        // $product->update([
        //     'name' => $request->input('name'),
        //     'price' => $request->input('price'),
        //     'description' => $request->input('description'),
        // ]);

        $product->update($request->all());

        // Redirect with success message
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // Delete the product
        $product->delete();

        // Redirect with success message
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
