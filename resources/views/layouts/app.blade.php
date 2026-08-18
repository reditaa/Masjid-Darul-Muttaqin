<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMADI - Masjid Darul Muttaqin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-gray-100 overflow-hidden">

<div x-data="{ sidebar:false }" class="h-screen flex overflow-hidden">

    {{-- Overlay --}}
    <div
        x-show="sidebar"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        @click="sidebar=false">
    </div>

    {{-- Sidebar --}}
    <aside
        :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
        class="fixed lg:static inset-y-0 left-0 z-50 w-72 h-screen transform transition-all duration-300 lg:translate-x-0 flex-shrink-0">

        @include('layouts.sidebar')

    </aside>

    {{-- Content --}}
    <div class="flex flex-col flex-1 h-screen overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-white shadow h-16 flex items-center px-4 lg:px-8 flex-shrink-0">

            <button
                @click="sidebar=true"
                class="lg:hidden text-2xl text-green-700 mr-4">
                <i class="fas fa-bars"></i>
            </button>

            <div class="flex-1">
                @include('layouts.navigation')
            </div>

        </header>

        @isset($header)
            <section class="bg-white border-b flex-shrink-0">
                <div class="px-4 lg:px-8 py-5">
                    {{ $header }}
                </div>
            </section>
        @endisset

        <main class="flex-1 overflow-y-auto">
            <div class="w-full p-4 lg:p-6">
                {{ $slot }}
            </div>
        </main>

    </div>

</div>

</body>
</html>