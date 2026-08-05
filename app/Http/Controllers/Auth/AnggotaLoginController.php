<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnggotaLoginController extends Controller
{
    /**
     * Menampilkan halaman login anggota
     */
    public function create(): View
    {
        return view('auth.login-anggota');
    }

    /**
     * Proses login anggota
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('anggota')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('anggota.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email', 'login_type'));
    }

    /**
     * Logout anggota
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('anggota')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('anggota.login');
    }
}