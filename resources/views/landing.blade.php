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

@php
    // Palet warna dipakai bersama oleh ketiga section jadwal di bawah
    $dayStyles = [
        'senin'  => ['badge' => 'bg-rose-100 text-rose-700',       'accent' => 'from-rose-400 to-rose-500'],
        'selasa' => ['badge' => 'bg-amber-100 text-amber-700',     'accent' => 'from-amber-400 to-amber-500'],
        'rabu'   => ['badge' => 'bg-emerald-100 text-emerald-700', 'accent' => 'from-emerald-400 to-emerald-500'],
        'kamis'  => ['badge' => 'bg-sky-100 text-sky-700',         'accent' => 'from-sky-400 to-sky-500'],
        'jumat'  => ['badge' => 'bg-violet-100 text-violet-700',   'accent' => 'from-violet-400 to-violet-500'],
        'sabtu'  => ['badge' => 'bg-fuchsia-100 text-fuchsia-700', 'accent' => 'from-fuchsia-400 to-fuchsia-500'],
        'minggu' => ['badge' => 'bg-orange-100 text-orange-700',   'accent' => 'from-orange-400 to-orange-500'],
    ];

    $pasaranStyles = [
        'legi'   => ['badge' => 'bg-rose-100 text-rose-700',       'accent' => 'from-rose-400 to-rose-500'],
        'pahing' => ['badge' => 'bg-amber-100 text-amber-700',     'accent' => 'from-amber-400 to-amber-500'],
        'pon'    => ['badge' => 'bg-emerald-100 text-emerald-700', 'accent' => 'from-emerald-400 to-emerald-500'],
        'wage'   => ['badge' => 'bg-sky-100 text-sky-700',         'accent' => 'from-sky-400 to-sky-500'],
        'kliwon' => ['badge' => 'bg-violet-100 text-violet-700',   'accent' => 'from-violet-400 to-violet-500'],
    ];

    $avatarColors = [
        'bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-500',
        'bg-purple-400', 'bg-pink-400', 'bg-teal-400', 'bg-indigo-400',
    ];

    // Hari ini (untuk menentukan tab yang tampil pertama kali)
    $hariUrutan = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    $hariIni = $hariUrutan[date('N') - 1] ?? 'senin';

    // Imam & Muazin dikelompokkan per hari (satu hari bisa punya beberapa waktu sholat)
    $imamByHari = $jadwalImamMuazin->groupBy(fn ($item) => strtolower($item->hari));
    $imamDays = $imamByHari->keys()->values();
    $imamDefaultIndex = $imamDays->search($hariIni);
    $imamDefaultIndex = $imamDefaultIndex === false ? 0 : $imamDefaultIndex;

    $piketList = $jadwalPiket->values();
    $piketDefaultIndex = $piketList->search(fn ($item) => strtolower($item->hari) === $hariIni);
    $piketDefaultIndex = $piketDefaultIndex === false ? 0 : $piketDefaultIndex;

    // Pasaran (siklus 5 hari Jawa) belum bisa dihitung otomatis di sini,
    // jadi tab pertama Bilal mengikuti urutan data yang tersimpan.
    $bilalList = $jadwalBilal->values();
    $bilalDefaultIndex = 0;
@endphp

{{-- Preload semua kelas warna dinamis supaya Tailwind (CDN) tetap men-generate CSS-nya
     walau kelasnya baru dipasang lewat JavaScript saat pindah tab --}}
<div class="hidden">
    <span class="bg-rose-100 text-rose-700 from-rose-400 to-rose-500 bg-amber-100 text-amber-700 from-amber-400 to-amber-500 bg-emerald-100 text-emerald-700 from-emerald-400 to-emerald-500 bg-sky-100 text-sky-700 from-sky-400 to-sky-500 bg-violet-100 text-violet-700 from-violet-400 to-violet-500 bg-fuchsia-100 text-fuchsia-700 from-fuchsia-400 to-fuchsia-500 bg-orange-100 text-orange-700 from-orange-400 to-orange-500 bg-gray-100 text-gray-700 from-gray-400 to-gray-500"></span>
