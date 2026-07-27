<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaLoginController extends Controller
{
    /**
     * Menampilkan halaman login anggota
     */
    public function create()
    {
        return view('auth.login-anggota');
    }

    /**
     * Proses login anggota
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Nanti kita isi proses login Guru & Siswa di sini

        return back()->with(
            'success',
            'Halaman Login Anggota berhasil dibuat. Selanjutnya kita akan membuat proses login menggunakan NIP/NIS.'
        );
    }
}