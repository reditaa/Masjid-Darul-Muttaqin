<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kegiatan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($kegiatan->poster)
                    <img src="{{ Storage::url($kegiatan->poster) }}" class="w-full h-56 object-cover rounded mb-4">
                @endif

                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $kegiatan->kategori)) }}
                    </span>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $kegiatan->status === 'selesai' ? 'bg-green-100 text-green-800' : ($kegiatan->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $kegiatan->status)) }}
                    </span>
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $kegiatan->judul }}</h1>

                <dl class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <dt class="text-gray-500">Tanggal</dt>
                        <dd>
                            {{ $kegiatan->tanggal_mulai->translatedFormat('d F Y') }}
                            @if ($kegiatan->tanggal_selesai)
                                s/d {{ $kegiatan->tanggal_selesai->translatedFormat('d F Y') }}
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Waktu</dt>
                        <dd>
                            {{ $kegiatan->waktu_mulai ?? '-' }}
                            @if ($kegiatan->waktu_selesai) - {{ $kegiatan->waktu_selesai }} @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Lokasi</dt>
                        <dd>{{ $kegiatan->lokasi ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Penanggung Jawab</dt>
                        <dd>{{ $kegiatan->penanggungJawab->nama ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Anggaran</dt>
                        <dd>{{ $kegiatan->anggaran ? 'Rp ' . number_format($kegiatan->anggaran, 0, ',', '.') : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Jumlah Peserta</dt>
                        <dd>{{ $kegiatan->jumlah_peserta ?? '-' }}</dd>
                    </div>
                </dl>

                @if ($kegiatan->deskripsi)
                    <div class="mb-6">
                        <dt class="text-gray-500 text-sm mb-1">Deskripsi</dt>
                        <dd class="text-sm whitespace-pre-line">{{ $kegiatan->deskripsi }}</dd>
                    </div>
                @endif

                @if ($kegiatan->laporan_hasil)
                    <div class="mb-6 pt-4 border-t">
                        <dt class="text-gray-500 text-sm mb-1">Laporan Hasil</dt>
                        <dd class="text-sm whitespace-pre-line">{{ $kegiatan->laporan_hasil }}</dd>
                    </div>
                @endif

                <div class="flex justify-end gap-2 pt-6 border-t">
                    <a href="{{ route('kegiatan.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('kegiatan.edit', $kegiatan) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>