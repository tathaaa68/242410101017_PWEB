@extends('layouts.app')

@section('title', 'Kontak – Sistem Informasi Loker Kampus')

@section('content')
<section class="hero" id="contact-hero">
    <div class="hero-badge">Hubungi Kami</div>
    <h1>Kontak SILOKER</h1>
    <h2>Kami Siap Membantu Anda</h2>
    <p>Memiliki kendala teknis, pertanyaan seputar penyewaan, atau ingin memberikan saran? 
       Tim administrasi SILOKER siap melayani Anda setiap hari kerja.</p>
    
    <div class="hero-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
        <x-stat-card 
            judul="Email Resmi" 
            nilai="rpl@unej.ac.id" 
            ikon="bi-envelope-at" 
            warna="#ffffff" 
        />
        <x-stat-card 
            judul="Telepon" 
            nilai="(0331) 330224" 
            ikon="bi-telephone" 
            warna="#ffc107" 
        />
        <x-stat-card 
            judul="Jam Layanan" 
            nilai="08:00 - 16:00" 
            ikon="bi-clock" 
            warna="#28a745" 
        />
    </div>
</section>

<div class="content-area">
    <aside class="sidebar">
        <div class="sidebar-content" id="sidebarContent" style="display: block;">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Lokasi Kantor</div>
                <div class="filter-item" style="padding: 10px; font-size: 0.9rem; line-height: 1.6;">
                    <i class="bi bi-geo-alt-fill" style="color: var(--blue-primary);"></i><br>
                    <strong>Gedung Fasilkom</strong><br>
                    Jl. Kalimantan No. 37, Kampus Tegalboto, Jember, Jawa Timur.
                </div>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
                <div class="sidebar-section-title">Media Sosial</div>
                <div style="display: flex; gap: 10px; padding: 10px;">
                    <a href="#" style="font-size: 1.5rem; color: #333;"><i class="bi bi-instagram"></i></a>
                    <a href="#" style="font-size: 1.5rem; color: #333;"><i class="bi bi-linkedin"></i></a>
                    <a href="#" style="font-size: 1.5rem; color: #333;"><i class="bi bi-globe"></i></a>
                </div>
            </div>
        </div>
    </aside>

    <main>
        <!-- Form Kontak -->
        <div class="form-card">
            <div class="section-heading" style="margin-bottom:24px">
                <h3 class="section-title">Kirim Pesan Langsung</h3>
                <span class="section-subtitle">Gunakan formulir di bawah ini untuk menghubungi administrator</span>
            </div>

            <form id="form-pesan">
                <div class="form-grid">
                    <p>
                        <label for="namaLengkap">Nama Lengkap *</label>
                        <input type="text" id="namaLengkap" name="namaLengkap" placeholder="Masukkan nama Anda" required />
                    </p>
                    <p>
                        <label for="emailUser">Alamat Email *</label>
                        <input type="email" id="emailUser" name="emailUser" placeholder="contoh@mail.com" required />
                    </p>
                    <p style="grid-column: 1 / -1;">
                        <label for="subjekPesan">Subjek</label>
                        <select id="subjekPesan" name="subjekPesan">
                            <option value="kendala">Kendala Teknis Loker</option>
                            <option value="pembayaran">Masalah Pembayaran</option>
                            <option value="saran">Kritik & Saran</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </p>
                    <p style="grid-column: 1 / -1;">
                        <label for="isiPesan">Pesan Anda *</label>
                        <textarea id="isiPesan" name="isiPesan" rows="5" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; font-family: inherit;" required placeholder="Tuliskan pesan Anda secara detail..."></textarea>
                    </p>
                </div>
                <div class="form-actions" style="margin-top: 20px;">
                    <button type="submit" class="btn-submit" style="background: var(--blue-primary); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-send"></i> Kirim Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Google Maps Embed (Opsional) -->
        <div class="table-card" style="margin-top: 30px; overflow: hidden;">
            <div class="table-card-header">
                <span class="table-card-title">Peta Lokasi</span>
            </div>
            <div style="width: 100%; height: 300px; background: #eee;">
                <!-- Anda bisa mengganti ini dengan iframe Google Maps asli -->
                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #888;">
                    <p><i class="bi bi-map"></i> Integrasi Google Maps di sini</p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection