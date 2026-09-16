<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Darul Muttaqin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
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

        /* ===== Blob dekoratif melayang di hero ===== */
        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -25px) scale(1.08); }
        }

        .hero-blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(70px);
            opacity: .35;
            pointer-events: none;
            animation: blobFloat 10s ease-in-out infinite;
        }

        /* ===== Divider lengkung antar section ===== */
        .divider-wave {
            display: block;
            width: 100%;
            height: 60px;
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

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<nav class="fixed w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
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
            <a href="#" class="hover:text-green-700">Beranda</a>
            <a href="#tentang" class="hover:text-green-700">Tentang</a>
            <a href="#statistik" class="hover:text-green-700">Statistik</a>
            <a href="#pengumuman" class="hover:text-green-700">Pengumuman</a>
            <a href="#jadwal" class="hover:text-green-700">Jadwal</a>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full shadow-sm hover:shadow-md transition">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('anggota.dashboard') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full shadow-sm hover:shadow-md transition">
                        Dashboard Saya
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full shadow-sm hover:shadow-md transition">
                    Login Admin
                </a>
            @endauth
        </div>

        <button type="button" onclick="toggleMenuMobile()" class="lg:hidden shrink-0 w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100">
            <svg id="icon-menu-buka" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
            <svg id="icon-menu-tutup" class="w-6 h-6 text-green-700 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="menu-mobile" class="hidden lg:hidden border-t border-gray-100 bg-white/95 backdrop-blur px-4 py-3 space-y-1">
        <a href="#" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-xl hover:bg-gray-50">Beranda</a>
        <a href="#tentang" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-xl hover:bg-gray-50">Tentang</a>
        <a href="#statistik" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-xl hover:bg-gray-50">Statistik</a>
        <a href="#pengumuman" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-xl hover:bg-gray-50">Pengumuman</a>
        <a href="#jadwal" onclick="tutupMenuMobile()" class="block px-3 py-2 rounded-xl hover:bg-gray-50">Jadwal</a>

        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full mt-2">
                    Dashboard Admin
                </a>
            @else
                <a href="{{ route('anggota.dashboard') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full mt-2">
                    Dashboard Saya
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="block text-center bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full mt-2">
                Login Admin
            </a>
        @endauth
    </div>
</nav>

<section class="hero relative min-h-[75vh] sm:min-h-[92vh] flex items-center pt-28 pb-24 sm:py-28 overflow-hidden" style="background-image: url('{{ $profil && $profil->foto_hero ? Storage::url($profil->foto_hero) : 'https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=2000' }}');">
    <!-- Overlay gradient lembut + sedikit blur, bukan hitam solid -->
    <div class="absolute inset-0" style="background: linear-gradient(160deg, rgba(6,40,26,.25) 0%, rgba(6,35,22,.55) 55%, rgba(3,18,11,.85) 100%);"></div>
    <div class="absolute inset-0 backdrop-blur-[1px]"></div>

    <!-- Blob dekoratif hijau melayang biar tidak terasa kotak -->
    <div class="hero-blob w-72 h-72 sm:w-96 sm:h-96 bg-emerald-400 -top-16 -left-16"></div>
    <div class="hero-blob w-64 h-64 sm:w-80 sm:h-80 bg-teal-300 bottom-0 -right-10" style="animation-delay: 2.5s;"></div>

    <!-- Vignette lembut di tepi supaya foto menyatu dengan section berikutnya -->
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-white/95 to-transparent"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 text-white">
        <span class="hero-fade-in inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/25 text-green-50 text-xs sm:text-sm font-medium px-4 py-1.5 rounded-full shadow-lg shadow-black/10" style="animation-delay: .05s;">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-3.5-2.5-7-5.5-7-10a7 7 0 1 1 14 0c0 4.5-3.5 7.5-7 10Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 13.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            </svg>
            Sistem Informasi Masjid Digital
        </span>

        <h1 class="hero-fade-in text-3xl sm:text-5xl md:text-6xl font-extrabold leading-[1.05] mt-5 drop-shadow-sm" style="animation-delay: .15s;">
            {{ $profil ? Str::words($profil->nama_masjid, 1, '') : 'Masjid' }}<br>
            <span class="text-green-400">{{ $profil ? trim(Str::after($profil->nama_masjid, ' ')) : 'Darul Muttaqin' }}</span>
        </h1>

        <p class="hero-fade-in mt-4 sm:mt-5 text-sm sm:text-base md:text-lg max-w-2xl text-gray-100" style="animation-delay: .25s;">
            {{ $profil && $profil->slogan ? $profil->slogan : 'Sistem Informasi Masjid Sekolah untuk memudahkan pengelolaan jadwal imam, jadwal Jumat, pengurus, dan pengumuman kegiatan.' }}
        </p>

        <div class="hero-fade-in mt-8 sm:mt-10 flex flex-col sm:flex-row gap-3 sm:gap-4" style="animation-delay: .35s;">
            <a href="#jadwal" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-500 hover:-translate-y-0.5 shadow-xl shadow-green-900/40 px-6 py-3.5 rounded-2xl text-base sm:text-lg font-semibold transition">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                Lihat Jadwal
            </a>
            <a href="#pengumuman" class="inline-flex items-center justify-center gap-2 bg-white/95 hover:bg-white text-green-700 hover:-translate-y-0.5 shadow-xl px-6 py-3.5 rounded-2xl text-base sm:text-lg font-semibold transition backdrop-blur-md">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                Pengumuman
            </a>
        </div>
    </div>

    <a href="#tentang" class="hero-fade-in absolute bottom-6 left-1/2 -translate-x-1/2 text-white/70 hover:text-white transition z-10" style="animation-delay: .5s;" aria-label="Scroll ke bawah">
        <svg class="w-7 h-7 animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </a>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <div>
                @if($profil && $profil->foto_utama)
                    <img src="{{ Storage::url($profil->foto_utama) }}"
                         class="rounded-3xl shadow-lg w-full h-auto max-h-[500px] object-contain bg-gray-100">
                @else
                    <img src="https://images.unsplash.com/photo-1512632578888-169bbbc64f33?q=80&w=1200"
                         class="rounded-3xl shadow-lg w-full h-auto max-h-[500px] object-contain bg-gray-100">
                @endif
            </div>

            <div>
                <span class="text-green-700 font-semibold text-sm">Tentang Masjid</span>
                <h2 class="text-2xl sm:text-3xl font-bold mt-2">{{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }}</h2>

                <p class="text-gray-700 mt-4 leading-7 text-base sm:text-lg">
                    {{ $profil && $profil->deskripsi ? $profil->deskripsi : 'Masjid Darul Muttaqin merupakan pusat kegiatan keagamaan di lingkungan sekolah. Website ini dibuat untuk mempermudah pengelolaan jadwal imam, jadwal Jumat, pengurus DKM, serta penyampaian pengumuman kepada seluruh warga sekolah.' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <button type="button" onclick="bukaModalVisiMisi()"
                            class="bg-green-50 rounded-2xl p-5 text-left w-full hover:-translate-y-1 hover:shadow-lg transition cursor-pointer">
                        <svg class="w-8 h-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        <h3 class="font-bold mt-3 text-lg">Visi</h3>
                        <p class="text-gray-600 text-base mt-2 leading-relaxed line-clamp-3">
                            {{ $profil && $profil->visi ? Str::limit($profil->visi, 90) : 'Belum diatur.' }}
                        </p>
                    </button>
                    <button type="button" onclick="bukaModalVisiMisi()"
                            class="bg-blue-50 rounded-2xl p-5 text-left w-full hover:-translate-y-1 hover:shadow-lg transition cursor-pointer">
                        <svg class="w-8 h-8 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        <h3 class="font-bold mt-3 text-lg">Misi</h3>
                        <p class="text-gray-600 text-base mt-2 leading-relaxed line-clamp-3">
                            {{ $profil && $profil->misi ? Str::limit($profil->misi, 90) : 'Belum diatur.' }}
                        </p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATISTIK ================= -->
<section id="statistik" class="py-14 bg-gradient-to-b from-green-50 via-emerald-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center">{{ $profil->judul_statistik ?? 'Statistik Masjid' }}</h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">{{ $profil->teks_statistik ?? 'Data diperbarui secara otomatis.' }}</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">

            <button type="button" onclick="bukaModalPengurus()"
                    class="bg-white rounded-3xl shadow p-5 text-center hover:-translate-y-1 hover:shadow-lg transition cursor-pointer w-full flex flex-col items-center justify-center min-h-[160px] sm:min-h-[180px]">
                <svg class="w-8 h-8 mx-auto text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <h3 class="text-2xl sm:text-3xl font-bold mt-2 text-green-700">{{ $jumlahPengurus }}</h3>
                <p class="mt-1 text-gray-600 text-sm">Pengurus</p>
                <p class="text-xs text-green-600 mt-1 whitespace-nowrap">Lihat bagan &rarr;</p>
            </button>

            <a href="#kegiatan"
               class="bg-white rounded-3xl shadow p-5 text-center hover:-translate-y-1 hover:shadow-lg transition cursor-pointer flex flex-col items-center justify-center min-h-[160px] sm:min-h-[180px]">
                <svg class="w-8 h-8 mx-auto text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <h3 class="text-2xl sm:text-3xl font-bold mt-2 text-blue-700">{{ $jumlahKegiatan }}</h3>
                <p class="mt-1 text-gray-600 text-sm">Kegiatan</p>
            </a>

            <a href="#pengumuman"
               class="bg-white rounded-3xl shadow p-5 text-center hover:-translate-y-1 hover:shadow-lg transition cursor-pointer flex flex-col items-center justify-center min-h-[160px] sm:min-h-[180px]">
                <svg class="w-8 h-8 mx-auto text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                <h3 class="text-2xl sm:text-3xl font-bold mt-2 text-red-600">{{ $jumlahPengumuman }}</h3>
                <p class="mt-1 text-gray-600 text-sm">Pengumuman</p>
            </a>

            <a href="#jadwal"
               class="bg-white rounded-3xl shadow p-5 text-center hover:-translate-y-1 hover:shadow-lg transition cursor-pointer flex flex-col items-center justify-center min-h-[160px] sm:min-h-[180px]">
                <svg class="w-8 h-8 mx-auto text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="text-2xl sm:text-3xl font-bold mt-2 text-yellow-600">{{ $jumlahJadwal }}</h3>
                <p class="mt-1 text-gray-600 text-sm whitespace-nowrap">Jadwal Harian</p>
            </a>

        </div>
    </div>
</section>

<!-- ================= PENGUMUMAN ================= -->
<section id="pengumuman" class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center">{{ $profil->judul_pengumuman ?? 'Pengumuman Terbaru' }}</h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">{{ $profil->teks_pengumuman ?? 'Informasi dan kegiatan terkini masjid.' }}</p>

        <div class="grid md:grid-cols-3 gap-5 mt-8">
            @forelse ($pengumuman as $item)
                <a href="{{ route('pengumuman.public', $item->slug) }}"
                   class="block bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-1 hover:shadow-lg transition">
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-green-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </div>
                        <h3 class="font-bold text-base mt-2">{{ $item->judul }}</h3>

                        <p class="text-gray-500 text-xs mt-1">
                            <svg class="w-3.5 h-3.5 inline-block -mt-0.5 mr-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09" />
                            </svg>
                            Dipublikasikan {{ $item->tanggal_publish->translatedFormat('d F Y') }}
                        </p>

                        @if ($item->tanggal_berakhir)
                            <p class="text-xs text-blue-600 font-medium mt-1">
                                <svg class="w-3.5 h-3.5 inline-block -mt-0.5 mr-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                Berlaku {{ $item->tanggal_publish->translatedFormat('d M Y') }}
                                &ndash; {{ $item->tanggal_berakhir->translatedFormat('d M Y') }}
                            </p>
                        @endif

                        <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                        @if ($item->kegiatan)
                            <p class="text-xs text-blue-600 mt-2">
                                Terkait kegiatan: {{ $item->kegiatan->judul }}
                            </p>
                        @endif
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-center text-gray-400">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= KEGIATAN ================= -->
<section id="kegiatan" class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center">{{ $profil->judul_kegiatan ?? 'Kegiatan Masjid' }}</h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">{{ $profil->teks_kegiatan ?? 'Riwayat agenda masjid terkini.' }}</p>

        <div class="grid md:grid-cols-3 gap-5 mt-8">
            @forelse ($kegiatan as $item)
                @php
                    $tanggalAcuan = $item->tanggal_selesai ?? $item->tanggal_mulai;
                    $sudahLewat = $tanggalAcuan && $tanggalAcuan->lt(now()->startOfDay());
                    $sudahSelesai = $item->status === 'selesai' || $sudahLewat;

                    if ($item->status === 'dibatalkan') {
                        $labelStatus = 'Dibatalkan';
                        $statusKey = 'dibatalkan';
                    } elseif ($sudahSelesai) {
                        $labelStatus = 'Selesai';
                        $statusKey = 'selesai';
                    } else {
                        $labelStatus = ucfirst(str_replace('_', ' ', $item->status));
                        $statusKey = $item->status;
                    }
                @endphp
                <button type="button"
                        onclick="bukaModalKegiatan(this)"
                        data-judul="{{ $item->judul }}"
                        data-kategori="{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}"
                        data-status="{{ $labelStatus }}"
                        data-status-raw="{{ $statusKey }}"
                        data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}"
                        data-lokasi="{{ $item->lokasi ?? '' }}"
                        data-deskripsi="{{ $item->deskripsi ? strip_tags($item->deskripsi) : '' }}"
                        data-poster="{{ $item->poster ? Storage::url($item->poster) : '' }}"
                        data-pengumuman='@json($item->pengumumans->map(fn($p) => ["judul" => $p->judul, "slug" => $p->slug]))'
                        class="text-left w-full bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-1 hover:shadow-lg transition cursor-pointer">
                    @if ($item->poster)
                        <img src="{{ Storage::url($item->poster) }}" class="w-full h-36 object-cover">
                    @else
                        <div class="w-full h-36 bg-blue-100 flex items-center justify-center">
                            <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>
                            <span @class([
                                'text-xs px-2 py-1 rounded-full',
                                'bg-green-100 text-green-700' => $statusKey === 'selesai',
                                'bg-blue-100 text-blue-700' => in_array($statusKey, ['akan_datang', 'berlangsung']),
                                'bg-red-100 text-red-700' => $statusKey === 'dibatalkan',
                            ])>
                                {{ $labelStatus }}
                            </span>
                        </div>
                        <h3 class="font-bold text-base mt-2">{{ $item->judul }}</h3>
                        <p class="text-gray-500 text-xs mt-1">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                            @if ($item->lokasi)
                                &middot; {{ $item->lokasi }}
                            @endif
                        </p>
                        @if ($item->deskripsi)
                            <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                                {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                            </p>
                        @endif
                        @if ($item->pengumumans->count() > 0)
                            <p class="text-xs text-green-600 mt-2">
                                {{ $item->pengumumans->count() }} pengumuman terkait
                            </p>
                        @endif
                    </div>
                </button>
            @empty
                <p class="col-span-3 text-center text-gray-400">Belum ada kegiatan.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= JADWAL IMAM & MUAZIN ================= -->
<section id="jadwal" class="py-14 bg-gradient-to-b from-green-50 via-emerald-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_imam_muazin ?? 'Jadwal Imam & Muazin' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">
            {{ $profil->teks_jadwal_imam_muazin ?? 'Jadwal petugas sholat sepanjang pekan.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-12">
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
                <p class="col-span-3 text-center text-gray-400 bg-white rounded-3xl shadow py-8">Belum ada jadwal.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= JADWAL JUMAT ================= -->
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_jumat ?? 'Jadwal Jumat' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">
            {{ $profil->teks_jadwal_jumat ?? 'Jadwal Khatib, Imam & Bilal shalat Jumat berdasarkan siklus pasaran.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-12">
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
                <p class="col-span-3 text-center text-gray-400 bg-white rounded-3xl shadow py-8">Belum ada jadwal Jumat.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= JADWAL BILAL ================= -->
<section class="py-14 bg-gradient-to-b from-green-50 via-emerald-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_bilal ?? 'Jadwal Bilal' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">
            {{ $profil->teks_jadwal_bilal ?? 'Petugas bilal berdasarkan siklus pasaran.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-12">
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
                <p class="col-span-3 text-center text-gray-400 bg-white rounded-3xl shadow py-8">Belum ada jadwal bilal.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= JADWAL PIKET KEBERSIHAN ================= -->
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-green-800">
            {{ $profil->judul_jadwal_piket ?? 'Jadwal Piket Kebersihan' }}
        </h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">
            {{ $profil->teks_jadwal_piket ?? 'Petugas kebersihan masjid setiap harinya.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12 mt-12">
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
                <p class="col-span-3 text-center text-gray-400 bg-white rounded-3xl shadow py-8">Belum ada jadwal piket.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= GALERI ================= -->
<section id="galeri" class="py-14 bg-green-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center">{{ $profil->judul_galeri ?? 'Galeri' }}</h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">{{ $profil->teks_galeri ?? 'Foto aset dan perlengkapan masjid.' }}</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            @forelse ($galeri as $item)
                <div class="group relative rounded-3xl overflow-hidden shadow bg-white aspect-square">
                    @if ($item->tipe === 'video')
                        <video src="{{ Storage::url($item->file) }}" class="w-full h-full object-cover"></video>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    @else
                        <img src="{{ Storage::url($item->file) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    @endif
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                        <p class="text-white text-sm font-medium truncate">{{ $item->judul }}</p>
                        <p class="text-gray-200 text-xs">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-400">Belum ada galeri.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= INVENTARIS ================= -->
<section id="inventaris" class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-center">{{ $profil->judul_inventaris ?? 'Inventaris Masjid' }}</h2>
        <p class="text-center text-gray-600 mt-2 text-sm sm:text-base">{{ $profil->teks_inventaris ?? 'Data aset dan perlengkapan masjid.' }}</p>

        {{-- Mobile: card view --}}
        <div class="sm:hidden mt-8 space-y-3">
            @forelse ($inventaris as $item)
                <div class="bg-gray-50 rounded-3xl shadow px-5 py-4">
                    <div class="flex items-center justify-between gap-2">
                        <span @class([
                            'text-xs px-2 py-1 rounded-full shrink-0 order-2',
                            'bg-green-100 text-green-700' => $item->kondisi === 'baik',
                            'bg-yellow-100 text-yellow-700' => $item->kondisi === 'rusak_ringan',
                            'bg-red-100 text-red-700' => in_array($item->kondisi, ['rusak_berat', 'hilang']),
                        ])>
                            {{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}
                        </span>
                        <p class="font-medium text-gray-800 order-1 min-w-0 flex-1 break-words">{{ $item->nama_barang }}</p>
                    </div>
                    <p class="text-sm text-gray-500 capitalize mt-1">{{ str_replace('_', ' ', $item->kategori) }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $item->jumlah }} {{ $item->satuan }}</p>
                </div>
            @empty
                <p class="text-center text-gray-400 bg-gray-50 rounded-3xl shadow py-8">Belum ada data inventaris.</p>
            @endforelse
        </div>

        {{-- Desktop: table view --}}
        <div class="hidden sm:block overflow-x-auto mt-8 bg-gray-50 rounded-3xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama Barang</th>
                        <th class="px-6 py-4 text-left">Kategori</th>
                        <th class="px-6 py-4 text-left">Jumlah</th>
                        <th class="px-6 py-4 text-left">Kondisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($inventaris as $item)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $item->nama_barang }}</td>
                            <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $item->kategori) }}</td>
                            <td class="px-6 py-4">{{ $item->jumlah }} {{ $item->satuan }}</td>
                            <td class="px-6 py-4">
                                <span @class([
                                    'text-xs px-2 py-1 rounded-full',
                                    'bg-green-100 text-green-700' => $item->kondisi === 'baik',
                                    'bg-yellow-100 text-yellow-700' => $item->kondisi === 'rusak_ringan',
                                    'bg-red-100 text-red-700' => in_array($item->kondisi, ['rusak_berat', 'hilang']),
                                ])>
                                    {{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($jumlahInventaris > 10)
            <p class="text-center text-gray-400 text-sm mt-4">
                Menampilkan 10 dari {{ $jumlahInventaris }} item inventaris.
            </p>
        @endif
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-[#062617] text-green-100/80 pt-14 pb-6">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Profil singkat -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-green-700 flex items-center justify-center overflow-hidden shrink-0 ring-2 ring-green-600/40">
                        <img src="{{ asset('images/logo-irmas.jpeg') }}" alt="Logo IRMAS Darul Muttaqin" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-bold text-white text-base leading-tight">Masjid Darul Muttaqin</p>
                        <p class="text-xs text-green-300/80">SMK Negeri 1 Bangsri</p>
                    </div>
                </div>
                <p class="text-sm text-green-100/70 mt-4 leading-relaxed">
                    Media digital untuk informasi jadwal, kegiatan, dan pengumuman Masjid Darul Muttaqin bagi seluruh warga sekolah.
                </p>

                <div class="flex items-center gap-3 mt-5">
                    <a href="#" aria-label="Instagram" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition">
                        <svg class="w-4.5 h-4.5 text-green-100" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 7.5h.008v.008H16.5V7.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3h10.5A3.75 3.75 0 0 1 21 6.75v10.5A3.75 3.75 0 0 1 17.25 21H6.75A3.75 3.75 0 0 1 3 17.25V6.75A3.75 3.75 0 0 1 6.75 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition">
                        <svg class="w-4.5 h-4.5 text-green-100" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0-1.892.11-3.451.31-4.704.257-1.6 1.545-2.815 3.156-2.98C7.42 4.14 9.502 4 12 4s4.58.14 6.284.316c1.611.165 2.9 1.38 3.156 2.98.2 1.253.31 2.812.31 4.704s-.11 3.451-.31 4.704c-.257 1.6-1.545 2.815-3.156 2.98C16.58 19.86 14.498 20 12 20s-4.58-.14-6.284-.316c-1.611-.165-2.9-1.38-3.156-2.98C2.36 15.451 2.25 13.892 2.25 12Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 9.75 15 12l-4.5 2.25v-4.5Z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/" aria-label="WhatsApp" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition">
                        <svg class="w-4.5 h-4.5 text-green-100" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.47 1.33 4.98L2 22l5.2-1.36a9.94 9.94 0 0 0 4.84 1.24h.01c5.5 0 9.96-4.46 9.96-9.96S17.54 2 12.04 2Zm5.86 14.12c-.25.7-1.24 1.28-2.02 1.44-.55.11-1.26.2-3.68-.79-2.94-1.2-4.83-4.14-4.98-4.33-.15-.19-1.19-1.58-1.19-3.02 0-1.43.75-2.14 1.02-2.43.25-.28.55-.35.73-.35h.53c.17 0 .4-.06.62.48.25.6.85 2.06.92 2.21.07.15.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.36-.42.48-.14.13-.28.28-.12.55.16.28.71 1.18 1.53 1.92 1.06.94 1.94 1.24 2.22 1.38.28.14.44.12.6-.07.16-.19.7-.81.88-1.09.19-.28.37-.23.62-.14.25.09 1.61.76 1.89.9.28.14.46.21.53.33.07.12.07.68-.18 1.38Z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Menu Utama -->
            <div>
                <h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-4">Menu Utama</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-white transition">Tentang</a></li>
                    <li><a href="#kegiatan" class="hover:text-white transition">Kegiatan</a></li>
                    <li><a href="#pengumuman" class="hover:text-white transition">Pengumuman</a></li>
                    <li><a href="#galeri" class="hover:text-white transition">Galeri</a></li>
                </ul>
            </div>

            <!-- Informasi -->
            <div>
                <h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-4">Informasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#statistik" class="hover:text-white transition">Statistik Masjid</a></li>
                    <li><a href="#jadwal" class="hover:text-white transition">Jadwal Imam & Muazin</a></li>
                    <li><a href="#inventaris" class="hover:text-white transition">Inventaris</a></li>
                    <li><button type="button" onclick="bukaModalPengurus()" class="hover:text-white transition text-left">Struktur Pengurus</button></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-4">Kontak Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4.5 h-4.5 text-green-400 mt-0.5 shrink-0" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>{{ $profil->alamat ?? 'SMK Negeri 1 Bangsri, Jepara, Jawa Tengah' }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4.5 h-4.5 text-green-400 shrink-0" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a1.5 1.5 0 0 0 1.5-1.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.5 1.5 0 0 0-1.423.39l-.97.97a.5.5 0 0 1-.58.095 12.042 12.042 0 0 1-5.65-5.65.5.5 0 0 1 .096-.579l.969-.97a1.5 1.5 0 0 0 .39-1.423L6.963 3.852a1.125 1.125 0 0 0-1.091-.852H4.5a1.5 1.5 0 0 0-1.5 1.5v2.25Z" />
                        </svg>
                        <span>{{ $profil->telepon ?? '+62 857 1259 5555' }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4.5 h-4.5 text-green-400 shrink-0" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <span>masjid.darulmuttaqin@smkn1bangsri.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-green-300/70">
            <p>&copy; {{ date('Y') }} Masjid Darul Muttaqin. All rights reserved.</p>
            <p>SIMMADI — Sistem Manajemen Masjid Digital</p>
        </div>
    </div>
</footer>

<!-- Tombol WhatsApp mengambang -->
<a href="https://wa.me/" target="_blank" rel="noopener"
   class="fixed bottom-5 right-5 z-40 w-14 h-14 rounded-full bg-green-500 hover:bg-green-600 shadow-xl shadow-green-900/40 flex items-center justify-center transition hover:scale-105"
   aria-label="Hubungi via WhatsApp">
    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.47 1.33 4.98L2 22l5.2-1.36a9.94 9.94 0 0 0 4.84 1.24h.01c5.5 0 9.96-4.46 9.96-9.96S17.54 2 12.04 2Zm5.86 14.12c-.25.7-1.24 1.28-2.02 1.44-.55.11-1.26.2-3.68-.79-2.94-1.2-4.83-4.14-4.98-4.33-.15-.19-1.19-1.58-1.19-3.02 0-1.43.75-2.14 1.02-2.43.25-.28.55-.35.73-.35h.53c.17 0 .4-.06.62.48.25.6.85 2.06.92 2.21.07.15.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.36-.42.48-.14.13-.28.28-.12.55.16.28.71 1.18 1.53 1.92 1.06.94 1.94 1.24 2.22 1.38.28.14.44.12.6-.07.16-.19.7-.81.88-1.09.19-.28.37-.23.62-.14.25.09 1.61.76 1.89.9.28.14.46.21.53.33.07.12.07.68-.18 1.38Z"/>
    </svg>
</a>

<!-- ================= MODAL VISI & MISI ================= -->
<div id="modal-visi-misi" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalVisiMisi()"></div>

    <div class="relative max-w-2xl mx-auto mt-16 mb-16 bg-white rounded-3xl shadow-2xl max-h-[80vh] flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Visi & Misi</h3>
                <p class="text-sm text-gray-500 mt-1">Masjid Darul Muttaqin</p>
            </div>
            <button onclick="tutupModalVisiMisi()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-lg">
                &times;
            </button>
        </div>

        <div class="px-6 py-5 overflow-y-auto space-y-6">
            <div class="bg-green-50 rounded-2xl p-5">
                <svg class="w-9 h-9 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                <h4 class="font-bold mt-3 text-lg">Visi</h4>
                @if ($profil && $profil->visi)
                    @php
                        $visiPoints = collect(preg_split('/(?=\d+\.\s*)/u', trim($profil->visi)))
                            ->map(fn ($p) => trim($p))
                            ->filter(fn ($p) => $p !== '')
                            ->values();
                    @endphp
                    <div class="text-gray-600 text-base mt-2 leading-relaxed space-y-1.5">
                        @foreach ($visiPoints as $point)
                            <p>{{ $point }}</p>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-base mt-2">Belum diatur.</p>
                @endif
            </div>

            <div class="bg-blue-50 rounded-2xl p-5">
                <svg class="w-9 h-9 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
                <h4 class="font-bold mt-3 text-lg">Misi</h4>
                @if ($profil && $profil->misi)
                    <ol class="text-gray-600 text-base mt-2 leading-relaxed list-decimal list-inside space-y-1.5">
                        @foreach (explode("\n", $profil->misi) as $point)
                            @if (trim($point) !== '')
                                <li>{{ trim($point) }}</li>
                            @endif
                        @endforeach
                    </ol>
                @else
                    <p class="text-gray-600 text-base mt-2">Belum diatur.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL DETAIL KEGIATAN ================= -->
<div id="modal-kegiatan" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalKegiatan()"></div>

    <div class="relative max-w-2xl mx-auto mt-16 mb-16 bg-white rounded-3xl shadow-2xl max-h-[80vh] flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <h3 id="kegiatan-judul" class="text-2xl font-bold text-gray-800">Detail Kegiatan</h3>
            <button onclick="tutupModalKegiatan()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-lg shrink-0 ml-4">
                &times;
            </button>
        </div>

        <div class="overflow-y-auto">
            <img id="kegiatan-poster" src="" class="w-full h-56 object-cover hidden">

            <div class="px-6 py-5">
                <div class="flex items-center gap-2 flex-wrap">
                    <span id="kegiatan-kategori" class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700"></span>
                    <span id="kegiatan-status" class="text-xs px-2 py-1 rounded-full"></span>
                </div>

                <p id="kegiatan-meta" class="text-gray-500 text-sm mt-4"></p>

                <p id="kegiatan-deskripsi" class="text-gray-600 text-sm mt-4 leading-relaxed whitespace-pre-line"></p>

                <div id="kegiatan-pengumuman-wrap" class="mt-6 hidden">
                    <h4 class="font-bold text-sm text-gray-700 mb-2">Pengumuman Terkait</h4>
                    <div id="kegiatan-pengumuman-list" class="space-y-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL BAGAN PENGURUS ================= -->
<div id="modal-pengurus" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalPengurus()"></div>

    <div class="relative max-w-5xl mx-auto mt-10 mb-10 bg-white rounded-3xl shadow-2xl max-h-[85vh] flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Struktur Pengurus DKM</h3>
                <p class="text-sm text-gray-500 mt-1">Masjid Darul Muttaqin</p>
            </div>
            <button onclick="tutupModalPengurus()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-lg shrink-0 ml-4">
                &times;
            </button>
        </div>

        <div class="px-6 py-8 overflow-auto">
            <div class="bagan-pengurus min-w-max mx-auto">
                @forelse ($strukturPengurus as $namaJabatan => $anggota)
                    @if (!$loop->first)
                        <div class="bagan-trunk"></div>
                    @endif

                    <div class="bagan-jabatan-label">{{ $namaJabatan }}</div>

                    <div class="bagan-nodes">
                        @foreach ($anggota as $item)
                            <div class="bagan-node">
                                <div class="bagan-card">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" class="bagan-avatar-img" alt="{{ $item->nama }}">
                                    @else
                                        <div class="bagan-avatar">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                    @endif
                                    <span class="bagan-nama">{{ $item->nama }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-center text-gray-400 py-8">Struktur pengurus belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

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

    function bukaModalKegiatan(btn) {
        document.getElementById('kegiatan-judul').textContent = btn.dataset.judul;
        document.getElementById('kegiatan-kategori').textContent = btn.dataset.kategori;

        const status = document.getElementById('kegiatan-status');
        status.textContent = btn.dataset.status;
        status.className = 'text-xs px-2 py-1 rounded-full';
        const statusColors = {
            selesai: 'bg-green-100 text-green-700',
            akan_datang: 'bg-blue-100 text-blue-700',
            berlangsung: 'bg-blue-100 text-blue-700',
            dibatalkan: 'bg-red-100 text-red-700',
        };
        status.classList.add(...(statusColors[btn.dataset.statusRaw] || 'bg-gray-200 text-gray-600').split(' '));

        const meta = btn.dataset.lokasi
            ? `${btn.dataset.tanggal} \u00b7 ${btn.dataset.lokasi}`
            : btn.dataset.tanggal;
        document.getElementById('kegiatan-meta').textContent = meta;

        document.getElementById('kegiatan-deskripsi').textContent = btn.dataset.deskripsi || 'Belum ada deskripsi.';

        const poster = document.getElementById('kegiatan-poster');
        if (btn.dataset.poster) {
            poster.src = btn.dataset.poster;
            poster.classList.remove('hidden');
        } else {
            poster.classList.add('hidden');
        }

        const pengumumanList = document.getElementById('kegiatan-pengumuman-list');
        const pengumumanWrap = document.getElementById('kegiatan-pengumuman-wrap');
        const daftarPengumuman = JSON.parse(btn.dataset.pengumuman || '[]');

        pengumumanList.innerHTML = '';
        if (daftarPengumuman.length > 0) {
            daftarPengumuman.forEach(p => {
                const a = document.createElement('a');
                a.href = `/pengumuman/${p.slug}`;
                a.className = 'block text-sm text-green-700 hover:underline bg-green-50 rounded-lg px-3 py-2';
                a.textContent = p.judul;
                pengumumanList.appendChild(a);
            });
            pengumumanWrap.classList.remove('hidden');
        } else {
            pengumumanWrap.classList.add('hidden');
        }

        document.getElementById('modal-kegiatan').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function tutupModalKegiatan() {
        document.getElementById('modal-kegiatan').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function bukaModalVisiMisi() {
        document.getElementById('modal-visi-misi').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function tutupModalVisiMisi() {
        document.getElementById('modal-visi-misi').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function bukaModalPengurus() {
        document.getElementById('modal-pengurus').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function tutupModalPengurus() {
        document.getElementById('modal-pengurus').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            tutupModalKegiatan();
            tutupModalVisiMisi();
            tutupModalPengurus();
        }
    });
</script>

</body>
</html>