<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'rates'])->get();

foreach ($products as $product) {

    // FORCE correct URL
    if ($product->image) {
        $product->image = asset('storage/' . $product->image);
    }
}
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric',
            'tax_percent' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,jfif,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        $tax = $data['tax_percent'] ?? 0;
        $data['final_price'] = $data['price'] + ($data['price'] * $tax / 100);

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $filename = time().'_'.str_replace(' ', '_', strtolower($data['name']))
                .'.'.$image->getClientOriginalExtension();

            $image->storeAs('products', $filename, 'public');

            $data['image'] = 'products/' . $filename;
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
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric',
            'tax_percent' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,jfif,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        $tax = $data['tax_percent'] ?? 0;
        $data['final_price'] = $data['price'] + ($data['price'] * $tax / 100);

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image');

            $filename = time().'_'.str_replace(' ', '_', strtolower($data['name']))
                .'.'.$image->getClientOriginalExtension();

            $image->storeAs('products', $filename, 'public');

            $data['image'] = 'products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}