<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal - Masjid Darul Muttaqin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }

        html {
            font-size: 80%;
        }

        * {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero {
            background-size: cover;
            background-position: center;
        }

        section[id] {
            scroll-margin-top: 5.5rem;
        }

        @keyframes heroFadeIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-fade-in {
            opacity: 0;
            animation: heroFadeIn .7s ease-out forwards;
        }

        /* ===== Tema Notebook Hijau untuk Jadwal ===== */
        .kartu-notebook {
            position: relative;
            background: #fbf9f0;
            border: 2px solid #15803d;
            border-radius: 6px 6px 20px 20px;
            box-shadow: 0 10px 25px -8px rgba(21, 128, 61, .25);
            padding: 28px 20px 20px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .kartu-notebook:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px -8px rgba(21, 128, 61, .3);
        }

        .ring-spiral {
            position: absolute;
            top: -12px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 14px;
        }

        .ring-spiral span {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fbf9f0;
            border: 2.5px solid #15803d;
        }

        .ornamen-pojok {
            position: absolute;
            top: 10px;
            right: 12px;
            width: 20px;
            height: 20px;
            color: rgba(21, 128, 61, .35);
        }

        .judul-kartu {
            text-align: center;
            font-weight: 800;
            font-size: 1.15rem;
            color: #14532d;
        }

        .garis-bawah {
            width: 48px;
            height: 4px;
            background: #15803d;
            border-radius: 999px;
            margin: 6px auto 16px;
        }

        .label-kartu {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #16a34a;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .isi-kartu {
            font-size: .875rem;
            color: #1f2937;
            line-height: 1.4;
        }

        /* ===== Bagan Struktur Pengurus ===== */
        .bagan-pengurus {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 8px;
        }

        .bagan-trunk {
            width: 2px;
            height: 26px;
            background: #86efac;
        }

        .bagan-jabatan-label {
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 6px 18px;
            border-radius: 9999px;
            border: 1.5px solid #86efac;
            white-space: nowrap;
        }

        .bagan-nodes {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            row-gap: 28px;
        }

        .bagan-node {
            position: relative;
            padding: 20px 14px 0 14px;
        }

        .bagan-node::before,
        .bagan-node::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #86efac;
            width: 50%;
            height: 20px;
        }

        .bagan-node::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #86efac;
        }

        .bagan-node:first-child::before {
            border: 0 none;
        }

        .bagan-node:last-child::after {
            border: 0 none;
        }

        .bagan-node:last-child::before {
            border-right: 2px solid #86efac;
            border-radius: 0 8px 0 0;
        }

        .bagan-node:first-child::after {
            border-radius: 8px 0 0 0;
        }

        .bagan-node:only-child {
            padding-top: 20px;
        }

        .bagan-node:only-child::before {
            display: none;
        }

        .bagan-node:only-child::after {
            right: auto;
            left: 50%;
            width: 0;
            border-top: none;
            border-left: 2px solid #86efac;
            border-radius: 0;
        }

        .bagan-card {
            background: #ffffff;
            border: 1.5px solid #bbf7d0;
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            min-width: 130px;
            box-shadow: 0 2px 8px -2px rgba(21, 128, 61, .15);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .bagan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px -4px rgba(21, 128, 61, .25);
        }

        .bagan-avatar,
        .bagan-avatar-img {
            width: 42px;
            height: 42px;
            border-radius: 9999px;
        }

        .bagan-avatar {
            background: #dcfce7;
            color: #15803d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .bagan-avatar-img {
            object-fit: cover;
        }

        .bagan-nama {
            font-size: .8rem;
            font-weight: 600;
            color: #1f2937;
            text-align: center;
            line-height: 1.3;
        }
    </style>
