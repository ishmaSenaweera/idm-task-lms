<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::view('/', 'auth.login')->name('login');
Route::POST('/', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::view('/register', 'auth.register')->middleware('auth')->name('register');
    Route::POST('/register', [AuthController::class, 'register']);

    Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index')
        ->middleware('can:view,App\Models\Course');

    // Route to show the form
    Route::get('/courses/create', [CourseController::class, 'create'])
        ->name('courses.create')
        ->middleware('can:create,App\Models\Course');

    // Route to handle the form submission
    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store')
        ->middleware('can:create,App\Models\Course');
});
