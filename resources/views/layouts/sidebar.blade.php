<div class="w-64 bg-green-800 text-white min-h-screen">

    <div class="p-6 border-b border-green-700 text-center">
        <h1 class="text-2xl font-bold">
            Darul Muttaqin
        </h1>

        <p class="text-sm text-green-200 mt-2">
            Sistem Informasi Masjid
        </p>
    </div>

    <nav class="mt-6">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('dashboard') ? 'bg-green-900' : '' }}">

            <i class="fas fa-home w-5"></i>
            Dashboard
        </a>

        <a href="{{ route('guru.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('guru.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-chalkboard-teacher w-5"></i>
            Guru
        </a>

        <a href="{{ route('siswa.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('siswa.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-user-graduate w-5"></i>
            Siswa
        </a>

        
        <a href="{{ route('pengurus.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('pengurus.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-user-tie w-5"></i>
            Pengurus DKM
        </a>

        <a href="{{ route('pengumuman.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('pengumuman.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-bullhorn w-5"></i>
            Pengumuman
        </a>

        <a href="{{ route('jadwal-adzan.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('jadwal-adzan.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-mosque w-5"></i>
            Jadwal Adzan
        </a>

        <a href="{{ route('jadwal-piket.index') }}"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('jadwal-piket.*') ? 'bg-green-900' : '' }}">

            <i class="fas fa-broom w-5"></i>
            Jadwal Piket
        </a>

        <a href="#"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700">

            <i class="fas fa-box w-5"></i>
            Inventaris
        </a>

        <a href="#"
            class="flex items-center gap-3 px-6 py-3 hover:bg-green-700">

            <i class="fas fa-wallet w-5"></i>
            Keuangan
        </a>

        <hr class="my-4 border-green-600">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button
                class="w-full flex items-center gap-3 px-6 py-3 hover:bg-red-600">

                <i class="fas fa-sign-out-alt w-5"></i>
                Logout

            </button>
        </form>

    </nav>

</div>