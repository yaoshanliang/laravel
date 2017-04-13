<?php

namespace App\Http\Middleware;

use Closure;

class AdminPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {

        if (! hasAdminPermission($permission)) {
            if ($request->ajax() || $request->wantsJson()) {
                return adminApiReturn(ERROR, 'forbidden', ['permission' => $permission]);
            } else {
                return redirect(url('admin/error/403'));
            }
        }

        return $next($request);
    }
}