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
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\AnggotaDashboardController;
use App\Http\Controllers\AnggotaPresensiController;
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
| AREA ANGGOTA (role: anggota)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:web', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {

    Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/presensi', [AnggotaPresensiController::class, 'store'])
        ->name('presensi.store');

});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (guard: web only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:web', 'role:admin'])->group(function () {

    // Data Pengurus DKM
    Route::resource('pengurus', PengurusController::class)
    ->parameters(['pengurus' => 'pengurus']);

    Route::post('/pengurus/{pengurus}/buat-akun', [PengurusController::class, 'buatAkun'])
        ->name('pengurus.buatAkun');

    Route::delete('/pengurus/{pengurus}/hapus-akun', [PengurusController::class, 'hapusAkun'])
        ->name('pengurus.hapusAkun');

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

    // Galeri
    Route::resource('galeri', GaleriController::class);

    // Inventaris
    Route::resource('inventaris', InventarisController::class)
        ->parameters(['inventaris' => 'inventaris']);

        // Keuangan
    Route::resource('keuangan', KeuanganController::class);

    // Presensi
    Route::resource('presensi', PresensiController::class)
        ->except(['show', 'edit', 'update']);


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