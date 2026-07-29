<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Masjid Darul Muttaqin') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Content --}}
        <div class="flex-1 min-h-screen">

            {{-- Navbar --}}
            @include('layouts.navigation')

            {{-- Header --}}
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Isi Halaman --}}
            <main class="p-6">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>

</html>