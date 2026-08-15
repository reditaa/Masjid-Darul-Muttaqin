<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Jadwal Bilal
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

                @php
                    $anggotaTerpilih = old('anggota_ids', $jadwal->anggota->pluck('id')->toArray());
                @endphp

                <form action="{{ route('jadwal-bilal.update', $jadwal) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pasaran</label>
                        <select name="pasaran" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="legi" {{ old('pasaran', $jadwal->pasaran) == 'legi' ? 'selected' : '' }}>Legi</option>
                            <option value="pahing" {{ old('pasaran', $jadwal->pasaran) == 'pahing' ? 'selected' : '' }}>Pahing</option>
                            <option value="pon" {{ old('pasaran', $jadwal->pasaran) == 'pon' ? 'selected' : '' }}>Pon</option>
                            <option value="wage" {{ old('pasaran', $jadwal->pasaran) == 'wage' ? 'selected' : '' }}>Wage</option>
                            <option value="kliwon" {{ old('pasaran', $jadwal->pasaran) == 'kliwon' ? 'selected' : '' }}>Kliwon</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Petugas Bilal</label>
                        <div class="grid grid-cols-2 gap-2 border rounded-md p-3 max-h-64 overflow-y-auto">
                            @foreach ($pengurus as $p)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="anggota_ids[]" value="{{ $p->id }}"
                                        {{ in_array($p->id, $anggotaTerpilih) ? 'checked' : '' }}>
                                    <span>{{ $p->nama }}</span>
                                    @if ($p->asal === 'guru')
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-blue-100 text-blue-700">Guru</span>
                                    @elseif ($p->asal === 'siswa')
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-700">Siswa</span>
                                    @elseif ($p->jabatan)
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-purple-100 text-purple-700">{{ $p->jabatan->nama_jabatan }}</span>
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
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>