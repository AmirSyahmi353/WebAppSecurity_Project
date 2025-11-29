<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureDemographicCompleted
{
    public function handle($request, Closure $next)
    {
        // If not logged in → let other middleware handle
        if (!Auth::check()) {
            return $next($request);
        }

        // If demographic not filled → redirect to create page
        if (Auth::user()->demographic()->count() == 0) {
            return redirect()->route('demographics.create')
                ->with('error', 'Please complete your demographic form before continuing.');
        }

        return $next($request);
    }
}

