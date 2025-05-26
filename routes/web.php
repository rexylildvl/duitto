<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [RegisterController::class, 'showLogin'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);