<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Galeri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (opsional)</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipe</label>
                            <select name="tipe" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="foto" {{ old('tipe', $galeri->tipe) == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ old('tipe', $galeri->tipe) == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal"
                                   value="{{ old('tanggal', $galeri->tanggal->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Saat Ini</label>
                        @if ($galeri->tipe === 'video')
                            <video class="w-40 h-24 object-cover rounded mb-2 bg-black" controls>
                                <source src="{{ Storage::url($galeri->file) }}">
                            </video>
                        @else
                            <img src="{{ Storage::url($galeri->file) }}" class="w-40 h-24 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="file" accept="image/*,video/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti file.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori (opsional)</label>
                            <select name="galeri_kategori_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">-- Tidak ada --</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('galeri_kategori_id', $galeri->galeri_kategori_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kaitkan Kegiatan (opsional)</label>
                            <select name="kegiatan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">-- Tidak ada --</option>
                                @foreach ($kegiatans as $k)
                                    <option value="{{ $k->id }}" {{ old('kegiatan_id', $galeri->kegiatan_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('galeri.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>