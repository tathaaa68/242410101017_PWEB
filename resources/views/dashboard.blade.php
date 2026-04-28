<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="SILOKER — Sistem Informasi Penyewaan Loker Kampus Universitas Jember" />
  <title>SILOKER – Sistem Informasi Loker Kampus</title>
  <link rel="icon" href="ikon logo.png">
  <link rel="stylesheet" href="style.css">
 @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
  <div class="loading-overlay" id="loading-overlay">
    <div class="loading-spinner"></div>
  </div>
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal-box">
      <div class="modal-header">
        <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--blue-dark)">Detail Loker</span>
        <button class="modal-tutup" id="modal-tutup" type="button" title="Tutup">✕</button>
      </div>
      <div id="modal-isi">
      </div>
    </div>
  </div>

  <div class="notif-box" id="notif-box"></div>
  <nav class="navbar">
    <div class="navbar-logo">
      <img src="{{asset('ikon logo.png')}}" alt="logo" class="logo-img">
      <span class="logo-text">SILOKER</span>
    </div>
    <ul class="navbar-menu">
      <li><a href="/dashboard"class="active" >Dashboard</a></li>
      <li><a href="{{ route('tentang') }}">Tentang</a></li>
      <li><a href="/dashboard#loker">Daftar Loker</a>
      <li><a href="/dashboard#transaksi">Transaksi</a></li>
      <li><a href="/dashboard#penyewa">Penyewa</a></li>
    </ul>
    <button class="navbar-toggle" id="navToggle" type="button" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <div class="navbar-mobile-menu" id="mobileMenu">
    <a href="#dashboard" class="active">Dashboard</a>
    <a href="{{ route('tentang') }}">Tentang</a>
    <a href="#loker">Data Loker</a>
    <a href="#transaksi">Transaksi Penyewaan</a>
    <a href="#penyewa">Data Penyewa</a>
</div>

  <div class="page-body">
    <section class="hero" id="dashboard">
      <div class="hero-badge">Universitas Jember · Fakultas Ilmu Komputer</div>
      <h1>SILOKER</h1>
      <h2>Sistem Informasi Penyewaan Loker Kampus</h2>
      <p>Platform digital terpadu untuk pengelolaan loker kampus, pemantauan ketersediaan,
         pencatatan transaksi, dan manajemen penyewa secara real time.</p>
      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num" id="stat-total">0</span>
          <span class="hero-stat-label">Total Loker</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" id="stat-tersedia">0</span>
          <span class="hero-stat-label">Tersedia</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" id="stat-disewa">0</span>
          <span class="hero-stat-label">Disewa</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" id="stat-aktif">0</span>
          <span class="hero-stat-label">Terdaftar</span>
        </div>
      </div>
    </section>


    <div class="content-area">
      <aside class="sidebar">
        <button class="sidebar-toggle-btn" id="sidebarToggle" type="button">
          <span>🔽 Filter &amp; Navigasi</span>
          <span class="sidebar-toggle-icon">▾</span>
        </button>

        <div class="sidebar-content" id="sidebarContent">

          <div class="sidebar-section">
            <div class="sidebar-section-title">Status Loker</div>
            <label class="filter-item" for="filter-tersedia">
              <input type="checkbox" id="filter-tersedia" class="filter-status" value="tersedia" checked>
              <span class="filter-label">Tersedia</span>
              <span class="filter-count" data-stat="tersedia">47</span>
            </label>
            <label class="filter-item" for="filter-disewa">
              <input type="checkbox" id="filter-disewa" class="filter-status" value="disewa" checked>
              <span class="filter-label">Disewa</span>
              <span class="filter-count" data-stat="disewa">68</span>
            </label>
            <label class="filter-item" for="filter-maintenance">
              <input type="checkbox" id="filter-maintenance" class="filter-status" value="maintenance" checked>
              <span class="filter-label">Maintenance</span>
              <span class="filter-count" data-stat="maintenance">5</span>
            </label>
          </div>

          <div class="sidebar-section">
            <div class="sidebar-section-title">Ukuran Loker</div>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Kecil</span><span class="filter-count">40</span></label>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Sedang</span><span class="filter-count">50</span></label>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Besar</span><span class="filter-count">30</span></label>
          </div>

          <div class="sidebar-section">
            <div class="sidebar-section-title">Gedung</div>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Gedung A</span><span class="filter-count">24</span></label>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Gedung B</span><span class="filter-count">20</span></label>
            <label class="filter-item"><input type="checkbox"><span class="filter-label">Gedung C</span><span class="filter-count">18</span></label>
            <label class="filter-item"><input type="checkbox"><span class="filter-label">Gedung D &amp; E</span><span class="filter-count">36</span></label>
          </div>

          <div class="sidebar-section">
            <div class="sidebar-section-title">Harga / Hari</div>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Rp 3.000</span><span class="filter-count">40</span></label>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Rp 5.000</span><span class="filter-count">50</span></label>
            <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Rp 8.000</span><span class="filter-count">30</span></label>
          </div>

          <button class="btn-filter-reset" type="button">↺ Reset Filter</button>
        </div>
      </aside>


      <main>
        <div class="search-bar-wrapper">
          <h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg> Cari &amp; Filter Data Loker</h4>
          <div class="search-row">
            <div class="search-field">
              <label for="searchKode">Kode / Pengelola</label>
              <input type="text" id="searchKode" placeholder="Contoh: LKR-A101 atau Budi" />
            </div>
            <div class="search-field">
              <label for="searchLokasi">Lokasi / Gedung</label>
              <input type="text" id="searchLokasi" placeholder="Contoh: Gedung A" />
            </div>
            <div class="search-field">
              <label for="searchStatus">Status</label>
              <select id="searchStatus">
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="disewa">Disewa</option>
                <option value="maintenance">Maintenance</option>
              </select>
            </div>
            <button class="btn-search" type="button">Cari Loker</button>
            <button class="btn-secondary" type="button">Reset</button>
          </div>
        </div>
        <section id="loker">
          <div class="section-heading">
            <h3 class="section-title">Data Loker</h3>
            <span class="section-subtitle" id="subtitel-loker">Memuat data…</span>
          </div>
          <div class="loker-grid">
            @foreach ( $loker as $data )
          <div class="loker-card"  style="animation-delay:${i * 0.06}s">
      <div class="loker-card-header">
        <span class="loker-card-code">{{ $data->kode }}</span>
        <span style="
    display:inline-block;
    padding:6px 12px;
    font-size:12px;
    font-weight:600;
    border-radius:20px;
    text-transform:capitalize;
    color:
        @if($data->status == 'disewa') #000
        @else #fff
        @endif;
    background-color:
        @if($data->status == 'tersedia') #28a745
        @elseif($data->status == 'disewa') #ffc107
        @elseif($data->status == 'maintenance') #dc3545
        @endif;
