<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

// Default route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (login, register, etc.)
Auth::routes();

// Route to Home Page (Optional)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Show the login form (for web-based login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login submission (for web-based login)
Route::post('/login', [LoginController::class, 'login']);

// Handle logout (for web-based logout)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User dashboard (requires authentication)
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

// Admin dashboard (requires authentication and role check)
Route::get('/admin/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard');
    }
    return redirect('/user/dashboard')->withErrors('You do not have access to this page.');
})->middleware('auth')->name('admin.dashboard');