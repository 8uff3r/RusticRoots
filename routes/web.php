<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingPageController::class, 'index'])->name('index');

Route::middleware('admin')->group(function () {
  Route::get('/dashboard', function () {
    return Inertia::render('dashboard/Index');
  })->name('dashboard');
  Route::get('/dashboard/products', [DashboardController::class, 'products'])->name(
    'dashboard.products'
  );
  Route::get('/dashboard/customers', [DashboardController::class, 'customers'])->name(
    'dashboard.customers'
  );
  Route::get('/customers', [UserController::class, 'indexCustomers'])->name('users.indexCustomers');
});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::post('/products/{product}', [ProductController::class, 'update'])->name('product.update');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';

Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart/', [CartController::class, 'index'])->name('cart.index');

Route::resource('cartItem', CartItemController::class);
