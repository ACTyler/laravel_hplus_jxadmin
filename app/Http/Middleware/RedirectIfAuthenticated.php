<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $admin = RouteServiceProvider::ADMIN;
        $admin_login = RouteServiceProvider::ADMIN_LOGIN;
        if (Auth::guard($guard)->check())
        {
            if('/'.$request->path() == $admin_login)
                return redirect($admin);
            return $next($request);
        }

        if('/'.$request->path() == $admin_login)
        {
            return $next($request);
        }
        return redirect($admin_login);
    }
}
