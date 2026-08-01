<x-app-layout>

<div class="py-6">

<div class="max-w-5xl mx-auto">

<div class="bg-white shadow rounded-lg p-6">


<h2 class="text-xl font-bold mb-5">
Edit Jadwal Imam
</h2>



<form action="{{ route('jadwal-imam.update',$jadwalImam->id) }}" method="POST">

@csrf
@method('PUT')



<div class="mb-4">

<label class="font-semibold">
Hari
</label>


<select 
name="hari"
id="hari"
class="w-full border rounded p-2">


<option value="Senin"
{{ $jadwalImam->hari == 'Senin' ? 'selected':'' }}>
Senin
</option>


<option value="Selasa"
{{ $jadwalImam->hari == 'Selasa' ? 'selected':'' }}>
Selasa
</option>


<option value="Rabu"
{{ $jadwalImam->hari == 'Rabu' ? 'selected':'' }}>
Rabu
</option>


<option value="Kamis"
{{ $jadwalImam->hari == 'Kamis' ? 'selected':'' }}>
Kamis
</option>


</select>


</div>







<h3 class="font-bold mt-5 mb-3">
Jadwal Dzuhur
</h3>



@for($i = 1; $i <= 3; $i++)


<div class="mb-3">


<label>
Imam Dzuhur {{ $i }}
</label>



<select
name="dzuhur_imam_{{ $i }}"
class="w-full border rounded p-2">


<option value="">
-- Pilih Imam --
</option>



@foreach($pengurus as $p)


<option 
value="{{ $p->id }}"


@if(
optional($jadwalImam->{'dzuhurImam'.$i})->id == $p->id
)

selected

@endif

>


{{ $p->anggota->nama ?? 'Tanpa Nama' }}


</option>


@endforeach


</select>


</div>


@endfor







<h3 class="font-bold mt-5 mb-3">
Jadwal Ashar
</h3>




@for($i = 1; $i <= 3; $i++)


<div class="mb-3">


<label>
Imam Ashar {{ $i }}
</label>



<select
name="ashar_imam_{{ $i }}"
class="w-full border rounded p-2">



<option value="">
-- Pilih Imam --
</option>



@foreach($pengurus as $p)


<option

value="{{ $p->id }}"


@if(
optional($jadwalImam->{'asharImam'.$i})->id == $p->id
)

selected

@endif

>


{{ $p->anggota->nama ?? 'Tanpa Nama' }}


</option>


@endforeach


</select>


</div>


@endfor






<button

class="bg-blue-600 text-white px-5 py-2 rounded"

>

Update

</button>




</form>


</div>

</div>

</div>


</x-app-layout>