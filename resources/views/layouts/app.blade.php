<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMADI - Masjid Darul Muttaqin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        html {
            font-size: 80%;
        }

        .form-hijau {
            display: block;
            width: 100%;
            border: 1px solid #86efac;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: #ffffff;
            color: #1f2937;
        }
        .form-hijau:focus {
            outline: none;
            border-color: #15803d;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, .15);
        }

        .kartu-notebook {
            position: relative;
            background: #fbf9f0;
            border: 2px solid #15803d;
            border-radius: 6px 6px 20px 20px;
            box-shadow: 0 10px 25px -8px rgba(21, 128, 61, .2);
            padding: 28px 20px 20px;
        }
        .ring-spiral {
            position: absolute;
            top: -12px; left: 0; right: 0;
            display: flex; justify-content: center; gap: 14px;
        }
        .ring-spiral span {
            width: 13px; height: 13px; border-radius: 50%;
            background: #fbf9f0; border: 2.5px solid #15803d;
        }
        .ornamen-pojok {
            position: absolute; top: 10px; right: 12px;
            width: 20px; height: 20px; color: rgba(21, 128, 61, .35);
        }
        .judul-kartu {
            text-align: center; font-weight: 800; font-size: 1.15rem; color: #14532d;
        }
        .garis-bawah {
            width: 48px; height: 4px; background: #15803d;
            border-radius: 999px; margin: 6px auto 16px;
        }
        .label-kartu {
            font-size: 11px; text-transform: uppercase; letter-spacing: .05em;
            color: #16a34a; font-weight: 700; margin-bottom: 2px;
        }
        .isi-kartu {
            font-size: .875rem; color: #1f2937; line-height: 1.4;
        }
    </style>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const aside = document.querySelector('aside');
    if (!aside) return;

    // Cari otomatis elemen scroll di dalam sidebar (overflow-y auto/scroll)
    let scrollEl = null;
    const candidates = aside.querySelectorAll('*');
    for (const el of candidates) {
        const style = window.getComputedStyle(el);
        if (style.overflowY === 'auto' || style.overflowY === 'scroll') {
            scrollEl = el;
            break;
        }
    }

    // Fallback: kalau tidak ketemu, pakai aside itu sendiri
    if (!scrollEl) scrollEl = aside;

    const STORAGE_KEY = 'sidebarScrollPos';

    // Restore posisi scroll setelah reload
    const savedScroll = sessionStorage.getItem(STORAGE_KEY);
    if (savedScroll !== null) {
        scrollEl.scrollTop = parseInt(savedScroll, 10);
    }

    // Simpan posisi setiap kali di-scroll
    scrollEl.addEventListener('scroll', function () {
        sessionStorage.setItem(STORAGE_KEY, scrollEl.scrollTop);
    });
});
</script>

</body>
</html>