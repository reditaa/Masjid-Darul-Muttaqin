<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            👨‍🏫 Data Guru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-5">

                    <form action="{{ route('guru.index') }}" method="GET" class="flex">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari Nama / NIP..."
                            class="border rounded-l-lg px-4 py-2 w-72">

                        <button
                            class="bg-blue-600 text-white px-5 rounded-r-lg hover:bg-blue-700">
                            Cari
                        </button>

                    </form>

                    <a href="{{ route('guru.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                        + Tambah Guru

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-3 py-2">No</th>

                                <th class="border px-3 py-2">Foto</th>

                                <th class="border px-3 py-2">NIP</th>

                                <th class="border px-3 py-2">Nama</th>

                                <th class="border px-3 py-2">Email</th>

                                <th class="border px-3 py-2">No HP</th>

                                <th class="border px-3 py-2">Status</th>

                                <th class="border px-3 py-2 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($guru as $item)

                                <tr>

                                    <td class="border px-3 py-2">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-3 py-2 text-center">

                                        @if($item->foto)

                                            <img src="{{ asset('storage/'.$item->foto) }}"
                                                class="w-14 h-14 rounded-full object-cover mx-auto">

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td class="border px-3 py-2">
                                        {{ $item->nip }}
                                    </td>

                                    <td class="border px-3 py-2">
                                        {{ $item->nama }}
                                    </td>

                                    <td class="border px-3 py-2">
                                        {{ $item->email }}
                                    </td>

                                    <td class="border px-3 py-2">
                                        {{ $item->no_hp }}
                                    </td>

                                    <td class="border px-3 py-2">

                                        @if($item->status=="Aktif")

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">

                                                Aktif

                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    <td class="border px-3 py-2 text-center">

                                        <a href="{{ route('guru.edit',$item->id) }}"
                                            class="bg-yellow-400 text-white px-3 py-1 rounded">

                                            Edit

                                        </a>

                                        <form action="{{ route('guru.destroy',$item->id) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="bg-red-600 text-white px-3 py-1 rounded">

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8"
                                        class="text-center py-5">

                                        Belum ada data guru.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-5">

                    {{ $guru->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>