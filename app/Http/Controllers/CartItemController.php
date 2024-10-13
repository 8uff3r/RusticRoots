<?php namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Services\CartItemService;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(CartItem $cartItem)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(CartItem $cartItem)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, CartItem $cartItem, CartItemService $cartItemService)
  {
    $newQuantity = $request->query('quantity');
    $cartItemService->updateCartItemQuantity($cartItem, $newQuantity);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(CartItem $cartItem, CartItemService $cartItemService)
  {
    return $cartItemService->rmCartItem($cartItem);
  }
}
