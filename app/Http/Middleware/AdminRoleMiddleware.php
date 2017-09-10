<?php

namespace App\Http\Middleware;

use Closure;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roleId
     * @return mixed
     */
    public function handle($request, Closure $next, $roleId)
    {
        if ($roleId != getAdminUserInfo('role_id')) {
            if ($request->ajax() || $request->wantsJson()) {
                return adminApiReturn(ERROR, 'forbidden');
            } else {
                return redirect(url('admin/error/403'));
            }
        }

        return $next($request);
    }
}