<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
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
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
