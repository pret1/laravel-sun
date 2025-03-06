<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], Response::HTTP_UNAUTHORIZED);
        }

        $route = $request->route()->getName();
        $section = explode('.', $route)[0];

        $requiredRoles = [
            "moderator_$section",
            "admin",
        ];

        $actionMap = [
            'POST'   => 'store',
            'GET'    => 'show',
            'PUT'    => 'update',
            'PATCH'  => 'update',
            'DELETE' => 'delete',
        ];
        $methodMap = $request->method();

        $permissionName = $actionMap[$request->method()] ?? null;
        $role = $user->roles()->whereIn('title', $requiredRoles)->exists();
        $permission = $user->hasPermission($permissionName);
        if(!$role || !$permission) {
            return response()->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
