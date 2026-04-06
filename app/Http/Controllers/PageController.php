<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class PageController extends Controller
{
    /**
     * Home page
     */
    public function home()
    {
        // Get all categories
        $categories = Category::orderBy('name')->get();

        // Featured products is not used, so pass empty collection
        $featuredProducts = collect(); // empty collection to avoid errors

        return view('home', compact('categories', 'featuredProducts'));
    }

    /**
     * Menu page
     */
    public function menu(Request $request)
    {
        $category_id = $request->query('category');

        // Fetch products by category if selected, otherwise all products
        $products = $category_id
            ? Product::where('category_id', $category_id)->get()
            : Product::all();

        // Get all categories for filter dropdown
        $categories = Category::orderBy('name')->get();

        return view('menu', compact('products', 'categories'));
    }
}