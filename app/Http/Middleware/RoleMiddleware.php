<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserRole; // UserRole enum
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
     * @param  string
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // 1. Check if the user is authenticated.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Check if the user's role matches the required role.
        // We use the UserRole enum for a reliable comparison.
        $requiredRole = UserRole::tryFrom($role);

        if ($request->user()->role !== $requiredRole) {
            // 3. If roles do not match, abort with a 403 Forbidden error.
            abort(403, 'Unauthorized Action');
        }

        // 4. If the user has the correct role, proceed with the request.
        return $next($request);
    }
}
