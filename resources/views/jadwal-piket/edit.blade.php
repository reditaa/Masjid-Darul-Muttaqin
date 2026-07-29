<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Jadwal Piket
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('jadwal-piket.update',$jadwalPiket->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal',$jadwalPiket->tanggal) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Koordinator
                        </label>

                        <select
                            name="koordinator_id"
                            class="w-full border rounded p-2"
                            required>

                            @foreach($pengurus as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $jadwalPiket->koordinator_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama }}
                                    ({{ $item->anggota->jenis }})
                                    - {{ $item->jabatan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Anggota 1
                        </label>

                        <select
                            name="anggota1_id"
                            class="w-full border rounded p-2"
                            required>

                            @foreach($pengurus as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $jadwalPiket->anggota1_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama }}
                                    ({{ $item->anggota->jenis }})
                                    - {{ $item->jabatan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Keterangan
                        </label>

                        <textarea
                            name="keterangan"
                            class="w-full border rounded p-2"
                            rows="4">{{ old('keterangan',$jadwalPiket->keterangan) }}</textarea>

                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Update

                        </button>

                        <a href="{{ route('jadwal-piket.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>