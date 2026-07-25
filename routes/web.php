<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\JadwalAdzanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('pengurus', PengurusController::class);

    Route::resource('pengumuman', PengumumanController::class);

    Route::patch('/pengumuman/{pengumuman}/toggle-status',
        [PengumumanController::class, 'toggleStatus'])
        ->name('pengumuman.toggleStatus');

    Route::resource('jadwal-adzan', JadwalAdzanController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';