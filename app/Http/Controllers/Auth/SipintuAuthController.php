<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SipintuApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SipintuAuthController extends Controller
{
    public function __construct(protected SipintuApiService $sipintu)
    {
    }

    public function redirect(Request $request)
    {
        $state = Str::random(40);
        session(['sipintu_oauth_state' => $state]);

        $redirectUri = route('sipintu.callback');
        $url = $this->sipintu->getAuthorizationUrl($redirectUri, $state);

        return redirect()->away($url);
    }

    public function callback(Request $request)
    {
        if ($request->query('state') !== session('sipintu_oauth_state')) {
            return redirect()->route('login')->with('error', 'Sesi login tidak valid, silakan coba lagi.');
        }

        if (! $request->has('code')) {
            return redirect()->route('login')->with('error', 'Login via SiPintu dibatalkan atau gagal.');
        }

        $redirectUri = route('sipintu.callback');
        $tokenResult = $this->sipintu->exchangeAuthorizationCode($request->query('code'), $redirectUri);

        if (! $tokenResult['success'] || empty($tokenResult['data']['access_token'])) {
            return redirect()->route('login')->with('error', 'Gagal mengambil token dari SiPintu.');
        }

        $profileResult = $this->sipintu->getUserProfile($tokenResult['data']['access_token']);

        if (! $profileResult['success'] || empty($profileResult['data']['email'])) {
            return redirect()->route('login')->with('error', 'Gagal mengambil data profil dari SiPintu.');
        }

        $profile = $profileResult['data'];

        $user = User::firstOrCreate(
            ['email' => $profile['email']],
            [
                'name'     => $profile['name'] ?? $profile['email'],
                'password' => bcrypt(Str::random(32)),
                'role'     => 'anggota',
            ]
        );

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended(route('anggota.dashboard'));
    }
}