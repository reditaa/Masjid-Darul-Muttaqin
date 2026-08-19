<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pengumuman
            </h2>

            <a href="{{ route('pengumuman.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i>
                Tambah Pengumuman
            </a>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif


            {{-- TABEL --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Judul
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Kategori
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Tgl Publish
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Dilihat
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            @forelse ($pengumuman as $item)

                                <tr class="hover:bg-gray-50">

                                    {{-- JUDUL --}}
                                    <td class="px-6 py-4">

                                        <button
                                            type="button"
                                            class="btn-detail text-blue-600 hover:text-blue-800 font-medium text-left"
                                            data-judul="{{ $item->judul }}"
                                            data-isi="{{ $item->isi }}"
                                            data-kategori="{{ ucfirst($item->kategori) }}"
                                            data-tanggal="{{ $item->tanggal_publish->translatedFormat('d F Y') }}"
                                            data-dilihat="{{ $item->dilihat }}"
                                            data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                        >
                                            {{ $item->judul }}
                                        </button>

                                    </td>


                                    {{-- KATEGORI --}}
                                    <td class="px-6 py-4">

                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                            {{ ucfirst($item->kategori) }}
                                        </span>

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-4">

                                        {{ $item->tanggal_publish->translatedFormat('d M Y') }}

                                    </td>


                                    {{-- DILIHAT --}}
                                    <td class="px-6 py-4">

                                        {{ $item->dilihat }}

                                    </td>


                                    {{-- STATUS --}}
                                    <td class="px-6 py-4">

                                        <form action="{{ route('pengumuman.toggleStatus', $item) }}"
                                              method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                class="px-2 py-1 text-xs rounded-full
                                                {{ $item->status === 'published'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($item->status === 'draft'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-gray-200 text-gray-600') }}">

                                                {{ ucfirst($item->status) }}

                                            </button>

                                        </form>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center justify-center gap-3">

                                            {{-- DETAIL --}}
                                            <button
                                                type="button"
                                                class="btn-detail w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                                                title="Lihat"

                                                data-judul="{{ $item->judul }}"
                                                data-isi="{{ $item->isi }}"
                                                data-kategori="{{ ucfirst($item->kategori) }}"
                                                data-tanggal="{{ $item->tanggal_publish->translatedFormat('d F Y') }}"
                                                data-dilihat="{{ $item->dilihat }}"
                                                data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                            >

                                                <i class="fas fa-eye"></i>

                                            </button>


                                            {{-- EDIT --}}
                                            <a href="{{ route('pengumuman.edit', $item) }}"
                                               title="Edit"
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">

                                                <i class="fas fa-pen"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form action="{{ route('pengumuman.destroy', $item) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus pengumuman ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
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

                                        Belum ada pengumuman.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $pengumuman->links() }}
            </div>

        </div>
    </div>



    {{-- =====================================================
         MODAL DETAIL
    ====================================================== --}}

    <div id="modalPengumuman"
         class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 p-4">

        <div class="bg-white w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl">


            {{-- GAMBAR --}}
            <div class="relative">

                <img id="detailGambar"
                     src=""
                     alt="Gambar Pengumuman"
                     class="hidden w-full h-64 object-cover rounded-t-2xl">

                <button
                    type="button"
                    id="btnCloseModal"
                    class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black/60 text-white hover:bg-black/80">

                    <i class="fas fa-times"></i>

                </button>

            </div>


            {{-- DETAIL --}}
            <div class="p-6 md:p-8">

                {{-- KATEGORI --}}
                <span id="detailKategori"
                      class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                </span>


                {{-- JUDUL --}}
                <h1 id="detailJudul"
                    class="text-3xl font-bold text-gray-900 mt-4">
                </h1>


                {{-- TANGGAL --}}
                <div class="flex gap-4 text-sm text-gray-500 mt-3">

                    <span>
                        <i class="far fa-calendar mr-1"></i>
                        <span id="detailTanggal"></span>
                    </span>

                    <span>
                        <i class="far fa-eye mr-1"></i>
                        <span id="detailDilihat"></span> dilihat
                    </span>

                </div>


                <div class="border-t my-6"></div>


                {{-- ISI LENGKAP --}}
                <div id="detailIsi"
                     class="text-gray-700 leading-relaxed whitespace-pre-line text-base">
                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         JAVASCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const modal = document.getElementById('modalPengumuman');

            const btnClose = document.getElementById('btnCloseModal');

            const detailJudul = document.getElementById('detailJudul');
            const detailIsi = document.getElementById('detailIsi');
            const detailKategori = document.getElementById('detailKategori');
            const detailTanggal = document.getElementById('detailTanggal');
            const detailDilihat = document.getElementById('detailDilihat');
            const detailGambar = document.getElementById('detailGambar');


            // SEMUA TOMBOL DETAIL
            document.querySelectorAll('.btn-detail').forEach(function (button) {

                button.addEventListener('click', function () {

                    // Ambil data
                    const judul = this.dataset.judul;
                    const isi = this.dataset.isi;
                    const kategori = this.dataset.kategori;
                    const tanggal = this.dataset.tanggal;
                    const dilihat = this.dataset.dilihat;
                    const gambar = this.dataset.gambar;


                    // Masukkan ke modal
                    detailJudul.textContent = judul;
                    detailIsi.textContent = isi;
                    detailKategori.textContent = kategori;
                    detailTanggal.textContent = tanggal;
                    detailDilihat.textContent = dilihat;


                    // Gambar
                    if (gambar && gambar !== '') {

                        detailGambar.src = gambar;
                        detailGambar.classList.remove('hidden');

                    } else {

                        detailGambar.src = '';
                        detailGambar.classList.add('hidden');

                    }


                    // TAMPILKAN MODAL
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    document.body.style.overflow = 'hidden';

                });

            });


            // TOMBOL X
            btnClose.addEventListener('click', function () {

                modal.classList.add('hidden');
                modal.classList.remove('flex');

                document.body.style.overflow = '';

            });


            // KLIK LUAR MODAL
            modal.addEventListener('click', function (event) {

                if (event.target === modal) {

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                    document.body.style.overflow = '';

                }

            });


            // TOMBOL ESC
            document.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                    document.body.style.overflow = '';

                }

            });

        });

    </script>

</x-app-layout>