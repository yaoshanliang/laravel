<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WeappAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->header('token')) {
            return apiReturn(ERROR, '缺少token');
        }
        if (! getWeappUserId($request->header('token'))) {
            return apiReturn(UNAUTHORIZED, 'token无效');
        }

        return $next($request);
    }
}