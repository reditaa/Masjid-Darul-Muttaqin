<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Barang Inventaris
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

                <form action="{{ route('inventaris.update', $inventaris) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Inventaris</label>
                        <input type="text" name="kode_inventaris" value="{{ old('kode_inventaris', $inventaris->kode_inventaris) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $inventaris->nama_barang) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="elektronik" {{ old('kategori', $inventaris->kategori) == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="mebel" {{ old('kategori', $inventaris->kategori) == 'mebel' ? 'selected' : '' }}>Mebel</option>
                                <option value="perlengkapan_ibadah" {{ old('kategori', $inventaris->kategori) == 'perlengkapan_ibadah' ? 'selected' : '' }}>Perlengkapan Ibadah</option>
                                <option value="kebersihan" {{ old('kategori', $inventaris->kategori) == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                                <option value="dokumen" {{ old('kategori', $inventaris->kategori) == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                <option value="lainnya" {{ old('kategori', $inventaris->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                            <select name="kondisi" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="baik" {{ old('kondisi', $inventaris->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak_ringan" {{ old('kondisi', $inventaris->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="rusak_berat" {{ old('kondisi', $inventaris->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                                <option value="hilang" {{ old('kondisi', $inventaris->kondisi) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah', $inventaris->jumlah) }}" min="1"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan', $inventaris->satuan) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan (opsional)</label>
                        <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan', $inventaris->lokasi_penyimpanan) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sumber Perolehan</label>
                            <select name="sumber_perolehan" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="pembelian" {{ old('sumber_perolehan', $inventaris->sumber_perolehan) == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                                <option value="donasi" {{ old('sumber_perolehan', $inventaris->sumber_perolehan) == 'donasi' ? 'selected' : '' }}>Donasi</option>
                                <option value="hibah" {{ old('sumber_perolehan', $inventaris->sumber_perolehan) == 'hibah' ? 'selected' : '' }}>Hibah</option>
                                <option value="lainnya" {{ old('sumber_perolehan', $inventaris->sumber_perolehan) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Perolehan (opsional)</label>
                            <input type="date" name="tanggal_perolehan"
                                   value="{{ old('tanggal_perolehan', $inventaris->tanggal_perolehan?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Perolehan (opsional)</label>
                        <input type="number" name="harga_perolehan" value="{{ old('harga_perolehan', $inventaris->harga_perolehan) }}" min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto</label>
                        @if ($inventaris->foto)
                            <img src="{{ Storage::url($inventaris->foto) }}" class="w-24 h-24 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti foto.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan', $inventaris->keterangan) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('inventaris.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>