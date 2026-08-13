<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Jadwal Imam & Muazin
            </h2>
            <a href="{{ route('jadwal-imam-muazin.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Sholat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imam (Urutan Cadangan)</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($jadwal as $item)
                            <tr>
                                <td class="px-6 py-4 font-medium capitalize">{{ $item->hari }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 capitalize">
                                        {{ $item->waktu_sholat }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($item->anggota as $imam)
                                        <span class="text-sm">{{ $imam->pivot->urutan }}. {{ $imam->nama }}</span>@if (!$loop->last)<br>@endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('jadwal-imam-muazin.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('jadwal-imam-muazin.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus jadwal ini?')">
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
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada jadwal imam & muazin.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>