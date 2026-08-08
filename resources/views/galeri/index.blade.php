<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Galeri
            </h2>
            <a href="{{ route('galeri.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Galeri
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @forelse ($galeri as $item)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <a href="{{ route('galeri.show', $item) }}" class="block relative">
                            @if ($item->tipe === 'video')
                                <video class="w-full h-40 object-cover bg-black">
                                    <source src="{{ Storage::url($item->file) }}">
                                </video>
                                <span class="absolute top-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded">
                                    <i class="fas fa-video"></i>
                                </span>
                            @else
                                <img src="{{ Storage::url($item->file) }}" class="w-full h-40 object-cover">
                            @endif
                        </a>
                        <div class="p-3">
                            <p class="font-medium text-sm truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->tanggal->translatedFormat('d M Y') }}</p>
                            @if ($item->kategori)
                                <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            @endif
                            <div class="flex items-center justify-end gap-2 mt-3">
                                <a href="{{ route('galeri.edit', $item) }}"
                                   title="Edit"
                                   class="w-7 h-7 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('galeri.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center text-gray-400 py-12">
                        Belum ada item galeri.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $galeri->links() }}
            </div>

        </div>
    </div>
</x-app-layout>