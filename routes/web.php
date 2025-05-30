<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here's where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Homepage Redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::name('auth.')->group(function () {
    // Registration
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Login
    Route::get('/login', [RegisterController::class, 'showLogin'])->name('login');
    Route::post('/login', [RegisterController::class, 'login']);
    
    // Logout
    Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
});

// Dashboard Route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Transaction Routes
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/create', [TransaksiController::class, 'create'])->name('create');
        Route::post('/', [TransaksiController::class, 'store'])->name('store');
    });
});