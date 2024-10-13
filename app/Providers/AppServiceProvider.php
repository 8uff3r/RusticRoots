<?php

namespace App\Providers;

use App\Services\CartItemService;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $services = [ProductService::class, CartService::class, CartItemService::class];

    // foreach ($services as $service) {
    //   $this->app->singleton($service, function () use ($service) {
    //     return new $service();
    //   });
    // }
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Vite::prefetch(concurrency: 3);
  }
}
