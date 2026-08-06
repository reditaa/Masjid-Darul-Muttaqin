<x-guest-layout>

<div class="min-h-screen flex">

    {{-- Kiri --}}
    <div class="hidden lg:flex lg:w-1/2 relative">

        <img
            src="https://images.unsplash.com/photo-1519817650390-64a93db511aa?q=80&w=1600&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-green-900/70"></div>

        <div class="relative z-10 flex flex-col justify-center px-16 text-white">

            <i class="fas fa-mosque text-7xl mb-8"></i>

            <h1 class="text-5xl font-bold">
                SIMADI
            </h1>

            <p class="text-2xl mt-3">
                Sistem Informasi Masjid
            </p>

            <p class="mt-8 text-lg leading-8 text-green-100">
                Kelola Pengurus DKM, Jadwal Imam & Muazin, Jadwal Bilal,
                Jadwal Piket Kebersihan, Pengumuman, Galeri, Inventaris,
                Keuangan, dan seluruh kegiatan masjid dalam satu sistem.
            </p>

        </div>

    </div>

    {{-- Kanan --}}
    <div class="flex-1 flex items-center justify-center bg-gradient-to-br from-green-50 to-white p-6">

        <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-10">

            <div class="text-center mb-6">

                <div class="mx-auto w-20 h-20 rounded-full bg-green-700 flex items-center justify-center text-white text-3xl">
                    <i class="fas fa-mosque"></i>
                </div>

                <h2 class="text-3xl font-bold mt-5">
                    Login SIMADI
                </h2>

                <p class="text-gray-500 mt-2">
                    Selamat datang kembali 👋
                </p>

            </div>

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">

                @csrf

                <div>
                    <label class="font-medium">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div>
                    <label class="font-medium">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <label class="flex items-center gap-3">
                    <input type="checkbox" name="remember" class="rounded text-green-700">
                    <span class="text-gray-600">Remember Me</span>
                </label>

                <button
                    class="w-full bg-green-700 hover:bg-green-800 transition rounded-xl py-3 text-white font-bold">
                    <i class="fas fa-right-to-bracket mr-2"></i>
                    LOGIN
                </button>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>