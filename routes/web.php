<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root Redirect
Route::get('/', function () {
    return redirect()->route('home');
});

/* Home Page */
Route::get('/home', function () {
    return view('home');
})->name('home');

/* Dashboard Page */
Route::get('/dashboard', [App\Http\Controllers\FrontendController::class, 'dashboard'])->middleware('auth')->name('dashboard');

/* Navbar Pages */
Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

/* Admin Routes (Secured by AdminMiddleware) */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admindashboard');
    })->name('dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::get('/orders/export', [AdminOrderController::class, 'exportCSV'])->name('orders.export');
    Route::get('/orders/report', [AdminOrderController::class, 'report'])->name('orders.report');
    Route::resource('orders', AdminOrderController::class);
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/orders/{id}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');
});

/* Cart Sync & Checkout */
Route::post('/cart/sync', [CartController::class, 'sync'])->name('cart.sync');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');

/* Profile Management */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Include Laravel Breeze Auth Routes */
require __DIR__.'/auth.php';