</head>
<!-- ================= NAVBAR ================= -->
<nav class="fixed w-full bg-white/95 backdrop-blur shadow z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4 sm:px-6">
        <div class="flex items-center gap-2 sm:gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-700 flex items-center justify-center overflow-hidden shrink-0">
                <img src="{{ asset('images/logo-irmas.jpeg') }}" alt="Logo IRMAS Darul Muttaqin" class="w-full h-full object-cover">
            </div>
            <div class="min-w-0">
                <h1 class="font-bold text-sm sm:text-xl text-green-700 leading-tight truncate">Masjid Darul Muttaqin</h1>
                <p class="text-xs sm:text-sm text-black truncate">SMK Negeri 1 Bangsri</p>
            </div>
        </div>

        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ url('/') }}" class="hover:text-green-700">Beranda</a>
            <a href="{{ url('/') }}#tentang" class="hover:text-green-700">Tentang</a>
            <a href="{{ url('/') }}#statistik" class="hover:text-green-700">Statistik</a>
            <a href="{{ url('/') }}#pengumuman" class="hover:text-green-700">Pengumuman</a>
            <a href="{{ route('jadwal') }}" class="text-green-700 font-semibold">Jadwal</a>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('anggota.dashboard') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">
                        Dashboard Saya
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">
                    Login Admin
                </a>
            @endauth
        </div>

        <button type="button" onclick="toggleMenuMobile()" class="lg:hidden shrink-0 w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100">
            <svg id="icon-menu-buka" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
            <svg id="icon-menu-tutup" class="w-6 h-6 text-green-700 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="menu-mobile" class="hidden lg:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-1">
        <a href="{{ url('/') }}" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-lg hover:bg-gray-50">Beranda</a>
        <a href="{{ url('/') }}#tentang" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-lg hover:bg-gray-50">Tentang</a>
        <a href="{{ url('/') }}#statistik" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-lg hover:bg-gray-50">Statistik</a>
        <a href="{{ url('/') }}#pengumuman" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-lg hover:bg-gray-50">Pengumuman</a>
        <a href="{{ route('jadwal') }}" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-lg bg-green-50 text-green-700 font-semibold">Jadwal</a>

        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg mt-2">
                    Dashboard Admin
                </a>
            @else
                <a href="{{ route('anggota.dashboard') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg mt-2">
                    Dashboard Saya
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg mt-2">
                Login Admin
            </a>
        @endauth
    </div>
</nav>

