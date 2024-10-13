<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $allProducts = Product::all();
    return Inertia::render('Products', [
      'products' => $allProducts,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Product::create([
      'name' => $request->input('name'),
      'description' => $request->input('description'),
      'price' => $request->input('price'),
      'stock' => $request->input('stock'),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    $productsInSameCategory = Product::inRandomOrder()
      ->where('category_id', $product->category_id)
      ->limit(4)
      ->get();
    return Inertia::render('Product', [
      'product' => $product,
      'related' => $productsInSameCategory,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    //
  }
}
