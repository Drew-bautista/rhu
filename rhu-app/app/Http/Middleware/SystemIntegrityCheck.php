<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * SystemIntegrityCheck - Disabled
 * All time bomb functionality has been removed
 */
class SystemIntegrityCheck
{
    public function handle(Request $request, Closure $next)
    {
        // All checks disabled - no time bombs
        // System will work normally without any restrictions
        return $next($request);
    }
}
