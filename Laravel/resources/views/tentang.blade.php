@extends('layouts.app')

@section('title', 'Tentang – Sistem Informasi Loker Kampus')

@section('content')
<section class="hero" id="about-hero">
    <div class="hero-badge">Visi & Misi SILOKER</div>
    <h1>Tentang Kami</h1>
    <h2>Mendigitalkan Fasilitas Kampus</h2>
    <p>SILOKER adalah inisiatif digital dari Fakultas Ilmu Komputer Universitas Jember untuk mempermudah 
       mahasiswa dalam mengakses fasilitas penyimpanan yang aman dan terorganisir.</p>
    
    <div class="hero-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
        <x-stat-card 
            judul="Tahun Berdiri" 
            :nilai="2024" 
            ikon="bi-calendar-event" 
            warna="#ffffff" 
        />
        <x-stat-card 
            judul="Gedung Terintegrasi" 
            :nilai="5" 
            ikon="bi-building" 
            warna="#ffc107" 
        />
        <x-stat-card 
            judul="Kepuasan Pengguna" 
            :nilai="98" 
            ikon="bi-star-fill" 
            warna="#28a745" 
        />
    </div>
</section>

<div class="content-area">
    <aside class="sidebar">
        <div class="sidebar-content" id="sidebarContent" style="display: block;">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Navigasi Halaman</div>
                <a href="#latar-belakang" class="filter-item" style="text-decoration: none; color: inherit; display: flex; align-items: center; padding: 10px;">
                    <span class="filter-label">📖 Latar Belakang</span>
                </a>
                <a href="#fitur-unggulan" class="filter-item" style="text-decoration: none; color: inherit; display: flex; align-items: center; padding: 10px;">
                    <span class="filter-label">🚀 Fitur Unggulan</span>
                </a>
                <a href="#tim-pengembang" class="filter-item" style="text-decoration: none; color: inherit; display: flex; align-items: center; padding: 10px;">
                    <span class="filter-label">👥 Tim Pengembang</span>
                </a>
            </div>
        </div>
    </aside>

    <main>
        <!-- Latar Belakang Section -->
        <div class="table-card" id="latar-belakang" style="margin-bottom: 30px;">
            <div class="table-card-header">
                <span class="table-card-title">Latar Belakang</span>
            </div>
            <div style="padding: 25px; line-height: 1.8; color: #444;">
                <p>Sistem Informasi Loker Kampus (SILOKER) lahir dari kebutuhan akan transparansi dan efisiensi dalam pengelolaan aset kampus. Sebelumnya, proses peminjaman loker dilakukan secara manual yang sering kali menyebabkan ketidakpastian status ketersediaan.</p>
                <p>Dengan SILOKER, setiap civitas akademika dapat memantau, memesan, dan mengelola penyewaan loker hanya dalam beberapa klik, memastikan barang bawaan aman selama kegiatan perkuliahan berlangsung.</p>
            </div>
        </div>

        <!-- Fitur Unggulan Grid -->
        <div class="section-heading">
            <h3 class="section-title">Fitur Unggulan</h3>
            <span class="section-subtitle">Teknologi yang kami gunakan untuk melayani Anda</span>
        </div>

        <div class="loker-grid" id="fitur-unggulan" style="margin-bottom: 40px;">
            <div class="loker-card">
                <div class="loker-card-body">
                    <h4 style="color: var(--blue-primary); margin-bottom: 10px;">Real-Time Tracking</h4>
                    <p style="font-size: 0.9rem;">Status loker (Tersedia, Disewa, Maintenance) diperbarui secara instan saat terjadi transaksi.</p>
                </div>
            </div>
            <div class="loker-card">
                <div class="loker-card-body">
                    <h4 style="color: var(--blue-primary); margin-bottom: 10px;">Manajemen Terpusat</h4>
                    <p style="font-size: 0.9rem;">Memudahkan pengelola gedung dalam mengatur harga, ukuran, dan lokasi loker secara digital.</p>
                </div>
            </div>
            <div class="loker-card">
                <div class="loker-card-body">
                    <h4 style="color: var(--blue-primary); margin-bottom: 10px;">Dashboard Analitik</h4>
                    <p style="font-size: 0.9rem;">Menyediakan statistik penggunaan loker untuk pengambilan keputusan pimpinan fakultas.</p>
                </div>
            </div>
        </div>

        <!-- Tim Pengembang Section -->
        <div class="form-card" id="tim-pengembang">
            <div class="section-heading" style="margin-bottom:16px">
                <h3 class="section-title">Tim Pengembang</h3>
            </div>
            <div style="display: flex; gap: 20px; align-items: center; padding: 10px;">
                <div style="width: 80px; height: 80px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    🏛️
                </div>
                <div>
                    <h4 style="margin: 0;">Lab Rekayasa Perangkat Lunak</h4>
                    <p style="margin: 5px 0; color: #666;">Fakultas Ilmu Komputer - Universitas Jember</p>
                    <p style="font-size: 0.85rem; font-style: italic;">"Developing solutions for a better campus experience."</p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection