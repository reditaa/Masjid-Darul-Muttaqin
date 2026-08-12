<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal Piket Kebersihan
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

                <form action="{{ route('jadwal-piket-kebersihan.store') }}" method="POST" id="form-piket" class="space-y-4">
                    @csrf

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
                        <label class="block text-sm font-medium text-gray-700">Cari Petugas (Data Sekolah - SiPintu)</label>
                        <div class="relative">
                            <input type="text" id="cari-sipintu" placeholder="Ketik minimal 3 huruf nama..."
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                            <div id="hasil-sipintu" class="absolute z-10 w-full bg-white border rounded-md shadow-lg mt-1 hidden max-h-48 overflow-y-auto"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Cari nama guru/siswa dari data sekolah, klik untuk menambahkan ke daftar petugas.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Petugas Piket Terpilih</label>
                        <div id="daftar-petugas" class="space-y-2 border rounded-md p-3 min-h-[60px]">
                            <p class="text-sm text-gray-400" id="petugas-kosong">Belum ada petugas dipilih.</p>
                        </div>
                    </div>

                    <div id="hidden-inputs"></div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('jadwal-piket-kebersihan.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const inputCari = document.getElementById('cari-sipintu');
        const hasilBox = document.getElementById('hasil-sipintu');
        const daftarPetugas = document.getElementById('daftar-petugas');
        const petugasKosong = document.getElementById('petugas-kosong');
        const hiddenInputs = document.getElementById('hidden-inputs');
        const petugasTerpilih = [];
        let timer = null;

        inputCari.addEventListener('input', function () {
            clearTimeout(timer);
            const keyword = this.value.trim();

            if (keyword.length < 3) {
                hasilBox.classList.add('hidden');
                return;
            }

            timer = setTimeout(async () => {
                const res = await fetch(`{{ route('sipintu.cari') }}?q=${encodeURIComponent(keyword)}`);
                const json = await res.json();

                hasilBox.innerHTML = '';

                if (json.results.length === 0) {
                    hasilBox.innerHTML = '<div class="p-3 text-sm text-gray-400">Tidak ditemukan.</div>';
                } else {
                    json.results.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'p-3 text-sm hover:bg-blue-50 cursor-pointer border-b last:border-0';
                        div.textContent = item.label;
                        div.addEventListener('click', () => tambahPetugas(item));
                        hasilBox.appendChild(div);
                    });
                }

                hasilBox.classList.remove('hidden');
            }, 400);
        });

        async function tambahPetugas(item) {
            if (petugasTerpilih.some(p => p.nama === item.nama && p.nik === item.nik)) {
                hasilBox.classList.add('hidden');
                inputCari.value = '';
                return;
            }

            const res = await fetch(`{{ route('sipintu.simpanAtauAmbil') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ nama: item.nama, nik: item.nik, asal: item.asal }),
            });
            const data = await res.json();

            petugasTerpilih.push({ nama: item.nama, nik: item.nik, pengurus_id: data.pengurus_id });
            renderPetugas();

            hasilBox.classList.add('hidden');
            inputCari.value = '';
        }

        function hapusPetugas(index) {
            petugasTerpilih.splice(index, 1);
            renderPetugas();
        }

        function renderPetugas() {
            daftarPetugas.innerHTML = '';
            hiddenInputs.innerHTML = '';

            if (petugasTerpilih.length === 0) {
                daftarPetugas.appendChild(petugasKosong);
                return;
            }

            petugasTerpilih.forEach((p, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between bg-gray-50 px-3 py-2 rounded';
                div.innerHTML = `<span class="text-sm">${p.nama}</span>`;

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'text-red-500 hover:text-red-700 text-xs';
                btn.textContent = 'Hapus';
                btn.addEventListener('click', () => hapusPetugas(index));
                div.appendChild(btn);

                daftarPetugas.appendChild(div);

                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'anggota_ids[]';
                hidden.value = p.pengurus_id;
                hiddenInputs.appendChild(hidden);
            });
        }

        document.addEventListener('click', function (e) {
            if (!hasilBox.contains(e.target) && e.target !== inputCari) {
                hasilBox.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>