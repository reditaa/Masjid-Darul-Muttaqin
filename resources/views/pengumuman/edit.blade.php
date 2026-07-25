<x-app-layout>

```
<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Edit Pengumuman
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-5xl mx-auto">

        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('pengumuman.update',$pengumuman->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Judul</label>

                    <input type="text"
                           name="judul"
                           value="{{ $pengumuman->judul }}"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label>Isi Pengumuman</label>

                    <textarea
                        name="isi"
                        rows="6"
                        class="w-full border rounded p-2"
                        required>{{ $pengumuman->isi }}</textarea>
                </div>

                <div class="mb-4">
                    <label>Tanggal</label>

                    <input type="date"
                           name="tanggal"
                           value="{{ $pengumuman->tanggal }}"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label>Gambar Saat Ini</label>

                    @if($pengumuman->gambar)
                        <img src="{{ asset('storage/' . $pengumuman->gambar) }}"
                             alt="Gambar"
                             class="w-32 h-32 object-cover rounded mb-2 border">
                    @else
                        <p class="text-gray-500">Belum ada gambar</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label>Ganti Gambar</label>

                    <input type="file"
                           name="gambar"
                           class="w-full border rounded p-2"
                           accept="image/*">
                </div>

                <button
                    class="bg-green-600 text-white px-5 py-2 rounded">
                    Update
                </button>

                <a href="{{ route('pengumuman.index') }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded">
                    Kembali
                </a>

            </form>

        </div>

    </div>
</div>
```

</x-app-layout>
