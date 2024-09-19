<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


// Handle API login
Route::post('/login', [LoginController::class, 'apiLogin']);

// Handle API logout (requires 'auth:sanctum' middleware)
Route::post('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');

// Protected route to get the authenticated user's data (for API)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});