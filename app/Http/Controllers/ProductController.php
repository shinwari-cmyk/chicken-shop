<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'rates'])->get(); 
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price'       => 'required|numeric',
            'tax_percent' => 'nullable|numeric',
            'image'       => 'nullable|image',
            'description' => 'nullable|string'
        ]);

        $tax = $data['tax_percent'] ?? 0;
        $data['final_price'] = $data['price'] + ($data['price'] * $tax / 100);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price'       => 'required|numeric',
            'tax_percent' => 'nullable|numeric',
            'image'       => 'nullable|image',
            'description' => 'nullable|string'
        ]);

        $tax = $data['tax_percent'] ?? 0;
        $data['final_price'] = $data['price'] + ($data['price'] * $tax / 100);

      if ($request->hasFile('image')) {

    $image = $request->file('image');

    // create clean name
    $filename = time() . '_' . strtolower(str_replace(' ', '_', $data['name'])) . '.' . $image->getClientOriginalExtension();

    // store in storage/app/public/products/images
    $image->storeAs('products/images', $filename, 'public');

    $data['image'] = 'products/images/' . $filename;
}



        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
