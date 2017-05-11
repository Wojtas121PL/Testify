<?php

namespace Testify\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class role
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::user()->role != $role) {
            return redirect('/home');
        }

        return $next($request);
    }

}