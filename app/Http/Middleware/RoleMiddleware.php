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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role, string ...$roles): Response
    {
        if (! $request->user() || ! $request->user()->hasRole([$role, ...$roles])) {
            abort(403, 'Unauthorized action.');
        }

        $response = $next($request);
        
        // Ensure we return a proper Response object
        if (!$response instanceof Response) {
            return new \Illuminate\Http\Response($response);
        }
        
        return $response;
    }
} 