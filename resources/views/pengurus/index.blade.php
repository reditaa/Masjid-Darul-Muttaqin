<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Pengurus DKM
            </h2>
            <a href="{{ route('pengurus.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Pengurus
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter Kelompok Asal (Guru, Siswa, Umum) -->
            <div class="mb-6 flex items-center justify-between bg-white p-4 rounded-lg shadow-sm">
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold text-gray-700 mr-2"><i class="fas fa-filter text-gray-400 mr-1"></i> Filter Kelompok:</span>
                    <a href="{{ route('pengurus.index') }}"
                       class="px-3 py-1.5 rounded-full text-xs font-medium transition {{ !request('asal') ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Semua
                    </a>
                    <a href="{{ route('pengurus.index', ['asal' => 'guru']) }}"
                       class="px-3 py-1.5 rounded-full text-xs font-medium transition {{ request('asal') == 'guru' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
                        👨‍🏫 Data Guru
                    </a>
                    <a href="{{ route('pengurus.index', ['asal' => 'siswa']) }}"
                       class="px-3 py-1.5 rounded-full text-xs font-medium transition {{ request('asal') == 'siswa' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                        🎓 Data Siswa
                    </a>
                    <a href="{{ route('pengurus.index', ['asal' => 'umum']) }}"
                       class="px-3 py-1.5 rounded-full text-xs font-medium transition {{ request('asal') == 'umum' ? 'bg-purple-600 text-white shadow-sm' : 'bg-purple-50 text-purple-700 hover:bg-purple-100' }}">
                        🏛️ Umum
                    </a>
                </div>
            </div>

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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pengurus as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}"
                                             class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    {{ $item->nama }}
                                    @if($item->nik)
                                        <span class="block text-xs text-gray-400">ID/NIP/NIS: {{ $item->nik }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->asal === 'guru')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            👨‍🏫 Guru
                                        </span>
                                    @elseif ($item->asal === 'siswa')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            🎓 Siswa
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                            🏛️ Umum
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->no_hp ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $item->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('pengurus.show', $item) }}"
                                           title="Lihat"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengurus.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('pengurus.destroy', $item) }}" method="POST"
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
                                    Belum ada data pengurus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pengurus->links() }}
            </div>

        </div>
    </div>
</x-app-layout>