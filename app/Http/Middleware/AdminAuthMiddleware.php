<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
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
        $guard = 'admin';

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(url('admin/auth/login'));
            }
        }

        $time = time();
        $lastActivity = session()->get('last_activity');
        $lifeTime = config('auth.guards.admin.life_time');

        if ($lastActivity && (($time - $lastActivity) > $lifeTime)) {
            session()->flush();
            return redirect()->guest(url('/admin/auth/login'));
        }
        session()->put(['last_activity' => $time]);

        return $next($request);
    }
}