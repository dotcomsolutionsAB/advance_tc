<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\Authentication\Auth_controller;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/data', [DataController::class, 'index']);
    Route::post('/data', [DataController::class, 'store']);});


// Handle API login
Route::post('/loginn', [LoginController::class, 'apiLogin']);

// Handle API logout (requires 'auth:sanctum' middleware)
Route::post('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');
Route::get('/data', [DataController::class, 'index']);
Route::post('/data', [DataController::class, 'store']);
Route::post('/login',[Auth_controller::class,'login']);
Route::post('/register', [Auth_controller::class, 'register']);


// Protected route to get the authenticated user's data (for API)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});