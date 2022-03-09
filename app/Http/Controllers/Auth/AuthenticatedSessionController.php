<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // dd($request->all());
        $request->authenticate();

        $request->session()->regenerate();


        if (Auth::user()->user_type == $request->user_type) {
            // Admin


            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(RouteServiceProvider::AdminDashboard);
                // branch manager
            } elseif (Auth::user()->hasRole('branch-manager') && Auth::user()->status == 1) {
                return redirect()->intended(RouteServiceProvider::BranchManagerDashboard);
                // account-manager
            } elseif (Auth::user()->hasRole('account-manager') && Auth::user()->status == 1) {
                return redirect()->intended(RouteServiceProvider::AccountManagerDashboard);
                // call-center
            } elseif (Auth::user()->hasRole('call-center') && Auth::user()->status == 1) {
                return redirect()->intended(RouteServiceProvider::CallCenterDashboard);
                // data-enterer
            } elseif (Auth::user()->hasRole('data-enterer') && Auth::user()->status == 1 && Auth::user()->entry_status == 1) {
                return redirect()->intended(RouteServiceProvider::DataEntererDashboard);
                // embassy
            } elseif (Auth::user()->hasRole('embassy') && Auth::user()->status == 1) {
                return redirect()->intended(RouteServiceProvider::EmbassyDashboard);
                // embassy
            } elseif (Auth::user()->hasRole('normal-user') && Auth::user()->status == 1) {
                return redirect()->intended(RouteServiceProvider::NormalUserDashboard);
            } elseif (Auth::user()->hasRole('corporate-user') && Auth::user()->status == 1) {

                return redirect()->intended(RouteServiceProvider::CorporateUserDashboard);
            } else {
                session()->flash('loginValidationError', 'Non-permitted role Or Your Status is Inactive');
                // session()->flash('type', 'danger');
                Auth::logout();
                // return redirect('/');
                return back();
            }
        } else {
            session()->flash('loginValidationError', 'Opps... This portal is not for you. Thank you !');
            // session()->flash('type', 'danger');

            Auth::logout();
            return back();
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
