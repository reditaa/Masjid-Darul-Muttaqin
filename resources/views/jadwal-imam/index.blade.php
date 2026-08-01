<x-app-layout>

<div class="py-6">
    <div class="max-w-7xl mx-auto">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-green-700">
                    Jadwal Imam Masjid
                </h2>

                <a href="{{ route('jadwal-imam.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    + Tambah Jadwal
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif


            {{-- ==================== JADWAL MAKTUBAH ==================== --}}

            <h3 class="text-xl font-bold mb-3">
                Jadwal Maktubah (Dzuhur & Ashar)
            </h3>

            <div class="overflow-x-auto mb-8">

                <table class="min-w-full border border-gray-300">

                    <thead class="bg-green-600 text-white">

                        <tr>
                            <th class="border p-3">Hari</th>
                            <th class="border p-3">Dzuhur</th>
                            <th class="border p-3">Ashar</th>
                            <th class="border p-3 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($jadwalImam as $j)

                        <tr class="hover:bg-gray-50">

                            <td class="border p-3 text-center font-semibold">
                                {{ $j->hari }}
                            </td>

                            <td class="border p-3">

                                @for($i=1;$i<=3;$i++)

                                    @php
                                        $imam = $j->{'dzuhurImam'.$i};
                                    @endphp

                                    @if($imam)

                                        <div>
                                            {{ $i }}.
                                            {{ $imam->anggota->nama ?? '-' }}
                                        </div>

                                    @endif

                                @endfor

                            </td>

                            <td class="border p-3">

                                @for($i=1;$i<=3;$i++)

                                    @php
                                        $imam = $j->{'asharImam'.$i};
                                    @endphp

                                    @if($imam)

                                        <div>
                                            {{ $i }}.
                                            {{ $imam->anggota->nama ?? '-' }}
                                        </div>

                                    @endif

                                @endfor

                            </td>

                            <td class="border p-3 text-center">

                                <a href="{{ route('jadwal-imam.edit',$j->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('jadwal-imam.destroy',$j->id) }}"
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

                            <td colspan="4"
                                class="border p-4 text-center">

                                Belum ada jadwal.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>



            {{-- ==================== JADWAL JUMAT ==================== --}}

            <div class="flex justify-between items-center mb-3">

                <h3 class="text-xl font-bold">
                    Jadwal Jumat
                </h3>

                <a href="{{ route('jadwal-jumat.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    + Tambah Jadwal Jumat

                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full border border-gray-300">

                    <thead class="bg-green-600 text-white">

                        <tr>

                            <th class="border p-3">Pasaran</th>

                            <th class="border p-3">Khatib</th>

                            <th class="border p-3">Imam</th>

                            <th class="border p-3 text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($jadwalJumat as $j)

                        <tr class="hover:bg-gray-50">

                            <td class="border p-3 text-center">
                                {{ $j->pasaran }}
                            </td>

                            <td class="border p-3">
                                {{ $j->khatib->anggota->nama ?? '-' }}
                            </td>

                            <td class="border p-3">
                                {{ $j->imam->anggota->nama ?? '-' }}
                            </td>

                            <td class="border p-3 text-center">

                                <a href="{{ route('jadwal-jumat.edit',$j->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                                    Edit

                                </a>

                                <form action="{{ route('jadwal-jumat.destroy',$j->id) }}"
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

                            <td colspan="4"
                                class="border p-4 text-center">

                                Belum ada jadwal Jumat.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

</x-app-layout>