@extends('layouts.app')

@section('title', 'Dashboard – Sistem Informasi Loker Kampus')

@section('content')
<section class="hero" id="dashboard">
    <div class="hero-badge">Universitas Jember · Fakultas Ilmu Komputer</div>
    <h1>SILOKER</h1>
    <h2>Sistem Informasi Penyewaan Loker Kampus</h2>
    <p>Platform digital terpadu untuk pengelolaan loker kampus, pemantauan ketersediaan,
       pencatatan transaksi, dan manajemen penyewa secara real time.</p>
    
    <div class="hero-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 30px;">
    
        <x-stat-card 
            judul="Total Loker" 
            :nilai="60" 
            ikon="bi-box-seam" 
            warna="#ffffff" 
        />

        <x-stat-card 
            judul="Tersedia" 
            :nilai="45" 
            ikon="bi-check-circle" 
            warna="#28a745" 
        />

        <x-stat-card 
            judul="Disewa" 
            :nilai="15" 
            ikon="bi-key" 
            warna="#ffc107" 
        />

        <x-stat-card 
            judul="Terdaftar" 
            :nilai="150" 
            ikon="bi-people" 
            warna="#17a2b8" 
        />
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
                    <span class="filter-count" data-stat="tersedia">0</span>
                </label>
                <label class="filter-item" for="filter-disewa">
                    <input type="checkbox" id="filter-disewa" class="filter-status" value="disewa" checked>
                    <span class="filter-label">Disewa</span>
                    <span class="filter-count" data-stat="disewa">0</span>
                </label>
                <label class="filter-item" for="filter-maintenance">
                    <input type="checkbox" id="filter-maintenance" class="filter-status" value="maintenance" checked>
                    <span class="filter-label">Maintenance</span>
                    <span class="filter-count" data-stat="maintenance">0</span>
                </label>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Ukuran Loker</div>
                <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Kecil</span></label>
                <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Sedang</span></label>
                <label class="filter-item"><input type="checkbox" checked><span class="filter-label">Besar</span></label>
            </div>

            <button class="btn-filter-reset" type="button">↺ Reset Filter</button>
        </div>
    </aside>
    <main>
        <div class="search-bar-wrapper">
            <h4>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg> Cari &amp; Filter Data Loker
            </h4>
            <div class="search-row">
                <div class="search-field">
                    <label for="searchKode">Kode / Pengelola</label>
                    <input type="text" id="searchKode" placeholder="Contoh: LKR-A101" />
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
            </div>
        </div>
        <section id="loker">
            <div class="section-heading">
                <h3 class="section-title">Data Loker</h3>
                <span class="section-subtitle" id="subtitel-loker">Menampilkan data loker terbaru</span>
            </div>
                 <div class="loker-grid">
                    @forelse ( $loker as $data )
                        <div class="loker-card">
                            <div class="loker-card-header">
                                <span class="loker-card-code">{{ $data->kode }}</span>
                                <span style="display:inline-block; padding:6px 12px; font-size:12px; font-weight:600; border-radius:20px; text-transform:capitalize; 
                                    color: {{ $data->status == 'disewa' ? '#000' : '#fff' }};
                                    background-color: {{ $data->status == 'tersedia' ? '#28a745' : ($data->status == 'disewa' ? '#ffc107' : '#dc3545') }};">
                                    {{ $data->status }}
                                </span>
                            </div>
                            <div class="loker-card-body">
                                <div class="loker-info-row">
                                    <span class="loker-info-key">Lokasi:</span>
                                    <span class="loker-info-val">{{ $data->lokasi }}</span>
                                </div>
                                <div class="loker-info-row">
                                    <span class="loker-info-key">Ukuran:</span>
                                    <span class="loker-info-val">{{ $data->ukuran }}</span>
                                </div>
                                <div class="loker-info-row">
                                    <span class="loker-info-key">Pengelola:</span>
                                    <span class="loker-info-val">{{ $data->pengelola }}</span>
                                </div>
                            </div>
                            <div class="loker-card-footer">
                                <div class="loker-price">Rp. {{ number_format($data->harga, 0, ',', '.') }} <small>/ hari</small></div>
                                <div style="display:flex; gap:6px">
                                    <button class="btn-card-detail" data-id="{{ $data->id }}">🔍</button>
                                    <button class="btn-card-edit" data-id="{{ $data->id }}">✏️</button>
                                    <button class="btn-card-hapus" data-id="{{ $data->id }}">🗑️</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #f8f9fa; border-radius: 12px; border: 2px dashed #dee2e6;">
                            <p style="color: #6c757d; font-size: 1.1rem;">Belum ada data loker yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>
         </section>
        <!-- Tabel Lengkap -->
        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Daftar Lengkap Data Loker</span>
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
                    @forelse($loker as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->kode }}</td>
                            <td>{{ $data->lokasi }}</td>
                            <td>{{ $data->ukuran }}</td>
                            <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <button class="btn-card-edit" data-id="{{ $data->id }}">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #6c757d;">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
        <!-- Form Tambah Loker -->
        <div class="form-card" id="form-section">
            <div class="section-heading" style="margin-bottom:16px">
                <h3 class="section-title">Tambah Data Loker</h3>
            </div>
            <form id="form-loker">
                <div class="form-grid">
                    <p>
                        <label for="kodeLoker">Kode Loker *</label>
                        <input type="text" id="kodeLoker" name="kodeLoker" required />
                    </p>
                    <p>
                        <label for="lokasiLoker">Lokasi / Gedung *</label>
                        <input type="text" id="lokasiLoker" name="lokasiLoker" required />
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
                        <label for="hargaSewa">Harga / Hari (Rp) *</label>
                        <input type="number" id="hargaSewa" name="hargaSewa" value="5000" />
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
                        <label for="namaPengelola">Nama Pengelola *</label>
                        <input type="text" id="namaPengelola" name="namaPengelola" required />
                    </p>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit" style="background: var(--blue-primary); color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">Simpan Data Loker</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. Sidebar Toggle Mobile ---
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarContent = document.getElementById('sidebarContent');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebarContent.style.display = sidebarContent.style.display === 'block' ? 'none' : 'block';
            });
        }

        // --- 2. Logika Pencarian & Filter ---
        const searchBtn = document.querySelector('.btn-search');
        const inputKode = document.getElementById('searchKode');
        const inputLokasi = document.getElementById('searchLokasi');
        const inputStatus = document.getElementById('searchStatus');
        const lokerCards = document.querySelectorAll('.loker-card');

        function filterLoker() {
            const filterKode = inputKode.value.toLowerCase();
            const filterLokasi = inputLokasi.value.toLowerCase();
            const filterStatus = inputStatus.value.toLowerCase();

            lokerCards.forEach(card => {
                const kode = card.querySelector('.loker-card-code').innerText.toLowerCase();
                const lokasi = card.querySelector('.loker-info-val').innerText.toLowerCase();
                const status = card.querySelector('.loker-card-header span:last-child').innerText.toLowerCase();

                const matchKode = kode.includes(filterKode);
                const matchLokasi = lokasi.includes(filterLokasi);
                const matchStatus = filterStatus === "" || status === filterStatus;

                if (matchKode && matchLokasi && matchStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            updateSubtitel();
        }

        searchBtn.addEventListener('click', filterLoker);

        // --- 3. Update Subtitel Counter ---
        function updateSubtitel() {
            const visibleCards = document.querySelectorAll('.loker-card[style="display: block;"]').length;
            const subtitel = document.getElementById('subtitel-loker');
            subtitel.innerText = `Menampilkan ${visibleCards} data loker ditemukan`;
        }

        // --- 4. Reset Filter ---
        const resetBtn = document.querySelector('.btn-filter-reset');
        resetBtn.addEventListener('click', () => {
            inputKode.value = '';
            inputLokasi.value = '';
            inputStatus.value = '';
            lokerCards.forEach(card => card.style.display = 'block');
            updateSubtitel();
        });

        // --- 5. Simulasi Form Submit ---
        const formLoker = document.getElementById('form-loker');
        formLoker.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Ambil Data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            // Di sini Anda biasanya menggunakan fetch() atau axios untuk ke backend
            console.log("Data siap dikirim:", data);

            alert('Data Loker ' + data.kodeLoker + ' berhasil disimpan! (Simulasi)');
            this.reset();
        });

        // --- 6. Event Buttons (Edit/Hapus) ---
        document.querySelectorAll('.btn-card-hapus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if(confirm('Apakah Anda yakin ingin menghapus loker dengan ID: ' + id + '?')) {
                    this.closest('.loker-card').remove();
                    alert('Data dihapus (Simulasi DOM)');
                }
            });
        });

        // Jalankan counter pertama kali
        updateSubtitel();
    });
</script>
@endpush