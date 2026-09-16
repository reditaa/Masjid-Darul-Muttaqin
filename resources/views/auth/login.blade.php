<x-guest-layout>

<style>
    html {
        font-size: 80%;
    }
</style>

<div class="min-h-screen relative flex items-center justify-center px-4 py-10"
     style="background-image: linear-gradient(rgba(6, 40, 24, 0.65), rgba(6, 40, 24, 0.75)), url('{{ asset('images/masjid-login-bg.jpg') }}'); background-size: cover; background-position: center;">

    <div class="w-full max-w-sm">

        <div class="bg-white/15 backdrop-blur-xl border border-white/25 w-full rounded-3xl shadow-2xl p-7 sm:p-8">

            <div class="text-center mb-5">

                <div class="mx-auto w-14 h-14 rounded-full bg-white/20 backdrop-blur border border-white/30 flex items-center justify-center text-white text-xl">
                    <i class="fas fa-mosque"></i>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold mt-4 text-white">
                    Login SIMADI
                </h2>

                <p class="text-green-100 mt-1 text-sm">
                    Selamat datang kembali 👋
                </p>

            </div>

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">

                @csrf

                <div>
                    <label class="font-medium text-white text-sm">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="mt-1.5 w-full text-sm py-2.5 rounded-xl border-white/30 bg-white/10 text-white placeholder-white/60 backdrop-blur focus:ring-green-400 focus:border-green-400">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div>
                    <label class="font-medium text-white text-sm">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="mt-1.5 w-full text-sm py-2.5 rounded-xl border-white/30 bg-white/10 text-white placeholder-white/60 backdrop-blur focus:ring-green-400 focus:border-green-400">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <label class="flex items-center gap-2.5">
                    <input type="checkbox" name="remember" class="rounded text-green-700">
                    <span class="text-green-50 text-sm">Remember Me</span>
                </label>

                <button
                    class="w-full bg-green-700/90 hover:bg-green-800 transition rounded-xl py-2.5 text-sm text-white font-bold backdrop-blur">
                    <i class="fas fa-right-to-bracket mr-2"></i>
                    LOGIN
                </button>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>