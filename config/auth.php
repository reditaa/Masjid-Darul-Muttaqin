<?php

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Anggota;

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [

        // ADMIN
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // GURU
        'guru' => [
            'driver' => 'session',
            'provider' => 'gurus',
        ],

        // SISWA
        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas',
        ],

        // ANGGOTA
        'anggota' => [
            'driver' => 'session',
            'provider' => 'anggotas',
        ],

    ],

    'providers' => [

        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],

        'gurus' => [
            'driver' => 'eloquent',
            'model' => Guru::class,
        ],

        'siswas' => [
            'driver' => 'eloquent',
            'model' => Siswa::class,
        ],

        'anggotas' => [
            'driver' => 'eloquent',
            'model' => Anggota::class,
        ],

    ],

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'gurus' => [
            'provider' => 'gurus',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'siswas' => [
            'provider' => 'siswas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'anggotas' => [
            'provider' => 'anggotas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],

    'password_timeout' => 10800,

];