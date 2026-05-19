@extends('layouts.app')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

  /* ── HERO BANNER (Sama dengan Index) ─────────────────────── */
  .mm-hero {
    background: linear-gradient(135deg, #0a1628 0%, #0d2247 50%, #0a3d4a 100%);
    padding: 36px 32px 56px;
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
  .mm-hero::after {
    content: '';
    position: absolute;
    bottom: -40px; left: 2%;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(58,155,213,0.08) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }
  .mm-hero-inner {
    max-width: 800px; /* Dipersempit untuk form */
    margin: 0 auto;
    position: relative;
    z-index: 1;
    text-align: center;
  }
  .mm-hero-label {
    display: inline-block;
    border: 1px solid rgba(62,207,207,0.45);
    border-radius: 20px;
    padding: 4px 16px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #3ecfcf;
    margin-bottom: 12px;
  }
  .mm-hero h1 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 2px;
    text-transform: uppercase;
    line-height: 1;
    margin: 0;
  }
  .mm-hero .sub {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    margin-top: 6px;
    font-family: 'DM Sans', sans-serif;
  }

  /* ── CONTENT AREA & CARD ─────────────────────── */
  .mm-content {
    max-width: 800px; /* Dipersempit agar form tidak terlalu lebar */
    margin: -28px auto 0;
    padding: 0 32px 40px;
    position: relative;
    z-index: 2;
  }
  .mm-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    border: 1px solid #e8edf3;
    padding: 32px;
  }

  /* ── FORM STYLES ─────────────────────── */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  .form-group.full-width {
    grid-column: span 2;
  }
  .form-label {
    display: block;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
  }
  .form-control {
    width: 100%;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 12px 16px;
    color: #1e293b;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: all .2s;
    box-sizing: border-box;
  }
  .form-control:focus {
    border-color: #3ecfcf;
    background: #f0fdfc;
    box-shadow: 0 0 0 3px rgba(62,207,207,0.1);
  }
  .form-control[readonly] {
    background: #e2e8f0;
    color: #64748b;
    cursor: not-allowed;
  }
  .form-control[readonly]:focus {
    border-color: #e2e8f0;
    box-shadow: none;
  }
  .help-text {
    display: block;
    font-family: 'DM Sans', sans-serif;
    font-size: 11px;
    color: #94a3b8;
    margin-top: 6px;
  }

  /* ── ACTION BUTTONS ─────────────────────── */
  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #f1f5f9;
  }
  .btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-family: 'Rajdhani', sans-serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    box-shadow: 0 4px 20px rgba(62,207,207,0.3);
    text-decoration: none;
  }
  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(62,207,207,0.4);
  }
  .btn-cancel {
    display: inline-flex;
    align-items: center;
    padding: 12px 26px;
    background: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    color: #475569;
    font-family: 'Rajdhani', sans-serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    text-decoration: none;
  }
  .btn-cancel:hover {
    background: #f8fafc;
    border-color: #94a3b8;
    color: #1e293b;
  }

  @media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-group.full-width { grid-column: span 1; }
    .mm-hero { padding: 28px 20px 48px; }
    .mm-content { padding: 0 16px 32px; }
    .form-actions { flex-direction: column-reverse; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
  }
</style>

{{-- HERO BANNER --}}
<div class="mm-hero">
  <div class="mm-hero-inner">
    <div class="mm-hero-label">Pembaruan Data</div>
    <h1>Edit Mahasiswa</h1>
    <p class="sub">NIM: {{ $mhs->nim }} — {{ $mhs->nama }}</p>
  </div>
</div>

{{-- CONTENT AREA --}}
<div class="mm-content">
  <div class="mm-card">
    <form action="{{ route('manajemen-mahasiswa.update', $mhs->id) }}" enctype="multipart/form-data" method="POST">
      @csrf 
      @method('PUT')
      
      <div class="form-grid">
        {{-- Field NIM --}}
        <div class="form-group">
          <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
          <input type="text" value="{{ $mhs->nim }}" class="form-control" readonly>
          <span class="help-text">*NIM bersifat permanen dan tidak dapat diubah.</span>
        </div>

        {{-- Field Nama --}}
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" value="{{ $mhs->nama }}" class="form-control" required placeholder="Masukkan nama lengkap...">
        </div>

        {{-- Field Prodi --}}
        <div class="form-group">
          <label class="form-label">Program Studi</label>
          <input type="text" name="prodi" value="{{ $mhs->prodi }}" class="form-control" required placeholder="Contoh: Informatika">
        </div>

        {{-- Field Angkatan --}}
        <div class="form-group">
          <label class="form-label">Tahun Angkatan</label>
          <input type="number" name="angkatan" value="{{ $mhs->angkatan }}" class="form-control" required placeholder="Contoh: 2024">
        </div>

        {{-- Field Email --}}
        <div class="form-group full-width">
          <label class="form-label">Alamat Email Aktif</label>
          <input type="email" name="email" value="{{ $mhs->email }}" class="form-control" required placeholder="mahasiswa@mail.unej.ac.id">
        </div>
      </div>
      {{-- Field Foto Profil --}}
      <div class="form-group full-width">
        <label class="form-label">Foto Profil</label>
        <div class="mb-3">
          @if(isset($mhs) && $mhs->foto)
            <img id="preview-foto" src="{{ asset('storage/' . $mhs->foto) }}" class="w-32 h-32 object-cover rounded-lg border-2 border-pink-200">
          @else
            <img id="preview-foto" src="{{ asset('images/default-avatar.png') }}" class="w-32 h-32 object-cover rounded-lg border-2 border-dashed border-gray-300">
          @endif
        </div>
        <input type="file" name="foto" id="input-foto" 
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100"
               accept="image/png, image/jpeg">
        @error('foto')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Action Buttons --}}
      <div class="form-actions">
        <a href="{{ route('manajemen-mahasiswa.index') }}" class="btn-cancel">Batal</a>
        <button type="submit" class="btn-submit">
          <i class="fas fa-save"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

