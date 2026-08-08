<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-sm rounded-full
                        {{ $transaksi->jenis === 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($transaksi->jenis) }}
                    </span>
                </div>

                <h1 class="text-3xl font-bold mb-1 {{ $transaksi->jenis === 'pemasukan' ? 'text-green-700' : 'text-red-600' }}">
                    {{ $transaksi->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                </h1>
                <p class="text-gray-500 text-sm mb-6">{{ $transaksi->tanggal->translatedFormat('d F Y') }}</p>

                <dl class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <dt class="text-gray-500">Kategori</dt>
                        <dd>{{ $transaksi->kategori->nama_kategori ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Sumber / Tujuan</dt>
                        <dd>{{ $transaksi->sumber_tujuan ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Kegiatan Terkait</dt>
                        <dd>{{ $transaksi->kegiatan->judul ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Dicatat Oleh</dt>
                        <dd>{{ $transaksi->pencatat->name ?? '-' }}</dd>
                    </div>
                </dl>

                @if ($transaksi->keterangan)
                    <div class="mb-6 pt-4 border-t">
                        <dt class="text-gray-500 text-sm mb-1">Keterangan</dt>
                        <dd class="text-sm whitespace-pre-line">{{ $transaksi->keterangan }}</dd>
                    </div>
                @endif

                @if ($transaksi->bukti)
                    <div class="mb-6">
                        <dt class="text-gray-500 text-sm mb-2">Bukti Transaksi</dt>
                        <a href="{{ Storage::url($transaksi->bukti) }}" target="_blank"
                           class="text-blue-600 text-sm hover:underline">
                            <i class="fas fa-file mr-1"></i> Lihat bukti transaksi
                        </a>
                    </div>
                @endif

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <a href="{{ route('keuangan.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('keuangan.edit', $transaksi) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>