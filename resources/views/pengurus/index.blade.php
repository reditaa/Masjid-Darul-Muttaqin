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

                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold">Daftar Pengurus</h3>

                    <a href="{{ route('pengurus.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        + Tambah Pengurus
                    </a>
                </div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
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
                            <td class="border p-2">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $item->nama }}</td>
                            <td class="border p-2">{{ $item->jabatan }}</td>
                            <td class="border p-2">{{ $item->no_hp }}</td>
                            <td class="border p-2">{{ $item->status }}</td>

                            <td class="border p-2">

                                <a href="{{ route('pengurus.edit',$item->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('pengurus.destroy',$item->id) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus data?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center p-4">
                                Belum ada data pengurus.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>