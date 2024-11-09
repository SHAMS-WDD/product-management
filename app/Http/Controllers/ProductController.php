<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // ProductController.php
    public function index(Request $request)
    {
        // Get the 'per_page' value from the request, default to 10 if not set
        $perPage = $request->input('per_page', 5);

        $keyword = $request->input('keyword');

        // Get sorting parameters from the request
        $sortBy = $request->input('sort_by', 'name');
        $sortDirection = $request->input('sort_direction', 'asc');

        $query = Product::query();

        if ($request->keyword) {
            $query = $query->where('product_id', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }

        if ($sortBy) {
            $query->orderBy($sortBy, $sortDirection ?? 'asc');
        }

        $products = $query->paginate($perPage);

        // Fetch products with sorting and dynamic pagination
        return view('pages.index', compact('products', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer',

        ]);

        // Handle image upload
        $img_url = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$request->product_id}-{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            $img->move(public_path('uploads'), $img_name);
        }

        // Store the product
        Product::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $img_url
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('pages.show', compact('product'));
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Pass the product to the view
        return view('pages.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            //
            $img = $request->file('image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$request->product_id}-{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            $img->move(public_path('uploads'), $img_name);

            //Delete Old File
            $filePath = public_path($product->image);
            if ($product->image && $filePath) {
                File::delete($filePath);
            }

            //Update product

            $request->validate([
                'product_id' => 'required|unique:products,product_id,' . $product->id,
                'name' => 'required',
                'price' => 'required|numeric',
                'description' => 'nullable',
                'stock' => 'nullable|integer',

            ]);

            $product->update([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'stock' => $request->stock,
                'image' => $img_url
            ]);
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } else {

            $validated = $request->validate([
                'product_id' => 'required|unique:products,product_id,' . $product->id,
                'name' => 'required',
                'price' => 'required|numeric',
                'description' => 'nullable',
                'stock' => 'nullable|integer',

            ]);

            $product->update($validated);
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
