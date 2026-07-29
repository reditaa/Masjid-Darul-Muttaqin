<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Darul Muttaqin - Sistem Informasi Terpadu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-600 text-white p-2 rounded-xl">
                    <i class="fas fa-mosque text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-emerald-800">Darul Muttaqin</h1>
                    <p class="text-xs text-gray-500">Sistem Informasi Masjid</p>
                </div>
            </div>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="#fitur" class="text-gray-600 hover:text-emerald-600 font-medium transition">Fitur</a>
                <a href="#tentang" class="text-gray-600 hover:text-emerald-600 font-medium transition">Tentang</a>
                <a href="#pengumuman" class="text-gray-600 hover:text-emerald-600 font-medium transition">Pengumuman</a>
                <a href="{{ route('anggota.login') }}" class="text-emerald-600 border-2 border-emerald-600 px-5 py-2 rounded-lg font-semibold hover:bg-emerald-50 transition">
                    Login Jamaah
                </a>
                <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                    Login Admin
                </a>
            </div>

            <button class="md:hidden text-gray-600" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t p-4 space-y-3">
            <a href="#fitur" class="block text-gray-600 py-2">Fitur</a>
            <a href="#tentang" class="block text-gray-600 py-2">Tentang</a>
            <a href="#pengumuman" class="block text-gray-600 py-2">Pengumuman</a>
            <a href="{{ route('anggota.login') }}" class="block text-emerald-600 py-2 font-semibold">Login Jamaah</a>
            <a href="{{ route('login') }}" class="block bg-emerald-600 text-white px-4 py-2 rounded-lg text-center font-semibold">Login Admin</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-700 text-white py-16 md:py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-medium mb-6 inline-block">
                    <i class="fas fa-star text-amber-400 mr-2"></i>Sistem Informasi Masjid Terpadu
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight">
                    Selamat Datang di <br>
                    <span class="text-amber-400">Masjid Darul Muttaqin</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 text-emerald-100 max-w-2xl mx-auto">
                    Platform digital untuk mengelola kegiatan, keuangan, dan informasi masjid secara transparan dan terintegrasi.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#fitur" class="bg-amber-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-amber-600 transition flex items-center justify-center gap-2">
                        <i class="fas fa-rocket"></i> Jelajahi Fitur
                    </a>
                    <a href="{{ route('login') }}" class="bg-white text-emerald-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i> Masuk Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-12 bg-white border-b">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">500+</div>
                    <div class="text-gray-600">Jamaah Aktif</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">50+</div>
                    <div class="text-gray-600">Pengurus</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">1200+</div>
                    <div class="text-gray-600">Pengumuman</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">365</div>
                    <div class="text-gray-600">Hari Melayani</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
                    <div class="w-20 h-1 bg-emerald-600 mx-auto"></div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-start gap-6">
                        <div class="hidden md:block">
                            <div class="bg-emerald-100 p-4 rounded-xl">
                                <i class="fas fa-mosque text-4xl text-emerald-600"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Masjid Darul Muttaqin</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                Masjid Darul Muttaqin adalah pusat kegiatan keagamaan dan sosial yang melayani jamaah dengan berbagai program dan kegiatan. Kami berkomitmen untuk menjadi masjid yang modern, transparan, dan bermanfaat bagi umat.
                            </p>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-emerald-600"></i>
                                    <span class="text-gray-700">Transparan</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-emerald-600"></i>
                                    <span class="text-gray-700">Modern</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-emerald-600"></i>
                                    <span class="text-gray-700">Terintegrasi</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-emerald-600"></i>
                                    <span class="text-gray-700">Bermanfaat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama (12 Fitur) -->
    <section id="fitur" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">12 Fitur lengkap untuk mendukung pengelolaan Masjid Darul Muttaqin yang modern dan profesional.</p>
                <div class="w-20 h-1 bg-emerald-600 mx-auto mt-4"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @php
                    $fitur = [
                        ['icon' => 'fa-home', 'title' => 'Beranda', 'desc' => 'Pusat informasi dan kabar terkini masjid.', 'color' => 'bg-blue-100 text-blue-600'],
                        ['icon' => 'fa-mosque', 'title' => 'Profil Masjid', 'desc' => 'Sejarah, visi, misi, dan struktur DKM.', 'color' => 'bg-emerald-100 text-emerald-600'],
                        ['icon' => 'fa-users', 'title' => 'Pengurus DKM', 'desc' => 'Data lengkap pengurus dan tugasnya.', 'color' => 'bg-indigo-100 text-indigo-600'],
                        ['icon' => 'fa-calendar-days', 'title' => 'Jadwal Imam', 'desc' => 'Jadwal imam sholat 5 waktu & tarawih.', 'color' => 'bg-purple-100 text-purple-600'],
                        ['icon' => 'fa-microphone', 'title' => 'Jadwal Bilal', 'desc' => 'Penjadwalan muadzin untuk adzan.', 'color' => 'bg-pink-100 text-pink-600'],
                        ['icon' => 'fa-broom', 'title' => 'Jadwal Piket', 'desc' => 'Atur kebersihan dan perawatan masjid.', 'color' => 'bg-orange-100 text-orange-600'],
                        ['icon' => 'fa-bullhorn', 'title' => 'Pengumuman', 'desc' => 'Informasi resmi dan kabar mendesak.', 'color' => 'bg-red-100 text-red-600'],
                        ['icon' => 'fa-images', 'title' => 'Galeri', 'desc' => 'Dokumentasi kegiatan dan acara masjid.', 'color' => 'bg-teal-100 text-teal-600'],
                        ['icon' => 'fa-boxes-stacked', 'title' => 'Inventaris', 'desc' => 'Pencatatan aset dan barang masjid.', 'color' => 'bg-cyan-100 text-cyan-600'],
                        ['icon' => 'fa-coins', 'title' => 'Ringkasan Keuangan', 'desc' => 'Laporan infaq, sedekah, dan kas transparan.', 'color' => 'bg-amber-100 text-amber-600'],
                        ['icon' => 'fa-calendar', 'title' => 'Kalender Kegiatan', 'desc' => 'Agenda kajian, PHBI, dan acara rutin.', 'color' => 'bg-lime-100 text-lime-600'],
                        ['icon' => 'fa-clipboard-list', 'title' => 'Riwayat Kegiatan', 'desc' => 'Arsip dan laporan kegiatan masa lalu.', 'color' => 'bg-gray-100 text-gray-600'],
                    ];
                @endphp

                @foreach($fitur as $item)
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 hover:shadow-lg hover:border-emerald-300 transition-all duration-300 group">
                    <div class="w-12 h-12 {{ $item['color'] }} rounded-lg flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $item['desc'] }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Pengumuman Terbaru -->
    <section id="pengumuman" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pengumuman Terbaru</h2>
                <p class="text-gray-600">Informasi terkini dari masjid kami</p>
                <div class="w-20 h-1 bg-emerald-600 mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @php
                    $pengumuman = [
                        ['title' => 'Kajian Rutin Mingguan', 'date' => '28 Juli 2026', 'icon' => 'fa-book-open', 'color' => 'bg-blue-500'],
                        ['title' => 'Jumat Berkah & Santunan', 'date' => '1 Agustus 2026', 'icon' => 'fa-hand-holding-heart', 'color' => 'bg-green-500'],
                        ['title' => 'Peringatan Maulid Nabi', 'date' => '15 Agustus 2026', 'icon' => 'fa-star-and-crescent', 'color' => 'bg-purple-500']
                    ];
                @endphp
                
                @foreach($pengumuman as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                    <div class="{{ $item['color'] }} h-2"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 {{ $item['color'] }} bg-opacity-10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas {{ $item['icon'] }} text-2xl {{ $item['color'] }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-gray-600 text-sm mb-4"><i class="far fa-calendar mr-2"></i>{{ $item['date'] }}</p>
                        <a href="#" class="text-emerald-600 font-semibold hover:text-emerald-800 text-sm">Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-emerald-700 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Mengelola Masjid dengan Lebih Baik?</h2>
            <p class="text-emerald-100 mb-8 max-w-2xl mx-auto text-lg">Bergabunglah bersama pengurus dan jamaah Masjid Darul Muttaqin dalam satu platform digital yang terintegrasi.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="bg-amber-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-amber-600 transition flex items-center justify-center gap-2">
                    <i class="fas fa-user-shield"></i> Login sebagai Admin
                </a>
                <a href="{{ route('anggota.login') }}" class="bg-white text-emerald-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition flex items-center justify-center gap-2">
                    <i class="fas fa-user"></i> Login sebagai Jamaah
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-mosque text-2xl text-emerald-500"></i>
                        <span class="text-xl font-bold text-white">Darul Muttaqin</span>
                    </div>
                    <p class="text-sm">Membangun umat melalui teknologi dan manajemen masjid yang modern.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#fitur" class="hover:text-emerald-500 transition">Fitur</a></li>
                        <li><a href="#tentang" class="hover:text-emerald-500 transition">Tentang</a></li>
                        <li><a href="#pengumuman" class="hover:text-emerald-500 transition">Pengumuman</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jl. Masjid No. 1</li>
                        <li><i class="fas fa-phone mr-2"></i> (021) 1234-5678</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@darulmuttaqin.id</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center">
                <div class="flex justify-center space-x-4 mb-4">
                    <a href="#" class="text-gray-400 hover:text-emerald-500 transition"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-emerald-500 transition"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-emerald-500 transition"><i class="fab fa-youtube text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-emerald-500 transition"><i class="fab fa-whatsapp text-xl"></i></a>
                </div>
                <p class="text-xs">&copy; {{ date('Y') }} Masjid Darul Muttaqin. Dibuat dengan <i class="fas fa-heart text-red-500"></i> menggunakan Laravel.</p>
            </div>
        </div>
    </footer>

</body>
</html>