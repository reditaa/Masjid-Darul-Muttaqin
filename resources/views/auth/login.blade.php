<x-guest-layout>

<style>
    .login-shell {
        background-image: linear-gradient(120deg, rgba(5, 36, 25, 0.84), rgba(11, 86, 60, 0.56)), url('{{ asset('images/masjid-login-bg.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    .login-panel {
        box-shadow: 0 24px 70px rgba(3, 26, 18, 0.28);
    }

    .login-field::placeholder {
        color: rgb(100 116 139);
    }
</style>

<div class="login-shell min-h-screen relative flex items-center justify-center px-4 py-8 sm:py-12">

    <div class="w-full max-w-md">

        <div class="login-panel overflow-hidden rounded-3xl border border-white/50 bg-white/95">
            <div class="h-1.5 bg-emerald-600"></div>
            <div class="p-7 sm:p-9">

                <div class="text-center mb-7">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-emerald-50 ring-8 ring-emerald-50/70">
                        <img src="{{ asset('images/logo-irmas.jpeg') }}" alt="Logo SIMADI" class="h-full w-full object-cover">
                    </div>

                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700">SIMADI</p>

                    <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        Selamat datang kembali
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Masuk untuk mengelola administrasi masjid.
                    </p>
                </div>

                <x-auth-session-status
                    class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800"
                    :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">

                    @csrf

                    <div>
                        <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                        <div class="relative mt-2">
                            <i class="fas fa-envelope pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="login-field w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-emerald-500">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
                    </div>

                    <div>
                        <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative mt-2">
                            <i class="fas fa-lock pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="login-field w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-emerald-500">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
                    </div>

                    <label class="flex cursor-pointer items-center gap-3">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="text-sm text-slate-600">Ingat saya di perangkat ini</span>
                    </label>

                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-900/15 transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-right-to-bracket"></i>
                        Masuk ke SIMADI
                    </button>

                </form>

                <p class="mt-7 text-center text-xs text-slate-400">Sistem Informasi Masjid Darul Muttaqin</p>
            </div>
        </div>

    </div>

</div>

</x-guest-layout>