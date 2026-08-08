<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catat Presensi
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

                <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Tugas</label>
                        <select name="jenis" id="jenis" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="imam_muazin" {{ old('jenis') == 'imam_muazin' ? 'selected' : '' }}>Imam & Muazin</option>
                            <option value="bilal" {{ old('jenis') == 'bilal' ? 'selected' : '' }}>Bilal</option>
                            <option value="piket" {{ old('jenis') == 'piket' ? 'selected' : '' }}>Piket Kebersihan</option>
                            <option value="kegiatan" {{ old('jenis') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        </select>
                    </div>

                    <div id="wrapper-imam_muazin" class="jadwal-wrapper hidden">
                        <label class="block text-sm font-medium text-gray-700">Pilih Jadwal Imam & Muazin</label>
                        <select class="jadwal-select mt-1 block w-full border-gray-300 rounded-md" data-jenis="imam_muazin">
                            <option value="">-- Pilih --</option>
                            @foreach ($jadwalImamMuazin as $j)
                                <option value="{{ $j->id }}">
                                    {{ ucfirst($j->hari) }} - {{ ucfirst($j->waktu_sholat) }}
                                    (Imam: {{ $j->imam->nama ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="wrapper-bilal" class="jadwal-wrapper hidden">
                        <label class="block text-sm font-medium text-gray-700">Pilih Jadwal Bilal</label>
                        <select class="jadwal-select mt-1 block w-full border-gray-300 rounded-md" data-jenis="bilal">
                            <option value="">-- Pilih --</option>
                            @foreach ($jadwalBilal as $j)
                                <option value="{{ $j->id }}">Pasaran {{ ucfirst($j->pasaran) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="wrapper-piket" class="jadwal-wrapper hidden">
                        <label class="block text-sm font-medium text-gray-700">Pilih Jadwal Piket</label>
                        <select class="jadwal-select mt-1 block w-full border-gray-300 rounded-md" data-jenis="piket">
                            <option value="">-- Pilih --</option>
                            @foreach ($jadwalPiket as $j)
                                <option value="{{ $j->id }}">{{ ucfirst($j->hari) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="wrapper-kegiatan" class="jadwal-wrapper hidden">
                        <label class="block text-sm font-medium text-gray-700">Pilih Kegiatan</label>
                        <select class="jadwal-select mt-1 block w-full border-gray-300 rounded-md" data-jenis="kegiatan">
                            <option value="">-- Pilih --</option>
                            @foreach ($kegiatan as $j)
                                <option value="{{ $j->id }}">{{ $j->judul }} ({{ $j->tanggal_mulai->format('d M Y') }})</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="presentable_id" id="presentable_id" value="{{ old('presentable_id') }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Petugas</label>
                        <select name="pengurus_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach ($pengurus as $p)
                                <option value="{{ $p->id }}" {{ old('pengurus_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="hadir" {{ old('status', 'hadir') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="tidak_hadir" {{ old('status') == 'tidak_hadir' ?