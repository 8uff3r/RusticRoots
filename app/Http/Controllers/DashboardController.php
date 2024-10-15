<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function products()
  {
    $products = Product::all();
    return Inertia::render('dashboard/Products', ['products' => $products]);
  }
}
