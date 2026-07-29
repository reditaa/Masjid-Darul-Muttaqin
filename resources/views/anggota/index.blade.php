<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Anggota
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded shadow p-6">

                <div class="flex justify-between mb-5">

                    <h3 class="text-xl font-bold">
                        Daftar Anggota
                    </h3>

                    <a href="{{ route('anggota.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                        Tambah Anggota

                    </a>

                </div>

                <table class="w-full border">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="border p-2">No</th>
                            <th class="border p-2">Jenis</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">NIP / NIS</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($anggotas as $anggota)

                            <tr>

                                <td class="border p-2 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-2">
                                    {{ $anggota->jenis }}
                                </td>

                                <td class="border p-2">
                                    {{ $anggota->nama }}
                                </td>

                                <td class="border p-2">

                                    @if($anggota->jenis == 'Guru')
                                        {{ $anggota->guru->nip }}
                                    @else
                                        {{ $anggota->siswa->nis }}
                                    @endif

                                </td>

                                <td class="border p-2">
                                    {{ $anggota->status }}
                                </td>

                                <td class="border p-2 text-center">

                                    <a href="{{ route('anggota.edit',$anggota->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('anggota.destroy',$anggota->id) }}"
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

                                <td colspan="6" class="text-center py-5">

                                    Belum ada data anggota.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-5">
                    {{ $anggotas->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>