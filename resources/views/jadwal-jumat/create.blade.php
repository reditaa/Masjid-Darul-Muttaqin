<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Khotib & Imam Jumat
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
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Khatib (urutan cadangan)</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 text-sm text-gray-500">1.</span>
                                <select name="khatib_ids[]" class="block w-full border-gray-300 rounded-md" required>
                                    <option value="">-- Khatib Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-6 text-sm text-gray-500">2.</span>
                                <select name="khatib_ids[]" class="block w-full border-gray-300 rounded-md">
                                    <option value="">-- Cadangan (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imam (urutan cadangan)</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 text-sm text-gray-500">1.</span>
                                <select name="imam_ids[]" class="block w-full border-gray-300 rounded-md" required>
                                    <option value="">-- Imam Utama --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-6 text-sm text-gray-500">2.</span>
                                <select name="imam_ids[]" class="block w-full border-gray-300 rounded-md">
                                    <option value="">-- Cadangan (opsional) --</option>
                                    @foreach ($pengurus as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
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
</x-app-layout>