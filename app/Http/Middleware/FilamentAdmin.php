<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilamentAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if accessing /admin route
        if ($request->is('admin*')) {
            // Check if user is authenticated
            if (!auth()->check()) {
                // Not authenticated - let Filament handle it (redirect to login)
                return $next($request);
            }

            // Check if user has admin access
            if (!auth()->user()->canAccessFilament()) {
                // User not authorized
                abort(403, 'Unauthorized access to admin panel. You must be an admin.');
            }
        }

        return $next($request);
    }
}
