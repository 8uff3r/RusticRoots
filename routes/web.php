<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//   return Inertia::render('Welcome', [
//     'canLogin' => Route::has('login'),
//     'canRegister' => Route::has('register'),
//     'laravelVersion' => Application::VERSION,
//     'phpVersion' => PHP_VERSION,
//   ]);
// });
Route::get('/', [LandingPageController::class, 'index']);

Route::get('/dashboard', function () {
  return Inertia::render('dashboard/Index');
})
  ->middleware(['auth', 'verified'])
  ->name('dashboard');
Route::get('/dashboard/products', [DashboardController::class, 'products']);

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
