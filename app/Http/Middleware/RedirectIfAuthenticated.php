<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


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
        if (Auth::check() && Auth::user()->user_role_id == 1) {
            return redirect('/tss_dashboard');
        }
        if (Auth::check() && Auth::user()->user_role_id == 2){
            return redirect('/asp_dashboard');
        }
    
        if (Auth::check() && Auth::user()->user_role_id == 3){
            return redirect('/user_dashboard');
        }
        if (Auth::check() && Auth::user()->user_role_id == 4){
            return redirect('/log_dashboard');
        }
/**/
        return $next($request);
    }
}
