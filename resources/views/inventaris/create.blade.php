<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Barang Inventaris
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

                <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Inventaris (opsional, dibuat otomatis kalau kosong)</label>
                        <input type="text" name="kode_inventaris" value="{{ old('kode_inventaris') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="elektronik" {{ old('kategori') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="mebel" {{ old('kategori') == 'mebel' ? 'selected' : '' }}>Mebel</option>
                                <option value="perlengkapan_ibadah" {{ old('kategori') == 'perlengkapan_ibadah' ? 'selected' : '' }}>Perlengkapan Ibadah</option>
                                <option value="kebersihan" {{ old('kategori') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                                <option value="dokumen" {{ old('kategori') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                <option value="lainnya" {{ old('kategori', 'lainnya') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                            <select name="kondisi" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="baik" {{ old('kondisi', 'baik') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                                <option value="hilang" {{ old('kondisi') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan', 'unit') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan (opsional)</label>
                        <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sumber Perolehan</label>
                            <select name="sumber_perolehan" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="pembelian" {{ old('sumber_perolehan', 'pembelian') == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                                <option value="donasi" {{ old('sumber_perolehan') == 'donasi' ? 'selected' : '' }}>Donasi</option>
                                <option value="hibah" {{ old('sumber_perolehan') == 'hibah' ? 'selected' : '' }}>Hibah</option>
                                <option value="lainnya" {{ old('sumber_perolehan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Perolehan (opsional)</label>
                            <input type="date" name="tanggal_perolehan" value="{{ old('tanggal_perolehan') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Perolehan (opsional)</label>
                        <input type="number" name="harga_perolehan" value="{{ old('harga_perolehan') }}" min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('inventaris.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>