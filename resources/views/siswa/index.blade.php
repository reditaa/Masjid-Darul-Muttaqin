<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Siswa
        </h2>
    </x-slot>

  <div class="w-full px-0">
    <div class="w-full">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full bg-white shadow rounded-lg p-6">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-5">

                    <h3 class="text-xl font-bold">
                        Daftar Siswa
                    </h3>

                    <form action="{{ route('siswa.index') }}" method="GET" class="flex gap-2">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau kelas..."
                            class="border rounded px-4 py-2">

                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

                            Cari

                        </button>

                        <a href="{{ route('siswa.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                            Reset

                        </a>

                    </form>

                    <a href="{{ route('siswa.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                        Tambah Siswa

                    </a>

                </div>

              <div class="w-full overflow-x-auto">

    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border p-2">No</th>
                                <th class="border p-2">Foto</th>
                                <th class="border p-2">NIS</th>
                                <th class="border p-2">Nama</th>
                                <th class="border p-2">Kelas</th>
                                <th class="border p-2">Email</th>
                                <th class="border p-2">No HP</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($siswas as $item)

                                <tr>

                                    <td class="border p-2 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border p-2 text-center">

                                        @if($item->foto)

                                            <img src="{{ asset('storage/'.$item->foto) }}"
                                                class="w-14 h-14 rounded-full object-cover mx-auto">

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td class="border p-2">
                                        {{ $item->nis }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $item->nama }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $item->kelas }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $item->email }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $item->no_hp }}
                                    </td>

                                    <td class="border p-2 text-center">
                                        {{ $item->status }}
                                    </td>

                                    <td class="border p-2 text-center">

                                        <a href="{{ route('siswa.edit',$item->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                            Edit

                                        </a>

                                        <form action="{{ route('siswa.destroy',$item->id) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Yakin ingin menghapus?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center p-5">

                                        Belum ada data siswa.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-5">

                    {{ $siswas->withQueryString()->links() }}

                </div>

            </div>


        </div>
    </div>

</x-app-layout>