<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function index()
    {
$products = [
    'Whole Raw Chicken',
    'Chicken Breast',
    'Chicken Qeema',
    'Karahi Cut',
    'Drumsticks',
    'Boneless Breast',
    'Boneless Handi Cut',
    'Chicken Wings',
];
        $rates = DB::table('product_rates')->orderBy('created_at', 'desc')->get();

        return view('rates.index', compact('products', 'rates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'active' => 'required|boolean',
        ]);

        DB::table('product_rates')->insert([
    'product_id' => $request->product_id,
    'price' => $request->price,
    'weight' => $request->weight,
    'active' => $request->active ?? 1,
    'created_at' => now(),
    'updated_at' => now(),
]);


        return redirect()->back()->with('success', '✅ Product rate added successfully!');
    }
}
