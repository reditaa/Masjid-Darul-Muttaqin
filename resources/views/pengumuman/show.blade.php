<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengumuman
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($pengumuman->gambar)
                    <img src="{{ Storage::url($pengumuman->gambar) }}" class="w-full h-56 object-cover rounded mb-4">
                @endif

                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        {{ ucfirst($pengumuman->kategori) }}
                    </span>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $pengumuman->status === 'published' ? 'bg-green-100 text-green-800' : ($pengumuman->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-200 text-gray-600') }}">
                        {{ ucfirst($pengumuman->status) }}
                    </span>
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $pengumuman->judul }}</h1>

                <p class="text-sm text-gray-500 mb-6">
                    Dipublikasikan {{ $pengumuman->tanggal_publish->translatedFormat('d F Y, H:i') }} WIB
                    @if ($pengumuman->tanggal_berakhir)
                        — berakhir {{ $pengumuman->tanggal_berakhir->translatedFormat('d F Y, H:i') }} WIB
                    @endif
                    · {{ $pengumuman->dilihat }} kali dilihat
                </p>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $pengumuman->isi }}
                </div>

                <div class="flex justify-end gap-2 pt-6 mt-6 border-t">
                    <a href="{{ route('pengumuman.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('pengumuman.edit', $pengumuman) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>