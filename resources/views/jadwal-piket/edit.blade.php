<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
Edit Jadwal Piket
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-4xl mx-auto">

<div class="bg-white p-6 rounded shadow">

<form action="{{ route('jadwal-piket.update',$jadwalPiket->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-4">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
value="{{ $jadwalPiket->tanggal }}"
class="w-full border rounded p-2">

</div>

<div class="mb-4">

<label>Koordinator</label>

<select
name="koordinator_id"
class="w-full border rounded p-2">

@foreach($pengurus as $p)

<option
value="{{ $p->id }}"
{{ $jadwalPiket->koordinator_id == $p->id ? 'selected' : '' }}>
{{ $p->nama }}
</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label>Anggota</label>

<select
name="anggota1_id"
class="w-full border rounded p-2">

@foreach($pengurus as $p)

<option
value="{{ $p->id }}"
{{ $jadwalPiket->anggota1_id == $p->id ? 'selected' : '' }}>
{{ $p->nama }}
</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label>Keterangan</label>

<textarea
name="keterangan"
class="w-full border rounded p-2">{{ $jadwalPiket->keterangan }}</textarea>

</div>

<button
class="bg-blue-600 text-white px-5 py-2 rounded">
Update
</button>

<a
href="{{ route('jadwal-piket.index') }}"
class="bg-gray-500 text-white px-5 py-2 rounded">
Kembali
</a>

</form>

</div>

</div>
</div>

</x-app-layout>