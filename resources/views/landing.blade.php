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
            background:
                linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
                url('https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=2000');
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
                🕌
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
<section class="hero h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-6 text-white">
        <span class="bg-green-600 px-4 py-2 rounded-full">🕌 Website Resmi</span>

        <h1 class="text-6xl font-extrabold mt-6 leading-tight">
            Masjid<br>Darul Muttaqin
        </h1>

        <p class="mt-6 text-xl max-w-2xl">
            Sistem Informasi Masjid Sekolah untuk memudahkan pengelolaan
            jadwal imam, jadwal Jumat, pengurus, dan pengumuman kegiatan.
        </p>

        <div class="mt-10 flex gap-4">
            <a href="#jadwal" class="bg-green-600 hover:bg-green-700 px-7 py-3 rounded-xl text-lg">
                📅 Lihat Jadwal
            </a>
            <a href="#pengumuman" class="bg-white text-green-700 px-7 py-3 rounded-xl text-lg">
                📢 Pengumuman
            </a>
        </div>
    </div>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1512632578888-169bbbc64f33?q=80&w=1200"
                     class="rounded-3xl shadow-xl w-full">
            </div>

            <div>
                <span class="text-green-700 font-semibold">Tentang Masjid</span>
                <h2 class="text-4xl font-bold mt-3">Masjid Darul Muttaqin</h2>

                <p class="text-gray-600 mt-6 leading-8">
                    Masjid Darul Muttaqin merupakan pusat kegiatan keagamaan di
                    lingkungan sekolah. Website ini dibuat untuk mempermudah
                    pengelolaan jadwal imam, jadwal Jumat, pengurus DKM, serta
                    penyampaian pengumuman kepada seluruh warga sekolah.
                </p>

                <div class="grid grid-cols-2 gap-6 mt-10">
                    <div class="bg-green-50 rounded-2xl p-5">
                        <div class="text-4xl">🕌</div>
                        <h3 class="font-bold mt-3">Ibadah</h3>
                        <p class="text-gray-600 text-sm mt-2">Jadwal imam selalu diperbarui.</p>
                    </div>
                    <div class="bg-blue-50 rounded-2xl p-5">
                        <div class="text-4xl">📢</div>
                        <h3 class="font-bold mt-3">Informasi</h3>
                        <p class="text-gray-600 text-sm mt-2">Pengumuman kegiatan terbaru.</p>
                    </div>
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
            <div class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 transition">
                <div class="text-5xl">👳</div>
                <h3 class="text-5xl font-bold mt-4 text-green-700">{{ $jumlahPengurus }}</h3>
                <p class="mt-3 text-gray-600">Pengurus</p>
            </div>

            <div class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 transition">
                <div class="text-5xl">📅</div>
                <h3 class="text-5xl font-bold mt-4 text-blue-700">{{ $jumlahKegiatan }}</h3>
                <p class="mt-3 text-gray-600">Kegiatan</p>
            </div>

            <div class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 transition">
                <div class="text-5xl">📢</div>
                <h3 class="text-5xl font-bold mt-4 text-red-600">{{ $jumlahPengumuman }}</h3>
                <p class="mt-3 text-gray-600">Pengumuman</p>
            </div>

            <div class="bg-white rounded-3xl shadow p-8 text-center hover:-translate-y-2 transition">
                <div class="text-5xl">🕌</div>
                <h3 class="text-5xl font-bold mt-4 text-yellow-600">{{ $jumlahJadwal }}</h3>
                <p class="mt-3 text-gray-600">Jadwal Imam</p>
            </div>
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
                <div class="bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-2 transition">
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-green-100 flex items-center justify-center text-5xl">📢</div>
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
                    </div>
                </div>
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
                        <th class="px-6 py-4 text-left">Hari</th>
                        <th class="px-6 py-4 text-left">Waktu</th>
                        <th class="px-6 py-4 text-left">Imam</th>
                        <th class="px-6 py-4 text-left">Khatib</th>
                        <th class="px-6 py-4 text-left">Muazin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jadwalImamMuazin as $item)
                        <tr>
                            <td class="px-6 py-4 capitalize">{{ $item->hari }}</td>
                            <td class="px-6 py-4 capitalize">{{ $item->waktu_sholat }}</td>
                            <td class="px-6 py-4">{{ $item->imam->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->khatib->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->muazin->nama ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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

</body>
</html>