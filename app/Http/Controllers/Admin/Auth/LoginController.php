<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Apply a guest middleware.
     * 
     * @return  void
     */
    public function __construct() 
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect to dashboard after successfull login.
     * 
     * @return  redirect
     */
    public function redirectTo() 
    {
        if(auth()->user()->isAdmin) return route('admin.dashboard');
        else return route('home');
    }

    /**
     * Show the dashboard's login form.
     * 
     * @return  view
     */
    public function showLoginForm() 
    {
        return view('admin.auth.login');
    }
}
