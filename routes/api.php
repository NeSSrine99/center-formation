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
    // GET all formations
    Route::get('/', [FormationController::class, 'index'])->name('formations.index');

    // GET formation by ID
    Route::get('/{id}', [FormationController::class, 'show'])->name('formations.show');

    // POST create new formation
    Route::post('/', [FormationController::class, 'store'])->name('formations.store');

    // PUT update formation
    Route::put('/{id}', [FormationController::class, 'update'])->name('formations.update');

    // DELETE formation
    Route::delete('/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');
});

/*
    ╔════════════════════════════════════════════════════════════════════╗
    ║  Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    ║      return $request->user();
    ║  });
    ╚════════════════════════════════════════════════════════════════════╝
*/
