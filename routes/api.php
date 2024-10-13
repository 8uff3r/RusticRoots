
<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/api/random-products', [ProductController::class, 'random'])->name('product.random');
Route::get('/api/top-categories', [CategoryController::class, 'top'])->name('category.top');
Route::get('/api/top-offers', [ProductController::class, 'topOffers'])->name('product.offers');

Route::post('/api/cart/add', [CartController::class, 'store'])
  ->middleware('auth')
  ->name('cart.add');

