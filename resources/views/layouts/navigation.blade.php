<nav class="bg-white shadow-md h-20 flex items-center justify-between px-8">

    {{-- Judul Halaman --}}
    <div>

        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard Admin
        </h1>

        <p class="text-sm text-gray-500">
            Sistem Informasi Masjid Darul Muttaqin
        </p>

    </div>

    {{-- Profil Admin --}}
    <div class="flex items-center gap-4">

        <div class="text-right">

            <h4 class="font-semibold text-gray-800">
                {{ Auth::user()->name }}
            </h4>

            <small class="text-gray-500">
                Administrator
            </small>

        </div>

        <div
            class="w-12 h-12 rounded-full bg-green-700 flex items-center justify-center text-white text-xl">

            <i class="fas fa-user"></i>

        </div>

    </div>

</nav>