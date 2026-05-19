@extends('layouts.app')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

  /* ── HERO BANNER (Versi Minimal) ─────────────────────── */
  .mm-hero {
    background: linear-gradient(135deg, #0a1628 0%, #0d2247 50%, #0a3d4a 100%);
    padding: 36px 32px 70px; /* Padding bawah dilebihkan untuk overlap card */
    position: relative;
    overflow: hidden;
  }
  .mm-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: 5%;
    width: 340px; height: 340px;
    background: radial-gradient(circle, rgba(62,207,207,0.09) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }
  .mm-hero-inner {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    text-align: center;
  }
  .mm-hero h1 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin: 0;
  }

  /* ── PROFILE CARD ─────────────────────── */
  .mm-content-profile {
    max-width: 480px; /* Card dibuat compact agar fokus */
    margin: -40px auto 40px;
    padding: 0 20px;
    position: relative;
    z-index: 2;
  }
  .profile-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    overflow: hidden;
    border: 1px solid #e8edf3;
  }
  
  /* ── PROFILE HEADER ─────────────────────── */
  .profile-header {
    background: #0d2247;
    padding: 40px 32px 32px;
    text-align: center;
    position: relative;
  }
  .profile-header::after {
    content: '';
    position: absolute;
    top: 0; right: 0; left: 0; bottom: 0;
    background: radial-gradient(circle at top left, rgba(62,207,207,0.1), transparent 60%);
    pointer-events: none;
  }
  .profile-avatar {
    width: 96px;
    height: 96px;
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    border-radius: 50%;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 8px 24px rgba(62,207,207,0.4);
    border: 4px solid rgba(255,255,255,0.1);
    position: relative;
    z-index: 1;
  }
  .profile-name {
    font-family: 'Rajdhani', sans-serif;
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    line-height: 1.2;
    position: relative;
    z-index: 1;
  }
  .profile-nim {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: #3ecfcf;
    font-weight: 500;
    margin-top: 6px;
    letter-spacing: 1px;
    position: relative;
    z-index: 1;
  }

  /* ── PROFILE BODY ─────────────────────── */
  .profile-body {
    padding: 32px;
  }
  .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px dashed #e2e8f0;
  }
  .info-row:last-of-type {
    border-bottom: none;
  }
  .info-label {
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .info-label i {
    color: #94a3b8;
    font-size: 14px;
    width: 16px;
    text-align: center;
  }
  .info-value {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: #1e293b;
    font-weight: 600;
    text-align: right;
  }
  .info-value.email-text {
    color: #0d9488;
    font-size: 14px;
  }
  .info-value.prodi-chip {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    padding: 4px 12px;
    color: #2563eb;
    font-size: 13px;
  }

  /* ── ACTION BUTTON ─────────────────────── */
  .profile-actions {
    margin-top: 24px;
  }
  .btn-back-full {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 14px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    color: #475569;
    font-family: 'Rajdhani', sans-serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all .2s;
  }
  .btn-back-full:hover {
    background: #e2e8f0;
    color: #1e293b;
    border-color: #cbd5e1;
    transform: translateY(-2px);
  }
</style>

{{-- HERO BANNER --}}
<div class="mm-hero">
  <div class="mm-hero-inner">
    <h1>Profil Mahasiswa</h1>
  </div>
</div>

{{-- CONTENT AREA --}}
<div class="mm-content-profile">
  <div class="profile-card">
    
    {{-- Bagian Atas / Header Profil --}}
    <div class="profile-header">
      <div class="profile-avatar">
        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
      </div>
      <h2 class="profile-name">{{ $mhs->nama }}</h2>
      <div class="profile-nim">{{ $mhs->nim }}</div>
    </div>

    {{-- Bagian Bawah / Detail Informasi --}}
    <div class="profile-body">
      
      <div class="info-row">
        <span class="info-label"><i class="fas fa-graduation-cap"></i> Program Studi</span>
        <span class="info-value prodi-chip">{{ $mhs->prodi }}</span>
      </div>

      <div class="info-row">
        <span class="info-label"><i class="fas fa-calendar-alt"></i> Tahun Angkatan</span>
        <span class="info-value">{{ $mhs->angkatan ?? '-' }}</span>
      </div>
      
      <div class="info-row">
        <span class="info-label"><i class="fas fa-envelope"></i> Alamat Email</span>
        <span class="info-value email-text">{{ $mhs->email }}</span>
      </div>
      
      <div class="info-row">
        <span class="info-label"><i class="fas fa-phone-alt"></i> No. Handphone</span>
        <span class="info-value">{{ $mhs->no_hp ?? '-' }}</span>
      </div>

      {{-- Tombol Kembali --}}
      <div class="profile-actions">
        <a href="{{ route('manajemen-mahasiswa.index') }}" class="btn-back-full">
          <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
      </div>

    </div>
  </div>
</div>
@endsection