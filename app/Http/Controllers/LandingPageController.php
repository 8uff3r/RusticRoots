<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Inertia\Inertia;

class LandingPageController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(ProductService $productService)
  {
    $topProducts = $productService->random();
    $topCategories = Category::all()->take(4);
    $topOffers = $productService->topOffers();
    return Inertia::render('Index', [
      'topProducts' => $topProducts,
      'topCategories' => $topCategories,
      'topOffers' => $topOffers,
    ]);
  }
}
