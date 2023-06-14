<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        //   dd($admin = auth()->user());
        $admin = auth()->user();
        if ($admin != null && !in_array('user', $admin->all_roles)){
            if ($permission != null && !in_array($permission, $admin->all_permissions)) {
                abort(403);
            }
            return $next($request);
        }

        abort(403);
    }
}
