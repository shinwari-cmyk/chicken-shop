<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;

class ProductRateController extends Controller
{
    // 📌 Show all rates of a product
    public function index(Product $product)
    {
        $rates = $product->rates()
            ->orderByDesc('active')
            ->orderByDesc('created_at')
            ->get();

        return view('product_rates.index', compact('product', 'rates'));
    }

    // 📌 Show create form
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('product_rates.create', compact('product'));
    }

    // 📌 Store new rate (AUTO CALCULATION)
    public function store(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $data = $request->validate([
            'weight'       => 'required|numeric|min:0',
            'rate_per_kg'  => 'required|numeric|min:0',
            'active'       => 'nullable|boolean',
            'note'         => 'nullable|string|max:255',
        ]);

        // ✅ AUTO PRICE CALCULATION
        $price = $data['weight'] * $data['rate_per_kg'];

        // If active checked → deactivate others
        if (!empty($data['active'])) {
            $product->rates()->update(['active' => false]);
        }

        $rate = ProductRate::create([
            'product_id'  => $product->id,
            'weight'      => $data['weight'],
            'rate_per_kg' => $data['rate_per_kg'],
            'price'       => $price,
            'active'      => $data['active'] ?? false,
            'note'        => $data['note'] ?? null,
        ]);

        // Update product price if active
        if ($rate->active) {
            $product->price = $rate->price;
            if (method_exists($product, 'recalcFinalPrice')) {
                $product->recalcFinalPrice();
            }
            $product->save();
        }

        return redirect()
            ->route('product_rates.index', $product->id)
            ->with('success', 'Rate added successfully.');
    }

    // 📌 Show edit form
    public function edit(ProductRate $rate)
    {
        return view('product_rates.edit', compact('rate'));
    }

    // 📌 Update rate (AUTO CALCULATION)
    public function update(Request $request, ProductRate $rate)
    {
        $data = $request->validate([
            'weight'       => 'required|numeric|min:0',
            'rate_per_kg'  => 'required|numeric|min:0',
            'active'       => 'nullable|boolean',
            'note'         => 'nullable|string|max:255',
        ]);

        // ✅ AUTO PRICE CALCULATION
        $price = $data['weight'] * $data['rate_per_kg'];

        // If active checked → deactivate others
        if (!empty($data['active'])) {
            $rate->product->rates()->update(['active' => false]);
        }

        $rate->update([
            'weight'      => $data['weight'],
            'rate_per_kg' => $data['rate_per_kg'],
            'price'       => $price,
            'active'      => $data['active'] ?? false,
            'note'        => $data['note'] ?? null,
        ]);

        // Update product price if active
        if ($rate->active) {
            $product = $rate->product;
            $product->price = $rate->price;
            if (method_exists($product, 'recalcFinalPrice')) {
                $product->recalcFinalPrice();
            }
            $product->save();
        }

        return redirect()
            ->route('product_rates.index', $rate->product_id)
            ->with('success', 'Rate updated successfully.');
    }

    // 📌 Delete rate
    public function destroy(ProductRate $rate)
    {
        $product = $rate->product;
        $wasActive = $rate->active;

        $rate->delete();

        // If deleted rate was active → set next active
        if ($wasActive) {
            $next = $product->rates()->latest()->first();
            if ($next) {
                $next->update(['active' => true]);
                $product->price = $next->price;
                if (method_exists($product, 'recalcFinalPrice')) {
                    $product->recalcFinalPrice();
                }
                $product->save();
            }
        }

        return redirect()
            ->route('product_rates.index', $product->id)
            ->with('success', 'Rate deleted successfully.');
    }
}
