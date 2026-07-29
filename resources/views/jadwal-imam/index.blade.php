<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Jadwal Imam
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-5">

                    <h3 class="text-xl font-bold">
                        Daftar Jadwal Imam
                    </h3>

                    <a href="{{ route('jadwal-imam.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                        Tambah Jadwal

                    </a>

                </div>

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-2">No</th>
                            <th class="border p-2">Tanggal</th>
                            <th class="border p-2">Imam</th>
                            <th class="border p-2">Jenis</th>
                            <th class="border p-2">Jabatan</th>
                            <th class="border p-2">Keterangan</th>
                            <th class="border p-2">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($jadwalImam as $item)

                            <tr>

                                <td class="border p-2 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $item->tanggal }}
                                </td>

                                <td class="border p-2">

                                    {{ $item->imam->nama }}

                                </td>

                                <td class="border p-2 text-center">

                                    {{ $item->imam->anggota->jenis }}

                                </td>

                                <td class="border p-2">

                                    {{ $item->imam->jabatan }}

                                </td>

                                <td class="border p-2">

                                    {{ $item->keterangan ?? '-' }}

                                </td>

                                <td class="border p-2 text-center">

                                    <a href="{{ route('jadwal-imam.edit',$item->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                        Edit

                                    </a>

                                    <form action="{{ route('jadwal-imam.destroy',$item->id) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center p-5">

                                    Belum ada data jadwal imam.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-5">

                    {{ $jadwalImam->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>