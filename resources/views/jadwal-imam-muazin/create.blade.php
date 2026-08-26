<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Imam & Muazin
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

                <form action="{{ route('jadwal-imam-muazin.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
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
                            <label class="block text-sm font-medium text-gray-700">Waktu Sholat</label>
                            <select name="waktu_sholat" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="">-- Pilih Waktu --</option>
                                <option value="subuh" {{ old('waktu_sholat') == 'subuh' ? 'selected' : '' }}>Subuh</option>
                                <option value="dzuhur" {{ old('waktu_sholat') == 'dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                                <option value="ashar" {{ old('waktu_sholat') == 'ashar' ? 'selected' : '' }}>Ashar</option>
                                <option value="maghrib" {{ old('waktu_sholat') == 'maghrib' ? 'selected' : '' }}>Maghrib</option>
                                <option value="isya" {{ old('waktu_sholat') == 'isya' ? 'selected' : '' }}>Isya</option>
                            </select>
                        </div>
                    </div>

                    {{-- Live Search Filter Box (berlaku untuk Imam & Muazin sekaligus) --}}
                    <div class="bg-blue-50/70 p-3 rounded-lg border border-blue-100">
                        <label class="block text-xs font-semibold text-blue-800 mb-1">
                            <i class="fas fa-search text-blue-500 mr-1"></i> Cari Nama Imam / Muazin:
                        </label>
                        <input type="text" id="search-imam-global" placeholder="Ketik nama petugas untuk menyaring pilihan..."
                               class="w-full text-xs border border-blue-200 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imam (urutan cadangan)</label>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">1. Utama:</span>
                                <select name="imam_ids[]" id="select-imam-1" class="select-imam-list block w-full border-gray-300 rounded-md text-sm" required>
                                    <option value="">-- Pilih Imam Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">2. Cadangan 1:</span>
                                <select name="imam_ids[]" id="select-imam-2" class="select-imam-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan 1 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">3. Cadangan 2:</span>
                                <select name="imam_ids[]" id="select-imam-3" class="select-imam-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan 2 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Muazin (urutan cadangan)</label>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">1. Utama:</span>
                                <select name="muazin_ids[]" id="select-muazin-1" class="select-imam-list block w-full border-gray-300 rounded-md text-sm" required>
                                    <option value="">-- Pilih Muazin Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">2. Cadangan 1:</span>
                                <select name="muazin_ids[]" id="select-muazin-2" class="select-imam-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan 1 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">3. Cadangan 2:</span>
                                <select name="muazin_ids[]" id="select-muazin-3" class="select-imam-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan 2 (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('jadwal-imam-muazin.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
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
    </script>
</x-app-layout>