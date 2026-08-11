<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

```
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Deskripsi halaman --}}
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">
            Pengurus DKM
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Data pengurus DKM Masjid Darul Muttaqin.
        </p>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($pengurus as $item)
                    <tr>
                        <td class="px-6 py-4">
                            @if ($item->foto)
                                <img src="{{ Storage::url($item->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ $item->nama }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->jabatan->nama_jabatan ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->no_hp ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $item->status === 'aktif'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3">

                                <a href="{{ route('pengurus.show', $item) }}"
                                   title="Lihat"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('pengurus.edit', $item) }}"
                                   title="Edit"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('pengurus.destroy', $item) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            title="Hapus"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6"
                            class="px-6 py-8 text-center text-gray-400">
                            Belum ada data pengurus.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pengurus->links() }}
    </div>

</div>
```

</div>
