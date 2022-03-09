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
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //Admin
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->intended(RouteServiceProvider::AdminDashboard);
                    // branch manager
                } elseif (Auth::user()->hasRole('branch-manager')) {
                    return redirect()->intended(RouteServiceProvider::BranchManagerDashboard);
                    // account-manager
                } elseif (Auth::user()->hasRole('account-manager')) {
                    return redirect()->intended(RouteServiceProvider::AccountManagerDashboard);
                    // call-center
                } elseif (Auth::user()->hasRole('call-center')) {
                    return redirect()->intended(RouteServiceProvider::CallCenterDashboard);
                    // data-enterer
                } elseif (Auth::user()->hasRole('data-enterer')) {
                    return redirect()->intended(RouteServiceProvider::DataEntererDashboard);
                    // embassy
                } elseif (Auth::user()->hasRole('embassy')) {
                    return redirect()->intended(RouteServiceProvider::EmbassyDashboard);
                }
            }
        }

        return $next($request);
    }
}
