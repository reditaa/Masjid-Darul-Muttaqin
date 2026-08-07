<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Jadwal Imam & Muazin
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

                <form action="{{ route('jadwal-imam-muazin.update', $jadwal) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hari</label>
                            <select name="hari" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="senin" {{ old('hari', $jadwal->hari) == 'senin' ? 'selected' : '' }}>Senin</option>
                                <option value="selasa" {{ old('hari', $jadwal->hari) == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="rabu" {{ old('hari', $jadwal->hari) == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="kamis" {{ old('hari', $jadwal->hari) == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="jumat" {{ old('hari', $jadwal->hari) == 'jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="sabtu" {{ old('hari', $jadwal->hari) == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                                <option value="minggu" {{ old('hari', $jadwal->hari) == 'minggu' ? 'selected' : '' }}>Minggu</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu Sholat</label>
                            <select name="waktu_sholat" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="subuh" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'subuh' ? 'selected' : '' }}>Subuh</option>
                                <option value="dzuhur" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                                <option value="ashar" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'ashar' ? 'selected' : '' }}>Ashar</option>
                                <option value="maghrib" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'maghrib' ? 'selected' : '' }}>Maghrib</option>
                                <option value="isya" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'isya' ? 'selected' : '' }}>Isya</option>
                                <option value="jumat" {{ old('waktu_sholat', $jadwal->waktu_sholat) == 'jumat' ? 'selected' : '' }}>Jumat (Sholat Jumat)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imam</label>
                        <select name="imam_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @foreach ($pengurus as $p)
                                <option value="{{ $p->id }}" {{ old('imam_id', $jadwal->imam_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Khatib (khusus Jumat, opsional)</label>
                        <select name="khatib_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">-- Tidak ada / bukan Jumat --</option>
                            @foreach ($pengurus as $p)
                                <option value="{{ $p->id }}" {{ old('khatib_id', $jadwal->khatib_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Muazin (opsional)</label>
                        <select name="muazin_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($pengurus as $p)
                                <option value="{{ $p->id }}" {{ old('muazin_id', $jadwal->muazin_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('jadwal-imam-muazin.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>