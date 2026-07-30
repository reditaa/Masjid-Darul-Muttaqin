<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>SIMADI - Masjid Darul Muttaqin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('layouts.navigation')

        {{-- Header --}}
        @isset($header)

            <div class="bg-white shadow">

                <div class="px-8 py-5">

                    {{ $header }}

                </div>

            </div>

        @endisset

        {{-- Isi --}}
        <main class="p-8">

            {{ $slot }}

        </main>

    </div>

</div>

</body>

</html>