<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\MTCController;

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/create', [CertificateController::class, 'make_physical']);   // Create
    Route::get('/view', [CertificateController::class, 'view']);       // View all
    Route::get('/view/{id}', [CertificateController::class, 'view']);  // View single
    Route::put('/update/{id}', [CertificateController::class, 'update_physical']); // Update
    Route::delete('/delete/{id}', [CertificateController::class, 'delete']); // Delete

    Route::post('/create', [CertificateController::class, 'make_chemical']);   // Create
    Route::get('/view', [CertificateController::class, 'view']);       // View all
    Route::get('/view/{id}', [CertificateController::class, 'view']);  // View single
    Route::put('/update/{id}', [CertificateController::class, 'update_physical']); // Update
    Route::delete('/delete/{id}', [CertificateController::class, 'delete']); // Delete

    Route::post('/create', [MTCController::class, 'create_mtc']);   // Create
    Route::get('/view', [MTCController::class, 'view_mtc']);       // View all
    Route::get('/view/{id}', [MTCController::class, 'view_mtc']);  // View single
    Route::put('/update/{id}', [MTCController::class, 'update_mtc']); // Update
    Route::delete('/delete/{id}', [MTCController::class, 'delete_mtc']); // Delete

    Route::post('/create', [MTCController::class, 'create_mtc_item']);   // Create
    Route::get('/view', [MTCController::class, 'view_mtc_items']);       // View all
    Route::get('/view/{id}', [MTCController::class, 'view_mtc_items']);  // View single
    Route::put('/update/{id}', [MTCController::class, 'update_mtc_item']); // Update
    Route::delete('/delete/{id}', [MTCController::class, 'delete_mtc_item']); // Delete

    Route::post('/create', [MTCController::class, 'create_counter']);   // Create
    Route::get('/view', [MTCController::class, 'view_counter']);       // View all
    Route::get('/view/{id}', [MTCController::class, 'view_counter']);  // View single
    Route::put('/update/{id}', [MTCController::class, 'update_counter']); // Update
    Route::delete('/delete/{id}', [MTCController::class, 'delete_counter']); // Delete
});


// Route::middleware([CorsMiddleware::class])->group(function () {
//     Route::get('/data', [DataController::class, 'index']);
//     Route::post('/data', [DataController::class, 'store']);});


// // Handle API login
// Route::post('/loginn', [LoginController::class, 'apiLogin']);

// // Handle API logout (requires 'auth:sanctum' middleware)
// Route::post('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');
// Route::get('/data', [DataController::class, 'index']);
// Route::post('/data', [DataController::class, 'store']);
// Route::post('/login',[Auth_controller::class,'login']);


// // Protected route to get the authenticated user's data (for API)
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });