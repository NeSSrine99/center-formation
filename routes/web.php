<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\FrontController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/courses', [FrontController::class, 'courses'])->name('courses');
Route::get('/courses/{id}', [FrontController::class, 'courseDetail'])->name('course.detail');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontController::class, 'storeContact'])->name('contact.store');
Route::get('/instructor/{id}', [FrontController::class, 'instructor'])->name('instructor');

Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Auth::user();

    if ($user && $user->isAdministrateur()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user && $user->isFormateur()) {
        return redirect()->route('formateur.dashboard');
    } elseif ($user && $user->isApprenant()) {
        return redirect()->route('apprenant.dashboard');
    }

    return redirect('/')->with('error', 'Role non reconnu.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apprenant/dashboard', [ApprenantController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'role:apprenant'])
    ->name('apprenant.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('role:administrateur')->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->middleware('role:administrateur')->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->middleware('role:administrateur')->name('admin.create-user');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->middleware('role:administrateur')->name('admin.store-user');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->middleware('role:administrateur')->name('admin.edit-user');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->middleware('role:administrateur')->name('admin.update-user');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->middleware('role:administrateur')->name('admin.delete-user');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->middleware('role:administrateur')->name('admin.settings');

    // Admin trainings and sessions
    Route::get('/admin/formations', [AdminController::class, 'formations'])->middleware('role:administrateur')->name('admin.formations');
    Route::get('/admin/formations/create', [AdminController::class, 'createFormation'])->middleware('role:administrateur')->name('admin.create-formation');
    Route::post('/admin/formations', [AdminController::class, 'storeFormation'])->middleware('role:administrateur')->name('admin.store-formation');
    Route::get('/admin/formations/{id}/edit', [AdminController::class, 'editFormation'])->middleware('role:administrateur')->name('admin.edit-formation');
    Route::put('/admin/formations/{id}', [AdminController::class, 'updateFormation'])->middleware('role:administrateur')->name('admin.update-formation');
    Route::delete('/admin/formations/{id}', [AdminController::class, 'deleteFormation'])->middleware('role:administrateur')->name('admin.delete-formation');

    Route::get('/admin/sessions', [AdminController::class, 'sessions'])->middleware('role:administrateur')->name('admin.sessions');
    Route::get('/admin/sessions/create', [AdminController::class, 'createSession'])->middleware('role:administrateur')->name('admin.create-session');
    Route::post('/admin/sessions', [AdminController::class, 'storeSession'])->middleware('role:administrateur')->name('admin.store-session');
    Route::get('/admin/sessions/{id}/edit', [AdminController::class, 'editSession'])->middleware('role:administrateur')->name('admin.edit-session');
    Route::put('/admin/sessions/{id}', [AdminController::class, 'updateSession'])->middleware('role:administrateur')->name('admin.update-session');
    Route::delete('/admin/sessions/{id}', [AdminController::class, 'deleteSession'])->middleware('role:administrateur')->name('admin.delete-session');

    Route::get('/formateur/dashboard', [FormateurController::class, 'dashboard'])->middleware('role:formateur')->name('formateur.dashboard');
    Route::get('/formateur/courses', [FormateurController::class, 'courses'])->middleware('role:formateur')->name('formateur.courses');
    Route::get('/formateur/students', [FormateurController::class, 'students'])->middleware('role:formateur')->name('formateur.students');
    Route::get('/formateur/materials', [FormateurController::class, 'materials'])->middleware('role:formateur')->name('formateur.materials');

    Route::get('/apprenant/dashboard', [ApprenantController::class, 'dashboard'])->middleware('role:apprenant')->name('apprenant.dashboard');
    Route::get('/apprenant/courses', [ApprenantController::class, 'courses'])->middleware('role:apprenant')->name('apprenant.courses');
    Route::get('/apprenant/progress', [ApprenantController::class, 'progress'])->middleware('role:apprenant')->name('apprenant.progress');
    Route::get('/apprenant/materials', [ApprenantController::class, 'materials'])->middleware('role:apprenant')->name('apprenant.materials');
    Route::get('/apprenant/inscriptions', [ApprenantController::class, 'inscriptions'])->middleware('role:apprenant')->name('apprenant.inscriptions');
    Route::post('/apprenant/inscrire', [ApprenantController::class, 'inscrire'])->middleware('role:apprenant')->name('apprenant.inscrire');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
