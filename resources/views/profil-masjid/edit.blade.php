<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-800">⚙️ Profil Masjid</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola tampilan halaman utama website masjid</p>
            </div>
            <a href="/" target="_blank"
               class="flex items-center gap-2 text-sm bg-green-50 text-green-700 border border-green-200 px-4 py-2 rounded-xl hover:bg-green-100 transition">
                <i class="fas fa-external-link-alt text-xs"></i> Lihat Halaman
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-2xl flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('profil-masjid.update') }}" method="POST" enctype="multipart/form-data" id="form-profil" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- ============ SECTION: FOTO ============ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-base flex items-center gap-2">
                        <i class="fas fa-images"></i> Foto & Gambar
                    </h3>
                    <p class="text-green-100 text-xs mt-0.5">Foto yang ditampilkan di halaman utama website</p>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-8">

                    {{-- Foto Hero --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            🖼️ Foto Hero (Background Halaman Utama)
                        </label>
                        <div class="relative group cursor-pointer" onclick="document.getElementById('input_foto_hero').click()">
                            <div id="preview_hero"
                                 class="w-full h-48 rounded-2xl overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center transition group-hover:border-green-400 group-hover:bg-green-50">
                                @if($profil->foto_hero)
                                    <img src="{{ Storage::url($profil->foto_hero) }}"
                                         id="img_hero"
                                         class="w-full h-full object-cover">
                                @else
                                    <div id="img_hero" class="text-center text-gray-400">
                                        <i class="fas fa-image text-4xl mb-2 block"></i>
                                        <p class="text-sm">Klik untuk upload foto hero</p>
                                        <p class="text-xs mt-1">JPG, PNG, WEBP — maks 4MB</p>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-3 right-3 bg-green-600 text-white text-xs px-3 py-1.5 rounded-xl shadow group-hover:bg-green-700 transition">
                                <i class="fas fa-camera mr-1"></i> Ganti Foto
                            </div>
                        </div>
                        <input type="file" id="input_foto_hero" name="foto_hero" accept="image/*" class="hidden"
                               onchange="previewImage(this, 'preview_hero', 'img_hero')">
                        @error('foto_hero')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-400 text-xs mt-2">Rekomendasi: 1920×1080px. Foto ini menjadi background besar di halaman utama.</p>
                    </div>

                    {{-- Foto Tentang --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            🕌 Foto Tentang Masjid
                        </label>
                        <div class="relative group cursor-pointer" onclick="document.getElementById('input_foto_utama').click()">
                            <div id="preview_utama"
                                 class="w-full h-48 rounded-2xl overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center transition group-hover:border-green-400 group-hover:bg-green-50">
                                @if($profil->foto_utama)
                                    <img src="{{ Storage::url($profil->foto_utama) }}"
                                         id="img_utama"
                                         class="w-full h-full object-cover">
                                @else
                                    <div id="img_utama" class="text-center text-gray-400">
                                        <i class="fas fa-mosque text-4xl mb-2 block"></i>
                                        <p class="text-sm">Klik untuk upload foto masjid</p>
                                        <p class="text-xs mt-1">JPG, PNG, WEBP — maks 4MB</p>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-3 right-3 bg-green-600 text-white text-xs px-3 py-1.5 rounded-xl shadow group-hover:bg-green-700 transition">
                                <i class="fas fa-camera mr-1"></i> Ganti Foto
                            </div>
                        </div>
                        <input type="file" id="input_foto_utama" name="foto_utama" accept="image/*" class="hidden"
                               onchange="previewImage(this, 'preview_utama', 'img_utama')">
                        @error('foto_utama')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-400 text-xs mt-2">Rekomendasi: 800×600px. Foto ini tampil di bagian "Tentang Masjid".</p>
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            🏷️ Logo Masjid (Navbar & Footer)
                        </label>
                        <div class="relative group cursor-pointer w-40 mx-auto" onclick="document.getElementById('input_logo').click()">
                            <div id="preview_logo"
                                 class="w-40 h-40 rounded-full overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center transition group-hover:border-green-400 group-hover:bg-green-50">
                                @if($profil->logo)
                                    <img src="{{ Storage::url($profil->logo) }}"
                                         id="img_logo"
                                         class="w-full h-full object-cover">
                                @else
                                    <div id="img_logo" class="text-center text-gray-400">
                                        <i class="fas fa-image text-3xl mb-1 block"></i>
                                        <p class="text-xs">Klik untuk upload logo</p>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0 bg-green-600 text-white text-xs w-8 h-8 rounded-full shadow flex items-center justify-center group-hover:bg-green-700 transition">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <input type="file" id="input_logo" name="logo" accept="image/*" class="hidden"
                               onchange="previewImage(this, 'preview_logo', 'img_logo')">
                        @error('logo')
                            <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-400 text-xs mt-2 text-center">Rekomendasi: gambar persegi (misal 256×256px), maks 2MB.</p>
                    </div>

                    {{-- QRIS Infaq (foto singkat di sini, detail lengkap ada di section Infaq di bawah) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            💳 Barcode QRIS Infaq
                        </label>
                        <div class="relative group cursor-pointer w-40 mx-auto" onclick="document.getElementById('input_qris').click()">
                            <div id="preview_qris"
                                 class="w-40 h-40 rounded-2xl overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center transition group-hover:border-green-400 group-hover:bg-green-50">
                                @if($profil->qris_infaq)
                                    <img src="{{ Storage::url($profil->qris_infaq) }}"
                                         id="img_qris"
                                         class="w-full h-full object-contain">
                                @else
                                    <div id="img_qris" class="text-center text-gray-400">
                                        <i class="fas fa-qrcode text-3xl mb-1 block"></i>
                                        <p class="text-xs">Klik untuk upload QRIS</p>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0 bg-green-600 text-white text-xs w-8 h-8 rounded-full shadow flex items-center justify-center group-hover:bg-green-700 transition">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <input type="file" id="input_qris" name="qris_infaq" accept="image/*" class="hidden"
                               onchange="previewImage(this, 'preview_qris', 'img_qris')">
                        @error('qris_infaq')
                            <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-400 text-xs mt-2 text-center">Tampil di section "Mari Berinfaq" halaman utama. Maks 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: INFORMASI UTAMA ============ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-base flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> Informasi Utama
                    </h3>
                </div>

                <div class="p-6 space-y-5">
                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Nama Masjid --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Masjid <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_masjid" value="{{ old('nama_masjid', $profil->nama_masjid) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 @error('nama_masjid') border-red-400 @enderror"
                                   placeholder="Masjid Darul Muttaqin">
                            @error('nama_masjid') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Sub Judul --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Sub Judul
                                <span class="font-normal text-gray-400 text-xs ml-1">(tampil di bawah nama masjid di navbar &amp; footer)</span>
                            </label>
                            <input type="text" name="sub_judul" value="{{ old('sub_judul', $profil->sub_judul) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="Contoh: SMK Negeri 1 Bangsri">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Slogan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Slogan / Tagline</label>
                            <input type="text" name="slogan" value="{{ old('slogan', $profil->slogan) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="Contoh: Masjid Sekolah, Cahaya Umat">
                        </div>

                        {{-- Tahun Berdiri --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}"
                                   min="1900" max="{{ date('Y') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="2010">
                        </div>
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kapasitas Jamaah</label>
                        <input type="number" name="kapasitas_jamaah" value="{{ old('kapasitas_jamaah', $profil->kapasitas_jamaah) }}"
                               min="0"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                               placeholder="500">
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $profil->alamat) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                               placeholder="Jl. Raya ... No. ...">
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat
                            <span class="font-normal text-gray-400 text-xs ml-1">(tampil di section "Tentang Masjid")</span>
                        </label>
                        <textarea name="deskripsi" rows="4"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                  placeholder="Tulis deskripsi singkat tentang masjid...">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: SEJARAH, VISI, MISI ============ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-base flex items-center gap-2">
                        <i class="fas fa-scroll"></i> Sejarah, Visi & Misi
                    </h3>
                </div>

                <div class="p-6 space-y-5">
                    {{-- Sejarah --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sejarah Masjid</label>
                        <textarea name="sejarah" rows="6"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                  placeholder="Tuliskan sejarah pendirian masjid...">{{ old('sejarah', $profil->sejarah) }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Visi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visi</label>
                            <textarea name="visi" rows="4"
                                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                      placeholder="Visi masjid...">{{ old('visi', $profil->visi) }}</textarea>
                        </div>

                        {{-- Misi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Misi
                                <span class="font-normal text-gray-400 text-xs ml-1">(satu poin per baris)</span>
                            </label>
                            <textarea name="misi" rows="4"
                                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                      placeholder="Misi masjid...">{{ old('misi', $profil->misi) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: INFAQ (QRIS) ============ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-base flex items-center gap-2">
                        <i class="fas fa-hand-holding-heart"></i> Infaq (QRIS)
                    </h3>
                    <p class="text-green-100 text-xs mt-0.5">Gambar QRIS ditampilkan di section "Mari Berinfaq" pada halaman utama</p>
                </div>

                <div class="p-6 flex flex-col items-center">
                    <div class="relative group cursor-pointer" onclick="document.getElementById('input_qris').click()">
                        <div id="preview_qris_full"
                             class="w-56 h-56 rounded-2xl overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center transition group-hover:border-green-400 group-hover:bg-green-50">
                            @if($profil->qris_infaq)
                                <img src="{{ Storage::url($profil->qris_infaq) }}"
                                     id="img_qris_full"
                                     class="w-full h-full object-contain">
                            @else
                                <div id="img_qris_full" class="text-center text-gray-400">
                                    <i class="fas fa-qrcode text-4xl mb-2 block"></i>
                                    <p class="text-sm">Klik untuk upload QRIS</p>
                                    <p class="text-xs mt-1">JPG, PNG — maks 2MB</p>
                                </div>
                            @endif
                        </div>
                        <div class="absolute bottom-3 right-3 bg-green-600 text-white text-xs px-3 py-1.5 rounded-xl shadow group-hover:bg-green-700 transition">
                            <i class="fas fa-camera mr-1"></i> Ganti Gambar
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs mt-3 text-center">
                        Upload gambar barcode QRIS resmi rekening infaq masjid (persegi, disarankan min. 512×512px).<br>
                        Field ini sama dengan "Barcode QRIS Infaq" di section Foto & Gambar di atas — cukup diisi salah satu.
                    </p>
                </div>
            </div>

            {{-- ============ SECTION: KONTAK & MEDIA SOSIAL ============ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-base flex items-center gap-2">
                        <i class="fas fa-share-alt"></i> Kontak & Media Sosial
                    </h3>
                    <p class="text-green-100 text-xs mt-0.5">Ditampilkan di footer website</p>
                </div>

                <div class="p-6 space-y-5">
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon / WA</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email', $profil->email) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="masjid@email.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Website</label>
                        <input type="text" name="website" value="{{ old('website', $profil->website) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                               placeholder="https://...">
                    </div>

                    <div class="grid md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram</label>
                            <input type="text" name="instagram" value="{{ old('instagram', $profil->instagram) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="https://instagram.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook</label>
                            <input type="text" name="facebook" value="{{ old('facebook', $profil->facebook) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="https://facebook.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $profil->whatsapp) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"
                                   placeholder="628xxxxxxxxxx (untuk link wa.me)">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Teks Footer <span class="font-normal text-gray-400 text-xs ml-1">(kosongkan untuk pakai default)</span>
                        </label>
                        <textarea name="footer_text" rows="2"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                  placeholder="Contoh: Melayani umat, membangun peradaban.">{{ old('footer_text', $profil->footer_text) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="flex justify-end gap-3 pb-4">
                <button type="submit"
                        class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-semibold px-8 py-3 rounded-2xl transition shadow-lg shadow-green-200">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <script>
        function previewImage(input, previewId, imgId) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const html = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                const htmlContain = `<img src="${e.target.result}" class="w-full h-full object-contain">`;

                // Update preview utama
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.innerHTML = (previewId === 'preview_qris' || previewId === 'preview_qris_full') ? htmlContain : html;
                }

                // Sinkronkan preview QRIS di 2 tempat (section Foto & Gambar + section Infaq)
                if (previewId === 'preview_qris') {
                    const dup = document.getElementById('preview_qris_full');
                    if (dup) dup.innerHTML = htmlContain;
                } else if (previewId === 'preview_qris_full') {
                    const dup = document.getElementById('preview_qris');
                    if (dup) dup.innerHTML = htmlContain;
                }
            };

            reader.readAsDataURL(file);
        }
    </script>
</x-app-layout>