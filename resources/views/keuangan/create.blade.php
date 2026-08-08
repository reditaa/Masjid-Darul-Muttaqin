<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Transaksi
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

                <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis</label>
                        <select name="jenis" id="jenis" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="pemasukan" {{ old('jenis', 'pemasukan') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori_transaksi_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" data-jenis="{{ $k->jenis }}"
                                    {{ old('kategori_transaksi_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }} ({{ ucfirst($k->jenis) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sumber / Tujuan (opsional)</label>
                        <input type="text" name="sumber_tujuan" value="{{ old('sumber_tujuan') }}"
                               placeholder="Misal: Donatur Bpk. Ahmad, Toko Bangunan Jaya, dll"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kaitkan Kegiatan (opsional)</label>
                        <select name="kegiatan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($kegiatans as $k)
                                <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bukti Transaksi (opsional)</label>
                        <input type="file" name="bukti" accept="image/*,.pdf" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Maksimal 5MB. Format: jpg, png, pdf.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('keuangan.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>