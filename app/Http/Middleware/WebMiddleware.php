<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        $segments = $request->segments();
        $currentURL = implode('/', $segments);
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }
        return redirect('dang-nhap');
    }
}
