<div class="w-72 min-h-screen bg-gradient-to-b from-green-800 to-green-900 text-white shadow-2xl">

    {{-- Logo --}}
    <div class="h-20 flex items-center justify-center border-b border-green-700">

        <div class="text-center">

            <i class="fas fa-mosque text-4xl mb-2"></i>

            <h1 class="text-2xl font-bold">
                SIMADI
            </h1>

            <p class="text-sm text-green-200">
                Masjid Darul Muttaqin
            </p>

        </div>

    </div>

    <div class="mt-6">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 rounded-xl transition duration-200
            {{ request()->routeIs('dashboard') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-house w-5"></i>

            Dashboard

        </a>

        {{-- Guru --}}
        <a href="{{ route('guru.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('guru.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-chalkboard-teacher w-5"></i>

            Guru

        </a>

        {{-- Siswa --}}
        <a href="{{ route('siswa.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('siswa.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-user-graduate w-5"></i>

            Siswa

        </a>

        {{-- Anggota --}}
        <a href="{{ route('anggota.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('anggota.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-users w-5"></i>

            Anggota

        </a>

        {{-- Pengurus --}}
        <a href="{{ route('pengurus.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('pengurus.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-user-tie w-5"></i>

            Pengurus DKM

        </a>

        {{-- Imam --}}
        <a href="{{ route('jadwal-imam.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('jadwal-imam.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-mosque w-5"></i>

            Jadwal Imam

        </a>

        {{-- Adzan --}}
        <a href="{{ route('jadwal-adzan.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('jadwal-adzan.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-bell w-5"></i>

            Jadwal Adzan

        </a>

        {{-- Piket --}}
        <a href="{{ route('jadwal-piket.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('jadwal-piket.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-broom w-5"></i>

            Jadwal Piket

        </a>

        {{-- Pengumuman --}}
        <a href="{{ route('pengumuman.index') }}"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl transition
            {{ request()->routeIs('pengumuman.*') ? 'bg-white text-green-800 shadow-lg font-semibold' : 'hover:bg-green-700' }}">

            <i class="fas fa-bullhorn w-5"></i>

            Pengumuman

        </a>

        {{-- Inventaris --}}
        <a href="#"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl hover:bg-green-700">

            <i class="fas fa-box-open w-5"></i>

            Inventaris

        </a>

        {{-- Keuangan --}}
        <a href="#"
            class="flex items-center gap-4 px-6 py-3 mx-3 mt-2 rounded-xl hover:bg-green-700">

            <i class="fas fa-wallet w-5"></i>

            Keuangan

        </a>

    </div>

    <div class="absolute bottom-0 w-72 p-4 border-t border-green-700">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                class="w-full bg-red-600 hover:bg-red-700 rounded-xl py-3 font-semibold">

                <i class="fas fa-right-from-bracket mr-2"></i>

                Logout

            </button>

        </form>

    </div>

</div>