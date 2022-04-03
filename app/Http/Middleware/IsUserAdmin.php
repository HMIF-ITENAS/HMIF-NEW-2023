<?php

namespace App\Http\Middleware;

use Closure;

class IsUserAdmin
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
        if (auth()->user()->level != 'admin') {
            return redirect('/home');
        } else if (auth()->user()->level == "user" && auth()->user()->jabatan == 0 && auth()->user()->status == "active") {
            return redirect('profile/show/' . auth()->user()->id);
        }
        return $next($request);
    }
}
