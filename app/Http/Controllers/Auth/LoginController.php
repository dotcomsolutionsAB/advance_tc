<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;  // Use Laravel's built-in trait for handling web login

    /**
     * Where to redirect users after login (for web).
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Check the logged-in user's role and redirect accordingly
        if (auth()->user()->role === 'admin') {
            return '/admin/dashboard';  // Redirect to admin dashboard if user is admin
        }

        return '/user/dashboard';  // Redirect to user dashboard if not admin
    }

    /**
     * Handle the login request for API (Sanctum-based login).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiLogin(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user using email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If login is successful, generate a Sanctum token for the API
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }

        // If login fails, return a JSON error response
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Handle the logout request for API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiLogout(Request $request)
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Revoke all tokens associated with this user
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    /**
     * Handle the login request for web-based login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user using email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If login is successful, check the role and redirect for web
            return redirect()->intended($this->redirectTo());
        }

        // If login fails, return back to login page with an error message
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Log the user out of the application for web-based login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log the user out of the session
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the login page after logging out
        return redirect('/login');
    }

    /**
     * Show the login form (for web).
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');  // Show the login form
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'guest' middleware to all actions except for logout
        // $this->middleware('guest')->except('logout');
    }
}
