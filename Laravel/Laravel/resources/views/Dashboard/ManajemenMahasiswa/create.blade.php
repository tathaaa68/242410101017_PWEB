@extends('layouts.app')

@section('content')
<style>

@import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

  /* ── HERO ─────────────────────── */
  .create-hero {
    background: linear-gradient(135deg, #0a1628 0%, #0d2247 50%, #0a3d4a 100%);
    padding: 32px 32px 52px;
    position: relative;
    overflow: hidden;
  }
  .create-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: 5%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(62,207,207,0.08) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }
  .create-hero-inner {
    max-width: 860px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .c-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 13px;
  }
  .c-breadcrumb a { color: #3ecfcf; text-decoration: none; }
  .c-breadcrumb a:hover { color: #7de8e8; }
  .c-breadcrumb .sep { color: rgba(255,255,255,0.25); }
  .c-breadcrumb .cur { color: rgba(255,255,255,0.65); }

  .hero-label {
    display: inline-block;
    border: 1px solid rgba(62,207,207,0.4);
    border-radius: 20px;
    padding: 4px 16px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #3ecfcf;
    margin-bottom: 10px;
  }
  .create-hero-inner h1 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 2px;
    text-transform: uppercase;
    line-height: 1;
    margin: 0;
  }
  .create-hero-inner .sub {
    font-size: 13px;
    color: rgba(255,255,255,0.4);
    margin-top: 5px;
  }

  /* ── CONTENT AREA ─────────────────────── */
  .create-content {
    max-width: 860px;
    margin: -24px auto 0;
    padding: 0 32px 40px;
    position: relative;
    z-index: 2;
  }

  .create-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e8edf3;
  }

  /* ── CARD HEADER ─────────────────────── */
  .create-card-header {
    padding: 24px 32px;
    border-bottom: 1px solid #f1f5f9;
    background: #fafbfd;
    display: flex;
    align-items: center;
    gap: 16px;
  }
  .ch-icon {
    width: 46px; height: 46px;
    background: linear-gradient(135deg, #eff6ff, #f0fdfc);
    border: 1px solid #bfdbfe;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .ch-text h2 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0d2247;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0;
  }
  .ch-text p { font-size: 12px; color: #94a3b8; margin: 2px 0 0; }
  .ch-badge {
    margin-left: auto;
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    color: #fff;
    font-family: 'Rajdhani', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 20px;
  }

  /* ── CARD BODY ─────────────────────── */
  .create-card-body { padding: 28px 32px 24px; }

  .section-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #0d9488;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #ccfbf1, transparent);
  }

  .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
  .col-full { grid-column: 1 / -1; }
  .field { display: flex; flex-direction: column; gap: 7px; }

  .field label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 0;
  }

  .field-wrap { position: relative; }
  .field-wrap .f-icon {
    position: absolute;
    left: 13px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 15px;
    pointer-events: none;
    transition: color .2s;
  }

  .field-wrap input,
  .field-wrap select {
    width: 100%;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 11px;
    padding: 11px 14px 11px 40px;
    color: #1e293b;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: all .2s;
    appearance: none;
  }
  .field-wrap input::placeholder { color: #cbd5e1; }
  .field-wrap input:focus,
  .field-wrap select:focus {
    border-color: #3ecfcf;
    background: #f0fdfc;
    box-shadow: 0 0 0 3px rgba(62,207,207,0.12);
  }
  .field-wrap:focus-within .f-icon { color: #0d9488; }
  .field-wrap select { cursor: pointer; }
  .field-wrap select option { background: #fff; color: #1e293b; }

  .chevron-icon {
    position: absolute;
    right: 13px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    pointer-events: none;
    font-size: 13px;
  }

  .field-hint { font-size: 11px; color: #94a3b8; margin-top: -3px; }
  .field-error { font-size: 11px; color: #ef4444; margin-top: -3px; }

  /* ── CARD FOOTER ─────────────────────── */
  .create-card-footer {
    padding: 20px 32px;
    border-top: 1px solid #f1f5f9;
    background: #fafbfd;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }
  .footer-note {
    font-size: 12px;
    color: #94a3b8;
    display: flex; align-items: center; gap: 6px;
  }
  .footer-note i { color: #3ecfcf; }
  .btn-group { display: flex; gap: 10px; align-items: center; }

  .btn-cancel {
    padding: 9px 22px;
    background: transparent;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    color: #64748b;
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
  }
  .btn-cancel:hover { border-color: #94a3b8; color: #334155; background: #f1f5f9; }

  .btn-submit {
    padding: 10px 28px;
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 14px;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 4px 16px rgba(62,207,207,0.3);
  }
  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(62,207,207,0.4);
    color: #fff;
  }

  @media (max-width: 600px) {
    .create-hero { padding: 28px 20px 48px; }
    .create-content { padding: 0 16px 32px; }
    .form-grid { grid-template-columns: 1fr; }
    .col-full { grid-column: 1; }
    .create-card-header, .create-card-body, .create-card-footer { padding-left: 20px; padding-right: 20px; }
    .ch-badge { display: none; }
    .create-card-footer { flex-direction: column; align-items: stretch; }
    .btn-group { flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
  }
</style>

{{-- HERO --}}
<div class="create-hero">
  <div class="create-hero-inner">
    <div class="c-breadcrumb">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <span class="sep">›</span>
      <a href="{{ route('manajemen-mahasiswa.index') }}">Manajemen Mahasiswa</a>
      <span class="sep">›</span>
      <span class="cur">Tambah Baru</span>
    </div>
    <div class="hero-label">Manajemen Data</div>
    <h1>Tambah Mahasiswa Baru</h1>
    <p class="sub">Universitas Jember · Fakultas Ilmu Komputer</p>
  </div>
</div>

{{-- CONTENT --}}
<div class="create-content">
  <div class="create-card">

    {{-- Header --}}
    <div class="create-card-header">
      <div class="ch-icon">🎓</div>
      <div class="ch-text">
        <h2>Data Mahasiswa</h2>
        <p>Isi semua kolom yang diperlukan dengan benar</p>
      </div>
      <div class="ch-badge">SILOKER</div>
    </div>

    {{-- Form --}}
    <form action="{{ route('manajemen-mahasiswa.store') }}" enctype="multipart/form-data" method="POST">
      @csrf
      <div class="create-card-body">
        <div class="section-label">Identitas Mahasiswa</div>
        <div class="form-grid">

          {{-- NIM --}}
          <div class="field">
            <label for="nim">NIM</label>
            <div class="field-wrap">
              <i class="fas fa-id-card f-icon"></i>
              <input type="text" id="nim" name="nim"
                placeholder="242410101xxx"
                value="{{ old('nim') }}" required>
            </div>
            @error('nim')<span class="field-error">{{ $message }}</span>@enderror
            <span class="field-hint">Nomor Induk Mahasiswa aktif</span>
          </div>

          {{-- Nama --}}
          <div class="field">
            <label for="nama">Nama Lengkap</label>
            <div class="field-wrap">
              <i class="fas fa-user f-icon"></i>
              <input type="text" id="nama" name="nama"
                placeholder="Masukkan nama lengkap..."
                value="{{ old('nama') }}" required>
            </div>
            @error('nama')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          {{-- Prodi --}}
          <div class="field">
            <label for="prodi">Program Studi</label>
            <div class="field-wrap">
              <i class="fas fa-book f-icon"></i>
              <select id="prodi" name="prodi" required>
                <option value="" disabled {{ old('prodi') ? '' : 'selected' }}>Pilih program studi...</option>
                <option value="Informatika"     {{ old('prodi') == 'Informatika'     ? 'selected' : '' }}>Informatika</option>
                <option value="Sistem Informasi"{{ old('prodi') == 'Sistem Informasi'? 'selected' : '' }}>Sistem Informasi</option>
                <option value="Teknik Elektro"  {{ old('prodi') == 'Teknik Elektro'  ? 'selected' : '' }}>Teknik Elektro</option>
                <option value="Ilmu Komputer"   {{ old('prodi') == 'Ilmu Komputer'   ? 'selected' : '' }}>Ilmu Komputer</option>
              </select>
              <span class="chevron-icon">▾</span>
            </div>
            @error('prodi')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          {{-- Angkatan --}}
          <div class="field">
            <label for="angkatan">Angkatan</label>
            <div class="field-wrap">
              <i class="fas fa-calendar f-icon"></i>
              <input type="number" id="angkatan" name="angkatan"
                placeholder="2024"
                value="{{ old('angkatan', 2024) }}"
                min="2000" max="2099" required>
            </div>
            @error('angkatan')<span class="field-error">{{ $message }}</span>@enderror
            <span class="field-hint">Tahun masuk mahasiswa</span>
          </div>

          {{-- Email --}}
          <div class="field col-full">
            <label for="email">Email Universitas</label>
            <div class="field-wrap">
              <i class="fas fa-envelope f-icon"></i>
              <input type="email" id="email" name="email"
                placeholder="nim@mail.unej.ac.id"
                value="{{ old('email') }}" required>
            </div>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
            <span class="field-hint">Gunakan email resmi @mail.unej.ac.id</span>
          </div>

          {{-- Foto Profil --}}
          <div class="field col-full">
            <label for="foto">Foto Profil</label>
            <div class="field-wrap">
              <input type="file" id="foto" name="foto" required accept="image/png, image/jpeg, image/webp">
            </div>
            @error('foto')<span class="field-error">{{ $message }}</span>@enderror
          </div>

        </div>
      </div>

      {{-- Footer --}}
      <div class="create-card-footer">
        <div class="footer-note">
          <i class="fas fa-lock"></i> Semua data tersimpan dengan aman
        </div>
        <div class="btn-group">
          <a href="{{ route('manajemen-mahasiswa.index') }}" class="btn-cancel">
            <i class="fas fa-arrow-left"></i> Batal
          </a>
          <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Simpan Data
          </button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection

