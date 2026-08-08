<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Transaksi
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

                <form action="{{ route('keuangan.update', $transaksi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis</label>
                        <select name="jenis" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="pemasukan" {{ old('jenis', $transaksi->jenis) == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('jenis', $transaksi->jenis) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori_transaksi_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_transaksi_id', $transaksi->kategori_transaksi_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }} ({{ ucfirst($k->jenis) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal"
                                   value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah', $transaksi->jumlah) }}" min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sumber / Tujuan (opsional)</label>
                        <input type="text" name="sumber_tujuan" value="{{ old('sumber_tujuan', $transaksi->sumber_tujuan) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kaitkan Kegiatan (opsional)</label>
                        <select name="kegiatan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($kegiatans as $k)
                                <option value="{{ $k->id }}" {{ old('kegiatan_id', $transaksi->kegiatan_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bukti Transaksi</label>
                        @if ($transaksi->bukti)
                            <p class="text-xs text-blue-600 mb-2">
                                <a href="{{ Storage::url($transaksi->bukti) }}" target="_blank">Lihat bukti saat ini</a>
                            </p>
                        @endif
                        <input type="file" name="bukti" accept="image/*,.pdf" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti bukti.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('keuangan.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>