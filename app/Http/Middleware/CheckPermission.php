<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission): Response
    {
        // User::find(12)->hasPermissionTo($permission)
        if (!$request->user() || !$request->user()->hasPermissionTo($permission)) {
            # code...
            return response()->json(['message' => "you are forbidden to perform the $permission action"],402);
        }
        return $next($request);
    }
}
