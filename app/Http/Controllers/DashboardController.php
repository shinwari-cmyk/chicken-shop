<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersToday = Order::whereDate('created_at', today())->count();
        $recentOrders = Order::latest()->take(5)->get();

        return view('dashboard.index', compact('productsCount','categoriesCount','ordersToday','recentOrders'));
    }
}
