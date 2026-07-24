<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pengurus DKM
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('pengurus.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label>Nama</label>
                        <input type="text" name="nama" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Alamat</label>
                        <textarea name="alamat" class="w-full border rounded p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label>Mulai Jabatan</label>
                        <input type="date" name="mulai_jabatan" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Selesai Jabatan</label>
                        <input type="date" name="selesai_jabatan" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Status</label>

                        <select name="status" class="w-full border rounded p-2">

                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>

                        </select>
                    </div>

                    <button class="bg-blue-600 text-white px-5 py-2 rounded">
                        Simpan
                    </button>

                    <a href="{{ route('pengurus.index') }}"
                       class="bg-gray-500 text-white px-5 py-2 rounded">

                        Kembali

                    </a>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>