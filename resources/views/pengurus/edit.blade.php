<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Pengurus DKM
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('pengurus.update',$penguru->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Pilih Anggota
                        </label>

                        <select
                            name="anggota_id"
                            class="w-full border rounded p-2"
                            required>

                            @foreach($anggota as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $penguru->anggota_id==$item->id ? 'selected' : '' }}>

                                    @if($item->jenis=='Guru')

                                        {{ $item->guru->nama }} (Guru)

                                    @else

                                        {{ $item->siswa->nama }} (Siswa)

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
                            value="{{ old('jabatan',$penguru->jabatan) }}"
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
                            value="{{ old('mulai_jabatan',$penguru->mulai_jabatan) }}"
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
                            value="{{ old('selesai_jabatan',$penguru->selesai_jabatan) }}"
                            class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded p-2">

                            <option
                                value="Aktif"
                                {{ $penguru->status=='Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option
                                value="Nonaktif"
                                {{ $penguru->status=='Nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

                            Update

                        </button>

                        <a
                            href="{{ route('pengurus.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>