</div>

<!-- ================= JADWAL IMAM & MUAZIN ================= -->
<section id="jadwal" class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Imam & Muazin</h2>
        <p class="text-center text-gray-500 mt-2">Jadwal petugas sholat sepanjang pekan.</p>

        @if ($imamDays->isEmpty())
            <div class="bg-white rounded-2xl shadow p-12 text-center mt-14">
                <div class="text-5xl mb-3">🗓️</div>
                <p class="text-gray-400">Belum ada jadwal.</p>
            </div>
        @else
            <div class="mt-14">
                <div id="tabs-imam" class="flex gap-2 overflow-x-auto pb-3 mb-6 justify-start md:justify-center">
                    @foreach ($imamDays as $i => $hari)
                        @php $style = $dayStyles[$hari] ?? ['badge' => 'bg-gray-100 text-gray-700']; @endphp
                        <button type="button" data-active-class="{{ $style['badge'] }}" onclick="showDay('imam', {{ $i }})"
                                class="day-tab shrink-0 px-4 py-2 rounded-full text-sm font-semibold capitalize transition {{ $i === $imamDefaultIndex ? $style['badge'] : 'bg-white text-gray-500 hover:bg-gray-200 border border-gray-200' }}">
                            {{ $hari }}{{ $i === $imamDefaultIndex ? ' • Hari ini' : '' }}
                        </button>
                    @endforeach
                </div>

                <div class="relative">
                    <button type="button" onclick="prevDay('imam')" aria-label="Sebelumnya"
                            class="hidden md:flex absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">‹</button>

                    <div id="slider-imam">
                        @foreach ($imamDays as $i => $hari)
                            @php
                                $style = $dayStyles[$hari] ?? ['badge' => 'bg-gray-100 text-gray-700', 'accent' => 'from-gray-400 to-gray-500'];
                                $waktuList = $imamByHari[$hari];
                            @endphp
                            <div class="day-panel" data-group="imam" data-index="{{ $i }}" style="{{ $i === $imamDefaultIndex ? '' : 'display:none' }}">
                                <div class="grid gap-4">
                                    @foreach ($waktuList as $item)
                                        <div class="relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                                            <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b {{ $style['accent'] }}"></div>
                                            <div class="p-5 pl-7">
                                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600 capitalize mb-3">
                                                    {{ $item->waktu_sholat }}
                                                </span>
                                                @if ($item->anggota->isEmpty())
                                                    <p class="text-gray-400 text-sm italic">Belum ada petugas ditugaskan</p>
                                                @else
                                                    <div class="flex flex-col gap-2">
                                                        @foreach ($item->anggota as $index => $orang)
                                                            <div class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 transition-colors rounded-lg px-3 py-2 w-fit">
                                                                <span class="w-7 h-7 flex items-center justify-center rounded-full text-white text-xs font-bold {{ $avatarColors[$index % count($avatarColors)] }}">
                                                                    {{ strtoupper(substr($orang->nama, 0, 1)) }}
                                                                </span>
                                                                <span class="text-sm text-gray-700">{{ $orang->nama }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="nextDay('imam')" aria-label="Berikutnya"
                            class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">›</button>
                </div>

                <p class="text-center text-xs text-gray-400 mt-4 md:hidden">← Geser untuk lihat hari lain →</p>
            </div>
        @endif
    </div>
</section>

<!-- ================= JADWAL BILAL ================= -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Bilal</h2>
        <p class="text-center text-gray-500 mt-2">Petugas bilal berdasarkan siklus pasaran.</p>

        @if ($bilalList->isEmpty())
            <div class="bg-white rounded-2xl shadow p-12 text-center mt-14">
                <div class="text-5xl mb-3">🗓️</div>
                <p class="text-gray-400">Belum ada jadwal bilal.</p>
            </div>
        @else
            <div class="mt-14">
                <div id="tabs-bilal" class="flex gap-2 overflow-x-auto pb-3 mb-6 justify-start md:justify-center">
                    @foreach ($bilalList as $i => $item)
                        @php $style = $pasaranStyles[strtolower($item->pasaran)] ?? ['badge' => 'bg-gray-100 text-gray-700']; @endphp
                        <button type="button" data-active-class="{{ $style['badge'] }}" onclick="showDay('bilal', {{ $i }})"
                                class="day-tab shrink-0 px-4 py-2 rounded-full text-sm font-semibold capitalize transition {{ $i === $bilalDefaultIndex ? $style['badge'] : 'bg-white text-gray-500 hover:bg-gray-200 border border-gray-200' }}">
                            {{ $item->pasaran }}
                        </button>
                    @endforeach
                </div>

                <div class="relative">
                    <button type="button" onclick="prevDay('bilal')" aria-label="Sebelumnya"
                            class="hidden md:flex absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">‹</button>

                    <div id="slider-bilal">
                        @foreach ($bilalList as $i => $item)
                            @php $style = $pasaranStyles[strtolower($item->pasaran)] ?? ['badge' => 'bg-gray-100 text-gray-700', 'accent' => 'from-gray-400 to-gray-500']; @endphp
                            <div class="day-panel" data-group="bilal" data-index="{{ $i }}" style="{{ $i === $bilalDefaultIndex ? '' : 'display:none' }}">
                                <div class="relative bg-gray-50 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                                    <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b {{ $style['accent'] }}"></div>
                                    <div class="p-5 pl-7">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $style['badge'] }} capitalize mb-3">
                                            {{ $item->pasaran }}
                                        </span>
                                        @if ($item->anggota->isEmpty())
                                            <p class="text-gray-400 text-sm italic">Belum ada petugas ditugaskan</p>
                                        @else
                                            <div class="flex flex-col gap-2">
                                                @foreach ($item->anggota as $index => $orang)
                                                    <div class="flex items-center gap-2 bg-white hover:bg-gray-100 transition-colors rounded-lg px-3 py-2 w-fit">
                                                        <span class="w-7 h-7 flex items-center justify-center rounded-full text-white text-xs font-bold {{ $avatarColors[$index % count($avatarColors)] }}">
                                                            {{ strtoupper(substr($orang->nama, 0, 1)) }}
                                                        </span>
                                                        <span class="text-sm text-gray-700">{{ $orang->nama }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="nextDay('bilal')" aria-label="Berikutnya"
                            class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">›</button>
                </div>

                <p class="text-center text-xs text-gray-400 mt-4 md:hidden">← Geser untuk lihat pasaran lain →</p>
            </div>
        @endif
    </div>
</section>

<!-- ================= JADWAL PIKET KEBERSIHAN ================= -->
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center">Jadwal Piket Kebersihan</h2>
        <p class="text-center text-gray-500 mt-2">Petugas kebersihan masjid setiap harinya.</p>

        @if ($piketList->isEmpty())
            <div class="bg-white rounded-2xl shadow p-12 text-center mt-14">
                <div class="text-5xl mb-3">🗓️</div>
                <p class="text-gray-400">Belum ada jadwal piket.</p>
            </div>
        @else
            <div class="mt-14">
                <div id="tabs-piket" class="flex gap-2 overflow-x-auto pb-3 mb-6 justify-start md:justify-center">
                    @foreach ($piketList as $i => $item)
                        @php $style = $dayStyles[strtolower($item->hari)] ?? ['badge' => 'bg-gray-100 text-gray-700']; @endphp
                        <button type="button" data-active-class="{{ $style['badge'] }}" onclick="showDay('piket', {{ $i }})"
                                class="day-tab shrink-0 px-4 py-2 rounded-full text-sm font-semibold capitalize transition {{ $i === $piketDefaultIndex ? $style['badge'] : 'bg-white text-gray-500 hover:bg-gray-200 border border-gray-200' }}">
                            {{ $item->hari }}{{ $i === $piketDefaultIndex ? ' • Hari ini' : '' }}
                        </button>
                    @endforeach
                </div>

                <div class="relative">
                    <button type="button" onclick="prevDay('piket')" aria-label="Sebelumnya"
                            class="hidden md:flex absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">‹</button>

                    <div id="slider-piket">
                        @foreach ($piketList as $i => $item)
                            @php $style = $dayStyles[strtolower($item->hari)] ?? ['badge' => 'bg-gray-100 text-gray-700', 'accent' => 'from-gray-400 to-gray-500']; @endphp
                            <div class="day-panel" data-group="piket" data-index="{{ $i }}" style="{{ $i === $piketDefaultIndex ? '' : 'display:none' }}">
                                <div class="relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                                    <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b {{ $style['accent'] }}"></div>
                                    <div class="p-5 pl-7">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $style['badge'] }} capitalize mb-3">
                                            {{ $item->hari }}
                                        </span>
                                        @if ($item->anggota->isEmpty())
                                            <p class="text-gray-400 text-sm italic">Belum ada petugas ditugaskan</p>
                                        @else
                                            <div class="flex flex-col gap-2">
                                                @foreach ($item->anggota as $index => $orang)
                                                    <div class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 transition-colors rounded-lg px-3 py-2 w-fit">
                                                        <span class="w-7 h-7 flex items-center justify-center rounded-full text-white text-xs font-bold {{ $avatarColors[$index % count($avatarColors)] }}">
                                                            {{ strtoupper(substr($orang->nama, 0, 1)) }}
                                                        </span>
                                                        <span class="text-sm text-gray-700">{{ $orang->nama }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="nextDay('piket')" aria-label="Berikutnya"
                            class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center rounded-full bg-white shadow hover:bg-gray-100 z-10 text-gray-500 text-xl font-bold">›</button>
                </div>

                <p class="text-center text-xs text-gray-400 mt-4 md:hidden">← Geser untuk lihat hari lain →</p>
            </div>
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

<script>
    const sliderState = {};

    function initSlider(group, total, defaultIndex) {
        if (total === 0) return;
        sliderState[group] = { index: defaultIndex, total: total };
        renderSlider(group);
    }

    function renderSlider(group) {
        const state = sliderState[group];
        if (!state) return;

        document.querySelectorAll(`.day-panel[data-group="${group}"]`).forEach((panel) => {
            panel.style.display = (parseInt(panel.dataset.index, 10) === state.index) ? 'block' : 'none';
        });

        const tabsContainer = document.getElementById(`tabs-${group}`);
        if (tabsContainer) {
            tabsContainer.querySelectorAll('.day-tab').forEach((tab, i) => {
                const base = 'day-tab shrink-0 px-4 py-2 rounded-full text-sm font-semibold capitalize transition ';
                tab.className = base + (i === state.index
                    ? tab.dataset.activeClass
                    : 'bg-white text-gray-500 hover:bg-gray-200 border border-gray-200');
            });
        }
    }

    function showDay(group, index) {
        if (!sliderState[group]) return;
        sliderState[group].index = index;
        renderSlider(group);
    }

    function prevDay(group) {
        const state = sliderState[group];
        if (!state) return;
        state.index = (state.index - 1 + state.total) % state.total;
        renderSlider(group);
    }

    function nextDay(group) {
        const state = sliderState[group];
        if (!state) return;
        state.index = (state.index + 1) % state.total;
        renderSlider(group);
    }

    function enableSwipe(elId, group) {
        const el = document.getElementById(elId);
        if (!el) return;
        let startX = 0;

        el.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });

        el.addEventListener('touchend', (e) => {
            const diff = e.changedTouches[0].clientX - startX;
            if (diff > 50) prevDay(group);
            else if (diff < -50) nextDay(group);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initSlider('imam', {{ $imamDays->count() }}, {{ $imamDefaultIndex }});
        initSlider('bilal', {{ $bilalList->count() }}, {{ $bilalDefaultIndex }});
        initSlider('piket', {{ $piketList->count() }}, {{ $piketDefaultIndex }});

        enableSwipe('slider-imam', 'imam');
        enableSwipe('slider-bilal', 'bilal');
        enableSwipe('slider-piket', 'piket');
    });
</script>

</body>
</html>