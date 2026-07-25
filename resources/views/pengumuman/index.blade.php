<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Data Pengumuman
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

                    <form action="{{ route('pengumuman.index') }}" method="GET" class="flex gap-2">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari judul atau isi..."
                               class="border rounded-lg px-4 py-2 w-80">

                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 rounded-lg">
                            Cari
                        </button>

                        <a href="{{ route('pengumuman.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </a>

                    </form>

                    <a href="{{ route('pengumuman.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        + Tambah Pengumuman
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border border-gray-300">

                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border p-3">No</th>
                                <th class="border">Gambar</th>
                                <th class="border">Judul</th>
                                <th class="border">Tanggal</th>
                                <th class="border">Status</th>
                                <th class="border">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($pengumuman as $item)

                            <tr>

                                <td class="border text-center">
                                    {{ $pengumuman->firstItem() + $loop->index }}
                                </td>

                                <td class="border text-center p-2">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/'.$item->gambar) }}"
                                             class="w-20 h-20 object-cover rounded mx-auto">
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>

                                <td class="border px-3 font-semibold">
                                    {{ $item->judul }}
                                </td>

                                <td class="border text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>

                                <td class="border text-center">

                                    <form action="{{ route('pengumuman.toggleStatus', $item->id) }}" method="POST">

    @csrf
    @method('PATCH')

    <button
        type="submit"
        class="px-3 py-1 rounded-full text-sm text-white
        {{ $item->status ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">

        {{ $item->status ? 'Aktif' : 'Nonaktif' }}

    </button>

</form>

                                </td>

                                <td class="border text-center space-x-1">

                                    <a href="{{ route('pengumuman.edit',$item->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('pengumuman.destroy',$item->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5 text-gray-500">
                                    Data tidak ditemukan.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-5">
                    {{ $pengumuman->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>