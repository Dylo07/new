<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            dd('User not logged in'); // Debugging
        }
    
        if (!auth()->user()->is_admin) {
            dd('User is not admin'); // Debugging
        }
    
        return $next($request);
    }

    
}