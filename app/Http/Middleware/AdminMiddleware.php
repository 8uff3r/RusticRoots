<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::user()?->isAdmin()) {
      return $next($request);
    }
    return Inertia::render('Error', [
      'status' => 403,
      'message' => 'You do not have permission to access this resource',
    ])
      ->toResponse($request)
      ->setStatusCode(403);
  }
}
