<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Tambah Jadwal Piket
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                <form action="{{ route('jadwal-piket.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Hari</label>

                        <select
                            name="hari"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Hari --</option>

                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach

                        </select>

                        @error('hari')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Koordinator</label>

                        <select
                            name="koordinator_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Koordinator --</option>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}" {{ old('koordinator_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Anggota 1</label>

                        <select
                            name="anggota1_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Anggota --</option>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}" {{ old('anggota1_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Anggota 2</label>

                        <select
                            name="anggota2_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Anggota --</option>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}" {{ old('anggota2_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Anggota 3</label>

                        <select
                            name="anggota3_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Anggota --</option>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}" {{ old('anggota3_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Anggota 4</label>

                        <select
                            name="anggota4_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            <option value="">-- Pilih Anggota --</option>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}" {{ old('anggota4_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Keterangan</label>

                        <textarea
                            name="keterangan"
                            rows="4"
                            class="w-full border rounded-lg p-2">{{ old('keterangan') }}</textarea>
                    </div>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        Simpan
                    </button>

                    <a href="{{ route('jadwal-piket.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                        Kembali
                    </a>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>