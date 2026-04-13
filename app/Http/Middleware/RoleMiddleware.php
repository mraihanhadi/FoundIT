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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('signin');
        }

        if (auth()->user()->role !== $role) {
            // Redirect based on actual role
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.beranda');
            } else {
                return redirect()->route('user.beranda');
            }
        }

        return $next($request);
    }
}
