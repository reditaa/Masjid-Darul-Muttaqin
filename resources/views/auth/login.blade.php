<x-guest-layout>

<div class="min-h-screen relative flex items-center justify-center px-4"
     style="background-image: linear-gradient(rgba(6, 40, 24, 0.65), rgba(6, 40, 24, 0.75)), url('{{ asset('images/masjid-login-bg.jpg') }}'); background-size: cover; background-position: center;">

    <div class="w-full max-w-md">

        <div class="bg-white/15 backdrop-blur-xl border border-white/25 w-full rounded-3xl shadow-2xl p-10">

            <div class="text-center mb-6">

                <div class="mx-auto w-20 h-20 rounded-full bg-white/20 backdrop-blur border border-white/30 flex items-center justify-center text-white text-3xl">
                    <i class="fas fa-mosque"></i>
                </div>

                <h2 class="text-3xl font-bold mt-5 text-white">
                    Login SIMADI
                </h2>

                <p class="text-green-100 mt-2">
                    Selamat datang kembali 👋
                </p>

            </div>

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">

                @csrf

                <div>
                    <label class="font-medium text-white">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-xl border-white/30 bg-white/10 text-white placeholder-white/60 backdrop-blur focus:ring-green-400 focus:border-green-400">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div>
                    <label class="font-medium text-white">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="mt-2 w-full rounded-xl border-white/30 bg-white/10 text-white placeholder-white/60 backdrop-blur focus:ring-green-400 focus:border-green-400">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <label class="flex items-center gap-3">
                    <input type="checkbox" name="remember" class="rounded text-green-700">
                    <span class="text-green-50">Remember Me</span>
                </label>

                <button
                    class="w-full bg-green-700/90 hover:bg-green-800 transition rounded-xl py-3 text-white font-bold backdrop-blur">
                    <i class="fas fa-right-to-bracket mr-2"></i>
                    LOGIN
                </button>

            </form>

            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-white/25"></div>
                <span class="text-xs text-white/70">ATAU</span>
                <div class="flex-1 h-px bg-white/25"></div>
            </div>

            <a href="{{ route('sipintu.redirect') }}"
               class="w-full flex items-center justify-center gap-2 border-2 border-white/40 text-white hover:bg-white/10 transition rounded-xl py-3 font-bold backdrop-blur">
                <i class="fas fa-school"></i>
                LOGIN VIA SIPINTU
            </a>

        </div>

    </div>

</div>

</x-guest-layout>