<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengurus DKM
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('pengurus.update', $penguru->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="font-semibold">Foto Pengurus</label>

                        @if($penguru->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$penguru->foto) }}"
                                     class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif

                        <input type="file"
                               name="foto"
                               class="w-full border rounded p-2"
                               accept="image/*">
                    </div>

                    <div class="mb-4">
                        <label>Nama</label>
                        <input type="text"
                               name="nama"
                               class="w-full border rounded p-2"
                               value="{{ old('nama', $penguru->nama) }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Jabatan</label>
                        <input type="text"
                               name="jabatan"
                               class="w-full border rounded p-2"
                               value="{{ old('jabatan', $penguru->jabatan) }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>No HP</label>
                        <input type="text"
                               name="no_hp"
                               class="w-full border rounded p-2"
                               value="{{ old('no_hp', $penguru->no_hp) }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Alamat</label>
                        <textarea name="alamat"
                                  class="w-full border rounded p-2">{{ old('alamat', $penguru->alamat) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label>Mulai Jabatan</label>
                        <input type="date"
                               name="mulai_jabatan"
                               class="w-full border rounded p-2"
                               value="{{ old('mulai_jabatan', $penguru->mulai_jabatan) }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Selesai Jabatan</label>
                        <input type="date"
                               name="selesai_jabatan"
                               class="w-full border rounded p-2"
                               value="{{ old('selesai_jabatan', $penguru->selesai_jabatan) }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Status</label>

                        <select name="status" class="w-full border rounded p-2">
                            <option value="Aktif" {{ $penguru->status == 'Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="Nonaktif" {{ $penguru->status == 'Nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                        Update
                    </button>

                    <a href="{{ route('pengurus.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                        Kembali
                    </a>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>