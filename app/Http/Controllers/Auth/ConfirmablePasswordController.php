<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        // Admin
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
            session()->flash('message', 'Non-permitted role.');
            session()->flash('type', 'danger');
            Auth::logout();
            return redirect('/login');
        }
    }
}
