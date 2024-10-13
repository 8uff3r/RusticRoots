<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
  /**
   * @return Collection<int, Product>
   */
  public function random(): Collection
  {
    $products = Product::inRandomOrder()->limit(4)->get();
    return $products;
  }

  /**
   * @return Collection<int, Product>
   */
  public function topOffers(): Collection
  {
    $products = Product::inRandomOrder()->where('offer_price', '>', 0)->limit(5)->get();
    return $products;
  }
}
