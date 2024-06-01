<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'auth.login')->name('login');
Route::POST('/', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::view('/register', 'auth.register')->middleware('auth')->name('register');
    Route::POST('/register', [AuthController::class, 'register']);

    Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
