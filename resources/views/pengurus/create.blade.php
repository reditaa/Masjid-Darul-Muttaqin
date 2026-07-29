<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Pengurus DKM
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('pengurus.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Pilih Anggota
                        </label>

                        <select name="anggota_id"
                            class="w-full border rounded p-2"
                            required>

                            <option value="">
                                -- Pilih Anggota --
                            </option>

                           @foreach($anggota as $item)

    <option value="{{ $item->id }}">

        @if($item->jenis == 'Guru')

            {{ $item->guru->nama }}
            | {{ $item->guru->nip }}
            | Guru

        @else

            {{ $item->siswa->nama }}
            | {{ $item->siswa->nis }}
            | Siswa

        @endif

    </option>

@endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Jabatan
                        </label>

                        <input
                            type="text"
                            name="jabatan"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Mulai Jabatan
                        </label>

                        <input
                            type="date"
                            name="mulai_jabatan"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Selesai Jabatan
                        </label>

                        <input
                            type="date"
                            name="selesai_jabatan"
                            class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded p-2">

                            <option value="Aktif">
                                Aktif
                            </option>

                            <option value="Nonaktif">
                                Nonaktif
                            </option>

                        </select>
                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

                            Simpan

                        </button>

                        <a href="{{ route('pengurus.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>