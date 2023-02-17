<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ======================== ADMIN SIDE ===========================>
Route::prefix('/admin')->middleware('ImAdmin')->group(function() {
    // Show panel page
    Route::get('/manage', [AdminController::class, 'manage_admin'])->name('admin.manage');
});

// ======================== USER SIDE ===========================>
// Show welcome page
Route::get('/', [UserController::class, 'landing'])->name('user.index');
Route::prefix('/user')->group(function() {
    // Show login page
    Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('user.login');
    // User authenticate
    Route::post('/authenticate', [UserController::class, 'user_authenticate'])->middleware('guest')->name('user.auth');
    // Logout User
    Route::post('/logout', [UserController::class, 'user_logout'])->middleware('auth')->name('user.logout');
    // Show register page
    Route::get('/register', [UserController::class, 'register'])->middleware('guest')->name('user.register');
    // User new
    Route::post('/new', [UserController::class, 'user_new'])->middleware('guest')->name('user.new');
    // Show products
    Route::get('/products', [ProductController::class, 'show_products'])->middleware('guest')->name('user.products');
});