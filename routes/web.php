<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/courses', [FrontController::class, 'courses'])->name('courses');
Route::get('/courses/{id}', [FrontController::class, 'courseDetail'])->name('course.detail');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontController::class, 'storeContact'])->name('contact.store');
Route::get('/instructor/{id}', [FrontController::class, 'instructor'])->name('instructor');

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->isAdministrateur()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isFormateur()) {
        return redirect()->route('formateur.dashboard');
    } else {
        return redirect()->route('apprenant.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.create-user');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.store-user');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Admin trainings and sessions
    Route::get('/admin/formations', [AdminController::class, 'formations'])->name('admin.formations');
    Route::get('/admin/formations/create', [AdminController::class, 'createFormation'])->name('admin.create-formation');
    Route::post('/admin/formations', [AdminController::class, 'storeFormation'])->name('admin.store-formation');
    Route::get('/admin/formations/{id}/edit', [AdminController::class, 'editFormation'])->name('admin.edit-formation');
    Route::put('/admin/formations/{id}', [AdminController::class, 'updateFormation'])->name('admin.update-formation');
    Route::delete('/admin/formations/{id}', [AdminController::class, 'deleteFormation'])->name('admin.delete-formation');

    Route::get('/admin/sessions', [AdminController::class, 'sessions'])->name('admin.sessions');
    Route::get('/admin/sessions/create', [AdminController::class, 'createSession'])->name('admin.create-session');
    Route::post('/admin/sessions', [AdminController::class, 'storeSession'])->name('admin.store-session');
    Route::get('/admin/sessions/{id}/edit', [AdminController::class, 'editSession'])->name('admin.edit-session');
    Route::put('/admin/sessions/{id}', [AdminController::class, 'updateSession'])->name('admin.update-session');
    Route::delete('/admin/sessions/{id}', [AdminController::class, 'deleteSession'])->name('admin.delete-session');

    Route::get('/formateur/dashboard', [FormateurController::class, 'dashboard'])->name('formateur.dashboard');
    Route::get('/formateur/courses', [FormateurController::class, 'courses'])->name('formateur.courses');
    Route::get('/formateur/students', [FormateurController::class, 'students'])->name('formateur.students');
    Route::get('/formateur/materials', [FormateurController::class, 'materials'])->name('formateur.materials');

    Route::get('/apprenant/dashboard', [ApprenantController::class, 'dashboard'])->name('apprenant.dashboard');
    Route::get('/apprenant/courses', [ApprenantController::class, 'courses'])->name('apprenant.courses');
    Route::get('/apprenant/progress', [ApprenantController::class, 'progress'])->name('apprenant.progress');
    Route::get('/apprenant/materials', [ApprenantController::class, 'materials'])->name('apprenant.materials');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
