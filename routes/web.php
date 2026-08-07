<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\JadwalImamMuazinController;
use App\Http\Controllers\JadwalBilalController;
use App\Http\Controllers\JadwalPiketKebersihanController;
use App\Http\Controllers\KegiatanController;

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

    // Jadwal Imam & Muazin
    Route::resource('jadwal-imam-muazin', JadwalImamMuazinController::class)
        ->parameters(['jadwal-imam-muazin' => 'jadwal_imam_muazin']);
        // Jadwal Bilal
    Route::resource('jadwal-bilal', JadwalBilalController::class);

    // Jadwal Piket Kebersihan
    Route::resource('jadwal-piket-kebersihan', JadwalPiketKebersihanController::class)
        ->parameters(['jadwal-piket-kebersihan' => 'jadwal_piket_kebersihan']);


        // Kegiatan (Kalender & Riwayat)
    Route::resource('kegiatan', KegiatanController::class);
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