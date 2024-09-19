<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth');

// Admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

// Generic dashboard (redirect based on role)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    return redirect('/user/dashboard');
})->middleware('auth');

// Add this line to define the logout route
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');