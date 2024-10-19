<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\UserService;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function products()
  {
    $products = Product::all();
    return Inertia::render('dashboard/Products', ['products' => $products]);
  }

  public function customers(UserService $userService)
  {
    $customers = $userService->customers();
    return Inertia::render('dashboard/Customers', ['customers' => $customers]);
  }
}
