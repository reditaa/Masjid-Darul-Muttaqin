<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;

use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN (guard: web)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth:web', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN AREA (guard: web only)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:web')->group(function () {

    // Data Pengurus DKM
    Route::resource('pengurus', PengurusController::class)
    ->parameters(['pengurus' => 'pengurus']);

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    Route::patch(
        '/pengumuman/{pengumuman}/toggle-status',
        [PengumumanController::class, 'toggleStatus']
    )->name('pengumuman.toggleStatus');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';