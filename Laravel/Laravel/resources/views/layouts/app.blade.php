<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        function deleteCookie(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
        (function() {
            const theme = getCookie('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            const fontSize = getCookie('font_size') || 'medium';
            document.documentElement.classList.add('font-' + fontSize);
        })();
    </script>
</head>

<body class="font-sans antialiased dark:bg-gray-900 transition-colors duration-300">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- NAVBAR --}}
        <nav class="navbar">
            <div class="navbar-logo">
                <img src="{{ asset('ikon logo.png') }}" alt="logo" class="logo-img">
                <span class="logo-text dark:text-white">SILOKER</span>
            </div>

            <ul class="navbar-menu">
                <li><a href="/dashboard"
                        class="{{ request()->is('dashboard') && !request()->hash ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('tentang') }}"
                        class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="/dashboard#loker" class="nav-anchor">Daftar Loker</a></li>

                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li><a href="{{ route('penyewa') }}"
                            class="{{ request()->routeIs('penyewa') ? 'active' : '' }}">Penyewa</a></li>
                @endif

                <li><a href="{{ route('kontak') }}"
                        class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>

                <li><a href="{{ url('preferensi') }}"
                        class="{{ request()->is('preferensi') ? 'active' : '' }}">Preferensi</a></li>
            </ul>

            <div style="display:flex; align-items:center; gap: 12px; margin-left:auto;">
                <button id="darkModeToggle" title="Toggle Dark Mode"
                    style="background:none; border:none; cursor:pointer; font-size:1.25rem;">
                    <span id="icon-sun" style="display:none;">☀️</span>
                    <span id="icon-moon" style="display:none;">🌙</span>
                </button>

                <button class="navbar-toggle" id="navToggle" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>

        {{-- MOBILE MENU --}}
        <div class="navbar-mobile-menu" id="mobileMenu">
            <a href="#dashboard" class="active">Dashboard</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <a href="#loker">Data Loker</a>
            <a href="#penyewa">Data Penyewa</a>
            <a href="{{ route('kontak') }}">Kontak</a>
            <a href="{{ url('preferensi') }}">Pengaturan</a>
        </div>

        <main>
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('darkModeToggle');
            const iconSun = document.getElementById('icon-sun');
            const iconMoon = document.getElementById('icon-moon');


            function updateIcon() {
                if (document.documentElement.classList.contains('dark')) {
                    iconSun.style.display = 'inline';
                    iconMoon.style.display = 'none';
                } else {
                    iconSun.style.display = 'none';
                    iconMoon.style.display = 'inline';
                }
            }
            updateIcon();

            toggleBtn.addEventListener('click', () => {

                document.documentElement.classList.toggle('dark');


                const isDark = document.documentElement.classList.contains('dark');


                setCookie('theme', isDark ? 'dark' : 'light', 365);


                updateIcon();
            });
        });
    </script>
</body>

</html>
