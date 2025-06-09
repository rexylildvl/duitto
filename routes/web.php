<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

// Redirect to login
Route::redirect('/', '/login');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });
});

// Logout (accessible without auth)
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pemasukan
    Route::get('/pemasukan', [TransaksiController::class, 'pemasukanIndex'])->name('pemasukan.index');
    Route::post('/pemasukan', [TransaksiController::class, 'pemasukanStore'])->name('pemasukan.store');

    // Pengeluaran
    Route::get('/pengeluaran', [TransaksiController::class, 'pengeluaranIndex'])->name('pengeluaran.index');
    Route::post('/pengeluaran', [TransaksiController::class, 'pengeluaranStore'])->name('pengeluaran.store');

    // Tagihan
    Route::get('/tagihan', [TransaksiController::class, 'tagihanIndex'])->name('tagihan.index');
    Route::post('/tagihan', [TransaksiController::class, 'tagihanStore'])->name('tagihan.store');
    Route::post('/tagihan/{id}/bayar', [TransaksiController::class, 'bayarTagihan'])->name('tagihan.bayar');
    Route::post('/tagihan/{id}/bayar', [TransaksiController::class, 'bayar'])->name('tagihan.bayar');

    // Tabungan
    Route::get('/tabungan', [TransaksiController::class, 'tabunganIndex'])->name('tabungan.index');
    Route::post('/tabungan', [TransaksiController::class, 'tabunganStore'])->name('tabungan.store');
    Route::post('/tabungan/{id}/setor', [TransaksiController::class, 'setorTabungan'])->name('tabungan.setor');

    // Bantuan
    Route::get('/bantuan', function () {
        return view('bantuan.index');
    })->name('bantuan.index');

});