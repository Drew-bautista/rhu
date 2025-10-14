<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            if ($user->role === 'doctor') {
                return redirect('/doctor-dashboard'); 
            } elseif ($user->role === 'medtech') {
                return redirect('/doctor/cbc-results'); // Medtech goes directly to CBC Results
            } elseif ($user->role === 'staff') {
                return redirect('/staff-dashboard');
            } elseif ($user->role === 'nurse') {
                return redirect('/nurse-dashboard');
            } elseif ($user->role === 'head') {
                return redirect('/head-dashboard');
            } elseif ($user->role === 'teacher' || $user->role === 'student') {
                return redirect('/patient-dashboard');
            } else {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
