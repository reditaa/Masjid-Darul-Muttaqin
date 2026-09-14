<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                <i class="fas fa-mosque text-green-600 mr-2"></i>Jadwal Imam & Muazin
            </h2>
            <a href="{{ route('jadwal-imam-muazin.create') }}"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 text-sm shadow">
                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
                    <i class="fas fa-circle-check mr-1"></i> {{ session('success') }}
                </div>
            @endif

            @php
                $adaData = false;
                foreach ($hariUrutan as $h) {
                    if ($jadwal->get($h) && $jadwal->get($h)->isNotEmpty()) {
                        $adaData = true;
                        break;
                    }
                }
            @endphp

            @if (!$adaData)
                <div class="bg-white shadow rounded-2xl p-10 text-center text-gray-400 border border-green-100">
                    <i class="fas fa-calendar-xmark text-3xl text-green-200 mb-2"></i>
                    <p>Belum ada jadwal imam & muazin.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-10">
                    @foreach ($hariUrutan as $hari)
                        @php $itemsHariIni = $jadwal->get($hari, collect()); @endphp

                        @if ($itemsHariIni->isNotEmpty())
                            <div class="kartu-notebook">
                                <div class="ring-spiral">
                                    @for ($r = 0; $r < 6; $r++) <span></span> @endfor
                                </div>

                                <svg class="ornamen-pojok" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>

                                <h3 class="judul-kartu capitalize">{{ $hari }}</h3>
                                <div class="garis-bawah"></div>

                                <div class="space-y-3">
                                    @foreach ($itemsHariIni as $item)
                                        <div class="bg-white/70 border border-green-100 rounded-xl px-4 py-3">
                                            <div class="flex items-center justify-between gap-2 mb-2">
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 capitalize font-semibold">
                                                    {{ $item->waktu_sholat }}
                                                </span>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('jadwal-imam-muazin.edit', $item) }}" title="Edit"
                                                       class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                                        <i class="fas fa-pen text-xs"></i>
                                                    </a>
                                                    <form action="{{ route('jadwal-imam-muazin.destroy', $item) }}" method="POST"
                                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Hapus"
                                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                                            <i class="fas fa-trash text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-3 border-t border-dashed border-green-200 pt-2">
                                                <div>
                                                    <p class="label-kartu">Imam</p>
                                                    @forelse ($item->imam as $imam)
                                                        <p class="isi-kartu">{{ $imam->pivot->urutan }}. {{ $imam->nama }}</p>
                                                    @empty
                                                        <p class="isi-kartu text-gray-400">Belum ada imam</p>
                                                    @endforelse
                                                </div>
                                                <div>
                                                    <p class="label-kartu">Muazin</p>
                                                    @forelse ($item->muazin as $muazin)
                                                        <p class="isi-kartu">{{ $muazin->pivot->urutan }}. {{ $muazin->nama }}</p>
                                                    @empty
                                                        <p class="isi-kartu text-gray-400">Belum ada muazin</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>