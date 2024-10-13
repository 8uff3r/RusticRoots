<?php namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;

class CartItemService
{
  public function rmCartItem(CartItem $cartItem)
  {
    $result = $cartItem->delete();
    return $result;
  }

  public function updateCartItemQuantity(CartItem $cartItem, int $newQuantity)
  {
    if ($cartItem->quantity != $newQuantity) {
      $cartItem->quantity = $newQuantity;
      $cartItem->save();
    }
  }
}
