<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
  public function index()
  {
    $allProducts = Product::all();
    return $allProducts;
  }

  /**
   * Display a listing of the resource.
   */
  public function showAll()
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
  public function show(int $id)
  {
    $product = Product::whereId($id)->with('category')->get()->get(0);
    if (!$product) {
      return Inertia::render('Error', [
        'status' => 404,
        'message' => 'Product Not Found!',
      ]);
    }
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
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'price' => 'required|numeric',
      // 'category_id' => 'required|exists:categories,id',
      'description' => 'string',
      // Add other fields as necessary
    ]);
    $success = $product->update($validatedData);

    return $success;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    //
  }
}
