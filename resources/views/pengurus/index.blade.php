<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                    <i class="fas fa-user-tie text-emerald-600"></i> Data Anggota DKM
                </h2>
                <p class="text-xs text-gray-500 mt-1">Data Pengurus & Jamaah Internal Masjid — <span class="font-semibold text-emerald-700">Anggota Internal SIMADI</span></p>
            </div>
            <a href="{{ route('pengurus.create') }}"
               class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 text-sm font-semibold shadow-md transition-all duration-200 flex items-center gap-2 self-start sm:self-auto">
                <i class="fas fa-plus"></i> Tambah Anggota DKM
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Sub-Navbar Navigation --}}
            <x-anggota-sipintu-nav />

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm flex items-center gap-3">
                    <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jabatan DKM</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($pengurus as $item)
                            <tr class="hover:bg-emerald-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" class="w-10 h-10 rounded-full object-cover shadow-sm">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-100 to-green-200 text-emerald-800 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                                    @if($item->nik)
                                        <span class="text-xs text-gray-500">NIK: <span class="font-mono">{{ $item->nik }}</span></span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        👤 Anggota DKM
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $item->jabatan->nama_jabatan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    <div><i class="fas fa-phone text-gray-400 mr-1"></i> {{ $item->no_hp ?? '-' }}</div>
                                    <div class="text-gray-400 mt-0.5"><i class="fas fa-envelope mr-1"></i> {{ $item->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                        {{ $item->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('pengurus.show', $item) }}"
                                           title="Lihat"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengurus.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('pengurus.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <div class="max-w-sm mx-auto">
                                        <i class="fas fa-user-tie text-4xl mb-3 text-gray-300"></i>
                                        <p class="font-medium text-gray-500">Belum ada data anggota DKM.</p>
                                        <p class="text-xs text-gray-400 mt-1">Klik <strong>"Tambah Anggota DKM"</strong> untuk menginputkan data pengurus atau anggota masjid baru.</p>
                                    </div>
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