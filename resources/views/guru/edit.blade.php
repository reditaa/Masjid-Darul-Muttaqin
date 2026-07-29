<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">Edit Guru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow rounded-xl p-6">

                <form action="{{ route('guru.update',$guru->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block mb-1">NIP</label>
                            <input type="text" name="nip" value="{{ $guru->nip }}" class="w-full border rounded-lg p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1">Nama Guru</label>
                            <input type="text" name="nama" value="{{ $guru->nama }}" class="w-full border rounded-lg p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1">Email</label>
                            <input type="email" name="email" value="{{ $guru->email }}" class="w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Password Baru (opsional)</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block mb-1">No HP</label>
                            <input type="text" name="no_hp" value="{{ $guru->no_hp }}" class="w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Status</label>
                            <select name="status" class="w-full border rounded-lg p-2">
                                <option value="Aktif" {{ $guru->status=='Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ $guru->status=='Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full border rounded-lg p-2">{{ $guru->alamat }}</textarea>
                    </div>

                    <div class="mt-5">
                        <label class="block mb-1">Foto</label>
                        <input type="file" name="foto" class="w-full border rounded-lg p-2">

                        @if($guru->foto)
                            <img src="{{ asset('storage/'.$guru->foto) }}"
                                 class="w-24 h-24 rounded-lg object-cover mt-3">
                        @endif
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                            Update
                        </button>

                        <a href="{{ route('guru.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
