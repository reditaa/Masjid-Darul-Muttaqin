<x-app-layout>

<div class="py-6">

<div class="max-w-5xl mx-auto">

<div class="bg-white shadow rounded-lg p-6">


<h2 class="text-xl font-bold mb-5">
Tambah Jadwal Imam
</h2>


<form action="{{ route('jadwal-imam.store') }}" method="POST">

@csrf



<div class="mb-4">

<label class="font-semibold">
Hari
</label>


<select 
name="hari"
id="hari"
class="w-full border rounded p-2"
onchange="ubahHari()">


<option value="">
-- Pilih Hari --
</option>


<option>Senin</option>

<option>Selasa</option>

<option>Rabu</option>

<option>Kamis</option>

<option>Jumat</option>


</select>

</div>





<!-- JADWAL BIASA -->

<div id="jadwalBiasa"
style="display:none;">


<h3 class="font-bold mb-3">
Jadwal Dzuhur
</h3>



@for($i=1;$i<=3;$i++)

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

<option value="{{ $p->id }}">

{{ $p->anggota->nama ?? 'Tanpa Nama' }}

</option>


@endforeach


</select>

</div>


@endfor





<h3 class="font-bold mt-5 mb-3">
Jadwal Ashar
</h3>



@for($i=1;$i<=3;$i++)

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

<option value="{{ $p->id }}">

{{ $p->anggota->nama ?? 'Tanpa Nama' }}

</option>


@endforeach


</select>

</div>


@endfor


</div>







<!-- JUMAT -->

<div id="jadwalJumat"
style="display:none;">



<div class="mb-4">

<label>
Pasaran
</label>


<select 
name="pasaran"
class="w-full border rounded p-2">


<option value="">
-- Pilih Pasaran --
</option>


<option>Pon</option>

<option>Kliwon</option>

<option>Pahing</option>

<option>Wage</option>

<option>Legi</option>


</select>

</div>





<div class="mb-4">


<label>
Khatib Jumat
</label>


<select 
name="khatib_jumat"
class="w-full border rounded p-2">


<option>
-- Pilih Khatib --
</option>


@foreach($pengurus as $p)


<option value="{{ $p->id }}">

{{ $p->anggota->nama ?? 'Tanpa Nama' }}

</option>


@endforeach


</select>


</div>







<div class="mb-4">


<label>
Imam Jumat
</label>


<select 
name="imam_jumat"
class="w-full border rounded p-2">


<option>
-- Pilih Imam --
</option>


@foreach($pengurus as $p)


<option value="{{ $p->id }}">

{{ $p->anggota->nama ?? 'Tanpa Nama' }}

</option>


@endforeach


</select>


</div>



</div>






<button 
class="bg-blue-600 text-white px-5 py-2 rounded">


Simpan


</button>



</form>


</div>

</div>

</div>





<script>


function ubahHari()
{


let hari =
document.getElementById('hari').value;



let biasa =
document.getElementById('jadwalBiasa');


let jumat =
document.getElementById('jadwalJumat');




if(hari === "Jumat")
{

    biasa.style.display="none";

    jumat.style.display="block";

}

else if(hari !== "")
{

    biasa.style.display="block";

    jumat.style.display="none";

}

else
{

    biasa.style.display="none";

    jumat.style.display="none";

}


}


</script>


</x-app-layout>