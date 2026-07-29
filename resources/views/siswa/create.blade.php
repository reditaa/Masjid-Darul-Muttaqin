<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Data Siswa
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('siswa.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Foto
                        </label>

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
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="w-full border rounded p-2"></textarea>
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
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Simpan

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