<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;

use App\Http\Controllers\JadwalAdzanController;
use App\Http\Controllers\JadwalPiketController;

use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AnggotaController;

use App\Http\Controllers\JadwalImamController;
use App\Http\Controllers\JadwalJumatController;

use App\Http\Controllers\Auth\AnggotaLoginController;

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
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    // Data Guru
    Route::resource('guru', GuruController::class);



    // Data Siswa
    Route::resource('siswa', SiswaController::class);



    // Data Anggota
    Route::resource('anggota', AnggotaController::class);



    // Data Pengurus DKM
    Route::resource('pengurus', PengurusController::class);



    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class);



    Route::patch(
        '/pengumuman/{pengumuman}/toggle-status',
        [PengumumanController::class,'toggleStatus']
    )
    ->name('pengumuman.toggleStatus');



    // Jadwal Imam Dzuhur Ashar + Jumat
    Route::resource(
        'jadwal-imam',
        JadwalImamController::class
    );



    // Jadwal Jumat
    Route::resource(
        'jadwal-jumat',
        JadwalJumatController::class
    );



    // Jadwal Adzan
    Route::resource(
        'jadwal-adzan',
        JadwalAdzanController::class
    );



    // Jadwal Piket Kebersihan
    Route::resource(
        'jadwal-piket',
        JadwalPiketController::class
    );



    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class,'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class,'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class,'destroy'])
        ->name('profile.destroy');



});



require __DIR__.'/auth.php';