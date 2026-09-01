<nav class="h-full">

    <div class="flex items-center justify-between h-full">

        {{-- Kiri --}}
        <div class="min-w-0">

            <h1 class="text-xl lg:text-2xl font-bold text-gray-800 truncate">
                Dashboard Admin
            </h1>

            <p class="hidden md:block text-sm text-gray-500">
                Sistem Informasi Masjid Darul Muttaqin
            </p>

        </div>

        {{-- Kanan --}}
        <div class="flex items-center gap-3 lg:gap-5">

            {{-- Kembali ke Web --}}
            <a href="{{ route('landing') }}"
                class="hidden sm:inline-flex items-center gap-2 px-3 lg:px-4 h-11 rounded-xl bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-700 text-sm font-medium transition">
                <i class="fas fa-arrow-left"></i>
                <span class="hidden lg:inline">Kembali ke Web</span>
            </a>

            {{-- Versi ikon saja untuk mobile --}}
            <a href="{{ route('landing') }}"
                class="sm:hidden w-11 h-11 rounded-xl bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-700 transition flex items-center justify-center">
                <i class="fas fa-arrow-left"></i>
            </a>

            {{-- Notifikasi --}}
            <button
                class="relative w-11 h-11 rounded-xl bg-gray-100 hover:bg-green-100 transition flex items-center justify-center">

                <i class="fas fa-bell text-gray-600"></i>

                <span
                    class="absolute top-2 right-2 w-2.5 h-2.5 rounded-full bg-red-500"></span>

            </button>

            {{-- User --}}
            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">

                    <h4 class="font-semibold text-gray-800 leading-none">

                        {{ Auth::user()->name }}

                    </h4>

                    <span class="text-xs text-gray-500">

                        Administrator

                    </span>

                </div>

                <div
                    class="w-11 h-11 rounded-full bg-gradient-to-r from-green-600 to-green-800 text-white flex items-center justify-center shadow-lg">

                    <i class="fas fa-user"></i>

                </div>

            </div>

        </div>

    </div>

</nav>