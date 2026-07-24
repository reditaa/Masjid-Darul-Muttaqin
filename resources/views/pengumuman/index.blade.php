<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Data Pengumuman
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="bg-green-200 p-3 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-5 rounded shadow">

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Daftar Pengumuman</h3>

                    <a href="{{ route('pengumuman.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        + Tambah Pengumuman
                    </a>
                </div>

                <table class="w-full border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2">No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($pengumuman as $item)

                        <tr class="border-t">
                            <td class="p-2">{{ $loop->iteration }}</td>

                            <td>{{ $item->judul }}</td>

                            <td>{{ $item->tanggal }}</td>

                            <td>

                                <a href="{{ route('pengumuman.edit',$item->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                   Edit
                                </a>

                                <form action="{{ route('pengumuman.destroy',$item->id) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Hapus data?')"
                                            class="bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>