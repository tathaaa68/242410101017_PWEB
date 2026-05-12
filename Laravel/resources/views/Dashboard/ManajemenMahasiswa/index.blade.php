@extends('layouts.app')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

  /* ── HERO BANNER ─────────────────────── */
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
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
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
  }
  .stat-pills { display: flex; gap: 8px; margin-top: 14px; flex-wrap: wrap; }
  .stat-pill {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(62,207,207,0.2);
    border-radius: 20px;
    padding: 5px 14px;
    font-size: 12px;
    color: rgba(255,255,255,0.55);
  }
  .stat-pill strong { color: #3ecfcf; font-weight: 600; }

  .btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-family: 'Rajdhani', sans-serif;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    box-shadow: 0 4px 20px rgba(62,207,207,0.3);
    text-decoration: none;
    align-self: center;
  }
  .btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(62,207,207,0.4);
    color: #fff;
  }

  /* ── CONTENT AREA ─────────────────────── */
  .mm-content {
    max-width: 1100px;
    margin: -28px auto 0;
    padding: 0 32px 40px;
    position: relative;
    z-index: 2;
  }

  .mm-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e8edf3;
  }

  /* ── TOOLBAR ─────────────────────── */
  .mm-toolbar {
    padding: 16px 24px;
    border-bottom: 1px solid #f0f4f8;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    background: #fafbfd;
  }
  .mm-search-wrap { position: relative; flex: 1; min-width: 200px; }
  .mm-search-wrap i {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
  }
  .mm-search-wrap input {
    width: 100%;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 9px 14px 9px 36px;
    color: #1e293b;
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: all .2s;
  }
  .mm-search-wrap input::placeholder { color: #94a3b8; }
  .mm-search-wrap input:focus {
    border-color: #3ecfcf;
    background: #f0fdfc;
    box-shadow: 0 0 0 3px rgba(62,207,207,0.1);
  }
  .mm-filter-sel {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 9px 14px;
    color: #475569;
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    appearance: none;
    cursor: pointer;
    transition: all .2s;
    min-width: 140px;
  }
  .mm-filter-sel:focus { border-color: #3ecfcf; }
  .mm-filter-sel option { background: #fff; color: #1e293b; }

  /* ── TABLE ─────────────────────── */
  .mm-table-wrap { overflow-x: auto; }
  .mm-table { width: 100%; border-collapse: collapse; }
  .mm-table thead tr { background: #f8fafc; border-bottom: 2px solid #e2e8f0; }
  .mm-table thead th {
    padding: 13px 20px;
    font-family: 'Rajdhani', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #64748b;
    white-space: nowrap;
    text-align: left;
  }
  .mm-table thead th:last-child { text-align: center; }
  .mm-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background .15s;
    animation: rowIn .3s ease both;
  }
  .mm-table tbody tr:last-child { border-bottom: none; }
  .mm-table tbody tr:hover { background: #f8fdfc; }
  .mm-table td { padding: 14px 20px; font-size: 14px; vertical-align: middle; }

  .mm-table tbody tr:nth-child(1) { animation-delay: .03s; }
  .mm-table tbody tr:nth-child(2) { animation-delay: .06s; }
  .mm-table tbody tr:nth-child(3) { animation-delay: .09s; }
  .mm-table tbody tr:nth-child(4) { animation-delay: .12s; }
  .mm-table tbody tr:nth-child(5) { animation-delay: .15s; }
  @keyframes rowIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .row-num { color: #cbd5e1; font-size: 13px; }
  .nim-badge { font-family: 'Rajdhani', sans-serif; font-size: 14px; font-weight: 700; color: #0d2247; letter-spacing: .5px; }
  .nama-text { color: #1e293b; font-weight: 500; }
  .prodi-chip {
    display: inline-block;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 20px;
    padding: 3px 12px;
    font-size: 12px;
    color: #2563eb;
    font-weight: 500;
    white-space: nowrap;
  }
  .email-text { color: #94a3b8; font-size: 13px; }
  .angkatan-badge {
    display: inline-block;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 2px 10px;
    font-size: 12px;
    color: #16a34a;
    font-weight: 600;
    font-family: 'Rajdhani', sans-serif;
    letter-spacing: .5px;
  }

  /* ── ACTION BUTTONS ─────────────────────── */
  .mm-actions { display: flex; justify-content: center; gap: 6px; flex-wrap: wrap; }
  .btn-act {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid;
    transition: all .18s;
    text-decoration: none;
    white-space: nowrap;
    font-family: 'DM Sans', sans-serif;
    background: transparent;
  }
  .btn-view { color: #2563eb; border-color: #bfdbfe; background: #eff6ff; }
  .btn-view:hover { background: #dbeafe; border-color: #93c5fd; color: #1d4ed8; }
  .btn-edit { color: #d97706; border-color: #fde68a; background: #fffbeb; }
  .btn-edit:hover { background: #fef3c7; border-color: #fcd34d; color: #b45309; }
  .btn-del { color: #dc2626; border-color: #fecaca; background: #fef2f2; }
  .btn-del:hover { background: #fee2e2; border-color: #fca5a5; color: #b91c1c; }

  /* ── EMPTY STATE ─────────────────────── */
  .empty-state { padding: 56px 20px; text-align: center; }
  .empty-state i { font-size: 36px; color: #cbd5e1; display: block; margin-bottom: 10px; }
  .empty-state p { color: #94a3b8; font-size: 14px; font-style: italic; }

  /* ── FOOTER / PAGINATION ─────────────────────── */
  .mm-footer {
    padding: 14px 24px;
    border-top: 1px solid #f1f5f9;
    background: #fafbfd;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
  }
  .mm-footer-info { font-size: 12px; color: #94a3b8; }
  .mm-pagination { display: flex; gap: 4px; }
  .pg-btn {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    color: #64748b;
    font-size: 13px;
    cursor: pointer;
    transition: all .18s;
    text-decoration: none;
    font-family: 'DM Sans', sans-serif;
  }
  .pg-btn:hover { border-color: #3ecfcf; color: #0d9488; background: #f0fdfc; }
  .pg-btn.active {
    background: linear-gradient(135deg, #1a6b7a, #3ecfcf);
    border-color: transparent;
    color: #fff;
    font-weight: 700;
  }

  @media (max-width: 700px) {
    .mm-hero { padding: 28px 20px 48px; }
    .mm-content { padding: 0 16px 32px; }
    .mm-hero-inner { flex-direction: column; }
    .btn-add { width: 100%; justify-content: center; }
  }
</style>

{{-- HERO BANNER --}}
<div class="mm-hero">
    <div class="flex justify-end max-w-[1100px] mx-auto mb-4">
        <div class="flex items-center gap-2 text-white/70 text-xs font-semibold bg-white/10 px-4 py-2 rounded-full border border-white/10">
            <i class="fas fa-user-circle text-cyan-400"></i>
            <span>Halo, {{ auth()->user()->name }}</span>
        </div>
    ...
</div>
  <div class="mm-hero-inner">
    <div>
      <div class="mm-hero-label">Manajemen Data</div>
      <h1>Manajemen Mahasiswa</h1>
      <p class="sub">Universitas Jember · Fakultas Ilmu Komputer</p>
      <div class="stat-pills">
        <div class="stat-pill"><strong>{{ $mahasiswa->total() }}</strong>&nbsp;Total Mahasiswa</div>
        <div class="stat-pill"><strong>{{ \App\Models\Mahasiswa::distinct('prodi')->count('prodi') }}</strong>&nbsp;Prodi Aktif</div>
        <div class="stat-pill"><strong>{{ \App\Models\Mahasiswa::max('angkatan') }}</strong>&nbsp;Angkatan Terbaru</div>
      </div>
    </div>
    <a href="{{ route('manajemen-mahasiswa.create') }}" class="btn-add">
      <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>
  </div>
</div>

{{-- CONTENT AREA --}}
<div class="mm-content">
  <div class="mm-card">

    {{-- Toolbar --}}
    <div class="mm-toolbar">
      <div class="mm-search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Cari NIM, nama, atau email...">
      </div>
      <select class="mm-filter-sel">
        <option value="">Semua Prodi</option>
        <option>Informatika</option>
        <option>Sistem Informasi</option>
        <option>Teknik Elektro</option>
      </select>
      <select class="mm-filter-sel">
        <option value="">Semua Angkatan</option>
        <option>2024</option>
        <option>2023</option>
        <option>2022</option>
      </select>
    </div>

    {{-- Table --}}
    <div class="mm-table-wrap">
      <table class="mm-table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Email</th>
            <th>Angkatan</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($mahasiswa as $index => $mhs)
          <tr>
            <td><span class="row-num">{{ str_pad($mahasiswa->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}</span></td>
            <td><span class="nim-badge">{{ $mhs->nim }}</span></td>
            <td><span class="nama-text">{{ $mhs->nama }}</span></td>
            <td><span class="prodi-chip">{{ $mhs->prodi }}</span></td>
            <td><span class="email-text">{{ $mhs->email }}</span></td>
            <td><span class="angkatan-badge">{{ $mhs->angkatan }}</span></td>
            <td>
              @if($mhs->foto)
                <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto Profil" class="w-16 h-16 object-cover rounded-lg">
              @else
                <img src="{{ asset('images/default-avatar.png') }}" alt="Foto Profil" class="w-16 h-16 object-cover rounded-lg">
              @endif
            </td>
            <td>
              <div class="mm-actions">
                <a href="{{ route('manajemen-mahasiswa.show', $mhs->id) }}" class="btn-act btn-view">
                  <i class="fas fa-eye"></i> Lihat
                </a>
                <a href="{{ route('manajemen-mahasiswa.edit', $mhs->id) }}" class="btn-act btn-edit">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('manajemen-mahasiswa.destroy', $mhs->id) }}" method="POST"
                  onsubmit="return confirm('Hapus mahasiswa ini?')" style="display:inline">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-act btn-del">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <i class="fas fa-user-graduate"></i>
                <p>Belum ada data mahasiswa terdaftar.</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Footer & Pagination --}}
    <div class="mm-footer">
      <span class="mm-footer-info">
        Menampilkan {{ $mahasiswa->firstItem() }}–{{ $mahasiswa->lastItem() }}
        dari {{ $mahasiswa->total() }} data mahasiswa
      </span>
      <div class="mm-pagination">
        <a href="{{ $mahasiswa->previousPageUrl() ?? '#' }}" class="pg-btn">
          <i class="fas fa-chevron-left"></i>
        </a>
        @for($i = 1; $i <= $mahasiswa->lastPage(); $i++)
        <a href="{{ $mahasiswa->url($i) }}"
          class="pg-btn {{ $mahasiswa->currentPage() == $i ? 'active' : '' }}">
          {{ $i }}
        </a>
        @endfor
        <a href="{{ $mahasiswa->nextPageUrl() ?? '#' }}" class="pg-btn">
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
    </div>

  </div>
</div>
@endsection