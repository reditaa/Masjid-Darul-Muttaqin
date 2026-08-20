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
use App\Http\Controllers\Auth\SipintuAuthController;
use App\Http\Controllers\SipintuController;
use App\Http\Controllers\JadwalJumatController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilMasjidController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');
    
    /*
|--------------------------------------------------------------------------
| LOGIN VIA SIPINTU (OAuth SSO)
|--------------------------------------------------------------------------
*/

Route::get('/login/sipintu', [SipintuAuthController::class, 'redirect'])
    ->name('sipintu.redirect');

Route::get('/login/sipintu/callback', [SipintuAuthController::class, 'callback'])
    ->name('sipintu.callback');

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
    Route::post('/pengurus/sync-sipintu', [PengurusController::class, 'syncSipintu'])
        ->name('pengurus.syncSipintu');

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

        
    // Jadwal Jumat
    Route::resource('jadwal-jumat', JadwalJumatController::class)
        ->parameters(['jadwal-jumat' => 'jadwal_jumat']);
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

    // Data SiPintu (Bukan Anggota)
    Route::get('/sipintu-data', [SipintuController::class, 'dataIndex'])
        ->name('sipintu.data');

    // Pencarian SiPintu (dipakai di form Jadwal Imam/Muazin, Bilal, Piket)
    Route::get('/sipintu/cari', [SipintuController::class, 'cari'])
        ->name('sipintu.cari');

    Route::post('/sipintu/simpan-atau-ambil', [SipintuController::class, 'simpanAtauAmbil'])
        ->name('sipintu.simpanAtauAmbil');


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

    // Profil Masjid (Landing Page Settings)
    Route::get('/profil-masjid', [ProfilMasjidController::class, 'edit'])
        ->name('profil-masjid.edit');
    Route::put('/profil-masjid', [ProfilMasjidController::class, 'update'])
        ->name('profil-masjid.update');

});

/*
|--------------------------------------------------------------------------
| PUBLIC PENGUMUMAN DETAIL
|--------------------------------------------------------------------------
*/

Route::get('/pengumuman/{pengumuman:slug}', [PengumumanController::class, 'showPublic'])
    ->name('pengumuman.public');

require __DIR__.'/auth.php';