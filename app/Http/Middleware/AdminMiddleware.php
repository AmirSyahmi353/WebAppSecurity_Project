<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check admin guard OR normal guard with role=admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
