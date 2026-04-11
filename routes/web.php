<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InscriptionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/courses', [FrontController::class, 'courses'])->name('courses');
Route::get('/courses/{id}', [FrontController::class, 'courseDetail'])->name('course.detail');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontController::class, 'storeContact'])->name('contact.store');
Route::get('/instructor/{id}', [FrontController::class, 'instructor'])->name('instructor');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
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

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:administrateur')->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Users
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.create-user');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.store-user');
        Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

        Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

        // Formations
        Route::get('/admin/formations', [AdminController::class, 'formations'])->name('admin.formations');
        Route::get('/admin/formations/create', [AdminController::class, 'createFormation'])->name('admin.create-formation');
        Route::post('/admin/formations', [AdminController::class, 'storeFormation'])->name('admin.store-formation');
        Route::get('/admin/formations/{id}/edit', [AdminController::class, 'editFormation'])->name('admin.edit-formation');
        Route::put('/admin/formations/{id}', [AdminController::class, 'updateFormation'])->name('admin.update-formation');
        Route::delete('/admin/formations/{id}', [AdminController::class, 'deleteFormation'])->name('admin.delete-formation');

        // Sessions
        Route::get('/admin/sessions', [AdminController::class, 'sessions'])->name('admin.sessions');
        Route::get('/admin/sessions/create', [AdminController::class, 'createSession'])->name('admin.create-session');
        Route::post('/admin/sessions', [AdminController::class, 'storeSession'])->name('admin.store-session');
        Route::get('/admin/sessions/{id}/edit', [AdminController::class, 'editSession'])->name('admin.edit-session');
        Route::put('/admin/sessions/{id}', [AdminController::class, 'updateSession'])->name('admin.update-session');
        Route::delete('/admin/sessions/{id}', [AdminController::class, 'deleteSession'])->name('admin.delete-session');

        // Inscriptions
        Route::get('/admin/inscriptions', [AdminController::class, 'inscriptions'])->name('admin.inscriptions');
        Route::patch('/admin/inscriptions/{id}/valider', [InscriptionController::class, 'valider'])->name('admin.inscriptions.valider');
        Route::patch('/admin/inscriptions/{id}/refuser', [InscriptionController::class, 'refuser'])->name('admin.inscriptions.refuser');
        Route::patch('/admin/inscriptions/{id}/payer', [InscriptionController::class, 'marquerPayee'])->name('admin.inscriptions.payer');

    });

    /*
    |--------------------------------------------------------------------------
    | Formateur Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:formateur')->group(function () {

        Route::get('/formateur/dashboard', [FormateurController::class, 'dashboard'])->name('formateur.dashboard');
        Route::get('/formateur/courses', [FormateurController::class, 'courses'])->name('formateur.courses');
        Route::get('/formateur/courses/{id}', [FormateurController::class, 'show'])->name('formateur.courses.show');
        Route::get('/formateur/students', [FormateurController::class, 'students'])->name('formateur.students');
        Route::get('/formateur/materials', [FormateurController::class, 'materials'])->name('formateur.materials');

    });

    /*
    |--------------------------------------------------------------------------
    | Apprenant Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:apprenant')->group(function () {

        Route::get('/apprenant/dashboard', [ApprenantController::class, 'dashboard'])->name('apprenant.dashboard');
        Route::get('/apprenant/courses', [ApprenantController::class, 'courses'])->name('apprenant.courses');
        Route::get('/apprenant/progress', [ApprenantController::class, 'progress'])->name('apprenant.progress');
        Route::get('/apprenant/materials', [ApprenantController::class, 'materials'])->name('apprenant.materials');
        Route::get('/apprenant/inscriptions', [ApprenantController::class, 'inscriptions'])->name('apprenant.inscriptions');

        Route::post('/apprenant/inscrire', [InscriptionController::class, 'inscrire'])->name('apprenant.inscrire');
        Route::delete('/apprenant/inscription/{id}', [InscriptionController::class, 'annuler'])->name('apprenant.cancel');

    });

    /*
    |--------------------------------------------------------------------------
    | General Authenticated Routes (for all user types)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        // Notifications (accessible to all authenticated users)
        Route::patch('/notifications/{id}/read', [ApprenantController::class, 'markNotificationRead'])->name('notifications.read');
        Route::patch('/notifications/mark-all-read', [ApprenantController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');
    });

});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';