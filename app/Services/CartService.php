<?php namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Session;

class CartService
{
  /**
   * @return Model<Cart>
   */
  public function currentCart(): Model
  {
    $sessionId = Session::id();
    $user = Auth::User();
    $userId = $user?->id;
    $cart = ($user
      ? Cart::whereUserId($userId)->with('items.product')->get()
      : Cart::whereSessionId($sessionId)->with('items.product')->get()
    )->first();

    if (!$cart) {
      $cart = $this->createCart();
    }
    return $cart;
  }

  public function createCart(): Cart
  {
    $sessionId = Session::id();
    $user = Auth::User();
    $userId = $user?->id;
    $cart = Cart::create(['user_id' => $userId, 'session_id' => $userId ? null : $sessionId]);
    return $cart;
  }
  public function addToCart(Product $product, int $quantity)
  {
    error_log('ADDING TO CART');
    $sessionId = Session::id();
    $user = Auth::User();
    $userId = $user?->id;
    error_log("sId: $sessionId / uId: $userId");
    // $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);
    $cart = ($user
      ? Cart::whereUserId($userId)->get()
      : Cart::whereSessionId($sessionId)->get()
    )->first();
    error_log("CART: $cart");
    if (!$cart) {
      error_log('NO CART');
      $cart = Cart::create(['user_id' => $userId, 'session_id' => $userId ? null : $sessionId]);
    }

    $cartItem = $cart
      ->items()
      ->get()
      ->where('product_id', $product->id)
      ->first();
    error_log("CartItem: $cartItem");
    if ($cartItem) {
      $cartItem->quantity += $quantity ?? 1;
      $cartItem->save();
    } else {
      $cartItem = CartItem::create([
        'cart_id' => $cart->id,
        'product_id' => $product->id,
        'quantity' => $quantity ?? 1,
      ]);
    }
    return $cartItem;
  }
}
