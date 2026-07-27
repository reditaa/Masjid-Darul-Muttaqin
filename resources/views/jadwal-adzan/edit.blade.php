<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Jadwal Piket
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                <form action="{{ route('jadwal-piket.update', $jadwalPiket->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Tanggal</label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal', $jadwalPiket->tanggal) }}"
                            class="w-full border rounded-lg p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Koordinator</label>

                        <select
                            name="koordinator_id"
                            class="w-full border rounded-lg p-2"
                            required>

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}"
                                    {{ $jadwalPiket->koordinator_id == $item->id ? 'selected' : '' }}>
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

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}"
                                    {{ $jadwalPiket->anggota1_id == $item->id ? 'selected' : '' }}>
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

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}"
                                    {{ $jadwalPiket->anggota2_id == $item->id ? 'selected' : '' }}>
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

                            @foreach($pengurus as $item)
                                <option value="{{ $item->id }}"
                                    {{ $jadwalPiket->anggota3_id == $item->id ? 'selected' : '' }}>
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
                            class="w-full border rounded-lg p-2">{{ old('keterangan', $jadwalPiket->keterangan) }}</textarea>
                    </div>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        Update
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