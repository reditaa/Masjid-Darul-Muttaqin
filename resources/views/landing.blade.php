<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Masjid Darul Muttaqin</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-50">


<!-- NAVBAR -->

<nav class="bg-white shadow">

<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

<h1 class="text-xl font-bold text-green-700">
Masjid Darul Muttaqin
</h1>


<div>

<a href="#tentang" class="mx-3 text-gray-600">
Tentang
</a>


<a href="#jadwal" class="mx-3 text-gray-600">
Jadwal
</a>


<a href="{{ route('login') }}"
class="bg-green-700 text-white px-4 py-2 rounded">
Login Admin
</a>


</div>

</div>

</nav>



<!-- HERO -->

<section class="bg-green-700 text-white">

<div class="max-w-7xl mx-auto px-6 py-20 text-center">


<h2 class="text-4xl font-bold mb-5">

Selamat Datang di

<br>

Masjid Darul Muttaqin

</h2>


<p class="text-lg">

Website informasi masjid sekolah untuk melihat

jadwal imam, pengumuman, dan kegiatan masjid.

</p>


<a href="#jadwal"

class="inline-block mt-8 bg-white text-green-700 px-6 py-3 rounded">

Lihat Jadwal

</a>


</div>

</section>




<!-- TENTANG -->

<section id="tentang"

class="max-w-6xl mx-auto px-6 py-16">


<h2 class="text-2xl font-bold text-center mb-6">

Tentang Masjid

</h2>


<p class="text-center text-gray-600">

Masjid Darul Muttaqin merupakan pusat kegiatan

keagamaan sekolah untuk mendukung ibadah dan

pembinaan karakter warga sekolah.

</p>


</section>





<!-- PENGUMUMAN -->

<section class="max-w-6xl mx-auto px-6 pb-10">


<h2 class="text-2xl font-bold mb-6 text-center">

Pengumuman Terbaru

</h2>


<div class="grid md:grid-cols-3 gap-5">


@forelse($pengumuman as $p)

<div class="bg-white rounded shadow p-5">


<h3 class="font-bold text-green-700">

{{ $p->judul }}

</h3>


<p class="text-gray-600 mt-2">

{{ $p->isi }}

</p>


</div>


@empty

<p class="text-center">

Belum ada pengumuman

</p>

@endforelse


</div>


</section>







<!-- JADWAL -->

<section id="jadwal"

class="bg-gray-100 py-16">


<div class="max-w-6xl mx-auto px-6">


<h2 class="text-2xl font-bold text-center mb-10">

Jadwal Imam

</h2>



<div class="grid md:grid-cols-2 gap-6">



@foreach($jadwalImam as $jadwal)


<div class="bg-white rounded shadow p-6">


<h3 class="font-bold text-green-700 text-lg mb-4">

{{ $jadwal->hari }}

</h3>



<div class="mb-4">

<h4 class="font-semibold">

Dzuhur

</h4>


<p>
{{ $jadwal->dzuhurImam1->nama ?? '-' }}
</p>

<p>
{{ $jadwal->dzuhurImam2->nama ?? '-' }}
</p>

<p>
{{ $jadwal->dzuhurImam3->nama ?? '-' }}
</p>


</div>




<div>

<h4 class="font-semibold">

Ashar

</h4>


<p>
{{ $jadwal->asharImam1->nama ?? '-' }}
</p>

<p>
{{ $jadwal->asharImam2->nama ?? '-' }}
</p>

<p>
{{ $jadwal->asharImam3->nama ?? '-' }}
</p>


</div>



</div>


@endforeach


</div>





<!-- JUMAT -->


<h2 class="text-2xl font-bold text-center mt-12 mb-6">

Jadwal Jumat

</h2>



@if($jadwalJumat)


<div class="bg-white rounded shadow p-6 text-center">


<p>

Pasaran :

<b>
{{ $jadwalJumat->pasaran }}
</b>

</p>


<p>

Khatib :

<b>
{{ $jadwalJumat->khatib->nama ?? '-' }}
</b>

</p>


<p>

Imam :

<b>
{{ $jadwalJumat->imam->nama ?? '-' }}
</b>

</p>



</div>


@else

<p class="text-center">

Belum ada jadwal Jumat

</p>

@endif



</div>


</section>





<!-- FOOTER -->


<footer class="bg-green-700 text-white text-center py-5">


© {{ date('Y') }} Masjid Darul Muttaqin


</footer>



</body>

</html>