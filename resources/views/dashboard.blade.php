<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard Masjid Darul Muttaqin
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold mb-8">
                Selamat Datang 👋
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Pengurus -->
                <div class="bg-blue-600 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">👥 Pengurus</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalPengurus }}
                    </p>

                    <a href="{{ route('pengurus.index') }}"
                        class="inline-block mt-5 bg-white text-blue-600 px-4 py-2 rounded font-semibold">

                        Kelola

                    </a>
                </div>

                <!-- Pengumuman -->
                <div class="bg-green-600 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">📢 Pengumuman</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalPengumuman }}
                    </p>

                    <a href="{{ route('pengumuman.index') }}"
                        class="inline-block mt-5 bg-white text-green-600 px-4 py-2 rounded font-semibold">

                        Kelola

                    </a>
                </div>

                <!-- Imam -->
                <div class="bg-purple-600 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">🕌 Jadwal Imam</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalImam }}
                    </p>

                    <button class="mt-5 bg-white text-purple-600 px-4 py-2 rounded font-semibold">

                        Segera Hadir

                    </button>
                </div>

                <!-- Muazin -->
                <div class="bg-orange-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">🎤 Jadwal Muazin</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalMuazin }}
                    </p>

                    <button class="mt-5 bg-white text-orange-500 px-4 py-2 rounded font-semibold">

                        Segera Hadir

                    </button>
                </div>

                <!-- Piket -->
                <div class="bg-red-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">🧹 Jadwal Piket</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalPiket }}
                    </p>

                    <button class="mt-5 bg-white text-red-500 px-4 py-2 rounded font-semibold">

                        Segera Hadir

                    </button>
                </div>

                <!-- Inventaris -->
                <div class="bg-gray-700 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">📦 Inventaris</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalInventaris }}
                    </p>

                    <button class="mt-5 bg-white text-gray-700 px-4 py-2 rounded font-semibold">

                        Segera Hadir

                    </button>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>