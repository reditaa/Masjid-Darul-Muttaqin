<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Jumat
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

                <form action="{{ route('jadwal-jumat.store') }}" method="POST" class="space-y-4">
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
                        <p class="text-xs text-gray-400 mt-1">
                            Tiap pasaran cuma bisa punya 1 jadwal (berputar tiap 5 minggu).
                        </p>
                    </div>

                    {{-- Live Search Filter Box --}}
                    <div class="bg-blue-50/70 p-3 rounded-lg border border-blue-100">
                        <label class="block text-xs font-semibold text-blue-800 mb-1">
                            <i class="fas fa-search text-blue-500 mr-1"></i> Cari Nama Petugas:
                        </label>
                        <input type="text" id="search-petugas-global" placeholder="Ketik nama petugas untuk menyaring pilihan..."
                               class="w-full text-xs border border-blue-200 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Khatib (urutan cadangan)</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">1. Utama:</span>
                                <select name="khatib_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm" required>
                                    <option value="">-- Pilih Khatib Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">2. Cadangan:</span>
                                <select name="khatib_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan (opsional) --</option>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imam (urutan cadangan)</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">1. Utama:</span>
                                <select name="imam_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm" required>
                                    <option value="">-- Pilih Imam Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">2. Cadangan:</span>
                                <select name="imam_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan (opsional) --</option>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bilal (urutan cadangan)</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">1. Utama:</span>
                                <select name="bilal_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm" required>
                                    <option value="">-- Pilih Bilal Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}" data-nama="{{ strtolower($p->nama) }}">
                                            {{ $p->nama }} {{ $p->asal ? '('.ucfirst($p->asal).')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-24 text-xs font-semibold text-gray-600">2. Cadangan:</span>
                                <select name="bilal_ids[]" class="select-petugas-list block w-full border-gray-300 rounded-md text-sm">
                                    <option value="">-- Cadangan (opsional) --</option>
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
                        <a href="{{ route('jadwal-jumat.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-petugas-global').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const selects = document.querySelectorAll('.select-petugas-list');
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