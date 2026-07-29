<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Data Siswa
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('siswa.update', $siswa->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Foto
                        </label>

                        @if($siswa->foto)

                            <img
                                src="{{ asset('storage/'.$siswa->foto) }}"
                                class="w-24 h-24 rounded-full object-cover mb-3">

                        @endif

                        <input
                            type="file"
                            name="foto"
                            class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            value="{{ old('nis',$siswa->nis) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama',$siswa->nama) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Kelas
                        </label>

                        <input
                            type="text"
                            name="kelas"
                            value="{{ old('kelas',$siswa->kelas) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$siswa->email) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full border rounded p-2">

                        <small class="text-gray-500">
                            Kosongkan jika password tidak ingin diubah.
                        </small>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            value="{{ old('no_hp',$siswa->no_hp) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="w-full border rounded p-2">{{ old('alamat',$siswa->alamat) }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded p-2">

                            <option value="Aktif"
                                {{ $siswa->status=='Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="Nonaktif"
                                {{ $siswa->status=='Nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>

                    <div class="flex gap-2">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Update

                        </button>

                        <a href="{{ route('siswa.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>