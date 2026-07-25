<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pengurus DKM
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-5">

    <h3 class="text-xl font-bold">Daftar Pengurus</h3>

    <form action="{{ route('pengurus.index') }}" method="GET" class="flex gap-2">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau jabatan..."
            class="border rounded px-4 py-2 w-64">

        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

            Cari

        </button>

        <a href="{{ route('pengurus.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

            Reset

        </a>

    </form>

    <a href="{{ route('pengurus.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

        + Tambah Pengurus

    </a>

</div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
                            <th class="border p-2">Foto</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Jabatan</th>
                            <th class="border p-2">No HP</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($pengurus as $item)

                        <tr>
                            <td class="border p-2 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-2 text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}"
                                         class="w-16 h-16 rounded-full object-cover mx-auto">
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>

                            <td class="border p-2">{{ $item->nama }}</td>
                            <td class="border p-2">{{ $item->jabatan }}</td>
                            <td class="border p-2">{{ $item->no_hp }}</td>
                            <td class="border p-2">{{ $item->status }}</td>

                            <td class="border p-2">

                                <a href="{{ route('pengurus.edit',$item->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('pengurus.destroy',$item->id) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus data?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-4">
                                Belum ada data pengurus.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="mt-4">
    {{ $pengurus->withQueryString()->links() }}
</div>

            </div>

        </div>
    </div>

</x-app-layout>