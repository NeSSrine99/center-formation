<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ApprenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
