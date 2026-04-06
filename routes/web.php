<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRateController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (NO LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home', [PageController::class, 'home']); // optional
Route::get('/menu', [PageController::class, 'menu'])->name('menu');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| CART ROUTES (NO LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/submit', [CartController::class, 'submitOrder'])->name('cart.submit');
Route::get('/cart/direct-whatsapp/{id}', [CartController::class, 'directWhatsApp'])->name('cart.direct.whatsapp');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Products & Categories
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | PRODUCT RATES (Nested under product)
    |--------------------------------------------------------------------------
    */
    Route::get('products/{product}/rates', [ProductRateController::class, 'index'])->name('product_rates.index');
    Route::get('products/{product}/rates/create', [ProductRateController::class, 'create'])->name('product_rates.create');
    Route::post('products/{product}/rates', [ProductRateController::class, 'store'])->name('product_rates.store');
    Route::get('rates/{rate}/edit', [ProductRateController::class, 'edit'])->name('product_rates.edit');
    Route::put('rates/{rate}', [ProductRateController::class, 'update'])->name('product_rates.update');
    Route::delete('rates/{rate}', [ProductRateController::class, 'destroy'])->name('product_rates.destroy');

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.index');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.update');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

require __DIR__.'/auth.php';