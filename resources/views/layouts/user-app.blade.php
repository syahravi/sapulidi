<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Sapulidi Landing Page')</title>

    {{-- Alpine.js (Hanya versi 3.x.x) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    {{-- AOS CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- Custom CSS Anda --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    {{-- Vite Assets (jika menggunakan Laravel Mix/Vite untuk CSS/JS) --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Fallback for local development if Vite is not running --}}
    @endif

    {{-- Custom CSS untuk halaman ini (jika ada) --}}
    @stack('styles')
</head>

<body class="antialiased">
    {{-- Header/Navbar --}}
    @include('partials.header')

    {{-- Content Utama Halaman --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')
    <button x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 300 })" x-show="show"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-50 bg-green-600 hover:bg-green-700 text-white p-3 rounded-full shadow-lg transition-all duration-300"
        x-transition aria-label="Back to Top">
        <!-- Icon panah ke atas -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    {{-- AOS JavaScript --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Durasi animasi default
            once: true, // Animasi hanya berjalan sekali saat di-scroll
        });
    </script>
    {{-- Custom JavaScript untuk halaman ini (jika ada) --}}
    @stack('scripts')
</body>

</html>
