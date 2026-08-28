<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengumuman->judul }} - Masjid Darul Muttaqin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<nav class="bg-white shadow">
    <div class="max-w-4xl mx-auto flex items-center gap-3 py-3 px-4 sm:py-4 sm:px-6">
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-700 flex items-center justify-center text-white text-lg sm:text-xl shrink-0">
            🕌
        </div>
        <div>
            <h1 class="font-bold text-base sm:text-lg text-green-700">Masjid Darul Muttaqin</h1>
            <p class="text-xs text-gray-500">SMK Negeri 1 Bangsri</p>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-4 py-6 sm:px-6 sm:py-10">

    <a href="{{ route('landing') }}#pengumuman" class="text-green-700 text-sm hover:underline">
        &larr; Kembali ke Beranda
    </a>

    <div class="bg-white rounded-2xl sm:rounded-3xl shadow overflow-hidden mt-4">

        @if ($pengumuman->gambar)
            <img src="{{ Storage::url($pengumuman->gambar) }}" class="w-full h-48 sm:h-72 object-contain bg-gray-100">
        @else
            <div class="w-full h-48 sm:h-72 bg-green-100 flex items-center justify-center text-5xl sm:text-7xl">📢</div>
        @endif

        <div class="p-5 sm:p-8">
            <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">
                {{ ucfirst($pengumuman->kategori) }}
            </span>

            <h1 class="text-2xl sm:text-3xl font-bold mt-4 break-words">{{ $pengumuman->judul }}</h1>

            <p class="text-gray-500 text-sm mt-2">
                {{ $pengumuman->tanggal_publish->translatedFormat('d F Y') }}
                &middot; {{ $pengumuman->dilihat }} kali dilihat
            </p>

            <div class="mt-6 text-gray-700 text-sm sm:text-base leading-7 sm:leading-8 whitespace-pre-line break-words">
                {{ $pengumuman->isi }}
            </div>
        </div>
    </div>

</div>

</body>
</html>