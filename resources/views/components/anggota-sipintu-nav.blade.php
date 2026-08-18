<div class="bg-white border border-gray-200 mb-6 rounded-2xl shadow-sm overflow-hidden">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 via-emerald-50/20 to-blue-50/20">
        <div class="flex items-center gap-3 mb-2 sm:mb-0">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-700 to-green-600 text-white flex items-center justify-center shadow-md">
                <i class="fas fa-users-rectangle text-lg"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-lg leading-tight">Manajemen Data Keanggotaan & Eksternal</h3>
                <p class="text-xs text-gray-500">Pemisahan data internal Anggota DKM dengan Data Eksternal Sekolah (SiPintu)</p>
            </div>
        </div>
        <div class="flex items-center gap-2 text-xs">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100/80 text-emerald-800 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Anggota DKM
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100/80 text-blue-800 font-medium">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Bukan Anggota (SiPintu)
            </span>
        </div>
    </div>

    {{-- Sub Navbar Tabs --}}
    <div class="flex border-b border-gray-200 px-6 bg-white overflow-x-auto gap-2">
        <a href="{{ route('pengurus.index') }}"
           class="flex items-center gap-2.5 py-3.5 px-5 text-sm font-semibold border-b-2 transition-all duration-200 whitespace-nowrap {{ request()->routeIs('pengurus.*') ? 'border-emerald-600 text-emerald-700 bg-emerald-50/50' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-gray-300' }}">
            <i class="fas fa-user-tie {{ request()->routeIs('pengurus.*') ? 'text-emerald-600' : 'text-gray-400' }}"></i>
            <span>Data Anggota DKM</span>
            <span class="px-2.5 py-0.5 text-xs rounded-full font-bold {{ request()->routeIs('pengurus.*') ? 'bg-emerald-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                Anggota Internal
            </span>
        </a>

        <a href="{{ route('sipintu.data') }}"
           class="flex items-center gap-2.5 py-3.5 px-5 text-sm font-semibold border-b-2 transition-all duration-200 whitespace-nowrap {{ request()->routeIs('sipintu.data') ? 'border-blue-600 text-blue-700 bg-blue-50/50' : 'border-transparent text-gray-600 hover:text-blue-600 hover:border-gray-300' }}">
            <i class="fas fa-school {{ request()->routeIs('sipintu.data') ? 'text-blue-600' : 'text-gray-400' }}"></i>
            <span>Data SiPintu (Guru & Siswa)</span>
            <span class="px-2.5 py-0.5 text-xs rounded-full font-bold {{ request()->routeIs('sipintu.data') ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                Bukan Anggota
            </span>
        </a>
    </div>
</div>
