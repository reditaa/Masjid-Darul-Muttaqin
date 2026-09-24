<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Piket Kebersihan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jadwal-piket-kebersihan.store') }}" method="POST" enctype="multipart/form-data" id="form-piket" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hari</label>
                        <select name="hari" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="senin" {{ old('hari') == 'senin' ? 'selected' : '' }}>Senin</option>
                            <option value="selasa" {{ old('hari') == 'selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="rabu" {{ old('hari') == 'rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="kamis" {{ old('hari') == 'kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="jumat" {{ old('hari') == 'jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="sabtu" {{ old('hari') == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="minggu" {{ old('hari') == 'minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Petugas Piket Kebersihan</label>

                        <div class="relative mb-2">
                            <input type="text" id="search-piket" name="search-piket-noautofill" autocomplete="off"
                                   placeholder="🔍 Ketik nama untuk mencari petugas piket..."
                                   class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 border rounded-md p-3 max-h-64 overflow-y-auto bg-white" id="container-piket">
                            @foreach ($pengurus as $p)
                                <label class="item-piket flex items-center justify-between p-2 rounded hover:bg-emerald-50 cursor-pointer text-sm border border-gray-100 transition"
                                       data-nama="{{ strtolower($p->nama) }}">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <input type="checkbox" name="anggota_ids[]" value="{{ $p->id }}"
                                               class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                                               {{ collect(old('anggota_ids'))->contains($p->id) ? 'checked' : '' }}>
                                        @if ($p->foto)
                                            <img src="{{ Storage::url($p->foto) }}" alt="Foto {{ $p->nama }}" class="w-8 h-8 rounded-full object-cover">
                                        @else
                                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 text-xs font-semibold">{{ strtoupper(substr($p->nama, 0, 1)) }}</span>
                                        @endif
                                        <span class="truncate">{{ $p->nama }}</span>
                                    </div>
                                    <input type="file" name="foto[{{ $p->id }}]" accept="image/*"
                                           class="foto-petugas hidden w-32 text-[10px]" title="Foto petugas">
                                    @if ($p->asal === 'guru')
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-blue-100 text-blue-700 font-semibold flex-shrink-0">Guru</span>
                                    @elseif ($p->asal === 'siswa')
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-700 font-semibold flex-shrink-0">Siswa</span>
                                    @elseif ($p->jabatan)
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-purple-100 text-purple-700 font-semibold flex-shrink-0 truncate max-w-[100px]">{{ $p->jabatan->nama_jabatan }}</span>
                                    @else
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-gray-100 text-gray-600 font-semibold flex-shrink-0">Anggota</span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih 3 sampai 6 anak yang berbeda.</p>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('jadwal-piket-kebersihan.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-piket').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.item-piket');
            items.forEach(item => {
                const name = item.getAttribute('data-nama') || '';
                item.style.display = name.includes(keyword) ? 'flex' : 'none';
            });
        });

        document.querySelectorAll('input[name="anggota_ids[]"]').forEach(function (checkbox) {
            const foto = checkbox.closest('.item-piket').querySelector('.foto-petugas');
            const tampilkanFoto = () => foto.classList.toggle('hidden', !checkbox.checked);
            checkbox.addEventListener('change', tampilkanFoto);
            tampilkanFoto();
        });

        document.querySelectorAll('.foto-petugas').forEach(function (input) {
            input.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        document.getElementById('form-piket').addEventListener('submit', function (e) {
            const jumlahDipilih = document.querySelectorAll('input[name="anggota_ids[]"]:checked').length;
            if (jumlahDipilih < 3 || jumlahDipilih > 6) {
                e.preventDefault();
                alert('Pilih 3 sampai 6 anak terlebih dahulu.');
            }
        });
    </script>
</x-app-layout>