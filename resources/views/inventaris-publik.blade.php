<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - {{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        html { font-size: 80%; }
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<nav class="sticky top-0 w-full bg-white/95 backdrop-blur shadow z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4 sm:px-6">
        <a href="{{ route('landing') }}" class="flex items-center gap-2 sm:gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-700 flex items-center justify-center overflow-hidden shrink-0">
                <img src="{{ $profil && $profil->logo ? Storage::url($profil->logo) : asset('images/logo-irmas.jpeg') }}"
                     alt="Logo {{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }}"
                     class="w-full h-full object-cover">
            </div>
            <div class="min-w-0">
                <h1 class="font-bold text-sm sm:text-xl text-green-700 leading-tight truncate">{{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }}</h1>
                <p class="text-xs sm:text-sm text-black truncate">{{ $profil->sub_judul ?? 'SMK Negeri 1 Bangsri' }}</p>
            </div>
        </a>

        <a href="{{ route('landing') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-green-700 hover:text-green-800">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</nav>

<!-- ================= HEADER HALAMAN ================= -->
<section class="py-10 sm:py-14 bg-gradient-to-b from-green-50 via-emerald-50 to-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <span class="inline-flex items-center gap-2 bg-white/70 border border-green-200 text-green-700 text-xs sm:text-sm font-medium px-4 py-1.5 rounded-full">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            Inventaris Masjid
        </span>

        <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mt-4">
            {{ $profil->judul_inventaris ?? 'Inventaris Masjid' }}
        </h2>
        <p class="text-gray-600 mt-2 text-sm sm:text-base max-w-xl mx-auto">
            {{ $profil->teks_inventaris ?? 'Data aset dan perlengkapan masjid.' }}
        </p>
    </div>
</section>

<!-- ================= FILTER KATEGORI ================= -->
<section class="bg-white border-b border-gray-100 sticky top-[57px] sm:top-[65px] z-40">
    <div class="max-w-7xl mx-auto px-6 py-3 overflow-x-auto">
        <div class="flex items-center gap-2 w-max">
            <button type="button" onclick="filterKategori(this, 'semua')"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold bg-green-700 text-white transition whitespace-nowrap"
                    data-kategori="semua">
                Semua
            </button>
            @foreach ($daftarKategori as $kat)
                <button type="button" onclick="filterKategori(this, '{{ $kat }}')"
                        class="filter-btn px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition whitespace-nowrap"
                        data-kategori="{{ $kat }}">
                    {{ ucfirst(str_replace('_', ' ', $kat)) }}
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= GRID INVENTARIS ================= -->
<section class="py-10 bg-gray-50 min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="grid-inventaris">
            @forelse ($inventaris as $item)
                <button type="button"
                        onclick="bukaModalInventaris(this)"
                        data-kategori-filter="{{ $item->kategori }}"
                        data-nama="{{ $item->nama_barang }}"
                        data-kategori="{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}"
                        data-jumlah="{{ $item->jumlah }} {{ $item->satuan }}"
                        data-kondisi="{{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}"
                        data-kondisi-raw="{{ $item->kondisi }}"
                        data-lokasi="{{ $item->lokasi_penyimpanan ?? '' }}"
                        data-keterangan="{{ $item->keterangan ?? '' }}"
                        data-foto="{{ $item->foto ? Storage::url($item->foto) : '' }}"
                        class="kartu-inventaris group relative rounded-2xl overflow-hidden shadow bg-white aspect-square text-left w-full cursor-pointer">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    @else
                        <div class="w-full h-full bg-green-100 flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                    @endif

                    <span @class([
                        'absolute top-2 right-2 text-[10px] px-2 py-1 rounded-full font-semibold',
                        'bg-green-100 text-green-700' => $item->kondisi === 'baik',
                        'bg-yellow-100 text-yellow-700' => $item->kondisi === 'rusak_ringan',
                        'bg-red-100 text-red-700' => in_array($item->kondisi, ['rusak_berat', 'hilang']),
                    ])>
                        {{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}
                    </span>

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                        <p class="text-white text-sm font-medium truncate">{{ $item->nama_barang }}</p>
                        <p class="text-gray-200 text-xs">{{ $item->jumlah }} {{ $item->satuan }}</p>
                    </div>
                </button>
            @empty
                <p class="col-span-full text-center text-gray-400 py-10">Belum ada data inventaris.</p>
            @endforelse
        </div>

        <p id="kosong-filter" class="col-span-full text-center text-gray-400 py-10 hidden">
            Tidak ada barang pada kategori ini.
        </p>
    </div>
</section>

<!-- ================= MODAL DETAIL INVENTARIS ================= -->
<div id="modal-inventaris" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50" onclick="tutupModalInventaris()"></div>

    <div class="relative max-w-lg mx-auto mt-16 mb-16 bg-white rounded-3xl shadow-2xl max-h-[80vh] flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <h3 id="inventaris-nama" class="text-xl font-bold text-gray-800">Detail Barang</h3>
            <button onclick="tutupModalInventaris()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-lg shrink-0 ml-4">
                &times;
            </button>
        </div>

        <div class="overflow-y-auto">
            <img id="inventaris-foto" src="" class="w-full h-56 object-cover hidden">

            <div class="px-6 py-5">
                <div class="flex items-center gap-2 flex-wrap">
                    <span id="inventaris-kategori" class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-700"></span>
                    <span id="inventaris-kondisi" class="text-xs px-2 py-1 rounded-full"></span>
                </div>

                <p id="inventaris-jumlah" class="text-gray-700 text-sm font-medium mt-4"></p>

                <p id="inventaris-lokasi-wrap" class="text-gray-600 text-sm mt-2 hidden">
                    Lokasi: <span id="inventaris-lokasi" class="font-medium"></span>
                </p>

                <p id="inventaris-keterangan" class="text-gray-600 text-sm mt-4 leading-relaxed whitespace-pre-line"></p>
            </div>
        </div>
    </div>
</div>

<!-- ================= FOOTER SEDERHANA ================= -->
<footer class="bg-green-900 text-green-100 py-6">
    <div class="max-w-7xl mx-auto px-6 text-center text-sm text-green-300/80">
        <p>&copy; {{ date('Y') }} {{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }} &middot; {{ $profil->sub_judul ?? 'SMK Negeri 1 Bangsri' }}</p>
    </div>
</footer>

<script>
    function filterKategori(btn, kategori) {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-green-700', 'text-white');
            b.classList.add('bg-gray-100', 'text-gray-600');
        });
        btn.classList.remove('bg-gray-100', 'text-gray-600');
        btn.classList.add('bg-green-700', 'text-white');

        const kartu = document.querySelectorAll('.kartu-inventaris');
        let adaYangTampil = false;

        kartu.forEach(k => {
            const cocok = kategori === 'semua' || k.dataset.kategoriFilter === kategori;
            k.classList.toggle('hidden', !cocok);
            if (cocok) adaYangTampil = true;
        });

        document.getElementById('kosong-filter').classList.toggle('hidden', adaYangTampil || kartu.length === 0);
    }

    function bukaModalInventaris(btn) {
        document.getElementById('inventaris-nama').textContent = btn.dataset.nama;
        document.getElementById('inventaris-kategori').textContent = btn.dataset.kategori;

        const kondisi = document.getElementById('inventaris-kondisi');
        kondisi.textContent = btn.dataset.kondisi;
        kondisi.className = 'text-xs px-2 py-1 rounded-full';
        const kondisiColors = {
            baik: 'bg-green-100 text-green-700',
            rusak_ringan: 'bg-yellow-100 text-yellow-700',
            rusak_berat: 'bg-red-100 text-red-700',
            hilang: 'bg-red-100 text-red-700',
        };
        kondisi.classList.add(...(kondisiColors[btn.dataset.kondisiRaw] || 'bg-gray-200 text-gray-600').split(' '));

        document.getElementById('inventaris-jumlah').textContent = 'Jumlah: ' + btn.dataset.jumlah;

        const lokasiWrap = document.getElementById('inventaris-lokasi-wrap');
        if (btn.dataset.lokasi) {
            document.getElementById('inventaris-lokasi').textContent = btn.dataset.lokasi;
            lokasiWrap.classList.remove('hidden');
        } else {
            lokasiWrap.classList.add('hidden');
        }

        document.getElementById('inventaris-keterangan').textContent = btn.dataset.keterangan || '';

        const foto = document.getElementById('inventaris-foto');
        if (btn.dataset.foto) {
            foto.src = btn.dataset.foto;
            foto.classList.remove('hidden');
        } else {
            foto.classList.add('hidden');
        }

        document.getElementById('modal-inventaris').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function tutupModalInventaris() {
        document.getElementById('modal-inventaris').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            tutupModalInventaris();
        }
    });
</script>

</body>
</html>