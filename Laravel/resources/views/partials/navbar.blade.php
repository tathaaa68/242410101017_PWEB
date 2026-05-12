<!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="{{ asset('ikon logo.png') }}" alt="logo" class="logo-img">
            <span class="logo-text">SILOKER</span>
        </div>
        <ul class="navbar-menu">
            <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="/dashboard#loker">Daftar Loker</a></li>
            <li><a href="/dashboard#transaksi">Transaksi</a></li>
            <li><a href="/dashboard#penyewa">Penyewa</a></li>
            <li><a href="{{ route('manajemen-mahasiswa.index') }}"class="{{ request()->is('manajemen-mahasiswa*') ? 'active' : '' }}">Manajemen Mahasiswa</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
        </ul>
        <button class="navbar-toggle" id="navToggle" type="button" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </nav>
