<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                    👨‍🏫 Data Guru
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Kelola seluruh data guru SIMADI
                </p>
            </div>

            <a href="{{ route('guru.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow font-semibold text-center transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Guru
            </a>
        </div>
    </x-slot>

    <div class="w-full">

        @if(session('success'))

            <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-2xl shadow-lg p-5">

            {{-- Search --}}
            <form
                action="{{ route('guru.index') }}"
                method="GET"
                class="flex flex-col md:flex-row gap-3 mb-6">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari Nama / NIP..."
                    class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-6 py-3 font-semibold transition">

                    <i class="fas fa-search mr-2"></i>
                    Cari

                </button>

            </form>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border">

                <table class="min-w-full">

                    <thead class="bg-green-700 text-white">

                        <tr>

                            <th class="px-4 py-3 text-left">No</th>

                            <th class="px-4 py-3 text-left">Foto</th>

                            <th class="px-4 py-3 text-left">NIP</th>

                            <th class="px-4 py-3 text-left">Nama</th>

                            <th class="px-4 py-3 text-left">Email</th>

                            <th class="px-4 py-3 text-left">No HP</th>

                            <th class="px-4 py-3 text-center">Status</th>

                            <th class="px-4 py-3 text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($guru as $item)

                            <tr class="border-b hover:bg-green-50 transition">
<td class="px-4 py-3">
    {{ $guru->firstItem() + $loop->index }}
</td>

                                <td class="px-4 py-3">

                                    @if($item->foto)

                                        <img
                                            src="{{ asset('storage/'.$item->foto) }}"
                                            class="w-14 h-14 rounded-full object-cover">

                                    @else

                                        <div class="w-14 h-14 rounded-full bg-gray-200 flex items-center justify-center">

                                            <i class="fas fa-user text-gray-500"></i>

                                        </div>

                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    {{ $item->nip }}

                                </td>

                                <td class="px-4 py-3 font-semibold">

                                    {{ $item->nama }}

                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">

                                    {{ $item->email }}

                                </td>

                                <td class="px-4 py-3">

                                    {{ $item->no_hp ?: '-' }}

                                </td>

                                <td class="px-4 py-3 text-center">

                                    @if($item->status=="Aktif")

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                            Aktif

                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex justify-center gap-2">

                                        <a
                                            href="{{ route('guru.edit',$item->id) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form
                                            action="{{ route('guru.destroy',$item->id) }}"
                                            method="POST">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="py-10 text-center text-gray-500">

                                    Belum ada data guru.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="mt-6">

                {{ $guru->links() }}

            </div>

        </div>

    </div>

</x-app-layout>