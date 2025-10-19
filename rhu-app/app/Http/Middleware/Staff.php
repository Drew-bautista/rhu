<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Staff
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && Auth::user()->role == 'staff') {
      return $next($request);
    }

    // Log the issue for debugging
    \Log::info('Staff middleware failed - User: ' . (Auth::check() ? Auth::user()->email . ' (Role: ' . Auth::user()->role . ')' : 'Not authenticated'));
    
    return redirect()->route('error');
  }
}
