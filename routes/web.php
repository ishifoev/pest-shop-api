<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/v1')->middleware(['jwt.token'])->group(function () {
    // Create a new admin account
    Route::post('admin/create', [AdminController::class, 'create']);

    // Admin login
    Route::post('admin/login', [AdminController::class, 'login']);

    // Admin logout
    Route::get('admin/logout', [AdminController::class, 'logout']);

    // Get user listing (non-admins)
    Route::get('admin/user-listing', [AdminController::class, 'userListing']);

    // Edit user account by UUID
    Route::put('admin/user-edit/{uuid}', [AdminController::class, 'editUser']);

    // Delete user account by UUID
    Route::delete('admin/user-delete/{uuid}', [AdminController::class, 'deleteUser']);
});



