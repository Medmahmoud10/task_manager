<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $user = Auth::user();
        
        // Define role mappings
        $roleMappings = [
            'admin' => 1,
            'user' => 2,
            // Add more roles as needed
        ];

        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if (isset($roleMappings[$role]) && $user->role_id === $roleMappings[$role]) {
                return $next($request);
            }
        }

        // If no roles matched, deny access
        return response()->json([
            'message' => 'Access denied. Required role: ' . implode(' or ', $roles)
        ], 403);
    }
}   