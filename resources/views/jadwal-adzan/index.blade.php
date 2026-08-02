<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Jadwal Adzan
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

                    <form action="{{ route('jadwal-adzan.index') }}" method="GET" class="flex gap-2">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama muadzin..."
                            class="border rounded-lg px-4 py-2 w-72">

                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-5 rounded-lg">
                            Cari
                        </button>

                        <a href="{{ route('jadwal-adzan.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </a>

                    </form>

                    <a href="{{ route('jadwal-adzan.create') }}"
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
                                <th class="border">Dzuhur</th>
                                <th class="border">Asar</th>
                                <th class="border">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($jadwalAdzan as $item)

                            <tr>

                                <td class="border text-center">
                                    {{ $jadwalAdzan->firstItem() + $loop->index }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->hari }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->dzuhurMuadzin->nama ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $item->asharMuadzin->nama ?? '-' }}
                                </td>

                                <td class="border text-center">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('jadwal-adzan.edit',$item->id) }}"
                                           title="Edit"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-9 h-9 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>

                                        <form
                                            action="{{ route('jadwal-adzan.destroy',$item->id) }}"
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

                                <td colspan="5"
                                    class="text-center py-5 text-gray-500">

                                    Belum ada jadwal adzan.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-5">

                    {{ $jadwalAdzan->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>