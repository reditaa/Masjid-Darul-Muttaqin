<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\JadwalAdzanController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\Auth\AnggotaLoginController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\JadwalImamController;
// 1. TAMBAHKAN IMPORT LANDING CONTROLLER DI SINI
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE (HALAMAN UTAMA)
|--------------------------------------------------------------------------
*/
// 2. UBAH ROUTE '/' YANG LAMA MENJADI INI:
Route::get('/', [LandingController::class, 'index'])->name('landing');


/*
|--------------------------------------------------------------------------
| LOGIN ANGGOTA
|--------------------------------------------------------------------------
*/

Route::get('/login-anggota', [AnggotaLoginController::class, 'create'])
    ->name('anggota.login');

Route::post('/login-anggota', [AnggotaLoginController::class, 'store'])
    ->name('anggota.login.store');

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('guru', GuruController::class);

    Route::resource('pengurus', PengurusController::class);

    Route::resource('pengumuman', PengumumanController::class);

    Route::resource('siswa', SiswaController::class);

    Route::resource('anggota', AnggotaController::class);

    Route::patch('/pengumuman/{pengumuman}/toggle-status',
        [PengumumanController::class, 'toggleStatus'])
        ->name('pengumuman.toggleStatus');

    Route::resource('jadwal-adzan', JadwalAdzanController::class);

    Route::resource('jadwal-piket', JadwalPiketController::class);

    Route::resource('jadwal-imam', JadwalImamController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';