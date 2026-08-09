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
                                <option value="tidak_hadir" {{ old('status') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="diganti" {{ old('status') == 'diganti' ? 'selected' : '' }}>Diganti</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti Kehadiran (wajib)</label>

                        <div id="camera-area">
                            <video id="camera-video" class="w-full rounded-md bg-black" autoplay playsinline muted></video>
                            <button type="button" id="btn-ambil-foto"
                                    class="mt-2 w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                <i class="fas fa-camera mr-1"></i> Ambil Foto
                            </button>
                        </div>

                        <div id="preview-area" class="hidden">
                            <img id="preview-foto" class="w-full rounded-md">
                            <button type="button" id="btn-ulangi"
                                    class="mt-2 w-full px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                <i class="fas fa-rotate mr-1"></i> Ambil Ulang
                            </button>
                        </div>

                        <canvas id="camera-canvas" class="hidden"></canvas>

                        <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden" required>

                        <p id="camera-error" class="text-xs text-red-500 mt-2 hidden">
                            Kamera tidak dapat diakses. Pastikan browser sudah diberi izin kamera.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('presensi.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('jenis').addEventListener('change', function () {
            document.querySelectorAll('.jadwal-wrapper').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.jadwal-select').forEach(el => el.removeAttribute('required'));
            document.getElementById('presentable_id').value = '';

            if (this.value) {
                const wrapper = document.getElementById('wrapper-' + this.value);
                wrapper.classList.remove('hidden');
                wrapper.querySelector('.jadwal-select').setAttribute('required', 'required');
            }
        });

        document.querySelectorAll('.jadwal-select').forEach(select => {
            select.addEventListener('change', function () {
                document.getElementById('presentable_id').value = this.value;
            });
        });

        const video = document.getElementById('camera-video');
        const canvas = document.getElementById('camera-canvas');
        const btnAmbil = document.getElementById('btn-ambil-foto');
        const btnUlangi = document.getElementById('btn-ulangi');
        const cameraArea = document.getElementById('camera-area');
        const previewArea = document.getElementById('preview-area');
        const previewImg = document.getElementById('preview-foto');
        const inputFoto = document.getElementById('input-foto');
        const cameraError = document.getElementById('camera-error');

        let currentStream = null;

        async function startCamera() {
            try {
                currentStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'environment' }
                });
                video.srcObject = currentStream;
                cameraError.classList.add('hidden');
            } catch (err) {
                cameraError.classList.remove('hidden');
            }
        }

        startCamera();

        btnAmbil.addEventListener('click', function () {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            canvas.toBlob(function (blob) {
                const file = new File([blob], 'presensi-' + Date.now() + '.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFoto.files = dataTransfer.files;

                previewImg.src = URL.createObjectURL(blob);
                cameraArea.classList.add('hidden');
                previewArea.classList.remove('hidden');

                if (currentStream) {
                    currentStream.getTracks().forEach(track => track.stop());
                }
            }, 'image/jpeg', 0.9);
        });

        btnUlangi.addEventListener('click', function () {
            previewArea.classList.add('hidden');
            cameraArea.classList.remove('hidden');
            inputFoto.value = '';
            startCamera();
        });
    </script>
</x-app-layout>