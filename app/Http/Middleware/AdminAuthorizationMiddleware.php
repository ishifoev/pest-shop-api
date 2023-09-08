<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the authenticated user is an admin
       if ($request->user() && $request->user()->is_admin) {
        return $next($request);
        }

        // If not an admin, return an unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
