<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (auth()->user()->role == "ADMIN") {
      # code...
      // dd(auth()->user()->role);
      return $next($request);
    }
    flash()->error('Hak akses tidak diberikan!');
    return redirect('/');
  }
}
