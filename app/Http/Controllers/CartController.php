<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderDetail;

class CartController extends Controller
{
    // Show checkout page
    public function checkout()
    {
        $cart = session('cart', []);
        $grand_total = 0;

        foreach ($cart as $item) {
            $kg = $item['kg'] ?? 0.5;
            $grand_total += ($item['price'] ?? 0) * $kg;
        }

        return view('cart.checkout', compact('cart', 'grand_total'));
    }

    // Add item to session cart
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cart = session('cart', []);
        $weight = floatval($request->weight ?? 0.5);

        $cart[$id] = [
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'kg' => $weight,
            'image' => $product->image,
        ];

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'cart' => $cart,
        ]);
    }

    // Update item quantity/weight
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if (!isset($cart[$id])) return response()->json(['error'=>'Item not in cart'], 404);

        $kg = floatval($request->kg ?? 0.5);
        $cart[$id]['kg'] = $kg;
        session(['cart' => $cart]);

        $item_total = $cart[$id]['price'] * $kg;
        $grand_total = 0;
        foreach ($cart as $c) $grand_total += $c['price'] * $c['kg'];

        return response()->json([
            'success' => true,
            'item_total' => $item_total,
            'grand_total' => $grand_total,
        ]);
    }

    // Remove item from cart
    public function remove($id)
    {
        $cart = session('cart', []);
        if (!isset($cart[$id])) return response()->json(['error'=>'Item not in cart'], 404);

        unset($cart[$id]);
        session(['cart' => $cart]);

        $grand_total = 0;
        foreach ($cart as $c) $grand_total += $c['price'] * $c['kg'];

        return response()->json([
            'success' => true,
            'grand_total' => $grand_total,
        ]);
    }

    // Submit order → save in DB + open WhatsApp
    public function submitOrder(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return response()->json(['error'=>'Cart is empty'], 400);

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $grand_total = 0;

        // Generate order number
        $lastOrder = Order::latest()->first();
        $order_number = $lastOrder ? 'ORD-'.str_pad($lastOrder->id+1,4,'0',STR_PAD_LEFT) : 'ORD-0001';

        // Create order
        $order = Order::create([
            'order_number' => $order_number,
            'status' => 'pending',
            'order_source' => 'website',
            'sub_total' => 0,
            'discount' => 0,
            'grand_total' => 0,
        ]);

        // Save each item
        $itemsText = "";
        foreach ($cart as $item) {
            $kg = $item['kg'] ?? 0.5;
            $line_total = $item['price'] * $kg;
            $grand_total += $line_total;

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'unit_price' => $item['price'],
                'quantity' => 1,
                'weight' => $kg,
                'total_price' => $line_total,
            ]);

            $itemsText .= "{$item['name']} - {$kg} KG - Rs {$line_total}\n";
        }

        // Save order totals
        $order->update([
            'sub_total' => $grand_total,
            'grand_total' => $grand_total,
        ]);

        // Save customer details
        OrderDetail::create([
            'order_id' => $order->id,
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address ?? 'N/A',
        ]);

        // Clear cart session
        session()->forget('cart');

        // WhatsApp link
        $whatsappNumber = '923170097125';
        $message = urlencode(
            "🍗 NEW ORDER\n\n".
            "Name: {$request->name}\n".
            "Phone: {$request->phone}\n\n".
            "Items:\n{$itemsText}\n".
            "Grand Total: Rs {$grand_total}"
        );
        $whatsapp_url = "https://wa.me/{$whatsappNumber}?text={$message}";

        return response()->json(['success'=>true,'whatsapp_url'=>$whatsapp_url]);
    }

    // Direct WhatsApp order → skip cart
    public function directWhatsApp(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->back()->with('error','Product not found');

        $weight = floatval($request->weight ?? 0.5);
        $line_total = $product->price * $weight;

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        // Generate order number
        $lastOrder = Order::latest()->first();
        $order_number = $lastOrder ? 'ORD-'.str_pad($lastOrder->id+1,4,'0',STR_PAD_LEFT) : 'ORD-0001';

        $order = Order::create([
            'order_number' => $order_number,
            'status' => 'pending',
            'order_source' => 'whatsapp',
            'sub_total' => $line_total,
            'discount' => 0,
            'grand_total' => $line_total,
        ]);

        OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => 1,
            'weight' => $weight,
            'total_price' => $line_total,
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address ?? 'N/A',
        ]);

        $whatsappNumber = '923170097125';
        $message = urlencode(
            "🍗 NEW WHATSAPP ORDER\n\n".
            "Name: {$request->name}\n".
            "Phone: {$request->phone}\n\n".
            "Item:\n{$product->name} - {$weight} KG - Rs {$line_total}\n".
            "Grand Total: Rs {$line_total}"
        );

        return redirect("https://wa.me/{$whatsappNumber}?text={$message}");
    }
    
}
