<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
Tambah Jadwal Piket
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-4xl mx-auto">

<div class="bg-white p-6 rounded shadow">

<form action="{{ route('jadwal-piket.store') }}" method="POST">

@csrf

<div class="mb-4">
<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="w-full border rounded p-2"
required>

</div>

<div class="mb-4">

<label>Koordinator</label>

<select
name="koordinator_id"
class="w-full border rounded p-2">

@foreach($pengurus as $p)

<option value="{{ $p->id }}">
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

<option value="{{ $p->id }}">
{{ $p->nama }}
</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label>Keterangan</label>

<textarea
name="keterangan"
class="w-full border rounded p-2"></textarea>

</div>

<button
class="bg-blue-600 text-white px-5 py-2 rounded">
Simpan
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