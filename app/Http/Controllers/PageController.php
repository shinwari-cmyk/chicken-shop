<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;   // IMPORTANT

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function menu()
    {
        $products = Product::all();   // GET PRODUCTS FROM DATABASE
        return view('menu', compact('products'));
    }
}
