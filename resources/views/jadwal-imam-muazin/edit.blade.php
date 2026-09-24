<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            <i class="fas fa-mosque text-green-600 mr-2"></i>Edit Jadwal Imam & Muazin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#fbf9f0] border-2 border-green-700 rounded-2xl shadow-md p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $imamTerpilih = $jadwal->imam->sortBy('pivot.urutan')->values();
                    $muazinTerpilih = $jadwal->muazin->sortBy('pivot.urutan')->values();
                @endphp

                <form action="{{ route('jadwal-imam-muazin.update', $jadwal) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-green-800 mb-1">Hari</label>
                            <select name="hari" class="form-hijau" required>
                                <option value="senin" {{ $jadwal->hari == 'senin' ? 'selected' : '' }}>Senin</option>
                                <option value="selasa" {{ $jadwal->hari == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="rabu" {{ $jadwal->hari == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="kamis" {{ $jadwal->hari == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="jumat" {{ $jadwal->hari == 'jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="sabtu" {{ $jadwal->hari == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                                <option value="minggu" {{ $jadwal->hari == 'minggu' ? 'selected' : '' }}>Minggu</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-green-800 mb-1">Waktu Sholat</label>
                            <select name="waktu_sholat" class="form-hijau" required>
                                <option value="subuh" {{ $jadwal->waktu_sholat == 'subuh' ? 'selected' : '' }}>Subuh</option>
                                <option value="dzuhur" {{ $jadwal->waktu_sholat == 'dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                                <option value="ashar" {{ $jadwal->waktu_sholat == 'ashar' ? 'selected' : '' }}>Ashar</option>
                                <option value="maghrib" {{ $jadwal->waktu_sholat == 'maghrib' ? 'selected' : '' }}>Maghrib</option>
                                <option value="isya" {{ $jadwal->waktu_sholat == 'isya' ? 'selected' : '' }}>Isya</option>
                            </select>
                        </div>
                    </div>

                    {{-- Live Search Filter Box (berlaku untuk Imam & Muazin sekaligus) --}}
                    <div class="bg-green-50 p-3 rounded-xl border border-green-200">
                        <label class="block text-xs font-semibold text-green-800 mb-1">
                            <i class="fas fa-search text-green-600 mr-1"></i> Cari Nama Imam / Muazin:
                        </label>
                        <input type="text" id="search-imam-global" placeholder="Ketik nama petugas untuk menyaring pilihan..."
                               class="w-full text-xs border border-green-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-green-800 mb-2">Imam (urutan cadangan)</label>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">1. Utama:</span>
                                <select name="imam_ids[]" id="select-imam-1" class="select-imam-list form-hijau text-sm" required>
                                    <option value="">-- Imam Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($imamTerpilih->get(0)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">2. Cadangan 1:</span>
                                <select name="imam_ids[]" id="select-imam-2" class="select-imam-list form-hijau text-sm">
                                    <option value="">-- Cadangan 1 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($imamTerpilih->get(1)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">3. Cadangan 2:</span>
                                <select name="imam_ids[]" id="select-imam-3" class="select-imam-list form-hijau text-sm">
                                    <option value="">-- Cadangan 2 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($imamTerpilih->get(2)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-green-800 mb-2">Muazin (urutan cadangan)</label>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">1. Utama:</span>
                                <select name="muazin_ids[]" id="select-muazin-1" class="select-imam-list form-hijau text-sm" required>
                                    <option value="">-- Muazin Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($muazinTerpilih->get(0)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">2. Cadangan 1:</span>
                                <select name="muazin_ids[]" id="select-muazin-2" class="select-imam-list form-hijau text-sm">
                                    <option value="">-- Cadangan 1 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($muazinTerpilih->get(1)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-green-700">3. Cadangan 2:</span>
                                <select name="muazin_ids[]" id="select-muazin-3" class="select-imam-list form-hijau text-sm">
                                    <option value="">-- Cadangan 2 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}" {{ ($muazinTerpilih->get(2)?->id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-green-800 mb-1">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="2" class="form-hijau">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                    </div>

                    <div id="foto-petugas-container" class="space-y-2"></div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-green-100">
                        <a href="{{ route('jadwal-imam-muazin.index') }}"
                           class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 shadow">
                            <i class="fas fa-floppy-disk mr-1"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-imam-global').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const selects = document.querySelectorAll('.select-imam-list');
            selects.forEach(select => {
                Array.from(select.options).forEach(option => {
                    if (!option.value) return;
                    const name = option.getAttribute('data-nama') || option.text.toLowerCase();
                    if (name.includes(keyword)) {
                        option.hidden = false;
                        option.style.display = '';
                    } else {
                        option.hidden = true;
                        option.style.display = 'none';
                    }
                });
            });
        });

        const fotoContainer = document.getElementById('foto-petugas-container');
        const selectsPetugas = document.querySelectorAll('.select-imam-list');
        function renderFotoPetugas() {
            const selected = new Map();
            selectsPetugas.forEach(select => {
                if (select.value) selected.set(select.value, select.options[select.selectedIndex].text.trim());
            });
            fotoContainer.innerHTML = selected.size ? '<p class="text-xs font-semibold text-green-800">Foto Petugas (opsional)</p>' : '';
            selected.forEach((nama, id) => {
                fotoContainer.insertAdjacentHTML('beforeend', `<label class="flex items-center gap-3 text-xs text-gray-700"><span class="w-40 truncate">${nama}</span><input type="file" name="foto[${id}]" accept="image/*" class="text-xs"></label>`);
            });
        }
        selectsPetugas.forEach(select => select.addEventListener('change', renderFotoPetugas));
        renderFotoPetugas();
    </script>
</x-app-layout>