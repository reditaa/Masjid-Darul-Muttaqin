<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMADI - Anggota</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Topbar sederhana khusus Anggota --}}
    <header class="bg-green-700 shadow h-16 flex items-center justify-between px-4 lg:px-8">

        <div class="flex items-center gap-3 text-white">
            <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fas fa-mosque"></i>
            </div>
            <div>
                <p class="font-bold leading-tight">SIMADI</p>
                <p class="text-xs text-green-100 leading-tight">Area Anggota</p>
            </div>
        </div>

        <form action="{{ route('anggota.logout') }}" method="POST">
            @csrf
            <button class="bg-white/10 hover:bg-white/20 text-white text-sm px-4 py-2 rounded-lg transition">
                <i class="fas fa-right-from-bracket mr-1"></i>
                Logout
            </button>
        </form>

    </header>

    @isset($header)
        <section class="bg-white border-b">
            <div class="px-4 lg:px-8 py-5">
                {{ $header }}
            </div>
        </section>
    @endisset

    <main class="p-4 lg:p-8">
        {{ $slot }}
    </main>

</body>
</html>