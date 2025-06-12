<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// Redirect root to registration
Route::get('/', function () {
    return redirect('/register');
});

// Publicly accessible routes
Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);
Route::get('/register', [StudentController::class, 'showRegistrationForm']);
Route::post('/register', [StudentController::class, 'register']);
Route::get('/logout', [StudentController::class, 'logout']);

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/edit-profile', [StudentController::class, 'editProfile']);
    Route::post('/edit-profile', [StudentController::class, 'updateProfile']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/change-password', [StudentController::class, 'showChangePasswordForm']);
    Route::post('/change-password', [StudentController::class, 'changePassword']);

    Route::post('/courses/register/{id}', [CourseController::class, 'register'])->name('courses.register');
    Route::post('/courses/unregister/{id}', [CourseController::class, 'unregister'])->name('courses.unregister');
});
