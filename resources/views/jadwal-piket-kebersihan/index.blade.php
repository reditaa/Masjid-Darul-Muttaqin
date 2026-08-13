<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    🧹 Jadwal Piket Kebersihan
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola jadwal petugas piket kebersihan masjid</p>
            </div>
            <a href="{{ route('jadwal-piket-kebersihan.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-md hover:shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 text-sm font-medium">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
                    <i class="fas fa-circle-check text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            @php
                // Warna badge & aksen berbeda tiap hari biar lebih hidup
                $dayStyles = [
                    'senin'  => ['badge' => 'bg-rose-100 text-rose-700',       'accent' => 'from-rose-400 to-rose-500'],
                    'selasa' => ['badge' => 'bg-amber-100 text-amber-700',     'accent' => 'from-amber-400 to-amber-500'],
                    'rabu'   => ['badge' => 'bg-emerald-100 text-emerald-700', 'accent' => 'from-emerald-400 to-emerald-500'],
                    'kamis'  => ['badge' => 'bg-sky-100 text-sky-700',         'accent' => 'from-sky-400 to-sky-500'],
                    'jumat'  => ['badge' => 'bg-violet-100 text-violet-700',   'accent' => 'from-violet-400 to-violet-500'],
                    'sabtu'  => ['badge' => 'bg-fuchsia-100 text-fuchsia-700', 'accent' => 'from-fuchsia-400 to-fuchsia-500'],
                    'minggu' => ['badge' => 'bg-orange-100 text-orange-700',   'accent' => 'from-orange-400 to-orange-500'],
                ];

                $avatarColors = [
                    'bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-500',
                    'bg-purple-400', 'bg-pink-400', 'bg-teal-400', 'bg-indigo-400',
                ];
            @endphp

            @if ($jadwal->isEmpty())
                <div class="bg-white rounded-2xl shadow p-12 text-center">
                    <div class="text-5xl mb-3">🗓️</div>
                    <p class="text-gray-400">Belum ada jadwal piket.</p>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach ($jadwal as $item)
                        @php
                            $key = strtolower($item->hari);
                            $style = $dayStyles[$key] ?? ['badge' => 'bg-gray-100 text-gray-700', 'accent' => 'from-gray-400 to-gray-500'];
                            $anggota = $item->anggota;
                        @endphp

                        <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-200 overflow-hidden">
                            {{-- Garis aksen warna di kiri --}}
                            <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b {{ $style['accent'] }}"></div>

                            <div class="p-5 pl-7 flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $style['badge'] }} capitalize mb-3">
                                        {{ $item->hari }}
                                    </span>

                                    @if ($anggota->isEmpty())
                                        <p class="text-gray-400 text-sm italic">Belum ada petugas ditugaskan</p>
                                    @else
                                        <div class="flex flex-col gap-2">
                                            @foreach ($anggota as $index => $orang)
                                                <div class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 transition-colors rounded-lg px-3 py-2 w-fit">
                                                    <span class="w-7 h-7 flex items-center justify-center rounded-full text-white text-xs font-bold {{ $avatarColors[$index % count($avatarColors)] }}">
                                                        {{ strtoupper(substr($orang->nama, 0, 1)) }}
                                                    </span>
                                                    <span class="text-sm text-gray-700">{{ $orang->nama }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('jadwal-piket-kebersihan.edit', $item) }}"
                                       title="Edit"
                                       class="w-9 h-9 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white transition-colors">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>
                                    <form action="{{ route('jadwal-piket-kebersihan.destroy', $item) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition-colors">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>