">
    {{ $data->status }}
</span>
      </div>
      <div class="loker-card-body">
        <div class="loker-info-row">
          <span class="loker-info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
</svg></span>
          <span class="loker-info-key">Lokasi</span>
          <span class="loker-info-val">{{ $data->lokasi }}</span>
        </div>
        <div class="loker-info-row">
          <span class="loker-info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
</svg></span>
          <span class="loker-info-key">Ukuran</span>
          <span class="loker-info-val">{{$data->ukuran}}</span>
        </div>
        <div class="loker-info-row">
          <span class="loker-info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg></span>
          <span class="loker-info-key">Pengelola</span>
          <span class="loker-info-val">{{ $data->pengelola }}</span>
        </div>
      </div>
      <div class="loker-card-footer">
        <div class="loker-price">Rp. {{ number_format($data->harga, 0, ',', '.') }} <small>/ hari</small></div>
        <div style="display:flex; gap:6px">
          <button class="btn-card-detail" data-id="{{ $data->id }}" title="Lihat Detail"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg></button>
          <button class="btn-card-edit"   data-id="{{ $data->id }}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
</svg></button>
          <button class="btn-card-hapus"  data-id="{{ $data->id }}" title="Hapus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>
        </div>
      </div>
    </div>
    @endforeach
          </div>
        </section>

        <div class="table-card">
          <div class="table-card-header">
            <span class="table-card-title">Daftar Lengkap Data Loker</span>
            <span class="table-total" id="tabel-total">Memuat…</span>
          </div>
          
          <div class="table-container">
            <table id="tabel-loker">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Loker</th>
                  <th>Lokasi</th>
                  <th>Ukuran</th>
                  <th>Harga / Hari</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabel-tbody">
              </tbody>
              <tfoot>
                <tr><td colspan="7" id="tabel-footer">Total data ditampilkan: 0 loker</td></tr>
              </tfoot>
            </table>
          </div>
        </div>

        <hr />

        <div class="form-card" id="form-section">
          <div class="section-heading" style="margin-bottom:16px">
            <h3 class="section-title" id="form-title">Tambah Data Loker</h3>
          </div>

          <form id="form-loker" novalidate>
            <fieldset>
              <legend>Data Loker Baru</legend>
              <div class="form-grid">

                <p>
                  <label for="kodeLoker">Kode Loker <span style="color:#EF4444">*</span></label>
                  <input type="text" id="kodeLoker" name="kodeLoker"
                    placeholder="Contoh: LKR-A101" />
                  <span class="error-msg" id="error-kodeLoker"></span>
                </p>

                <p>
                  <label for="lokasiLoker">Lokasi / Gedung <span style="color:#EF4444">*</span></label>
                  <input type="text" id="lokasiLoker" name="lokasiLoker"
                    placeholder="Contoh: Gedung A / Lantai 2" />
                  <span class="error-msg" id="error-lokasiLoker"></span>
                </p>

                <p>
                  <label for="ukuranLoker">Ukuran Loker</label>
                  <select id="ukuranLoker" name="ukuranLoker">
                    <option value="kecil">Kecil</option>
                    <option value="sedang" selected>Sedang</option>
                    <option value="besar">Besar</option>
                  </select>
                </p>

                <p>
                  <label for="jumlahLoker">Jumlah</label>
                  <input type="number" id="jumlahLoker" name="jumlahLoker"
                    placeholder="Contoh: 1" min="1" value="1" />
                </p>

                <p>
                  <label for="hargaSewa">Harga / Hari (Rp) <span style="color:#EF4444">*</span></label>
                  <input type="number" id="hargaSewa" name="hargaSewa"
                    placeholder="Contoh: 5000" min="1000" value="5000" />
                  <span class="error-msg" id="error-hargaSewa"></span>
                </p>

                <p>
                  <label for="statusLoker">Status</label>
                  <select id="statusLoker" name="statusLoker">
                    <option value="tersedia">Tersedia</option>
                    <option value="disewa">Disewa</option>
                    <option value="maintenance">Maintenance</option>
                  </select>
                </p>

                <p>
                  <label for="tanggalTersedia">Tanggal Tersedia</label>
                  <input type="date" id="tanggalTersedia" name="tanggalTersedia" />
                </p>

                <p>
                  <label for="namaPengelola">Nama Pengelola <span style="color:#EF4444">*</span></label>
                  <input type="text" id="namaPengelola" name="namaPengelola"
                    placeholder="Nama penanggung jawab" />
                  <span class="error-msg" id="error-namaPengelola"></span>
                </p>

                <p style="grid-column: 1 / -1;">
                  <label for="keterangan">Keterangan</label>
                  <textarea id="keterangan" name="keterangan" rows="2"
                    placeholder="Tambahkan catatan mengenai loker..."></textarea>
                </p>

              </div>
              <div class="form-actions">
                <input type="submit" id="btn-submit" value="Simpan Data Loker" />
                <button type="button" id="btn-reset-form" class="btn-secondary"
                  style="align-self:auto">Batal / Reset</button>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="panel-card" id="penyewa">
          <div id="panel-penyewa">
            <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:24px">
              Klik <strong>Muat Data API</strong> untuk mengambil data penyewa dari server
            </p>
          </div>
        </div>

      </main>
    </div>
    <footer class="footer">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">SILOKER</div>
          <div class="footer-teal-bar"></div>
          <p>Sistem Informasi Penyewaan Loker Kampus — platform digital terpadu untuk pengelolaan loker di Universitas Jember secara efisien dan transparan.</p>
        </div>
        <div>
          <div class="footer-col-title">Navigasi</div>
          <ul class="footer-links">
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#loker">Data Loker</a></li>
            <li><a href="#transaksi">Transaksi Penyewaan</a></li>
            <li><a href="#penyewa">Data Penyewa</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-col-title">Informasi</div>
          <div class="footer-info-item">
            <span class="footer-info-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
  <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
  <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/>
</svg></span>
            <p><strong>Universitas Jember</strong><br>Fakultas Ilmu Komputer</p>
          </div>
          <div class="footer-info-item">
            <span class="footer-info-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
  <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
</svg></span>
            <p><strong>Dibuat oleh</strong><br>Talitha Puspitasari</p>
          </div>
          <div class="footer-info-item">
            <span class="footer-info-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-code" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708m-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708"/>
  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
</svg></span>
            <p><strong>Mata Kuliah</strong><br>Pemrograman Web · 2025/2026</p>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 <strong>SILOKER</strong> — Sistem Informasi Penyewaan Loker Kampus</p>
        <p>Universitas Jember · Fakultas Ilmu Komputer</p>
      </div>
    </footer>

  </div>

  <script src="script.js"></script>
</body>
</html>
