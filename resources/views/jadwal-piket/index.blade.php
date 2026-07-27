<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
Data Jadwal Piket
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-7xl mx-auto">

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
{{ session('success') }}
</div>
@endif

<div class="bg-white p-6 rounded shadow">

<div class="flex justify-between mb-5">

<a href="{{ route('jadwal-piket.create') }}"
class="bg-blue-600 text-white px-5 py-2 rounded">
+ Tambah Jadwal
</a>

</div>

<table class="w-full border">

<thead class="bg-gray-200">
<tr>

<th class="border p-2">No</th>
<th class="border">Tanggal</th>
<th class="border">Koordinator</th>
<th class="border">Anggota</th>
<th class="border">Keterangan</th>
<th class="border">Aksi</th>

</tr>
</thead>

<tbody>

@forelse($jadwalPiket as $item)

<tr>

<td class="border text-center">
{{ $loop->iteration }}
</td>

<td class="border text-center">
{{ $item->tanggal }}
</td>

<td class="border px-3">
{{ $item->koordinator->nama }}
</td>

<td class="border px-3">
{{ $item->anggota1->nama }}
</td>

<td class="border px-3">
{{ $item->keterangan }}
</td>

<td class="border text-center">

<a href="{{ route('jadwal-piket.edit',$item->id) }}"
class="bg-yellow-500 text-white px-3 py-2 rounded">
Edit
</a>

<form
action="{{ route('jadwal-piket.destroy',$item->id) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
onclick="return confirm('Yakin?')"
class="bg-red-600 text-white px-3 py-2 rounded">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="6"
class="text-center py-5">
Belum ada data.
</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5">

{{ $jadwalPiket->links() }}

</div>

</div>

</div>
</div>

</x-app-layout>