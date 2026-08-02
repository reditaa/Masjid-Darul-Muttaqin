<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Jadwal Piket Kebersihan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-5">

                    <form action="{{ route('jadwal-piket.index') }}" method="GET" class="flex gap-2">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama..."
                            class="border rounded-lg px-4 py-2 w-72">

                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-5 rounded-lg">
                            Cari
                        </button>

                        <a href="{{ route('jadwal-piket.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </a>

                    </form>

                    <a href="{{ route('jadwal-piket.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        + Tambah Jadwal
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border">

                        <thead class="bg-gray-200">

                            <tr>
                                <th class="border p-3">No</th>
                                <th class="border">Hari</th>
                                <th class="border">Koordinator</th>
                                <th class="border">Anggota 1</th>
                                <th class="border">Anggota 2</th>
                                <th class="border">Anggota 3</th>
                                <th class="border">Anggota 4</th>
                                <th class="border">Keterangan</th>
                                <th class="border">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($jadwalPiket as $item)

                            <tr>

                                <td class="border text-center">
                                    {{ $jadwalPiket->firstItem() + $loop->index }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->hari }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->koordinator->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->anggota1->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->anggota2->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->anggota3->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->anggota4->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->keterangan }}
                                </td>

                                <td class="border text-center">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('jadwal-piket.edit',$item->id) }}"
                                           title="Edit"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-9 h-9 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>

                                        <form
                                            action="{{ route('jadwal-piket.destroy',$item->id) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus?')"
                                                class="bg-red-600 hover:bg-red-700 text-white w-9 h-9 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center py-5 text-gray-500">

                                    Belum ada jadwal piket.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-5">

                    {{ $jadwalPiket->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>