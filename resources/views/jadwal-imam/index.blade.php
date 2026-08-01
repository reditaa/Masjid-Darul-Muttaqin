<x-app-layout>

<div class="py-6">

<div class="max-w-6xl mx-auto">


<div class="bg-white shadow rounded-lg p-6">


<div class="flex justify-between mb-5">

<h2 class="text-xl font-bold">
Jadwal Imam Masjid
</h2>


<a href="{{ route('jadwal-imam.create') }}"
class="bg-blue-600 text-white px-4 py-2 rounded">

+ Tambah Jadwal

</a>

</div>





@if(session('success'))

<div class="bg-green-100 p-3 rounded mb-4">

{{ session('success') }}

</div>

@endif







<h3 class="font-bold text-lg mb-3">
Jadwal Maktubah (Dzuhur & Ashar)
</h3>



<table class="w-full border mb-8">


<thead class="bg-gray-100">


<tr>

<th class="border p-2">
Hari
</th>


<th class="border p-2">
Dzuhur
</th>


<th class="border p-2">
Ashar
</th>


<th class="border p-2">
Aksi
</th>


</tr>


</thead>




<tbody>



@forelse($jadwalImam as $j)



<tr>


<td class="border p-3 text-center">

{{ $j->hari }}

</td>





<td class="border p-3">


@for($i=1;$i<=3;$i++)


@if($j->{'dzuhurImam'.$i})

<div>

{{ $i }}.
{{ $j->{'dzuhurImam'.$i}->anggota->nama ?? 'Tanpa Nama' }}

</div>

@endif


@endfor


</td>





<td class="border p-3">


@for($i=1;$i<=3;$i++)


@if($j->{'asharImam'.$i})

<div>

{{ $i }}.
{{ $j->{'asharImam'.$i}->anggota->nama ?? 'Tanpa Nama' }}

</div>

@endif


@endfor


</td>






<td class="border p-3 text-center">


<a href="{{ route('jadwal-imam.edit',$j->id) }}"

class="bg-yellow-500 text-white px-3 py-1 rounded">

Edit

</a>





<form

action="{{ route('jadwal-imam.destroy',$j->id) }}"

method="POST"

class="inline">


@csrf

@method('DELETE')


<button

onclick="return confirm('Hapus jadwal?')"

class="bg-red-600 text-white px-3 py-1 rounded">

Hapus

</button>


</form>



</td>



</tr>




@empty


<tr>

<td colspan="4"

class="border p-4 text-center">

Belum ada jadwal

</td>

</tr>


@endforelse



</tbody>


</table>









<h3 class="font-bold text-lg mb-3">

Jadwal Jumat

</h3>




<table class="w-full border">



<thead class="bg-gray-100">


<tr>


<th class="border p-2">
Pasaran
</th>


<th class="border p-2">
Khatib
</th>


<th class="border p-2">
Imam
</th>


</tr>


</thead>





<tbody>



@forelse($jadwalJumat as $j)



<tr>


<td class="border p-3 text-center">

{{ $j->pasaran }}

</td>



<td class="border p-3">

{{ $j->khatib->anggota->nama ?? 'Belum ada' }}

</td>



<td class="border p-3">

{{ $j->imam->anggota->nama ?? 'Belum ada' }}

</td>


</tr>




@empty


<tr>

<td colspan="3"

class="border p-4 text-center">

Belum ada jadwal Jumat

</td>

</tr>


@endforelse



</tbody>


</table>



</div>


</div>


</div>


</x-app-layout>