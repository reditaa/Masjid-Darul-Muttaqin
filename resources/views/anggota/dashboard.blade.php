<x-anggota-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Dashboard Anggota
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="bg-white p-6 rounded-lg shadow">

            <h3 class="text-lg font-bold mb-2">
                Selamat datang, {{ $anggota->nama }} 👋
            </h3>

            <p class="text-gray-600 mb-1">
                Jenis: {{ $anggota->jenis }}
            </p>

            <p class="text-gray-600 mb-1">
                Email: {{ $anggota->email }}
            </p>

            <p class="text-gray-600">
                Status: {{ $anggota->status }}
            </p>

        </div>

    </div>

</x-anggota-layout>