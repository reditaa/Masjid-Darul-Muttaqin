<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Presensi
            </h2>
            <a href="{{ route('presensi.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Catat Presensi
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petugas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Tugas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($presensi as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    @if ($item->foto)
                                        <a href="{{ Storage::url($item->foto) }}" target="_blank">
                                            <img src="{{ Storage::url($item->foto) }}" class="w-10 h-10 rounded-full object-cover">
                                        </a>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4 font-medium">{{ $item->pengurus->nama ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    @php
                                        $labelJenis = match($item->presentable_type) {
                                            \App\Models\JadwalImamMuazin::class => 'Imam & Muazin',
                                            \App\Models\JadwalBilal::class => 'Bilal',
                                            \App\Models\JadwalPiketKebersihan::class => 'Piket Kebersihan',
                                            \App\Models\Kegiatan::class => 'Kegiatan',
                                            default => '-',
                                        };
                                    @endphp
                                    {{ $labelJenis }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $item->status === 'hadir' ? 'bg-green-100 text-green-800' : ($item->status === 'tidak_hadir' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $item->label_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('presensi.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus presensi ini?')">
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
                                    Belum ada data presensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $presensi->links() }}
            </div>

        </div>
    </div>
</x-app-layout>