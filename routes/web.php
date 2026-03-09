<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/formateur/dashboard', function () {
    return view('formateur.dashboard');
})->middleware(['auth', 'verified'])->name('formateur.dashboard');

Route::get('/apprenant/dashboard', function () {
    return view('apprenant.dashboard');
})->middleware(['auth', 'verified'])->name('apprenant.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
