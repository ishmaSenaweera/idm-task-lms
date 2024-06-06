<?php

use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SyllabusController;

Route::view('/', 'auth.login')->name('login');
Route::POST('/', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/register', [AuthController::class, 'index'])
        ->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

    // Route to view audits
    Route::get('/audit', [AuditController::class, 'index'])
        ->name('audit.index');

    // Route to export audits
    Route::get('/audit/export', [AuditController::class, 'export'])
        ->name('audit.export');
});

Route::middleware(['auth', 'role:Admin|Academic Head'])->group(function () {
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

    // Route to show module form
    Route::get('/modules/create', [ModuleController::class, 'create'])
        ->name('modules.create');

    // Route to handle module submission
    Route::post('/modules', [ModuleController::class, 'store'])
        ->name('modules.store');

    // Route to show module edit form
    Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])
        ->name('modules.edit');

    // Route to handle module update
    Route::put('/modules/{module}', [ModuleController::class, 'update'])
        ->name('modules.update');

    // Route to delete a module
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])
        ->name('modules.destroy');

    // Route to show syllabus form
    Route::get('/syllabi/create', [SyllabusController::class, 'create'])
        ->name('syllabi.create');

    // Route to handle syllabus submission
    Route::post('/syllabi', [SyllabusController::class, 'store'])
        ->name('syllabi.store');

    // Route to show syllabus edit form
    Route::get('/syllabi/{syllabus}/edit', [SyllabusController::class, 'edit'])
        ->name('syllabi.edit');

    // Route to handle syllabus update
    Route::put('/syllabi/{syllabus}', [SyllabusController::class, 'update'])
        ->name('syllabi.update');

    // Route to delete a syllabus
    Route::delete('/syllabi/{syllabus}', [SyllabusController::class, 'destroy'])
        ->name('syllabi.destroy');
});

Route::middleware(['auth', 'role:Admin|Academic Head|Teacher'])->group(function () {
    // Route to view courses
    Route::get('/courses/all', [CourseController::class, 'index'])
        ->name('courses.index');

    // Route to view modules
    Route::get('/modules/all', [ModuleController::class, 'index'])
        ->name('modules.index');
});

Route::middleware(['auth', 'role:Admin|Academic Head|Teacher|Student'])->group(function () {
    // Route to view syllabus
    Route::get('/syllabi/all', [SyllabusController::class, 'index'])
        ->name('syllabi.index');
});
