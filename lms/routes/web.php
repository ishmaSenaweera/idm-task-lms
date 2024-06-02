<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::view('/', 'auth.login')->name('login');
Route::POST('/', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/courses/all', [CourseController::class, 'index'])
        ->name('courses.index');


    // Route to show course form
    Route::get('/courses/create', [CourseController::class, 'create'])
        ->name('courses.create');

    // Route to handle course submission
    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store');

    // Route to delete a course
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
        ->name('courses.destroy');

    // Route to show course edit form
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('courses.edit');

    // Route to handle course edit
    Route::put('/courses/{course}', [CourseController::class, 'update'])
        ->name('courses.update');

    // Route to show modules details of a course
    Route::get('/courses/{course}/modules', [CourseController::class, 'show'])
        ->name('modules.show');
});
