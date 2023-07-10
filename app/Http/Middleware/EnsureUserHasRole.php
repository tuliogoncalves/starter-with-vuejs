<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        $hasRole = false;
        $errors = [];

        $user = $request->user();

        if (is_null($user) == false) {
            $hasRole = is_null($role)
                ? true
                : $user->hasRole($role);
        }

        if (!$hasRole) {
            abort(403, '403 Unauthorized Roles (Middleware).');
        }

        return $next($request);
    }
}
