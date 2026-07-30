<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Pengurus DKM
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-xl p-6">


                <div class="flex justify-between items-center mb-6">

                    <h3 class="text-xl font-bold">
                        Daftar Pengurus Masjid
                    </h3>


                    <a href="{{ route('pengurus.create') }}"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

                        + Tambah Pengurus

                    </a>

                </div>



                <form method="GET" class="mb-6">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari jabatan..."
                        class="border rounded-lg p-2 w-full md:w-1/3">

                </form>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


                    @forelse($pengurus as $item)


                    <div class="border rounded-xl shadow-sm p-5">


                        <div class="flex items-center gap-4">


                            <img
                                src="{{ $item->foto 
                                    ? asset('storage/'.$item->foto) 
                                    : asset('images/default-user.png') }}"
                                class="w-20 h-20 rounded-full object-cover border">


                            <div>

                                <h4 class="font-bold text-lg">
                                    {{ $item->nama }}
                                </h4>


                                <p class="text-sm text-gray-600">

                                    @if($item->anggota?->jenis == 'Guru')

                                        NIP:
                                        {{ $item->nip_nis }}

                                    @elseif($item->anggota?->jenis == 'Siswa')

                                        NIS:
                                        {{ $item->nip_nis }}

                                    @endif

                                </p>


                            </div>


                        </div>



                        <div class="mt-5">


                            <p>
                                <span class="font-semibold">
                                    Jabatan:
                                </span>

                                {{ $item->jabatan }}
                            </p>



                            <p>
                                <span class="font-semibold">
                                    Mulai:
                                </span>

                                {{ $item->mulai_jabatan }}
                            </p>



                            <p class="mt-2">


                                @if($item->status == 'Aktif')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Aktif
                                    </span>

                                @else

                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                        Nonaktif
                                    </span>

                                @endif


                            </p>


                        </div>




                        <div class="mt-5 flex gap-2">


                            <a href="{{ route('pengurus.edit',$item->id) }}"
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg">

                                Edit

                            </a>


                            <form action="{{ route('pengurus.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')


                                <button
                                    onclick="return confirm('Hapus data pengurus?')"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg">

                                    Hapus

                                </button>


                            </form>


                        </div>



                    </div>


                    @empty


                    <div class="col-span-3 text-center text-gray-500">

                        Belum ada data pengurus.

                    </div>


                    @endforelse


                </div>



                <div class="mt-6">

                    {{ $pengurus->links() }}

                </div>


            </div>

        </div>

    </div>


</x-app-layout>