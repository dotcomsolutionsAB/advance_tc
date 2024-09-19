<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // Redirect to admin dashboard if the user is an admin
        if (auth()->user()->role === 'admin') {
            return '/admin/dashboard';
        }

        // Redirect to user dashboard for regular users
        return '/user/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        $loginField = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        return [
            $loginField => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }
    public function logout(Request $request)
    {
        // Log the user out of the application
        auth()->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to avoid CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the login page (or wherever you'd like to redirect)
        return redirect('/login');
    }
}
