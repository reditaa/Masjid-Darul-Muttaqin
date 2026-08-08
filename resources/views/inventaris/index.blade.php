<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inventaris
            </h2>
            <a href="{{ route('inventaris.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Barang
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

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($inventaris as $item)
                            <tr>
                                <td class="px-6 py-4 text-xs text-gray-500">{{ $item->kode_inventaris }}</td>
                                <td class="px-6 py-4 font-medium">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $item->jumlah }} {{ $item->satuan }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $item->kondisi === 'baik' ? 'bg-green-100 text-green-800' : ($item->kondisi === 'hilang' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('inventaris.show', $item) }}"
                                           title="Lihat"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('inventaris.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('inventaris.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
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
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada data inventaris.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $inventaris->links() }}
            </div>

        </div>
    </div>
</x-app-layout>