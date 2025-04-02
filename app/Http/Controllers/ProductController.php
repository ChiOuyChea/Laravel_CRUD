<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get(); // Joins products with categories
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
    // public function store(Request $request)
    // {
    //     Product::create($request->all());
    //     return redirect()->route('product.create')->with('success', 'Product Added Successfully');
    // }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'quantity' => 'required|integer',
        //     'category_id' => 'required|exists:categories,id',
        //     'description' => 'nullable|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
         // Define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate image
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            session()->flash('fail', $validator->errors()->first());
            return redirect()->route('product.create')->with(['success' => false, 'message' => $validator->errors()->first()]);
            // return response()->json();
        }


        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/products', 'public');
        }

        $category_id = $request->category_id;
        if ($category_id == 'null' || empty($category_id)) {
            $category_id = NULL;
        }

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $category_id,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // echo json_encode(['success' => true, 'message' => 'Product added Successfully!']);
        // return redirect()->route('product.create')->with('success', 'Product Added Successfully');
        session()->flash('success', 'Product updated successfully!');
        return response()->json(['success' => true, 'message' => 'Product added successfully!']);
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
    // public function update(Request $request, string $id)
    // {

    //     // Find the product by ID
    //     $product = Product::find($id);

    //     // Check if product exists
    //     if (!$product) {
    //         return redirect()->route('product.index')->with('error', 'Product not found.');
    //     }

    //     $product->update($request->all());

    //     // Redirect with success message
    //     return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    // }
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'quantity' => 'required|integer',
        //     'category_id' => 'required|exists:categories,id',
        //     'description' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate image
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            session()->flash('fail', $validator->errors()->first());
            return redirect()->route('product.edit', $id)->with(['success' => false, 'message' => $validator->errors()->first()]);
            // return response()->json();
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $product->image = $imagePath;
        }

        // Update other fields
        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        // echo json_encode(['success' => true, 'message' => 'Product updated Successfully!']);
        // return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        // Return a JSON response
        session()->flash('success', 'Product updated successfully!');
        return response()->json(['success' => true, 'message' => 'Product updated successfully!']);

         // Flash the success message to session and redirect to the index page

        // return redirect()->route('product.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     // Find the product by ID
    //     $product = Product::find($id);

    //     // Check if product exists
    //     if (!$product) {
    //         return redirect()->route('product.index')->with('error', 'Product not found.');
    //     }

    //     // Delete the product
    //     $product->delete();

    //     // Redirect with success message
    //     return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    // }
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // Delete the image file if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

}
