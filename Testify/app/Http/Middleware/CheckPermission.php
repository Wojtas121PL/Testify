<?php

namespace Testify\Http\Middleware;

use Closure;

class CheckPermission
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
        if (!$role == 2) {
            return redirect('/home');
        }

        return $next($request);
    }

}