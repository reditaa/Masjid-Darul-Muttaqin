<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Bilal
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

                <form action="{{ route('jadwal-bilal.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pasaran</label>
                        <select name="pasaran" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Pasaran --</option>
                            <option value="legi" {{ old('pasaran') == 'legi' ? 'selected' : '' }}>Legi</option>
                            <option value="pahing" {{ old('pasaran') == 'pahing' ? 'selected' : '' }}>Pahing</option>
                            <option value="pon" {{ old('pasaran') == 'pon' ? 'selected' : '' }}>Pon</option>
                            <option value="wage" {{ old('pasaran') == 'wage' ? 'selected' : '' }}>Wage</option>
                            <option value="kliwon" {{ old('pasaran') == 'kliwon' ? 'selected' : '' }}>Kliwon</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Petugas Bilal</label>

                        {{-- Live Search Box --}}
                        <div class="relative mb-2">
                            <input type="text" id="search-bilal" placeholder="🔍 Ketik nama untuk mencari petugas Bilal..."
                                   class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 border rounded-md p-3 max-h-64 overflow-y-auto bg-white" id="container-bilal">
                            @foreach ($pengurus as $p)
                                <label class="item-bilal flex items-center justify-between p-2 rounded hover:bg-blue-50 cursor-pointer text-sm border border-gray-100 transition"
                                       data-nama="{{ strtolower($p->nama) }}">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <input type="checkbox" name="anggota_ids[]" value="{{ $p->id }}"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            {{ collect(old('anggota_ids'))->contains($p->id) ? 'checked' : '' }}>
                                        <span class="truncate">{{ $p->nama }}</span>
                                    </div>
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
                        <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih petugas.</p>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('jadwal-bilal.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-bilal').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.item-bilal');
            items.forEach(item => {
                const name = item.getAttribute('data-nama') || '';
                if (name.includes(keyword)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>