<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Anggota - SIMADI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-green-800 text-white px-4 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-3">
            <i class="fas fa-mosque text-2xl"></i>
            <div>
                <p class="font-bold">SIMADI</p>
                <p class="text-xs text-green-200">{{ $pengurus->nama ?? Auth::user()->name }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-semibold">
                <i class="fas fa-right-from-bracket mr-1"></i> Logout
            </button>
        </form>
    </nav>

    <div class="max-w-3xl mx-auto p-4 space-y-6">

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-xl shadow-sm">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-100 text-red-800 rounded-xl shadow-sm">{{ session('error') }}</div>
        @endif

        @if (! $pengurus)
            <div class="p-4 bg-yellow-100 text-yellow-800 rounded-xl shadow-sm">
                Akun Anda belum terhubung ke data Pengurus. Hubungi admin.
            </div>
        @endif

        @if (! empty($tugasHariIni))
            <div class="p-4 bg-blue-600 text-white rounded-xl shadow">
                <p class="font-bold flex items-center gap-2">
                    <i class="fas fa-bell"></i> Anda ada tugas hari ini!
                </p>
                <ul class="mt-2 space-y-1 text-sm">
                    @foreach ($tugasHariIni as $tugas)
                        <li><i class="fas fa-check-circle mr-1"></i> {{ $tugas }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

               {{-- Jadwal Kegiatan Masjid --}}
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                <h2 class="font-bold text-lg">Jadwal Kegiatan Masjid</h2>
                <div class="flex items-center gap-3 text-xs text-gray-500">
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-green-500"></span> Hari ini</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Tugas saya</span>
                </div>
            </div>

            <div class="space-y-6">

                {{-- Imam & Muazin --}}
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Imam & Muazin</p>
                    <div class="space-y-2">
                        @forelse ($jadwalImam as $j)
                            <div class="flex justify-between items-center gap-3 border rounded-lg p-3 transition
                                {{ $j->hari_ini ? 'border-green-400 bg-green-50' : 'border-gray-200' }}">
                                <div>
                                    <p class="font-medium capitalize flex items-center gap-2 flex-wrap">
                                        {{ $j->hari }} - {{ ucfirst($j->waktu_sholat) }}
                                        @if ($j->hari_ini)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-600 text-white">HARI INI</span>
                                        @endif
                                        @if ($j->milik_saya)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-600 text-white">TUGAS SAYA</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Imam: {{ $j->imam->pluck('nama')->join(', ') ?: '-' }}
                                        &middot; Muazin: {{ $j->muazin->pluck('nama')->join(', ') ?: '-' }}
                                    </p>
                                </div>
                                @if ($j->milik_saya)
                                    <button type="button" class="btn-presensi px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition flex-shrink-0"
                                        data-type="{{ \App\Models\JadwalImamMuazin::class }}" data-id="{{ $j->id }}"
                                        data-label="{{ ucfirst($j->hari) }} - {{ ucfirst($j->waktu_sholat) }}">
                                        Presensi
                                    </button>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm">Belum ada jadwal.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Jumat --}}
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Jumat (Khatib & Imam)</p>
                    <div class="space-y-2">
                        @forelse ($jadwalJumat as $jj)
                            <div class="flex justify-between items-center gap-3 border rounded-lg p-3 transition
                                {{ $jj->hari_ini ? 'border-green-400 bg-green-50' : 'border-gray-200' }}">
                                <div>
                                    <p class="font-medium flex items-center gap-2 flex-wrap">
                                        Pasaran {{ ucfirst($jj->pasaran) }}
                                        @if ($jj->hari_ini)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-600 text-white">HARI INI</span>
                                        @endif
                                        @if ($jj->milik_saya)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-600 text-white">TUGAS SAYA</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Khatib: {{ $jj->khatib->pluck('nama')->join(', ') ?: '-' }}
                                        &middot; Imam: {{ $jj->imam->pluck('nama')->join(', ') ?: '-' }}
                                    </p>
                                </div>
                                @if ($jj->milik_saya)
                                    <button type="button" class="btn-presensi px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition flex-shrink-0"
                                        data-type="{{ \App\Models\JadwalJumat::class }}" data-id="{{ $jj->id }}"
                                        data-label="Jumat Pasaran {{ ucfirst($jj->pasaran) }}">
                                        Presensi
                                    </button>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm">Belum ada jadwal.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Bilal --}}
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Bilal</p>
                    <div class="space-y-2">
                        @forelse ($jadwalBilal as $jb)
                            <div class="flex justify-between items-center gap-3 border rounded-lg p-3 transition
                                {{ $jb->hari_ini ? 'border-green-400 bg-green-50' : 'border-gray-200' }}">
                                <div>
                                    <p class="font-medium flex items-center gap-2 flex-wrap">
                                        Pasaran {{ ucfirst($jb->pasaran) }}
                                        @if ($jb->hari_ini)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-600 text-white">HARI INI</span>
                                        @endif
                                        @if ($jb->milik_saya)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-600 text-white">TUGAS SAYA</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $jb->anggota->pluck('nama')->join(', ') ?: 'Belum ada petugas' }}
                                    </p>
                                </div>
                                @if ($jb->milik_saya)
                                    <button type="button" class="btn-presensi px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition flex-shrink-0"
                                        data-type="{{ \App\Models\JadwalBilal::class }}" data-id="{{ $jb->id }}"
                                        data-label="Pasaran {{ ucfirst($jb->pasaran) }}">
                                        Presensi
                                    </button>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm">Belum ada jadwal.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Piket Kebersihan --}}
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Piket Kebersihan</p>
                    <div class="space-y-2">
                        @forelse ($jadwalPiket as $jp)
                            <div class="flex justify-between items-center gap-3 border rounded-lg p-3 transition
                                {{ $jp->hari_ini ? 'border-green-400 bg-green-50' : 'border-gray-200' }}">
                                <div>
                                    <p class="font-medium capitalize flex items-center gap-2 flex-wrap">
                                        {{ $jp->hari }}
                                        @if ($jp->hari_ini)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-600 text-white">HARI INI</span>
                                        @endif
                                        @if ($jp->milik_saya)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-600 text-white">TUGAS SAYA</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $jp->anggota->pluck('nama')->join(', ') ?: 'Belum ada petugas' }}
                                    </p>
                                </div>
                                @if ($jp->milik_saya)
                                    <button type="button" class="btn-presensi px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition flex-shrink-0"
                                        data-type="{{ \App\Models\JadwalPiketKebersihan::class }}" data-id="{{ $jp->id }}"
                                        data-label="Piket {{ ucfirst($jp->hari) }}">
                                        Presensi
                                    </button>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm">Belum ada jadwal.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
                
            </div>
        </div>

        {{-- Form Presensi (muncul setelah pilih jadwal) --}}
        <div id="form-presensi" class="bg-white rounded-xl shadow p-5 hidden">
            <h2 class="font-bold text-lg mb-1">Presensi: <span id="label-jadwal" class="text-blue-600"></span></h2>
            <p class="text-xs text-gray-500 mb-3">{{ now()->translatedFormat('d F Y') }}</p>

            <form action="{{ route('anggota.presensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="presentable_type" id="presentable_type">
                <input type="hidden" name="presentable_id" id="presentable_id">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti (wajib)</label>

                    {{-- Switch Tab --}}
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <button type="button" id="tab-cam" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-green-600 text-white shadow-sm transition">
                            <i class="fas fa-video mr-1"></i> Kamera Laptop / PC
                        </button>
                        <button type="button" id="tab-mobile-cam" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white shadow-sm transition">
                            <i class="fas fa-camera mr-1"></i> Kamera HP Direct
                        </button>
                        <button type="button" id="tab-file" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                            <i class="fas fa-upload mr-1"></i> Galeri / File
                        </button>
                    </div>

                    {{-- Native Mobile Camera Capture --}}
                    <input type="file" id="input-file-mobile" accept="image/*" capture="environment" class="hidden">

                    {{-- Camera Area --}}
                    <div id="camera-area">
                        <div class="relative bg-gray-900 rounded-lg overflow-hidden min-h-[240px] flex items-center justify-center border shadow-inner">
                            <video id="camera-video" class="w-full h-full min-h-[240px] rounded-md bg-black object-cover hidden" autoplay playsinline muted></video>

                            {{-- User Gesture Prompt Overlay --}}
                            <div id="cam-start-prompt" class="absolute inset-0 bg-gradient-to-b from-gray-900 to-black text-white flex flex-col items-center justify-center p-6 text-center cursor-pointer hover:bg-black/95 transition">
                                <div class="w-14 h-14 rounded-full bg-green-600/30 text-green-400 border border-green-500/40 flex items-center justify-center mb-3 shadow-lg">
                                    <i class="fas fa-video text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-base text-white">Klik di sini untuk Mengaktifkan Kamera</h4>
                                <p class="text-xs text-gray-300 mt-1 max-w-xs">Klik kotak ini agar browser mengizinkan dan menampilkan video WebCam Anda</p>
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
                                <button type="button" id="btn-ambil-foto" class="flex-1 sm:flex-none px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-xs shadow transition flex items-center justify-center gap-2">
                                    <i class="fas fa-camera"></i> Ambil Foto Laptop
                                </button>
                                <button type="button" id="btn-retry-cam" title="Hubungkan Ulang" class="px-3.5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-xs transition font-semibold">
                                    <i class="fas fa-sync-alt"></i> Reload
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- File Area --}}
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
                        <button type="button" id="btn-ulangi" class="mt-2 w-full px-4 py-2 bg-gray-200 text-gray-700 font-semibold text-xs rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-rotate mr-1"></i> Ambil / Pilih Ulang Foto
                        </button>
                    </div>

                    <canvas id="camera-canvas" class="hidden"></canvas>
                    <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden" required>

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
                    <textarea name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>

                <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow">
                    Kirim Presensi
                </button>
            </form>
        </div>

        {{-- Pengumuman --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="font-bold text-lg mb-3">Pengumuman Terbaru</h2>
            @forelse ($pengumuman as $p)
                <div class="border-b py-2 last:border-0">
                    <p class="font-medium text-sm">{{ $p->judul }}</p>
                    <p class="text-xs text-gray-500">{{ $p->tanggal_publish->translatedFormat('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Belum ada pengumuman.</p>
            @endforelse
        </div>

        {{-- Kegiatan --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="font-bold text-lg mb-3">Kegiatan Mendatang</h2>
            @forelse ($kegiatan as $k)
                <div class="border-b py-2 last:border-0">
                    <p class="font-medium text-sm">{{ $k->judul }}</p>
                    <p class="text-xs text-gray-500">{{ $k->tanggal_mulai->translatedFormat('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Belum ada kegiatan mendatang.</p>
            @endforelse
        </div>

    </div>

    <script>
        document.querySelectorAll('.btn-presensi').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('presentable_type').value = this.dataset.type;
                document.getElementById('presentable_id').value = this.dataset.id;
                document.getElementById('label-jadwal').textContent = this.dataset.label;
                document.getElementById('form-presensi').classList.remove('hidden');
                document.getElementById('form-presensi').scrollIntoView({ behavior: 'smooth' });
                camStartPrompt.classList.remove('hidden');
                video.classList.add('hidden');
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

</body>
</html>