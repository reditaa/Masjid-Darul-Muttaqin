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
                                    (Imam: {{ $j->imam->pluck('nama')->join(', ') ?: '-' }})
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

                        {{-- Mode Switcher Tabs --}}
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <button type="button" id="tab-cam" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-green-600 text-white shadow-sm transition">
                                <i class="fas fa-video mr-1"></i> Kamera Laptop / PC
                            </button>
                            <button type="button" id="tab-mobile-cam" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white shadow-sm transition">
                                <i class="fas fa-camera mr-1"></i> Kamera HP Direct
                            </button>
                            <button type="button" id="tab-file" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                <i class="fas fa-upload mr-1"></i> Unggah File Foto
                            </button>
                        </div>

                        {{-- Native Mobile Camera Capture --}}
                        <input type="file" id="input-file-mobile" accept="image/*" capture="environment" class="hidden">

                        {{-- Camera Area (WebRTC Live Stream) --}}
                        <div id="camera-area">
                            <div class="relative bg-gray-900 rounded-lg overflow-hidden min-h-[240px] flex items-center justify-center border shadow-inner">
                                <video id="camera-video" class="w-full h-full min-h-[240px] rounded-md bg-black object-cover hidden" autoplay playsinline muted></video>

                                {{-- User Gesture Trigger Prompt Overlay --}}
                                <div id="cam-start-prompt" class="absolute inset-0 bg-gradient-to-b from-gray-900 to-black text-white flex flex-col items-center justify-center p-6 text-center cursor-pointer hover:bg-black/95 transition">
                                    <div class="w-14 h-14 rounded-full bg-green-600/30 text-green-400 border border-green-500/40 flex items-center justify-center mb-3 shadow-lg">
                                        <i class="fas fa-video text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-base text-white">Klik di sini untuk Mengaktifkan Kamera</h4>
                                    <p class="text-xs text-gray-300 mt-1 max-w-xs">Klik kotak ini agar browser laptop mengizinkan dan menampilkan video WebCam Anda</p>
                                </div>

                                {{-- Loading Overlay --}}
                                <div id="cam-loading" class="absolute inset-0 bg-black/80 text-white flex flex-col items-center justify-center text-xs hidden">
                                    <i class="fas fa-spinner fa-spin text-3xl mb-2 text-green-400"></i>
                                    <span class="font-semibold text-sm">Menghubungkan WebCam Laptop...</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-2 mt-3">
                                <select id="cam-device-select" class="text-xs border-gray-300 rounded-lg py-2 px-3 bg-white w-full sm:w-auto flex-1 hidden focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Kamera / WebCam --</option>
                                </select>

                                <div class="flex items-center gap-2 w-full sm:w-auto">
                                    <button type="button" id="btn-ambil-foto"
                                            class="flex-1 sm:flex-none px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-xs shadow transition flex items-center justify-center gap-2">
                                        <i class="fas fa-camera"></i> Ambil Foto Laptop
                                    </button>
                                    <button type="button" id="btn-retry-cam" title="Hubungkan Ulang"
                                            class="px-3.5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-xs transition font-semibold">
                                        <i class="fas fa-sync-alt"></i> Reload
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- File Upload Area --}}
                        <div id="file-area" class="hidden border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
                            <input type="file" id="input-file-direct" accept="image/*" class="hidden">
                            <div onclick="document.getElementById('input-file-direct').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-xs font-semibold text-gray-700">Klik untuk memilih foto dari Laptop / HP</p>
                                <p class="text-[11px] text-gray-400 mt-1">Format: JPG, PNG, WEBP</p>
                            </div>
                        </div>

                        {{-- Preview Area --}}
                        <div id="preview-area" class="hidden">
                            <img id="preview-foto" class="w-full rounded-md border shadow-sm max-h-72 object-cover">
                            <button type="button" id="btn-ulangi"
                                    class="mt-2 w-full px-4 py-2 bg-gray-200 text-gray-700 font-semibold text-xs rounded-lg hover:bg-gray-300 transition">
                                <i class="fas fa-rotate mr-1"></i> Ambil / Pilih Ulang Foto
                            </button>
                        </div>

                        <canvas id="camera-canvas" class="hidden"></canvas>
                        <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden" required>

                        {{-- Friendly Error Box --}}
                        <div id="camera-error" class="text-xs text-amber-800 bg-amber-50 border border-amber-200 p-3.5 rounded-lg mt-2 hidden flex items-start gap-2.5">
                            <i class="fas fa-exclamation-circle text-amber-600 text-base mt-0.5 flex-shrink-0"></i>
                            <div>
                                <p class="font-bold">Izin Kamera Ditolak / WebCam Tidak Ditemukan</p>
                                <p class="text-[11px] mt-1 leading-relaxed">
                                    - Klik ikon gembok/kamera pada address bar browser (sebelah kiri URL <code>127.0.0.1</code>) lalu ubah Camera menjadi <strong>"Allow"</strong>.<br>
                                    - Atau silakan klik tab <strong>"Unggah File Foto"</strong> di atas untuk langsung memilih file foto dari laptop Anda.
                                </p>
                            </div>
                        </div>
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
        const btnRetryCam = document.getElementById('btn-retry-cam');
        const camStartPrompt = document.getElementById('cam-start-prompt');
        const camDeviceSelect = document.getElementById('cam-device-select');
        const cameraArea = document.getElementById('camera-area');
        const fileArea = document.getElementById('file-area');
        const previewArea = document.getElementById('preview-area');
        const previewImg = document.getElementById('preview-foto');
        const inputFoto = document.getElementById('input-foto');
        const inputFileDirect = document.getElementById('input-file-direct');
        const inputFileMobile = document.getElementById('input-file-mobile');
        const cameraError = document.getElementById('camera-error');
        const camLoading = document.getElementById('cam-loading');

        const tabCam = document.getElementById('tab-cam');
        const tabMobileCam = document.getElementById('tab-mobile-cam');
        const tabFile = document.getElementById('tab-file');

        let currentStream = null;

        async function startCameraExplicit() {
            camStartPrompt.classList.add('hidden');
            camLoading.classList.remove('hidden');
            cameraError.classList.add('hidden');

            if (currentStream) {
                currentStream.getTracks().forEach(t => t.stop());
                currentStream = null;
            }

            // Populate devices
            if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
                try {
                    const devices = await navigator.mediaDevices.enumerateDevices();
                    const videoDevices = devices.filter(d => d.kind === 'videoinput');
                    if (videoDevices.length > 0 && camDeviceSelect.options.length <= 1) {
                        camDeviceSelect.innerHTML = '<option value="">-- Pilih Kamera --</option>';
                        videoDevices.forEach((dev, idx) => {
                            const opt = document.createElement('option');
                            opt.value = dev.deviceId;
                            opt.text = dev.label || `Kamera ${idx + 1}`;
                            camDeviceSelect.appendChild(opt);
                        });
                        if (videoDevices.length > 1) {
                            camDeviceSelect.classList.remove('hidden');
                        }
                    }
                } catch (e) {
                    console.warn('Enumerate devices error:', e);
                }
            }

            let selectedDeviceId = camDeviceSelect.value;
            let constraintsList = [];

            if (selectedDeviceId) {
                constraintsList.push({ video: { deviceId: { exact: selectedDeviceId } } });
            }
            constraintsList.push({ video: true });
            constraintsList.push({ video: { facingMode: 'user' } });
            constraintsList.push({ video: { facingMode: 'environment' } });

            let success = false;
            for (let constraint of constraintsList) {
                try {
                    currentStream = await navigator.mediaDevices.getUserMedia(constraint);
                    if (currentStream) {
                        video.srcObject = currentStream;
                        video.classList.remove('hidden');
                        try {
                            await video.play();
                        } catch(pErr) {
                            console.warn('Video play error:', pErr);
                        }
                        cameraError.classList.add('hidden');
                        camLoading.classList.add('hidden');
                        success = true;
                        break;
                    }
                } catch (err) {
                    console.warn('Camera constraint error:', constraint, err);
                }
            }

            if (!success) {
                camLoading.classList.add('hidden');
                camStartPrompt.classList.remove('hidden');
                cameraError.classList.remove('hidden');
            }
        }

        camStartPrompt.addEventListener('click', startCameraExplicit);
        btnRetryCam.addEventListener('click', startCameraExplicit);
        camDeviceSelect.addEventListener('change', startCameraExplicit);

        tabCam.addEventListener('click', function() {
            tabCam.className = "px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-green-600 text-white shadow-sm transition";
            tabMobileCam.className = "px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white shadow-sm transition";
            tabFile.className = "px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition";
            cameraArea.classList.remove('hidden');
            fileArea.classList.add('hidden');
            previewArea.classList.add('hidden');
            startCameraExplicit();
        });

        tabMobileCam.addEventListener('click', function() {
            inputFileMobile.click();
        });

        tabFile.addEventListener('click', function() {
            tabFile.className = "px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-green-600 text-white shadow-sm transition";
            tabCam.className = "px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition";
            fileArea.classList.remove('hidden');
            cameraArea.classList.add('hidden');
            if (currentStream) {
                currentStream.getTracks().forEach(t => t.stop());
            }
        });

        function handleFileSelected(file) {
            if (!file) return;
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            inputFoto.files = dataTransfer.files;

            previewImg.src = URL.createObjectURL(file);
            fileArea.classList.add('hidden');
            cameraArea.classList.add('hidden');
            previewArea.classList.remove('hidden');

            if (currentStream) {
                currentStream.getTracks().forEach(t => t.stop());
            }
        }

        inputFileDirect.addEventListener('change', (e) => handleFileSelected(e.target.files[0]));
        inputFileMobile.addEventListener('change', (e) => handleFileSelected(e.target.files[0]));

        btnAmbil.addEventListener('click', function () {
            if (!video.videoWidth || video.paused || video.ended || video.classList.contains('hidden')) {
                // If video is not active, trigger file picker directly
                inputFileDirect.click();
                return;
            }

            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;
            canvas.getContext('2d').drawImage(video, 0, 0);

            canvas.toBlob(function (blob) {
                if (!blob) {
                    inputFileDirect.click();
                    return;
                }
                const file = new File([blob], 'presensi-' + Date.now() + '.jpg', { type: 'image/jpeg' });
                handleFileSelected(file);
            }, 'image/jpeg', 0.9);
        });

        btnUlangi.addEventListener('click', function () {
            previewArea.classList.add('hidden');
            inputFoto.value = '';
            inputFileDirect.value = '';
            inputFileMobile.value = '';

            if (!fileArea.classList.contains('hidden')) {
                fileArea.classList.remove('hidden');
            } else {
                cameraArea.classList.remove('hidden');
                camStartPrompt.classList.remove('hidden');
                video.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>