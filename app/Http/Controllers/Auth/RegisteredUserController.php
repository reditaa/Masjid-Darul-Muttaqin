<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $pengurus = Pengurus::whereNull('user_id')
            ->orderBy('nama')
            ->get();

        return view('auth.register', compact('pengurus'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pengurus_id' => ['required', 'exists:pengurus,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pengurus = Pengurus::whereNull('user_id')->findOrFail($request->pengurus_id);

        $user = User::create([
            'name' => $pengurus->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        $pengurus->update(['user_id' => $user->id]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('anggota.dashboard', absolute: false));
    }
}