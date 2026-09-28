<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kegiatan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="kajian" {{ old('kategori') == 'kajian' ? 'selected' : '' }}>Kajian</option>
                                <option value="pengajian" {{ old('kategori') == 'pengajian' ? 'selected' : '' }}>Pengajian</option>
                                <option value="phbi" {{ old('kategori') == 'phbi' ? 'selected' : '' }}>PHBI</option>
                                <option value="santunan" {{ old('kategori') == 'santunan' ? 'selected' : '' }}>Santunan</option>
                                <option value="bakti_sosial" {{ old('kategori') == 'bakti_sosial' ? 'selected' : '' }}>Bakti Sosial</option>
                                <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="akan_datang" {{ old('status', 'akan_datang') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="berlangsung" {{ old('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai (opsional)</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu Mulai (opsional)</label>
                            <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu Selesai (opsional)</label>
                            <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Penanggung Jawab (opsional)</label>
                        <select name="penanggung_jawab_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($pengurus as $p)
                                <option value="{{ $p->id }}" {{ old('penanggung_jawab_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Poster (opsional)</label>
                        <input type="file" name="poster" accept="image/*" class="mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Video Kegiatan (opsional, maksimal 35 MB)</label>
                        <input type="file" name="video" accept="video/mp4,video/quicktime,video/webm,video/ogg" class="mt-1 block w-full">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Anggaran (opsional)</label>
                            <input type="number" name="anggaran" value="{{ old('anggaran') }}" min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Peserta (opsional)</label>
                            <input type="number" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Laporan Hasil (opsional, isi setelah kegiatan selesai)</label>
                        <textarea name="laporan_hasil" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('laporan_hasil') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('kegiatan.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>