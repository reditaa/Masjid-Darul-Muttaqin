<div class="flex flex-col h-screen w-72 bg-gradient-to-b from-green-800 via-green-900 to-green-950 text-white shadow-2xl">
    {{-- Logo --}}
    <div class="px-6 py-7 border-b border-green-700">
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
    <div class="flex-1 overflow-y-auto px-3 py-5 space-y-2">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('dashboard') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-chart-pie w-6 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('pengurus.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('pengurus.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-user-tie w-6 text-center"></i>
            <span>Pengurus DKM</span>
        </a>

        <a href="{{ route('pengumuman.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('pengumuman.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-bullhorn w-6 text-center"></i>
            <span>Pengumuman</span>
        </a>

        <p class="px-4 pt-4 pb-1 text-xs uppercase text-green-300 tracking-wider">Segera Hadir</p>
<a href="{{ route('jadwal-imam-muazin.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300
            {{ request()->routeIs('jadwal-imam-muazin.*') ? 'bg-white text-green-800 shadow-lg' : 'hover:bg-white/10' }}">
            <i class="fas fa-mosque w-6 text-center"></i>
            <span>Jadwal Imam & Muazin</span>
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
    <div class="border-t border-green-700 p-4">
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