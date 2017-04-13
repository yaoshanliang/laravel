<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        dd($permission);
        /*dd(config('project.admin.permissions'));
        $permissions = config('project.admin.permissions');

        dd(route('createAdminRole'));
        dd($request->path());*/

        $guard = 'admin';

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(url('admin/auth/login'));
            }
        }

        return $next($request);
    }
}