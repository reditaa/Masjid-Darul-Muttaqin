<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Tambah Guru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow">

                <form
                    action="{{ route('guru.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">NIP</label>

                        <input
                            type="text"
                            name="nip"
                            value="{{ old('nip') }}"
                            class="w-full border rounded-lg p-2">

                        @error('nip')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Nama</label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            class="w-full border rounded-lg p-2">

                        @error('nama')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full border rounded-lg p-2">

                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Password</label>

                        <input
                            type="password"
                            name="password"
                            class="w-full border rounded-lg p-2">

                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">No HP</label>

                        <input
                            type="text"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            class="w-full border rounded-lg p-2">

                        @error('no_hp')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Alamat</label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="w-full border rounded-lg p-2">{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Status</label>

                        <select
                            name="status"
                            class="w-full border rounded-lg p-2">

                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>

                        </select>

                        @error('status')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Foto</label>

                        <input
                            type="file"
                            name="foto"
                            accept="image/*"
                            class="w-full border rounded-lg p-2">

                        @error('foto')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg font-semibold">
                        Simpan
                    </button>

                    <a href="{{ route('guru.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                        Kembali
                    </a>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>