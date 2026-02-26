<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    // 🗂 Menu Page
    public function menu()
    {
        $products = Product::all();
        return view('menu', compact('products'));
    }

    // 📦 All Orders History (Website + WhatsApp)
    public function history()
    {
        $orders = Order::with(['details', 'items'])
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }

    // 🧾 Invoice page
    public function invoice(Order $order)
    {
        $order->load(['details', 'items']); // Make sure details & items are loaded
        return view('orders.invoice', compact('order'));
    }

    // ✏️ Edit Order (optional)
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    // 🔄 Update Status Only
    public function updateStatus(Order $order)
    {
        $order->update([
            'status' => request('status')
        ]);

        return redirect()->back()->with('success', 'Order status updated!');
    }

    // 🗑 Delete Order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted!');
    }
}
