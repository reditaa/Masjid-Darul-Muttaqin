<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                    <i class="fas fa-school text-blue-600"></i> Data SiPintu Gateway
                </h2>
                <p class="text-xs text-gray-500 mt-1">Data Eksternal Sekolah (Guru & Siswa) — <span class="font-semibold text-blue-700">Bukan Anggota DKM</span></p>
            </div>
            <form action="{{ route('pengurus.syncSipintu') }}" method="POST" onsubmit="return confirm('Proses sinkronisasi akan mengunduh data Guru & Siswa terbaru dari SiPintu Gateway. Lanjutkan?')">
                @csrf
                <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl hover:from-blue-700 hover:to-indigo-800 text-sm font-semibold shadow-md transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-sync-alt"></i> Sinkronkan SiPintu
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Sub-Navbar Navigation --}}
            <x-anggota-sipintu-nav />

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                    <div class="absolute right-3 -bottom-2 opacity-20 text-6xl">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <p class="text-xs font-medium uppercase tracking-wider text-blue-100">Data Guru (SiPintu)</p>
                    <div class="flex items-baseline gap-3 mt-1">
                        <span class="text-3xl font-extrabold">{{ number_format($totalGuru) }}</span>
                        <span class="text-xs text-blue-100">Tenaga Pendidik</span>
                    </div>
                    <p class="text-xs text-blue-100/90 mt-2">Bukan Anggota DKM • Terhubung via NIP</p>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                    <div class="absolute right-3 -bottom-2 opacity-20 text-6xl">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <p class="text-xs font-medium uppercase tracking-wider text-emerald-100">Data Siswa (SiPintu)</p>
                    <div class="flex items-baseline gap-3 mt-1">
                        <span class="text-3xl font-extrabold">{{ number_format($totalSiswa) }}</span>
                        <span class="text-xs text-emerald-100">Peserta Didik</span>
                    </div>
                    <p class="text-xs text-emerald-100/90 mt-2">Bukan Anggota DKM • Terhubung via NIS/NISN</p>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Filter & Search Bar -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center space-x-2 overflow-x-auto">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider mr-1"><i class="fas fa-filter text-gray-400 mr-1"></i> Filter:</span>
                    <a href="{{ route('sipintu.data') }}"
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition {{ !request('asal') ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Semua Data SiPintu
                    </a>
                    <a href="{{ route('sipintu.data', ['asal' => 'guru']) }}"
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition {{ request('asal') == 'guru' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
                        👨‍🏫 Data Guru (NIP)
                    </a>
                    <a href="{{ route('sipintu.data', ['asal' => 'siswa']) }}"
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition {{ request('asal') == 'siswa' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                        🎓 Data Siswa (NIS)
                    </a>
                </div>

                {{-- Search --}}
                <form action="{{ route('sipintu.data') }}" method="GET" class="relative">
                    @if(request('asal'))
                        <input type="hidden" name="asal" value="{{ request('asal') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, NIP, atau NIS..."
                           class="w-full md:w-64 pl-9 pr-4 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status Identitas</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($dataSipintu as $item)
                            <tr class="hover:bg-blue-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" class="w-10 h-10 rounded-full object-cover shadow-sm">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-100 to-indigo-100 text-blue-700 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                                    @if($item->nik)
                                        <span class="text-xs text-gray-500">ID / NIP / NIS: <span class="font-mono">{{ $item->nik }}</span></span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        @if ($item->asal === 'guru')
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                                👨‍🏫 Guru (SiPintu)
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                🎓 Siswa (SiPintu)
                                            </span>
                                        @endif
                                        <span class="px-2 py-0.5 text-[10px] uppercase font-semibold rounded bg-gray-100 text-gray-600 border border-gray-200">
                                            Bukan Anggota
                                        </span>
                                    </div>
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
                                           title="Lihat Detail"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengurus.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    <div class="max-w-sm mx-auto">
                                        <i class="fas fa-school text-4xl mb-3 text-gray-300"></i>
                                        <p class="font-medium text-gray-500">Belum ada data dari SiPintu Gateway.</p>
                                        <p class="text-xs text-gray-400 mt-1">Klik tombol <strong>"Sinkronkan SiPintu"</strong> di kanan atas untuk mengunduh data Guru & Siswa terbaru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $dataSipintu->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
