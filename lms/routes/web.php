<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'auth.login')->name('login');
Route::POST('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::view('/register', 'auth.register')->name('register');
Route::POST('/register', [AuthController::class, 'register']);
