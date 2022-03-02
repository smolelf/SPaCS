<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $usertype = isset(Auth::user()->usertype) ? Auth::user()->usertype : null;
        echo $usertype;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() AND $usertype == '1') {
                return redirect(RouteServiceProvider::HOME);
            }elseif (Auth::guard($guard)->check() AND $usertype == '0') {
                return redirect(RouteServiceProvider::MOBILE);
            }
        }

        return $next($request);
    }
}
