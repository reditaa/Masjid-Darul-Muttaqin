<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                Dashboard
            </h2>

            <p class="text-sm md:text-base text-gray-500 mt-1">
                Selamat datang di Sistem Informasi Masjid Darul Muttaqin
            </p>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- Pengurus --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-blue-600">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Total Pengurus</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalPengurus }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-user-tie text-blue-600 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <a href="{{ route('pengurus.index') }}"
                class="inline-block mt-5 text-blue-600 font-semibold hover:underline">
                Kelola →
            </a>

        </div>

        {{-- Pengumuman --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-green-600">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Pengumuman</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalPengumuman }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-bullhorn text-green-600 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <a href="{{ route('pengumuman.index') }}"
                class="inline-block mt-5 text-green-600 font-semibold hover:underline">
                Kelola →
            </a>

        </div>

        {{-- Jadwal Imam --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-purple-600">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Jadwal Imam</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalImam }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-mosque text-purple-600 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <a href="{{ route('jadwal-imam.index') }}"
                class="inline-block mt-5 text-purple-600 font-semibold hover:underline">
                Kelola →
            </a>

        </div>

        {{-- Jadwal Piket --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-orange-500">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Jadwal Piket</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalPiket }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-broom text-orange-500 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <a href="{{ route('jadwal-piket.index') }}"
                class="inline-block mt-5 text-orange-500 font-semibold hover:underline">
                Kelola →
            </a>

        </div>

        {{-- Inventaris --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-red-500">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Inventaris</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalInventaris }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-box-open text-red-500 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <button class="mt-5 text-red-500 font-semibold">
                Segera Hadir
            </button>

        </div>

        {{-- Muazin --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 border-l-4 border-cyan-500">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Jadwal Muazin</p>
                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $totalMuazin }}
                    </h1>
                </div>

                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-cyan-100 flex items-center justify-center">
                    <i class="fas fa-microphone text-cyan-600 text-2xl md:text-3xl"></i>
                </div>

            </div>

            <button class="mt-5 text-cyan-600 font-semibold">
                Segera Hadir
            </button>

        </div>

    </div>

</x-app-layout>