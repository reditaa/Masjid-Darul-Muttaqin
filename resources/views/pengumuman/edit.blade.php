<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengumuman
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

                <form action="{{ route('pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Isi Pengumuman</label>
                        <textarea name="isi" rows="6" class="mt-1 block w-full border-gray-300 rounded-md" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="umum" {{ old('kategori', $pengumuman->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="kegiatan" {{ old('kategori', $pengumuman->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="keuangan" {{ old('kategori', $pengumuman->kategori) == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="sosial" {{ old('kategori', $pengumuman->kategori) == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="lainnya" {{ old('kategori', $pengumuman->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="draft" {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $pengumuman->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="arsip" {{ old('status', $pengumuman->status) == 'arsip' ? 'selected' : '' }}>Arsip</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Publish</label>
                            <input type="datetime-local" name="tanggal_publish"
                                   value="{{ old('tanggal_publish', $pengumuman->tanggal_publish?->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Berakhir (opsional)</label>
                            <input type="datetime-local" name="tanggal_berakhir"
                                   value="{{ old('tanggal_berakhir', $pengumuman->tanggal_berakhir?->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar</label>
                        @if ($pengumuman->gambar)
                            <img src="{{ Storage::url($pengumuman->gambar) }}" class="w-32 h-20 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="gambar" accept="image/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti gambar.</p>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pengumuman.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>