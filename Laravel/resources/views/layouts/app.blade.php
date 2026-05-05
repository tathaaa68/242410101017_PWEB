<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SILOKER — Sistem Informasi Penyewaan Loker Kampus Universitas Jember" />
    <title>@yield('title', 'SILOKER – Sistem Informasi Loker Kampus')</title>
    
    <link rel="icon" href="{{ asset('ikon logo.png') }}">
    <!-- Load custom style.css jika masih digunakan selain Tailwind -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.navbar')
    <div>
            @if(session('success'))
            <div class="alert-success" style="
                background-color: #d4edda;
                color: #155724;
                padding: 15px;
                border-radius: 8px;
                margin: 20px;
                border-left: 5px solid #28a745;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-weight: 500;
                box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            ">
                <span>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </span>
                <button onclick="this.parentElement.style.display='none'" style="
                    background: none;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                    color: #155724;
                ">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-danger" style="
                background-color: #f8d7da;
                color: #721c24;
                padding: 15px;
                border-radius: 8px;
                margin: 20px;
                border-left: 5px solid #dc3545;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-weight: 500;
            ">
                <span>
                    <strong>Gagal!</strong> {{ session('error') }}
                </span>
                <button onclick="this.parentElement.style.display='none'" style="
                    background: none;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                    color: #721c24;
                ">&times;</button>
            </div>
        @endif
    <!-- Global UI Elements -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="modal-overlay" id="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--blue-dark)">Detail Loker</span>
                <button class="modal-tutup" id="modal-tutup" type="button" title="Tutup">✕</button>
            </div>
            <div id="modal-isi"></div>
        </div>
    </div>

    <div class="notif-box" id="notif-box"></div>

    <!-- Mobile Menu -->
    <div class="navbar-mobile-menu" id="mobileMenu">
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('tentang') }}">Tentang</a>
        <a href="#loker">Data Loker</a>
        <a href="#transaksi">Transaksi Penyewaan</a>
        <a href="#penyewa">Data Penyewa</a>
    </div>

    <!-- Main Content Area -->
    <div class="page-body">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('script.js') }}"></script>
    @stack('scripts')
</body>
</html>