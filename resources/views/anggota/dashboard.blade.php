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
            <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-right-from-bracket mr-1"></i> Logout
            </button>
        </form>
    </nav>

    <div class="max-w-3xl mx-auto p-4 space-y-6">

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        @if (! $pengurus)
            <div class="p-4 bg-yellow-100 text-yellow-800 rounded">
                Akun Anda belum terhubung ke data Pengurus. Hubungi admin.
            </div>
        @endif

        {{-- Jadwal Tugas --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="font-bold text-lg mb-3">Jadwal Tugas Saya</h2>

            <div class="space-y-2">
                @forelse ($jadwalImam as $j)
                    <div class="flex justify-between items-center border rounded-lg p-3">
                        <div>
                            <p class="font-medium capitalize">{{ $j->hari }} - {{ ucfirst($j->waktu_sholat) }}</p>
                            <p class="text-xs text-gray-500">Imam & Muazin</p>
                        </div>
                        <button type="button" class="btn-presensi px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm"
                            data-type="{{ \App\Models\JadwalImamMuazin::class }}" data-id="{{ $j->id }}"
                            data-label="{{ ucfirst($j->hari) }} - {{ ucfirst($j->waktu_sholat) }}">
                            Presensi
                        </button>
                    </div>
                @empty
                @endforelse

                @foreach ($jadwalBilal as $jb)
                    <div class="flex justify-between items-center border rounded-lg p-3">
                        <div>
                            <p class="font-medium">Pasaran {{ ucfirst($jb->jadwalBilal->pasaran) }}</p>
                            <p class="text-xs text-gray-500">Bilal</p>
                        </div>
                        <button type="button" class="btn-presensi px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm"
                            data-type="{{ \App\Models\JadwalBilal::class }}" data-id="{{ $jb->jadwal_bilal_id }}"
                            data-label="Pasaran {{ ucfirst($jb->jadwalBilal->pasaran) }}">
                            Presensi
                        </button>
                    </div>
                @endforeach

                @foreach ($jadwalPiket as $jp)
                    <div class="flex justify-between items-center border rounded-lg p-3">
                        <div>
                            <p class="font-medium capitalize">{{ $jp->jadwalPiket->hari }}</p>
                            <p class="text-xs text-gray-500">Piket Kebersihan</p>
                        </div>
                        <button type="button" class="btn-presensi px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm"
                            data-type="{{ \App\Models\JadwalPiketKebersihan::class }}" data-id="{{ $jp->jadwal_piket_kebersihan_id }}"
                            data-label="Piket {{ ucfirst($jp->jadwalPiket->hari) }}">
                            Presensi
                        </button>
                    </div>
                @endforeach

                @if ($jadwalImam->isEmpty() && $jadwalBilal->isEmpty() && $jadwalPiket->isEmpty())
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada jadwal tugas untuk Anda.</p>
                @endif
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti</label>
                    <div id="camera-area">
                        <video id="camera-video" class="w-full rounded-md bg-black" autoplay playsinline muted></video>
                        <button type="button" id="btn-ambil-foto" class="mt-2 w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            <i class="fas fa-camera mr-1"></i> Ambil Foto
                        </button>
                    </div>
                    <div id="preview-area" class="hidden">
                        <img id="preview-foto" class="w-full rounded-md">
                        <button type="button" id="btn-ulangi" class="mt-2 w-full px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                            <i class="fas fa-rotate mr-1"></i> Ambil Ulang
                        </button>
                    </div>
                    <canvas id="camera-canvas" class="hidden"></canvas>
                    <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden" required>
                    <p id="camera-error" class="text-xs text-red-500 mt-2 hidden">Kamera tidak dapat diakses.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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
                currentStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
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
                if (currentStream) currentStream.getTracks().forEach(t => t.stop());
            }, 'image/jpeg', 0.9);
        });

        btnUlangi.addEventListener('click', function () {
            previewArea.classList.add('hidden');
            cameraArea.classList.remove('hidden');
            inputFoto.value = '';
            startCamera();
        });
    </script>

</body>
</html>