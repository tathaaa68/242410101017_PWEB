<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- NAVBAR --}}
        <nav class="navbar">
            <div class="navbar-logo">
                <img src="{{ asset('ikon logo.png') }}" alt="logo" class="logo-img">
                <span class="logo-text">SILOKER</span>
            </div>

            <ul class="navbar-menu">
                <li>
                    <a href="/dashboard"
                        class="{{ request()->is('dashboard') && !request()->hash ? 'active' : '' }}">Dashboard</a>
                </li>

                <li>
                    <a href="{{ route('tentang') }}"
                        class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
                </li>

                <li><a href="/dashboard#loker" class="nav-anchor">Daftar Loker</a></li>
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li><a href="{{ route('penyewa') }}"
                            class="{{ request()->routeIs('penyewa') ? 'active' : '' }}">Penyewa</a></li>
                @endif

                <li>
                    <a href="{{ route('kontak') }}"
                        class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                </li>
            </ul>

            <button class="navbar-toggle" id="navToggle" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>

        {{-- MOBILE MENU --}}
        <div class="navbar-mobile-menu" id="mobileMenu">
            <a href="#dashboard" class="active">Dashboard</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <a href="#loker">Data Loker</a>
            <a href="#penyewa">Data Penyewa</a>
            <a href="{{ route('kontak') }}">Kontak</a>
        </div>

        <!-- Page Heading -->
        {{-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
