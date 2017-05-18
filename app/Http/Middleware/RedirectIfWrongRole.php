<?php

namespace Testify\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfWrongRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest() || Auth::user()->role !== $role) {
            return redirect('/home');
        }
        return $next($request);
    }
}
