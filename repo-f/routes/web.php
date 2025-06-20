<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;

// Redirect root to registration
Route::get('/', function () {
    return redirect()->route('register');
})->name('home');

// Guest Routes
Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);
Route::get('/register', [StudentController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [StudentController::class, 'register']);

// Protected Routes
Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profile', [StudentController::class, 'editProfile'])->name('profile.edit');
    Route::post('/edit-profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [StudentController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [StudentController::class, 'changePassword'])->name('password.update');

    // Course Management
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/register/{id}', [CourseController::class, 'register'])->name('courses.register');
    Route::post('/courses/unregister/{id}', [CourseController::class, 'unregister'])->name('courses.unregister');
});
