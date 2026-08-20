<div class="flex flex-col h-full w-72 bg-gradient-to-b from-green-800 via-green-900 to-green-950 text-white shadow-2xl">
    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-green-700 flex-shrink-0">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center">
                <i class="fas fa-mosque text-3xl text-green-300"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-wide">SIMADI</h1>
                <p class="text-xs text-green-200">Masjid Darul Muttaqin</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="flex-1 min-h-0 overflow-y-auto px-3 py-5 space-y-2">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('dashboard') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-chart-pie w-6 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('profil-masjid.edit') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('profil-masjid.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-mosque w-6 text-center"></i>
            <span class="font-medium">Profil Masjid</span>
        </a>

        {{-- Menu Dropdown Keanggotaan & SiPintu (Instant 1-Click Toggle via JS) --}}
        <div class="w-full">
            <button type="button" onclick="toggleKeanggotaanSubmenu(event)"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 cursor-pointer select-none text-left
                {{ request()->routeIs('pengurus.*', 'sipintu.data') ? 'bg-white/15 text-white font-semibold' : 'hover:bg-white/10 text-green-100' }}">
                <div class="flex items-center gap-3 pointer-events-none">
                    <i class="fas fa-users-gear w-6 text-center text-green-300"></i>
                    <span class="font-medium">Data Keanggotaan</span>
                </div>
                <i id="chevron-keanggotaan" class="fas fa-chevron-down text-xs transition-transform duration-300 pointer-events-none {{ request()->routeIs('pengurus.*', 'sipintu.data') ? 'rotate-180' : '' }}"></i>
            </button>

            {{-- Sub-Menu Dropdown --}}
            <div id="submenu-keanggotaan" class="pl-4 pr-1 mt-1.5 space-y-1 {{ request()->routeIs('pengurus.*', 'sipintu.data') ? '' : 'hidden' }}">
                <a href="{{ route('pengurus.index') }}"
                    class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-medium transition-all duration-200
                    {{ request()->routeIs('pengurus.*') ? 'bg-white text-green-900 shadow-md font-bold' : 'text-green-200 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-2.5">
                        <i class="fas fa-user-tie text-emerald-300 w-4 text-center"></i>
                        <span>Anggota DKM</span>
                    </div>
                    <span class="text-[9px] bg-emerald-700/80 text-emerald-100 px-2 py-0.5 rounded-full font-semibold">Anggota</span>
                </a>

                <a href="{{ route('sipintu.data') }}"
                    class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-medium transition-all duration-200
                    {{ request()->routeIs('sipintu.data') ? 'bg-white text-blue-900 shadow-md font-bold' : 'text-green-200 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-2.5">
                        <i class="fas fa-school text-blue-300 w-4 text-center"></i>
                        <span>Data SiPintu</span>
                    </div>
                    <span class="text-[9px] bg-blue-600/80 text-blue-100 px-2 py-0.5 rounded-full font-semibold">Bukan Anggota</span>
                </a>
            </div>
        </div>

        <a href="{{ route('pengumuman.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('pengumuman.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-bullhorn w-6 text-center"></i>
            <span>Pengumuman</span>
        </a>

        <p class="px-4 pt-4 pb-1 text-xs uppercase text-green-300 tracking-wider">Jadwal & Kegiatan</p>

        <a href="{{ route('jadwal-imam-muazin.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('jadwal-imam-muazin.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-mosque w-6 text-center"></i>
            <span>Jadwal Imam & Muazin</span>
        </a>
                <a href="{{ route('jadwal-jumat.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('jadwal-jumat.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-book-quran w-6 text-center"></i>
            <span>Jadwal Jumat</span>
        </a>

        <a href="{{ route('jadwal-bilal.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('jadwal-bilal.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-microphone w-6 text-center"></i>
            <span>Jadwal Bilal</span>
        </a>

        <a href="{{ route('jadwal-piket-kebersihan.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('jadwal-piket-kebersihan.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-broom w-6 text-center"></i>
            <span>Jadwal Piket Kebersihan</span>
        </a>

        <a href="{{ route('kegiatan.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('kegiatan.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-calendar-days w-6 text-center"></i>
            <span>Kalender Kegiatan</span>
        </a>

        <a href="{{ route('galeri.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('galeri.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-images w-6 text-center"></i>
            <span>Galeri</span>
        </a>

        <a href="{{ route('inventaris.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('inventaris.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-box-open w-6 text-center"></i>
            <span>Inventaris</span>
        </a>

        <a href="{{ route('keuangan.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('keuangan.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-wallet w-6 text-center"></i>
            <span>Keuangan</span>
        </a>

        <a href="{{ route('presensi.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('presensi.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-clipboard-check w-6 text-center"></i>
            <span>Presensi</span>
        </a>
    </div>

    {{-- User --}}
    <div class="border-t border-green-700 p-4 flex-shrink-0">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold">{{ Auth::user()->name }}</h4>
                <p class="text-xs text-green-200">Administrator</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-600 hover:bg-red-700 transition rounded-xl py-3 font-semibold">
                <i class="fas fa-right-from-bracket mr-2"></i>
                Logout
            </button>
        </form>
    </div>

</div>

<script>
    function toggleKeanggotaanSubmenu(e) {
        if (e) e.preventDefault();
        const sub = document.getElementById('submenu-keanggotaan');
        const chevron = document.getElementById('chevron-keanggotaan');
        if (sub) {
            sub.classList.toggle('hidden');
        }
        if (chevron) {
            chevron.classList.toggle('rotate-180');
        }
    }
</script>