<!-- ================= HEADER HALAMAN JADWAL ================= -->
<section class="pt-28 pb-8 bg-gradient-to-b from-green-50 via-emerald-50 to-white" x-data="{ tab: 'imam' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-xs sm:text-sm font-medium px-4 py-1.5 rounded-full">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Jadwal Masjid
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-green-800 mt-4">
            Semua Jadwal Petugas
        </h1>
        <p class="text-gray-600 mt-2 text-sm sm:text-base max-w-2xl mx-auto">
            Lihat jadwal Imam & Muazin harian, jadwal Jumat, jadwal Bilal, dan jadwal piket kebersihan masjid dalam satu halaman.
        </p>

        <!-- Tab -->
        <div class="flex flex-wrap justify-center gap-2 mt-8">
            <button @click="tab = 'imam'"
                    :class="tab === 'imam' ? 'bg-green-700 text-white' : 'bg-white text-green-700 border border-green-300'"
                    class="px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition">
                Imam &amp; Muazin
            </button>
            <button @click="tab = 'jumat'"
                    :class="tab === 'jumat' ? 'bg-green-700 text-white' : 'bg-white text-green-700 border border-green-300'"
                    class="px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition">
                Jumat
            </button>
            <button @click="tab = 'bilal'"
                    :class="tab === 'bilal' ? 'bg-green-700 text-white' : 'bg-white text-green-700 border border-green-300'"
                    class="px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition">
                Bilal
            </button>
            <button @click="tab = 'piket'"
                    :class="tab === 'piket' ? 'bg-green-700 text-white' : 'bg-white text-green-700 border border-green-300'"
                    class="px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition">
                Piket Kebersihan
            </button>
        </div>
    </div>

    <!-- ================= ISI: JADWAL IMAM & MUAZIN ================= -->
    <div x-show="tab === 'imam'" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 mt-10">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_imam_muazin ?? 'Jadwal Imam & Muazin' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm">
            {{ $profil->teks_jadwal_imam_muazin ?? 'Jadwal petugas sholat sepanjang pekan.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-10">
            @forelse ($jadwalImamMuazin->groupBy('hari') as $hari => $itemHari)
                @php $idHari = 'jadwal-hari-' . Str::slug($hari); @endphp

                <div class="kartu-notebook">
                    <div class="ring-spiral">
                        @for ($r = 0; $r < 6; $r++)
                            <span></span>
                        @endfor
                    </div>

                    <svg class="ornamen-pojok" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>

                    <h3 class="judul-kartu capitalize">{{ $hari }}</h3>
                    <div class="garis-bawah"></div>

                    <div class="flex flex-wrap justify-center gap-1.5 mb-4">
                        @foreach ($itemHari as $index => $item)
                            @php $idWaktu = $idHari . '-waktu-' . $index; @endphp
                            <button type="button"
                                    id="{{ $idWaktu }}-btn"
                                    onclick="pilihWaktuSholat('{{ $idHari }}', {{ $index }})"
                                    class="waktu-btn-{{ $idHari }} px-3 py-1 rounded-full text-xs font-semibold capitalize transition {{ $index === 0 ? 'bg-green-700 text-white' : 'bg-white text-green-700 border border-green-300 hover:border-green-500' }}">
                                {{ $item->waktu_sholat }}
                            </button>
                        @endforeach
                    </div>

                    @foreach ($itemHari as $index => $item)
                        @php $idWaktu = $idHari . '-waktu-' . $index; @endphp
                        <div id="{{ $idWaktu }}"
                             class="{{ $index === 0 ? '' : 'hidden' }} waktu-panel-{{ $idHari }} grid grid-cols-2 gap-3 border-t border-dashed border-green-300 pt-3">
                            <div>
                                <p class="label-kartu">Imam</p>
                                @forelse ($item->imam as $imam)
                                    <p class="isi-kartu">{{ $imam->nama }}</p>
                                @empty
                                    <p class="isi-kartu text-gray-400">-</p>
                                @endforelse
                            </div>
                            <div>
                                <p class="label-kartu">Muazin</p>
                                @forelse ($item->muazin as $muazin)
                                    <p class="isi-kartu">{{ $muazin->nama }}</p>
                                @empty
                                    <p class="isi-kartu text-gray-400">-</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-400 bg-white rounded-2xl shadow py-8">Belum ada jadwal.</p>
            @endforelse
        </div>
    </div>

    <!-- ================= ISI: JADWAL JUMAT ================= -->
    <div x-show="tab === 'jumat'" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 mt-10">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_jumat ?? 'Jadwal Jumat' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm">
            {{ $profil->teks_jadwal_jumat ?? 'Jadwal Khatib, Imam & Bilal shalat Jumat berdasarkan siklus pasaran.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-10">
            @forelse ($jadwalJumat as $item)
                <div class="kartu-notebook">
                    <div class="ring-spiral">
                        @for ($r = 0; $r < 6; $r++)
                            <span></span>
                        @endfor
                    </div>

                    <svg class="ornamen-pojok" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>

                    <h3 class="judul-kartu capitalize">{{ $item->pasaran }}</h3>
                    <div class="garis-bawah"></div>

                    <div class="grid grid-cols-3 gap-2 border-t border-dashed border-green-300 pt-3">
                        <div>
                            <p class="label-kartu">Khatib</p>
                            @forelse ($item->khatib as $khatib)
                                <p class="isi-kartu">{{ $khatib->nama }}</p>
                            @empty
                                <p class="isi-kartu text-gray-400">-</p>
                            @endforelse
                        </div>
                        <div>
                            <p class="label-kartu">Imam</p>
                            @forelse ($item->imam as $imam)
                                <p class="isi-kartu">{{ $imam->nama }}</p>
                            @empty
                                <p class="isi-kartu text-gray-400">-</p>
                            @endforelse
                        </div>
                        <div>
                            <p class="label-kartu">Bilal</p>
                            @forelse ($item->bilal as $bilal)
                                <p class="isi-kartu">{{ $bilal->nama }}</p>
                            @empty
                                <p class="isi-kartu text-gray-400">-</p>
                            @endforelse
                        </div>
                    </div>

                    @if ($item->keterangan)
                        <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-dashed border-green-200">
                            {{ $item->keterangan }}
                        </p>
                    @endif
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-400 bg-white rounded-2xl shadow py-8">Belum ada jadwal Jumat.</p>
            @endforelse
        </div>
    </div>

    <!-- ================= ISI: JADWAL BILAL ================= -->
    <div x-show="tab === 'bilal'" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 mt-10">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_bilal ?? 'Jadwal Bilal' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm">
            {{ $profil->teks_jadwal_bilal ?? 'Petugas bilal berdasarkan siklus pasaran.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-10">
            @forelse ($jadwalBilal as $item)
                <div class="kartu-notebook">
                    <div class="ring-spiral">
                        @for ($r = 0; $r < 6; $r++)
                            <span></span>
                        @endfor
                    </div>

                    <svg class="ornamen-pojok" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>

                    <h3 class="judul-kartu capitalize">{{ $item->pasaran }}</h3>
                    <div class="garis-bawah"></div>

                    <div class="border-t border-dashed border-green-300 pt-3">
                        <p class="label-kartu">Petugas</p>
                        @forelse ($item->anggota as $anggota)
                            <p class="isi-kartu">{{ $anggota->nama }}</p>
                        @empty
                            <p class="isi-kartu text-gray-400">-</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-400 bg-white rounded-2xl shadow py-8">Belum ada jadwal bilal.</p>
            @endforelse
        </div>
    </div>

    <!-- ================= ISI: JADWAL PIKET KEBERSIHAN ================= -->
    <div x-show="tab === 'piket'" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 mt-10">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_piket ?? 'Jadwal Piket Kebersihan' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm">
            {{ $profil->teks_jadwal_piket ?? 'Petugas kebersihan masjid setiap harinya.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-10">
            @forelse ($jadwalPiket as $item)
                <div class="kartu-notebook">
                    <div class="ring-spiral">
                        @for ($r = 0; $r < 6; $r++)
                            <span></span>
                        @endfor
                    </div>

                    <svg class="ornamen-pojok" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>

                    <h3 class="judul-kartu capitalize">{{ $item->hari }}</h3>
                    <div class="garis-bawah"></div>

                    <div class="border-t border-dashed border-green-300 pt-3">
                        <p class="label-kartu">Petugas</p>
                        @forelse ($item->anggota as $anggota)
                            <p class="isi-kartu">{{ $anggota->nama }}</p>
                        @empty
                            <p class="isi-kartu text-gray-400">-</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-400 bg-white rounded-2xl shadow py-8">Belum ada jadwal piket.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-green-900 text-green-100 py-6">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="font-bold text-white text-base">Masjid Darul Muttaqin</p>
        <p class="text-xs mt-1">SMK Negeri 1 Bangsri</p>
        <p class="text-xs mt-3 text-green-300">
            &copy; {{ date('Y') }} SIMMADI — Sistem Manajemen Masjid Digital
        </p>
    </div>
</footer>

<script>
    function pilihWaktuSholat(idHari, index) {
        const idWaktuAktif = idHari + '-waktu-' + index;

        document.querySelectorAll('.waktu-panel-' + idHari).forEach(function (panel) {
            panel.classList.toggle('hidden', panel.id !== idWaktuAktif);
        });

        document.querySelectorAll('.waktu-btn-' + idHari).forEach(function (btn) {
            const aktif = btn.id === idWaktuAktif + '-btn';
            btn.classList.toggle('bg-green-700', aktif);
            btn.classList.toggle('text-white', aktif);
            btn.classList.toggle('bg-white', !aktif);
            btn.classList.toggle('text-green-700', !aktif);
            btn.classList.toggle('border', !aktif);
            btn.classList.toggle('border-green-300', !aktif);
        });
    }

    function toggleMenuMobile() {
        document.getElementById('menu-mobile').classList.toggle('hidden');
        document.getElementById('icon-menu-buka').classList.toggle('hidden');
        document.getElementById('icon-menu-tutup').classList.toggle('hidden');
    }

    function tutupMenuMobile() {
        document.getElementById('menu-mobile').classList.add('hidden');
        document.getElementById('icon-menu-buka').classList.remove('hidden');
        document.getElementById('icon-menu-tutup').classList.add('hidden');
    }
</script>

</body>
</html>