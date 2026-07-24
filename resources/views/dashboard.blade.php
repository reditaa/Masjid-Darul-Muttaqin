<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin DKM
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-green-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Pengurus DKM</h3>
                    <p class="text-4xl mt-3">{{ $totalPengurus ?? 0 }}</p>
                </div>

                <div class="bg-blue-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Pengumuman</h3>
                    <p class="text-4xl mt-3">{{ $totalPengumuman ?? 0 }}</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Inventaris</h3>
                    <p class="text-4xl mt-3">{{ $totalInventaris ?? 0 }}</p>
                </div>

                <div class="bg-red-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Presensi Hari Ini</h3>
                    <p class="text-4xl mt-3">{{ $totalPresensi ?? 0 }}</p>
                </div>

            </div>

            <div class="mt-8 bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4">
                    Selamat Datang
                </h3>

                <p>
                    Selamat datang di Sistem Informasi Masjid Darul Muttaqin.
                    Gunakan menu yang tersedia untuk mengelola data masjid,
                    jadwal imam, jadwal bilal, jadwal piket, presensi,
                    inventaris, kegiatan, keuangan, dan pengumuman.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>