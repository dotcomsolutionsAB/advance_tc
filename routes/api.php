<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\MTCController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestCertificateController;

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/migrate', [ProductController::class, 'migrate_material']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/generate_certificate', [TestCertificateController::class, 'generateCertificate']);

    Route::post('/certificate', [CertificateController::class, 'create_certificate']);   // Create
    Route::get('/certificate', [CertificateController::class, 'view_certificate']);       // View all
    Route::get('/certificate/{id}', [CertificateController::class, 'view_certificate']);  // View single
    Route::post('/update_certificate/{id}', [CertificateController::class, 'update_certificate']); // Update
    Route::delete('/certificate/{id}', [CertificateController::class, 'delete_certificate']); // Delete

    Route::post('/physical_record', [CertificateController::class, 'make_physical']);   // Create
    Route::get('/physical_record', [CertificateController::class, 'view_physical']);       // View all
    Route::get('/physical_record/{id}', [CertificateController::class, 'view_physical']);  // View single
    Route::post('/update_physical_record/{id}', [CertificateController::class, 'update_physical']); // Update
    Route::delete('/physical_record/{id}', [CertificateController::class, 'delete_physical']); // Delete

    Route::post('/chemical_record', [CertificateController::class, 'make_chemical']);   // Create
    Route::get('/chemical_record', [CertificateController::class, 'view_chemical']);       // View all
    Route::get('/chemical_record/{id}', [CertificateController::class, 'view_chemical']);  // View single
    Route::post('/update_chemical_record/{id}', [CertificateController::class, 'update_chemical']); // Update
    Route::delete('/chemical_record/{id}', [CertificateController::class, 'delete_chemical']); // Delete

    Route::post('/mtc', [MTCController::class, 'create_mtc']);   // Create
    Route::get('/mtc', [MTCController::class, 'view_mtc']);       // View all
    Route::get('/mtc/{id}', [MTCController::class, 'view_mtc']);  // View single
    Route::post('/update_mtc/{id}', [MTCController::class, 'update_mtc']); // Update
    Route::delete('/mtc/{id}', [MTCController::class, 'delete_mtc']); // Delete

    Route::post('/mtc_item', [MTCController::class, 'create_mtc_item']);   // Create
    Route::get('/mtc_item', [MTCController::class, 'view_mtc_items']);       // View all
    Route::get('/mtc_item/{id}', [MTCController::class, 'view_mtc_items']);  // View single
    Route::post('/update_mtc_item/{id}', [MTCController::class, 'update_mtc_item']); // Update
    Route::delete('/mtc_item/{id}', [MTCController::class, 'delete_mtc_item']); // Delete

    Route::post('/counter', [MTCController::class, 'create_counter']);   // Create
    Route::get('/counter', [MTCController::class, 'view_counter']);       // View all
    Route::get('/counter/{id}', [MTCController::class, 'view_counter']);  // View single
    Route::post('/update_counter/{id}', [MTCController::class, 'update_counter']); // Update
    Route::delete('/counter/{id}', [MTCController::class, 'delete_counter']); // Delete

    Route::post('/lpi', [MTCController::class, 'create_lpi']);          // Create
    Route::get('/lpi', [MTCController::class, 'view_lpis']);            // View all
    Route::get('/lpi/{id}', [MTCController::class, 'view_lpis']);       // View single
    Route::post('/update_lpi/{id}', [MTCController::class, 'update_lpi']); // Update
    Route::delete('/lpi/{id}', [MTCController::class, 'delete_lpi']);   // Delete

    Route::post('/mpe', [MTCController::class, 'create_mpe']);          // Create
    Route::get('/mpe', [MTCController::class, 'view_mpes']);            // View all
    Route::get('/mpe/{id}', [MTCController::class, 'view_mpes']);       // View single
    Route::post('/update_mpe/{id}', [MTCController::class, 'update_mpe']); // Update
    Route::delete('/mpe/{id}', [MTCController::class, 'delete_mpe']);   // Delete

    Route::post('/product', [ProductController::class, 'create_product']);          // Create
    Route::get('/product', [ProductController::class, 'view_products']);             // View all
    Route::get('/product/{id}', [ProductController::class, 'view_products']);        // View single
    Route::post('/update_product/{id}', [ProductController::class, 'update_product']);    // Update
    Route::delete('/product/{id}', [ProductController::class, 'delete_product']);  // Delete

    Route::post('/material', [ProductController::class, 'create_material']);          // Create
    Route::get('/material', [ProductController::class, 'view_materials']);             // View all
    Route::get('/material/{id}', [ProductController::class, 'view_materials']);        // View single
    Route::post('/update_material/{id}', [ProductController::class, 'update_material']);    // Update
    Route::delete('/material/{id}', [ProductController::class, 'delete_material']);  // Delete

    Route::post('/physical', [ProductController::class, 'create_physical']);          // Create
    Route::get('/physical', [ProductController::class, 'view_physical']);              // View all
    Route::get('/physical/{id}', [ProductController::class, 'view_physical']);         // View single
    Route::post('/update_physical/{id}', [ProductController::class, 'update_physical']);    // Update
    Route::delete('/physical/{id}', [ProductController::class, 'delete_physical']);  // Delete

    Route::post('/chemical', [ProductController::class, 'create_chemical']);          // Create
    Route::get('/chemical', [ProductController::class, 'view_chemicals']);             // View all
    Route::get('/chemical/{id}', [ProductController::class, 'view_chemicals']);        // View single
    Route::post('/update_chemical/{id}', [ProductController::class, 'update_chemical']);    // Update
    Route::delete('/chemical/{id}', [ProductController::class, 'delete_chemical']);  // Delete

    Route::post('/physical_test', [ProductController::class, 'create_physical_test']);          // Create
    Route::get('/physical_test', [ProductController::class, 'view_physical_tests']);             // View all
    Route::get('/physical_test/{id}', [ProductController::class, 'view_physical_tests']);        // View single
    Route::post('/update_physical_test/{id}', [ProductController::class, 'update_physical_test']);    // Update
    Route::delete('/physical_test/{id}', [ProductController::class, 'delete_physical_test']);  // Delete

    Route::post('/pipe_data', [ProductController::class, 'create_pipe_data']);
    Route::get('/pipe_data', [ProductController::class, 'view_pipe_data']);
    Route::get('/pipe_data/{id}', [ProductController::class, 'view_pipe_data']);
    Route::post('/update_pipe_data/{id}', [ProductController::class, 'update_pipe_data']);
    Route::delete('/pipe_data/{id}', [ProductController::class, 'delete_pipe_data']);

    Route::post('/dimensional', [ProductController::class, 'create_dimensional']);
    Route::get('/dimensional', [ProductController::class, 'view_dimensionals']);
    Route::get('/dimensional/{id}', [ProductController::class, 'view_dimensionals']);
    Route::post('/update_dimensional/{id}', [ProductController::class, 'update_dimensional']);
    Route::delete('/dimensional/{id}', [ProductController::class, 'delete_dimensional']);

    Route::post('/create', [DimensionalController::class, 'create_dimensional']);
    Route::get('/view', [DimensionalController::class, 'view_dimensionals']);
    Route::get('/view/{id}', [DimensionalController::class, 'view_dimensionals']);
    Route::post('/update/{id}', [DimensionalController::class, 'update_dimensional']);
    Route::delete('/delete/{id}', [DimensionalController::class, 'delete_dimensional']);
});
