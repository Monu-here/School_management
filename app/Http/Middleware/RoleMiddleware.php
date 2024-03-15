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
    // public function handle(Request $request, Closure $next, $roles, $permission = null)
    // {
    //     if (!is_array($roles)) {
    //         $roles = explode(',', $roles);
    //     }

    //     foreach ($roles as $role) {
    //         if ($request->user()->hasRole(trim($role))) {
    //             return $next($request);
    //         }
    //     }

    //     abort(403, 'Unauthorized action, no right to access.');
    // }
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ($request->user()->hasRole(trim($role))) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action, no right to access.');
    }
}
