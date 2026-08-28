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
        * {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<nav class="fixed w-full bg-white/95 backdrop-blur shadow z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-green-700 flex items-center justify-center text-white text-xl">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m4.5-4.5H21m-4.5 0v4.5" />
                </svg>
            </div>
            <div>
                <h1 class="font-bold text-xl text-green-700">Masjid Darul Muttaqin</h1>
                <p class="text-sm text-gray-500">SMK Negeri 1 Bangsri</p>
            </div>
        </div>

        <div class="hidden md:flex items-center gap-8">
            <a href="#tentang" class="hover:text-green-700">Tentang</a>
            <a href="#statistik" class="hover:text-green-700">Statistik</a>
            <a href="#pengumuman" class="hover:text-green-700">Pengumuman</a>
            <a href="#jadwal" class="hover:text-green-700">Jadwal</a>
            <a href="{{ route('login') }}" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">
                Login Admin
            </a>
        </div>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="hero h-screen flex items-center" style="background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)), url('{{ $profil && $profil->foto_hero ? Storage::url($profil->foto_hero) : 'https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=2000' }}');">
    <div class="max-w-7xl mx-auto px-6 text-white">
        <span class="inline-flex items-center gap-2 bg-green-600 px-4 py-2 rounded-full">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m4.5-4.5H21m-4.5 0v4.5" />
            </svg>
            Website Resmi
        </span>

        <h1 class="text-6xl font-extrabold mt-6 leading-tight">
            {{ $profil ? Str::words($profil->nama_masjid, 1, '') : 'Masjid' }}<br>{{ $profil ? trim(Str::after($profil->nama_masjid, ' ')) : 'Darul Muttaqin' }}
        </h1>

        <p class="mt-6 text-xl max-w-2xl">
            {{ $profil && $profil->slogan ? $profil->slogan : 'Sistem Informasi Masjid Sekolah untuk memudahkan pengelolaan jadwal imam, jadwal Jumat, pengurus, dan pengumuman kegiatan.' }}
        </p>

        <div class="mt-10 flex gap-4">
            <a href="#jadwal" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 px-7 py-3 rounded-xl text-lg">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                Lihat Jadwal
            </a>
            <a href="#pengumuman" class="inline-flex items-center gap-2 bg-white text-green-700 px-7 py-3 rounded-xl text-lg">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                Pengumuman
            </a>
        </div>
    </div>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                @if($profil && $profil->foto_utama)
                    <img src="{{ Storage::url($profil->foto_utama) }}"
                         class="rounded-3xl shadow-xl w-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1512632578888-169bbbc64f33?q=80&w=1200"
                         class="rounded-3xl shadow-xl w-full">
                @endif
            </div>

            <div>
                <span class="text-green-700 font-semibold">Tentang Masjid</span>
                <h2 class="text-4xl font-bold mt-3">{{ $profil->nama_masjid ?? 'Masjid Darul Muttaqin' }}</h2>

                <p class="text-gray-600 mt-6 leading-8">
                    {{ $profil && $profil->deskripsi ? $profil->deskripsi : 'Masjid Darul Muttaqin merupakan pusat kegiatan keagamaan di lingkungan sekolah. Website ini dibuat untuk mempermudah pengelolaan jadwal imam, jadwal Jumat, pengurus DKM, serta penyampaian pengumuman kepada seluruh warga sekolah.' }}
                </p>

                <div class="grid grid-cols-2 gap-6 mt-10">
                    <button type="button" onclick="bukaModalVisiMisi()"
                            class="bg-green-50 rounded-2xl p-5 text-left w-full hover:-translate-y-2 hover:shadow-lg transition cursor-pointer">
                        <svg class="w-9 h-9 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        <h3 class="font-bold mt-3">Visi</h3>
                        <p class="text-gray-600 text-sm mt-2">
                            {{ $profil && $profil->visi ? Str::limit($profil->visi, 100) : 'Belum diatur.' }}
                        </p>
                    </button>
                    <button type="button" onclick="bukaModalVisiMisi()"
                            class="bg-blue-50 rounded-2xl p-5 text-left w-full hover:-translate-y-2 hover:shadow-lg transition cursor-pointer">
                        <svg class="w-9 h-9 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        <h3 class="font-bold mt-3">Misi</h3>
                        <p class="text-gray-600 text-sm mt-2">
                            {{ $profil && $profil->misi ? Str::limit($profil->misi, 100) : 'Belum diatur.' }}
                        </p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATISTIK ================= -->
<section id="statistik" class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Statistik Masjid</h2>
        <p class="text-center text-gray-500 mt-2">Data diperbarui secara otomatis.</p>

        <div class="grid md:grid-cols-4 gap-8 mt-14">

            <button type="button" onclick="bukaModalPengurus()"
                    class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 hover:shadow-lg transition cursor-pointer w-full">
                <svg class="w-12 h-12 mx-auto text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <h3 class="text-5xl font-bold mt-4 text-green-700">{{ $jumlahPengurus }}</h3>
                <p class="mt-3 text-gray-600">Pengurus</p>
                <p class="text-xs text-green-600 mt-2">Lihat bagan &rarr;</p>
            </button>

            <a href="#kegiatan"
               class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 hover:shadow-lg transition cursor-pointer block">
                <svg class="w-12 h-12 mx-auto text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <h3 class="text-5xl font-bold mt-4 text-blue-700">{{ $jumlahKegiatan }}</h3>
                <p class="mt-3 text-gray-600">Kegiatan</p>
            </a>

            <a href="#pengumuman"
               class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 hover:shadow-lg transition cursor-pointer block">
                <svg class="w-12 h-12 mx-auto text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                <h3 class="text-5xl font-bold mt-4 text-red-600">{{ $jumlahPengumuman }}</h3>
                <p class="mt-3 text-gray-600">Pengumuman</p>
            </a>

            <a href="#jadwal"
               class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 hover:shadow-lg transition cursor-pointer block">
                <svg class="w-12 h-12 mx-auto text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="text-5xl font-bold mt-4 text-yellow-600">{{ $jumlahJadwal }}</h3>
                <p class="mt-3 text-gray-600">Jadwal Harian</p>
            </a>

        </div>
    </div>
</section>

<!-- ================= PENGUMUMAN ================= -->
<section id="pengumuman" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Pengumuman Terbaru</h2>
        <p class="text-center text-gray-500 mt-2">Informasi dan kegiatan terkini masjid.</p>

        <div class="grid md:grid-cols-3 gap-8 mt-14">
            @forelse ($pengumuman as $item)
                <a href="{{ route('pengumuman.public', $item->slug) }}"
                   class="block bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-2 transition">
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-green-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">
                            {{ ucfirst($item->kategori) }}
                        </span>
                        <h3 class="font-bold text-lg mt-3">{{ $item->judul }}</h3>
                        <p class="text-gray-500 text-sm mt-2">
                            {{ $item->tanggal_publish->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-gray-600 text-sm mt-3 line-clamp-3">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                        @if ($item->kegiatan)
                            <p class="text-xs text-blue-600 mt-3">
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

<!-- ================= JADWAL IMAM & MUAZIN ================= -->
<section id="jadwal" class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Imam & Muazin</h2>
        <p class="text-center text-gray-500 mt-2">Jadwal petugas sholat sepanjang pekan.</p>

        <div class="overflow-x-auto mt-14 bg-white rounded-3xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left w-32">Hari</th>
                        <th class="px-6 py-4 text-left w-32">Waktu</th>
                        <th class="px-6 py-4 text-left">Imam</th>
                        <th class="px-6 py-4 text-left">Muazin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jadwalImamMuazin->groupBy('hari') as $hari => $itemHari)
                        @foreach ($itemHari as $index => $item)
                            <tr class="{{ $index === 0 ? 'border-t-2 border-t-green-100' : '' }}">
                                @if ($index === 0)
                                    <td class="px-6 py-4 capitalize font-bold text-green-700 align-top bg-green-50/40" rowspan="{{ $itemHari->count() }}">
                                        {{ $hari }}
                                    </td>
                                @endif
                                <td class="px-6 py-4 capitalize align-top">{{ $item->waktu_sholat }}</td>

                                <td class="px-6 py-4 align-top">
                                    @forelse ($item->imam as $imam)
                                        <div class="{{ !$loop->last ? 'mb-1' : '' }}">{{ $imam->nama }}</div>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                                </td>

                                <td class="px-6 py-4 align-top">
                                    @forelse ($item->muazin as $muazin)
                                        <div class="{{ !$loop->last ? 'mb-1' : '' }}">{{ $muazin->nama }}</div>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ================= JADWAL BILAL ================= -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Bilal</h2>
        <p class="text-center text-gray-500 mt-2">Petugas bilal berdasarkan siklus pasaran.</p>

        <div class="overflow-x-auto mt-14 bg-gray-50 rounded-3xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Pasaran</th>
                        <th class="px-6 py-4 text-left">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jadwalBilal as $item)
                        <tr>
                            <td class="px-6 py-4 capitalize font-medium">{{ $item->pasaran }}</td>
                            <td class="px-6 py-4">{{ $item->anggota->pluck('nama')->join(', ') ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-400">Belum ada jadwal bilal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ================= JADWAL PIKET KEBERSIHAN ================= -->
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Piket Kebersihan</h2>
        <p class="text-center text-gray-500 mt-2">Petugas kebersihan masjid setiap harinya.</p>

        <div class="overflow-x-auto mt-14 bg-white rounded-3xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Hari</th>
                        <th class="px-6 py-4 text-left">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jadwalPiket as $item)
                        <tr>
                            <td class="px-6 py-4 capitalize font-medium">{{ $item->hari }}</td>
                            <td class="px-6 py-4">{{ $item->anggota->pluck('nama')->join(', ') ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-400">Belum ada jadwal piket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- ================= KEGIATAN ================= -->
<section id="kegiatan" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Kegiatan Masjid</h2>
        <p class="text-center text-gray-500 mt-2">Agenda dan riwayat kegiatan masjid.</p>

        <div class="grid md:grid-cols-3 gap-8 mt-14">
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
                        class="text-left w-full bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-2 hover:shadow-lg transition cursor-pointer">
                    @if ($item->poster)
                        <img src="{{ Storage::url($item->poster) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-blue-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
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
                        <h3 class="font-bold text-lg mt-3">{{ $item->judul }}</h3>
                        <p class="text-gray-500 text-sm mt-2">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                            @if ($item->lokasi)
                                &middot; {{ $item->lokasi }}
                            @endif
                        </p>
                        @if ($item->deskripsi)
                            <p class="text-gray-600 text-sm mt-3 line-clamp-3">
                                {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                            </p>
                        @endif
                        @if ($item->pengumumans->count() > 0)
                            <p class="text-xs text-green-600 mt-3">
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

<!-- ================= GALERI ================= -->
<section id="galeri" class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Galeri</h2>
        <p class="text-center text-gray-500 mt-2">Dokumentasi foto dan video kegiatan masjid.</p>

        <div class="grid md:grid-cols-4 gap-6 mt-14">
            @forelse ($galeri as $item)
                <div class="group relative rounded-2xl overflow-hidden shadow bg-white aspect-square">
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
<section id="inventaris" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Inventaris Masjid</h2>
        <p class="text-center text-gray-500 mt-2">Data aset dan perlengkapan masjid.</p>

        <div class="overflow-x-auto mt-14 bg-gray-50 rounded-3xl shadow">
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
<footer class="bg-green-900 text-green-100 py-10">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="font-bold text-white text-lg">Masjid Darul Muttaqin</p>
        <p class="text-sm mt-2">SMK Negeri 1 Bangsri</p>
        <p class="text-xs mt-6 text-green-300">
            &copy; {{ date('Y') }} SIMADI — Sistem Informasi Masjid Darul Muttaqin
        </p>
    </div>
</footer>

<!-- ================= MODAL VISI & MISI ================= -->
<div id="modal-visi-misi" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50" onclick="tutupModalVisiMisi()"></div>

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
                <h4 class="font-bold mt-3">Visi</h4>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    {{ $profil && $profil->visi ? $profil->visi : 'Belum diatur.' }}
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-5">
                <svg class="w-9 h-9 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
                <h4 class="font-bold mt-3">Misi</h4>
                @if ($profil && $profil->misi)
                    <ol class="text-gray-600 text-sm mt-2 leading-relaxed list-decimal list-inside space-y-1">
                        @foreach (explode("\n", $profil->misi) as $point)
                            @if (trim($point) !== '')
                                <li>{{ trim($point) }}</li>
                            @endif
                        @endforeach
                    </ol>
                @else
                    <p class="text-gray-600 text-sm mt-2">Belum diatur.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL DETAIL KEGIATAN ================= -->
<div id="modal-kegiatan" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/50" onclick="tutupModalKegiatan()"></div>

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
    <div class="absolute inset-0 bg-black/50" onclick="tutupModalPengurus()"></div>

    <div class="relative max-w-2xl mx-auto mt-16 mb-16 bg-white rounded-3xl shadow-2xl max-h-[80vh] flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Struktur Pengurus DKM</h3>
                <p class="text-sm text-gray-500 mt-1">Masjid Darul Muttaqin</p>
            </div>
            <button onclick="tutupModalPengurus()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-lg">
                &times;
            </button>
        </div>

        <div class="px-6 py-5 overflow-y-auto space-y-6">
            @forelse ($strukturPengurus as $namaJabatan => $anggota)
                <div>
                    <h4 class="text-green-700 font-bold text-sm uppercase tracking-wide mb-3">
                        {{ $namaJabatan }}
                    </h4>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach ($anggota as $item)
                            <div class="flex items-center gap-3 bg-gray-50 rounded-2xl px-4 py-3">
                                @if ($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-800">{{ $item->nama }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 py-8">Struktur pengurus belum tersedia.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
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