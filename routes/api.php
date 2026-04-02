<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormationController;

/*
    ╔════════════════════════════════════════════════════════════════════╗
    ║  FORMATIONS API ENDPOINTS — RESTful JSON API                       ║
    ╚════════════════════════════════════════════════════════════════════╝
*/

Route::prefix('formations')->group(function () {

    // Public 
    Route::get('/', [FormationController::class, 'index'])->name('formations.index');
    Route::get('/{id}', [FormationController::class, 'show'])->name('formations.show');

    // Protected - requires authentication and admin role
    Route::middleware(['auth:sanctum', 'role:administrateur'])->group(function () {
        Route::post('/', [FormationController::class, 'store'])->name('formations.store');
        Route::put('/{id}', [FormationController::class, 'update'])->name('formations.update');
        Route::delete('/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');
    });
});

/*
    ╔════════════════════════════════════════════════════════════════════╗
    ║  Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    ║      return $request->user();
    ║  });
    ╚════════════════════════════════════════════════════════════════════╝
*/
