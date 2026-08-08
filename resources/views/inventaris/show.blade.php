<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Inventaris
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($inventaris->foto)
                    <img src="{{ Storage::url($inventaris->foto) }}" class="w-full h-56 object-cover rounded mb-4">
                @endif

                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $inventaris->kategori)) }}
                    </span>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $inventaris->kondisi === 'baik' ? 'bg-green-100 text-green-800' : ($inventaris->kondisi === 'hilang' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $inventaris->kondisi)) }}
                    </span>
                </div>

                <h1 class="text-xl font-bold text-gray-800 mb-1">{{ $inventaris->nama_barang }}</h1>
                <p class="text-xs text-gray-400 mb-4">{{ $inventaris->kode_inventaris }}</p>

                <dl class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <dt class="text-gray-500">Jumlah</dt>
                        <dd>{{ $inventaris->jumlah }} {{ $inventaris->satuan }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Lokasi Penyimpanan</dt>
                        <dd>{{ $inventaris->lokasi_penyimpanan ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Sumber Perolehan</dt>
                        <dd>{{ ucfirst($inventaris->sumber_perolehan) }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Tanggal Perolehan</dt>
                        <dd>{{ $inventaris->tanggal_perolehan?->translatedFormat('d F Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Harga Perolehan</dt>
                        <dd>{{ $inventaris->harga_perolehan ? 'Rp ' . number_format($inventaris->harga_perolehan, 0, ',', '.') : '-' }}</dd>
                    </div>
                </dl>

                @if ($inventaris->keterangan)
                    <div class="mb-6 pt-4 border-t">
                        <dt class="text-gray-500 text-sm mb-1">Keterangan</dt>
                        <dd class="text-sm whitespace-pre-line">{{ $inventaris->keterangan }}</dd>
                    </div>
                @endif

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <a href="{{ route('inventaris.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('inventaris.edit', $inventaris) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>