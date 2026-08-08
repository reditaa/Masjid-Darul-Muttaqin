<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Galeri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($galeri->tipe === 'video')
                    <video class="w-full rounded mb-4 bg-black" controls>
                        <source src="{{ Storage::url($galeri->file) }}">
                    </video>
                @else
                    <img src="{{ Storage::url($galeri->file) }}" class="w-full rounded mb-4">
                @endif

                <h1 class="text-xl font-bold text-gray-800 mb-2">{{ $galeri->judul }}</h1>

                <div class="flex items-center gap-2 mb-4">
                    @if ($galeri->kategori)
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                            {{ $galeri->kategori->nama_kategori }}
                        </span>
                    @endif
                    @if ($galeri->kegiatan)
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            <i class="fas fa-link mr-1"></i>{{ $galeri->kegiatan->judul }}
                        </span>
                    @endif
                </div>

                <p class="text-sm text-gray-500 mb-4">
                    {{ $galeri->tanggal->translatedFormat('d F Y') }}
                    @if ($galeri->pengunggah)
                        · Diunggah oleh {{ $galeri->pengunggah->name }}
                    @endif
                </p>

                @if ($galeri->deskripsi)
                    <p class="text-sm text-gray-700 whitespace-pre-line mb-6">{{ $galeri->deskripsi }}</p>
                @endif

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <a href="{{ route('galeri.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('galeri.edit', $galeri) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>