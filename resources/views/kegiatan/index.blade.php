<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kegiatan
            </h2>
            <a href="{{ route('kegiatan.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
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

            <div class="flex gap-2 mb-4">
                <a href="{{ route('kegiatan.index', ['tab' => 'kalender']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium
                   {{ $tab === 'kalender' ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border' }}">
                    <i class="fas fa-calendar-days mr-1"></i> Kalender Kegiatan
                </a>
                <a href="{{ route('kegiatan.index', ['tab' => 'riwayat']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium
                   {{ $tab === 'riwayat' ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border' }}">
                    <i class="fas fa-clock-rotate-left mr-1"></i> Riwayat Kegiatan
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($kegiatan as $item)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $item->judul }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $item->tanggal_mulai->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $item->status === 'selesai' ? 'bg-green-100 text-green-800' : ($item->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('kegiatan.show', $item) }}"
                                           title="Lihat"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('kegiatan.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('kegiatan.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $kegiatan->links() }}
            </div>

        </div>
    </div>
</x-app-layout>