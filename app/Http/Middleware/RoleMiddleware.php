<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated and has the required role
        if (!auth()->check() || !auth()->user()->hasRole($role)) {
            // Redirect or abort if the user doesn't have the required role
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
