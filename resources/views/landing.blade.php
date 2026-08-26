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
<section class="hero h-screen flex items-center" style="background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)), url('{{ $profil && $profil->foto_hero ? Storage::url($profil->foto_hero) : 'https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=2000' }}');">
    <div class="max-w-7xl mx-auto px-6 text-white">
        <span class="bg-green-600 px-4 py-2 rounded-full">🕌 Website Resmi</span>

        <h1 class="text-6xl font-extrabold mt-6 leading-tight">
            {{ $profil ? Str::words($profil->nama_masjid, 1, '') : 'Masjid' }}<br>{{ $profil ? trim(Str::after($profil->nama_masjid, ' ')) : 'Darul Muttaqin' }}
        </h1>

        <p class="mt-6 text-xl max-w-2xl">
            {{ $profil && $profil->slogan ? $profil->slogan : 'Sistem Informasi Masjid Sekolah untuk memudahkan pengelolaan jadwal imam, jadwal Jumat, pengurus, dan pengumuman kegiatan.' }}
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
                    <a href="#jadwal" class="bg-green-50 rounded-2xl p-5 block hover:bg-green-100 hover:-translate-y-1 transition cursor-pointer">
                        <div class="text-4xl">🕌</div>
                        <h3 class="font-bold mt-3">Ibadah</h3>
                        <p class="text-gray-600 text-sm mt-2">Jadwal imam selalu diperbarui.</p>
                    </a>
                    <a href="#pengumuman" class="bg-blue-50 rounded-2xl p-5 block hover:bg-blue-100 hover:-translate-y-1 transition cursor-pointer">
                        <div class="text-4xl">📢</div>
                        <h3 class="font-bold mt-3">Informasi</h3>
                        <p class="text-gray-600 text-sm mt-2">Pengumuman kegiatan terbaru.</p>
                    </a>
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
                <a href="{{ route('pengumuman.public', $item->slug) }}"
                   class="block bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-2 transition">
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
                        <th class="px-6 py-4 text-left">Hari</th>
                        <th class="px-6 py-4 text-left">Waktu</th>
                        <th class="px-6 py-4 text-left">Imam</th>
                        <th class="px-6 py-4 text-left">Muazin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jadwalImamMuazin as $item)
                        <tr>
                            <td class="px-6 py-4 capitalize">{{ $item->hari }}</td>
                            <td class="px-6 py-4 capitalize">{{ $item->waktu_sholat }}</td>
                            <td class="px-6 py-4">
                                {{ $item->imam->pluck('nama')->join(', ') ?: '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->muazin->pluck('nama')->join(', ') ?: '-' }}
                            </td>
                        </tr>
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
                <div class="bg-gray-50 rounded-3xl shadow overflow-hidden hover:-translate-y-2 transition">
                    @if ($item->poster)
                        <img src="{{ Storage::url($item->poster) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-blue-100 flex items-center justify-center text-5xl">📅</div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>
                            <span @class([
                                'text-xs px-2 py-1 rounded-full',
                                'bg-green-100 text-green-700' => $item->status === 'akan_datang',
                                'bg-yellow-100 text-yellow-700' => $item->status === 'berlangsung',
                                'bg-gray-200 text-gray-600' => $item->status === 'selesai',
                                'bg-red-100 text-red-700' => $item->status === 'dibatalkan',
                            ])>
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
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
                    </div>
                </div>
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
                            <span class="text-white text-4xl">▶</span>
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

</body>
</html>