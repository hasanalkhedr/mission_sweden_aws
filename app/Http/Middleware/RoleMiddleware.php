<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the authenticated user's role
        $userRole = Auth::user()->employee->role;

        // Check if the user's role matches the required role
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        // If role matches, continue with the request
        return $next($request);
    }
}
