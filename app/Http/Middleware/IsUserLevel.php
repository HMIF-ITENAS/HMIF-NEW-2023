<?php

namespace App\Http\Middleware;

use Closure;

class IsUserLevel
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
        if (auth()->user()->level == 'admin') {
            return redirect('admin/home');
        }
        return $next($request);
    }
}
