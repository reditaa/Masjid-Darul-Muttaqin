<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Jadwal Khotib - Imam Sholat Jumat
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto">


            @if(session('success'))

                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>

            @endif



            <div class="flex justify-between mb-5">

                <h3 class="text-lg font-semibold">
                    Daftar Jadwal Jumat
                </h3>


                <a href="{{ route('jadwal-jumat.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded">

                    + Tambah Jadwal

                </a>

            </div>




            <div class="bg-white shadow rounded-lg overflow-hidden">


                <table class="w-full text-left">


                    <thead class="bg-gray-100">

                        <tr>

                            <th class="p-3">
                                No
                            </th>

                            <th class="p-3">
                                Pasaran
                            </th>


                            <th class="p-3">
                                Khotib
                            </th>


                            <th class="p-3">
                                Imam
                            </th>


                            <th class="p-3">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    @forelse($jadwalJumat as $item)


                        <tr class="border-t">


                            <td class="p-3">
                                {{ $loop->iteration }}
                            </td>


                            <td class="p-3 font-semibold">
                                {{ $item->pasaran }}
                            </td>



                            <td class="p-3">

                                {{ $item->khotib?->nama ?? '-' }}

                                <br>

                                @if($item->khotib?->anggota?->jenis == 'Guru')

                                    <small>
                                        NIP:
                                        {{ $item->khotib->nip_nis }}
                                    </small>

                                @endif

                            </td>




                            <td class="p-3">

                                {{ $item->imam?->nama ?? '-' }}

                                <br>

                                @if($item->imam?->anggota?->jenis == 'Guru')

                                    <small>
                                        NIP:
                                        {{ $item->imam->nip_nis }}
                                    </small>

                                @endif

                            </td>




                            <td class="p-3">


                                <a href="{{ route('jadwal-jumat.edit',$item->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </a>



                                <form action="{{ route('jadwal-jumat.destroy',$item->id) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        onclick="return confirm('Hapus jadwal?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>


                                </form>


                            </td>


                        </tr>



                    @empty


                        <tr>

                            <td colspan="5" class="p-5 text-center">

                                Belum ada jadwal Jumat

                            </td>

                        </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>


        </div>

    </div>


</x-app-layout>