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

            @php
                // Cek apakah ada minimal satu hari yang punya data
                $adaData = false;
                foreach ($hariUrutan as $h) {
                    if ($jadwal->get($h) && $jadwal->get($h)->isNotEmpty()) {
                        $adaData = true;
                        break;
                    }
                }
            @endphp

            @if (!$adaData)
                <div class="bg-white shadow rounded-lg p-8 text-center text-gray-400">
                    Belum ada jadwal imam & muazin.
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($hariUrutan as $hari)
                        @php
                            $itemsHariIni = $jadwal->get($hari, collect());
                        @endphp

                        @if ($itemsHariIni->isNotEmpty())
                            <div class="bg-white shadow rounded-lg overflow-hidden">
                                {{-- Header nama hari --}}
                                <div class="bg-gray-800 px-6 py-3">
                                    <h3 class="text-white font-semibold capitalize">{{ $hari }}</h3>
                                </div>

                                {{-- Tabel waktu sholat untuk hari ini --}}
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase w-32">
                                                Waktu Sholat
                                            </th>
                                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Imam (Urutan Cadangan)
                                            </th>
                                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Muazin (Urutan Cadangan)
                                            </th>
                                            <th class="px-6 py-2 text-center text-xs font-medium text-gray-500 uppercase w-32">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($itemsHariIni as $item)
                                            <tr>
                                                <td class="px-6 py-4">
                                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 capitalize">
                                                        {{ $item->waktu_sholat }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    @forelse ($item->imam as $imam)
                                                        <span class="text-sm">{{ $imam->pivot->urutan }}. {{ $imam->nama }}</span>@if (!$loop->last)<br>@endif
                                                    @empty
                                                        <span class="text-sm text-gray-400">Belum ada imam</span>
                                                    @endforelse
                                                </td>
                                                <td class="px-6 py-4">
                                                    @forelse ($item->muazin as $muazin)
                                                        <span class="text-sm">{{ $muazin->pivot->urutan }}. {{ $muazin->nama }}</span>@if (!$loop->last)<br>@endif
                                                    @empty
                                                        <span class="text-sm text-gray-400">Belum ada muazin</span>
                                                    @endforelse
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>