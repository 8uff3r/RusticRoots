<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(CartService $cartService)
  {
    return $cartService->currentCart();
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Product $product, CartService $cartService)
  {
    $quantity = $request->query('quantity');
    error_log($product, $quantity);
    $cartService->addToCart($product, $quantity);
  }

  /**
   * Display the specified resource.
   */
  public function show(CartService $cartService, Request $request)
  {
    $p = Product::all()->first();
    // $cartService->addToCart($request->user(), $p);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Cart $cart)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Cart $cart)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Cart $cart)
  {
    //
  }
}
