<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Jadwal Imam
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('jadwal-imam.update',$jadwalImam->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal',$jadwalImam->tanggal) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Pilih Imam
                        </label>

                        <select
                            name="imam_id"
                            class="w-full border rounded p-2"
                            required>

                            @foreach($pengurus as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $jadwalImam->imam_id == $item->id ? 'selected' : '' }}>

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
                            rows="4"
                            class="w-full border rounded p-2">{{ old('keterangan',$jadwalImam->keterangan) }}</textarea>

                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Update

                        </button>

                        <a href="{{ route('jadwal-imam.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>