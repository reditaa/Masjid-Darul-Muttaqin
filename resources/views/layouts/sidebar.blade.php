<div class="w-64 bg-green-800 text-white min-h-screen">

    <div class="p-6 text-center border-b border-green-700">
        <h1 class="text-2xl font-bold">
            🕌 Darul Muttaqin
        </h1>

        <p class="text-sm mt-2 text-green-200">
            Sistem Informasi Masjid
        </p>
    </div>

    <nav class="mt-6">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-3 hover:bg-green-700 {{ request()->routeIs('dashboard') ? 'bg-green-900' : '' }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('pengurus.index') }}"
           class="block px-6 py-3 hover:bg-green-700 {{ request()->routeIs('pengurus.*') ? 'bg-green-900' : '' }}">
            👥 Pengurus DKM
        </a>

        <a href="{{ route('pengumuman.index') }}"
           class="block px-6 py-3 hover:bg-green-700 {{ request()->routeIs('pengumuman.*') ? 'bg-green-900' : '' }}">
            📢 Pengumuman
        </a>

        <a href="#"
           class="block px-6 py-3 hover:bg-green-700">
            🕌 Jadwal Imam
        </a>

        <a href="#"
           class="block px-6 py-3 hover:bg-green-700">
            🎤 Jadwal Muazin
        </a>

        <a href="#"
           class="block px-6 py-3 hover:bg-green-700">
            🧹 Jadwal Piket
        </a>

        <a href="#"
           class="block px-6 py-3 hover:bg-green-700">
            📦 Inventaris
        </a>

        <a href="#"
           class="block px-6 py-3 hover:bg-green-700">
            💰 Keuangan
        </a>

        <hr class="my-4 border-green-600">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full text-left px-6 py-3 hover:bg-red-600">
                🚪 Logout
            </button>
        </form>

    </nav>

</div>