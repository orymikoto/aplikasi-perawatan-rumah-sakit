<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$roles): Response
  {
    $userRole = $request->user()->role;

    if (!$userRole || !in_array($userRole, $roles)) {

      flash()->error('Hak akses tidak diberikan!');
      return redirect('/');
    }

    return $next($request);
  }
}
