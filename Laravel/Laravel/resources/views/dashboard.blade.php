@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <title>SILOKER – Sistem Informasi Loker Kampus</title>

        <meta name="description" content="SILOKER — Sistem Informasi Penyewaan Loker Kampus Universitas Jember" />

        <link rel="icon" href="{{ asset('ikon logo.png') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </x-slot>

    <div class="loading-overlay dark:bg-gray-900/80" id="loading-overlay">
        <div class="loading-spinner dark:border-t-blue-400"></div>
    </div>

    <div class="modal-overlay dark:bg-gray-900/80" id="modal-overlay">
        <div class="modal-box dark:bg-gray-800 dark:border-gray-700">
            <div class="modal-header dark:border-gray-700">
                <span class="dark:!text-blue-400"
                    style="font-family:'Syne',sans-serif;font-weight:700;color:var(--blue-dark)">
                    Detail Loker
                </span>

                <button class="modal-tutup dark:text-gray-400 dark:hover:text-white" id="modal-tutup" type="button"
                    title="Tutup">
                    ✕
                </button>
            </div>

            <div id="modal-isi" class="dark:text-gray-200"></div>
        </div>
    </div>

    <div class="notif-box dark:bg-gray-800 dark:text-white dark:border-gray-700" id="notif-box"></div>


    <div class="page-body dark:bg-gray-900 dark:text-white">

        {{-- HERO --}}
        <section class="hero dark:bg-gray-800 dark:border-gray-700" id="dashboard">
            <div class="hero-badge dark:bg-gray-700 dark:text-blue-300">
                Universitas Jember · Fakultas Ilmu Komputer
            </div>

            <h1 class="dark:text-white">SILOKER</h1>

            <h2 class="dark:text-gray-200">Sistem Informasi Penyewaan Loker Kampus</h2>

            <p class="dark:text-gray-400">
                Platform digital terpadu untuk pengelolaan loker kampus,
                pemantauan ketersediaan, pencatatan transaksi,
                dan manajemen penyewa secara real time.
            </p>

            <div class="hero-stats">
                <div class="hero-stat dark:p-2 dark:rounded-md dark:bg-gray-700 dark:border-gray-600">
                    <span class="hero-stat-num dark:text-white" id="stat-total">0</span>
                    <span class="hero-stat-label dark:text-gray-300">Total Loker</span>
                </div>

                <div class="hero-stat dark:p-2 dark:rounded-md dark:bg-gray-700 dark:border-gray-600">
                    <span class="hero-stat-num dark:text-white" id="stat-tersedia">0</span>
                    <span class="hero-stat-label dark:text-gray-300">Tersedia</span>
                </div>

                <div class="hero-stat dark:p-2 dark:rounded-md dark:bg-gray-700 dark:border-gray-600">
                    <span class="hero-stat-num dark:text-white" id="stat-disewa">0</span>
                    <span class="hero-stat-label dark:text-gray-300">Disewa</span>
                </div>

                <div class="hero-stat dark:p-2 dark:rounded-md dark:bg-gray-700 dark:border-gray-600">
                    <span class="hero-stat-num dark:text-white" id="stat-aktif">0</span>
                    <span class="hero-stat-label dark:text-gray-300">Terdaftar</span>
                </div>
            </div>
        </section>

        <div class="content-area">
            <aside class="sidebar dark:bg-gray-800 dark:border-gray-700">
                <button class="sidebar-toggle-btn dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                    id="sidebarToggle" type="button">
                    <span>🔽 Filter &amp; Navigasi</span>
                    <span class="sidebar-toggle-icon">▾</span>
                </button>

                <form method="GET" action="{{ url()->current() }}" class="sidebar-content" id="sidebarContent">

                    @if (request('searchKode'))
                        <input type="hidden" name="searchKode" value="{{ request('searchKode') }}">
                    @endif
                    @if (request('searchLokasi'))
                        <input type="hidden" name="searchLokasi" value="{{ request('searchLokasi') }}">
                    @endif
                    @if (request('searchStatus'))
                        <input type="hidden" name="searchStatus" value="{{ request('searchStatus') }}">
                    @endif

                    <div class="sidebar-section">
                        <div class="sidebar-section-title dark:text-gray-200 dark:border-gray-700">Info Cuaca Kampus</div>

                        <div id="weather-widget" class="dark:!bg-gray-700 dark:!border-gray-600 dark:!text-gray-300"
                            style="padding: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; text-align: center; font-size: 14px; color: #475569;">
                            <div id="weather-loading"
                                style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <div class="loading-spinner dark:border-t-blue-400"
                                    style="width: 16px; height: 16px; border-width: 2px;"></div>
                                <span>Memuat data cuaca...</span>
                            </div>

                            <div id="weather-content" style="display: none;">
                                <strong id="w-city" class="dark:!text-blue-400"
                                    style="color: var(--blue-dark); font-size: 16px; display: block;">-</strong>
                                <span id="w-temp" class="dark:!text-white"
                                    style="font-size: 24px; font-weight: bold; color: #0f172a;">-</span>°C
                                <br>
                                <span id="w-desc" style="text-transform: capitalize;">-</span>
                            </div>

                            <div id="weather-error" class="dark:!text-red-400" style="display: none; color: #dc3545;">
                                Gagal mengambil data cuaca.
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <div class="sidebar-section-title dark:text-gray-200 dark:border-gray-700">Status Loker</div>
                        <label class="filter-item">
                            <input type="checkbox" name="status[]" value="tersedia" onchange="this.form.submit()"
                                {{ in_array('tersedia', request('status', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Tersedia</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="status[]" value="disewa" onchange="this.form.submit()"
                                {{ in_array('disewa', request('status', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Disewa</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="status[]" value="maintenance" onchange="this.form.submit()"
                                {{ in_array('maintenance', request('status', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Maintenance</span>
                        </label>
                    </div>

                    <div class="sidebar-section">
                        <div class="sidebar-section-title dark:text-gray-200 dark:border-gray-700">Ukuran Loker</div>
                        <label class="filter-item">
                            <input type="checkbox" name="ukuran[]" value="kecil" onchange="this.form.submit()"
                                {{ in_array('kecil', request('ukuran', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Kecil</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="ukuran[]" value="sedang" onchange="this.form.submit()"
                                {{ in_array('sedang', request('ukuran', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Sedang</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="ukuran[]" value="besar" onchange="this.form.submit()"
                                {{ in_array('besar', request('ukuran', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Besar</span>
                        </label>
                    </div>

                    <div class="sidebar-section">
                        <div class="sidebar-section-title dark:text-gray-200 dark:border-gray-700">Gedung</div>
                        <label class="filter-item">
                            <input type="checkbox" name="gedung[]" value="Gedung A" onchange="this.form.submit()"
                                {{ in_array('Gedung A', request('gedung', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Gedung A</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="gedung[]" value="Gedung B" onchange="this.form.submit()"
                                {{ in_array('Gedung B', request('gedung', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Gedung B</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="gedung[]" value="Gedung C" onchange="this.form.submit()"
                                {{ in_array('Gedung C', request('gedung', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Gedung C</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="gedung[]" value="Gedung D" onchange="this.form.submit()"
                                {{ in_array('Gedung D', request('gedung', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Gedung D &amp; E</span>
                        </label>
                    </div>

                    <div class="sidebar-section">
                        <div class="sidebar-section-title dark:text-gray-200 dark:border-gray-700">Harga / Hari</div>
                        <label class="filter-item">
                            <input type="checkbox" name="harga[]" value="3000" onchange="this.form.submit()"
                                {{ in_array('3000', request('harga', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Rp 3.000</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="harga[]" value="5000" onchange="this.form.submit()"
                                {{ in_array('5000', request('harga', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Rp 5.000</span>
                        </label>
                        <label class="filter-item">
                            <input type="checkbox" name="harga[]" value="8000" onchange="this.form.submit()"
                                {{ in_array('8000', request('harga', [])) ? 'checked' : '' }}>
                            <span class="filter-label dark:text-gray-300">Rp 8.000</span>
                        </label>
                    </div>

                    <a href="{{ url()->current() }}" class="btn-filter-reset dark:!bg-gray-700 dark:!text-gray-200"
                        style="text-decoration:none; display:block; text-align:center; padding:10px; background:#f1f5f9; border-radius:8px; margin-top:10px;">↺
                        Reset Filter</a>
                </form>
            </aside>

            <main>
                <div class="search-bar-wrapper dark:bg-gray-800 dark:border-gray-700">
                    <h4 class="dark:text-gray-200 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg> Cari &amp; Filter Data Loker</h4>
                    <form method="GET" action="{{ url()->current() }}" class="search-row">
                        <div class="search-field">
                            <label for="searchKode" class="dark:text-gray-300">Kode / Pengelola</label>
                            <input type="text" id="searchKode" name="searchKode" value="{{ request('searchKode') }}"
                                placeholder="Contoh: LKR-A101 atau Budi"
                                class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                        </div>

                        <div class="search-field">
                            <label for="searchLokasi" class="dark:text-gray-300">Lokasi / Gedung</label>
                            <input type="text" id="searchLokasi" name="searchLokasi"
                                value="{{ request('searchLokasi') }}" placeholder="Contoh: Gedung A"
                                class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                        </div>

                        <div class="search-field">
                            <label for="searchStatus" class="dark:text-gray-300">Status</label>
                            <select id="searchStatus" name="searchStatus"
                                class="dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('searchStatus') == 'tersedia' ? 'selected' : '' }}>
                                    Tersedia</option>
                                <option value="disewa" {{ request('searchStatus') == 'disewa' ? 'selected' : '' }}>Disewa
                                </option>
                                <option value="maintenance"
                                    {{ request('searchStatus') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>

                        <button class="btn-search" type="submit">Cari Loker</button>

                        <a href="{{ url()->current() }}"
                            class="btn-secondary dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Reset</a>
                    </form>
                </div>

                <section id="loker">
                    <div class="section-heading">
                        <h3 class="section-title dark:text-white">Data Loker</h3>
                        <span class="section-subtitle dark:text-gray-400" id="subtitel-loker">Memuat data…</span>
                    </div>
                    <div class="loker-grid">
                        @foreach ($loker as $data)
                            <div class="loker-card dark:bg-gray-800 dark:border-gray-700"
                                style="animation-delay:${i * 0.06}s">
                                <div class="loker-card-header dark:border-gray-700">
                                    <span class="loker-card-code dark:text-white">{{ $data->kode }}</span>
                                    <span
                                        style="
            display:inline-block;
            padding:6px 12px;
            font-size:12px;
            font-weight:600;
            border-radius:20px;
            text-transform:capitalize;
            color:
                @if ($data->status == 'disewa') #000
                @else #fff @endif;
            background-color:
                @if ($data->status == 'tersedia') #28a745
                @elseif($data->status == 'disewa') #ffc107
                @elseif($data->status == 'maintenance') #dc3545 @endif;
        ">
                                        {{ $data->status }}
                                    </span>
                                </div>
                                <div class="loker-card-body">
                                    <div class="loker-info-row">
                                        <span class="loker-info-icon dark:text-gray-400"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                            </svg></span>
                                        <span class="loker-info-key dark:text-gray-400">Lokasi</span>
                                        <span class="loker-info-val dark:text-gray-200">{{ $data->lokasi }}</span>
                                    </div>
                                    <div class="loker-info-row">
                                        <span class="loker-info-icon dark:text-gray-400"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                                            </svg></span>
                                        <span class="loker-info-key dark:text-gray-400">Ukuran</span>
                                        <span class="loker-info-val dark:text-gray-200">{{ $data->ukuran }}</span>
                                    </div>
                                    <div class="loker-info-row">
                                        <span class="loker-info-icon dark:text-gray-400"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                            </svg></span>
                                        <span class="loker-info-key dark:text-gray-400">Pengelola</span>
                                        <span class="loker-info-val dark:text-gray-200">{{ $data->pengelola }}</span>
                                    </div>
                                </div>
                                <div class="loker-card-footer dark:border-gray-700">
                                    <div class="loker-price dark:text-white">Rp.
                                        {{ number_format($data->harga, 0, ',', '.') }} <small class="dark:text-gray-400">/
                                            hari</small></div>
                                    <div style="display:flex; gap:6px">
                                        <button class="btn-card-detail" data-id="{{ $data->id }}"
                                            title="Lihat Detail"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-search"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg></button>
                                        @if (Auth::check() && Auth::user()->role === 'admin')
                                            <button class="btn-card-edit" data-id="{{ $data->id }}"
                                                title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg></button>
                                            <button class="btn-card-hapus" data-id="{{ $data->id }}"
                                                title="Hapus"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Hanya tampil jika user sudah login dan memiliki role 'admin' --}}
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="form-card dark:bg-gray-800 dark:border-gray-700" id="form-section">
                        <div class="section-heading" style="margin-bottom:16px">
                            <h3 class="section-title dark:text-white" id="form-title">Tambah Data Loker</h3>
                        </div>

                        <form id="form-loker" novalidate>
                            <fieldset class="dark:border-gray-600">
                                <legend class="dark:text-white">Data Loker Baru</legend>
                                <div class="form-grid">

                                    <p>
                                        <label for="kodeLoker" class="dark:text-gray-300">Kode Loker <span
                                                style="color:#EF4444">*</span></label>
                                        <input type="text" id="kodeLoker" name="kodeLoker"
                                            placeholder="Contoh: LKR-A101"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                        <span class="error-msg" id="error-kodeLoker"></span>
                                    </p>

                                    <p>
                                        <label for="lokasiLoker" class="dark:text-gray-300">Lokasi / Gedung <span
                                                style="color:#EF4444">*</span></label>
                                        <input type="text" id="lokasiLoker" name="lokasiLoker"
                                            placeholder="Contoh: Gedung A / Lantai 2"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                        <span class="error-msg" id="error-lokasiLoker"></span>
                                    </p>

                                    <p>
                                        <label for="ukuranLoker" class="dark:text-gray-300">Ukuran Loker</label>
                                        <select id="ukuranLoker" name="ukuranLoker"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="kecil">Kecil</option>
                                            <option value="sedang" selected>Sedang</option>
                                            <option value="besar">Besar</option>
                                        </select>
                                    </p>

                                    <p>
                                        <label for="jumlahLoker" class="dark:text-gray-300">Jumlah</label>
                                        <input type="number" id="jumlahLoker" name="jumlahLoker"
                                            placeholder="Contoh: 1" min="1" value="1"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                    </p>

                                    <p>
                                        <label for="hargaSewa" class="dark:text-gray-300">Harga / Hari (Rp) <span
                                                style="color:#EF4444">*</span></label>
                                        <input type="number" id="hargaSewa" name="hargaSewa" placeholder="Contoh: 5000"
                                            min="1000" value="5000"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                        <span class="error-msg" id="error-hargaSewa"></span>
                                    </p>

                                    <p>
                                        <label for="statusLoker" class="dark:text-gray-300">Status</label>
                                        <select id="statusLoker" name="statusLoker"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="tersedia">Tersedia</option>
                                            <option value="disewa">Disewa</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select>
                                    </p>

                                    <p>
                                        <label for="tanggalTersedia" class="dark:text-gray-300">Tanggal Tersedia</label>
                                        <input type="date" id="tanggalTersedia" name="tanggalTersedia"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                    </p>

                                    <p>
                                        <label for="namaPengelola" class="dark:text-gray-300">Nama Pengelola <span
                                                style="color:#EF4444">*</span></label>
                                        <input type="text" id="namaPengelola" name="namaPengelola"
                                            placeholder="Nama penanggung jawab"
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                                        <span class="error-msg" id="error-namaPengelola"></span>
                                    </p>

                                    <p style="grid-column: 1 / -1;">
                                        <label for="keterangan" class="dark:text-gray-300">Keterangan</label>
                                        <textarea id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan catatan mengenai loker..."
                                            class="dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"></textarea>
                                    </p>

                                </div>
                                <div class="form-actions">
                                    <input type="submit" id="btn-submit" value="Simpan Data Loker" />
                                    <button type="button" id="btn-reset-form"
                                        class="btn-secondary dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                                        style="align-self:auto">Batal / Reset</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                @endif

                <section class="panel-card dark:bg-gray-800 dark:border-gray-700" style="margin: 20px;">
                    <div class="section-heading"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="section-title dark:text-white">Statistik Kunjungan Anda</h3>

                        <form action="{{ route('reset.visit') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-muat-api dark:!bg-red-700 dark:hover:!bg-red-600"
                                style="background: #ef4444; border: none; cursor: pointer; padding: 6px 12px; font-size: 12px;">
                                ↺ Reset Hitungan
                            </button>
                        </form>
                    </div>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                        <div class="dark:text-gray-300">
                            <strong>Jumlah Kunjungan:</strong> {{ $kunjungan['count'] ?? 0 }}x
                        </div>
                        <div class="dark:text-gray-300">
                            <strong>Kunjungan Pertama:</strong>
                            {{ isset($kunjungan['first_visit']) ? \Carbon\Carbon::parse($kunjungan['first_visit'])->format('d M Y, H:i') : '-' }}
                        </div>
                        <div class="dark:text-gray-300">
                            <strong>Kunjungan Terakhir:</strong>
                            {{ isset($kunjungan['last_visit']) ? \Carbon\Carbon::parse($kunjungan['last_visit'])->format('d M Y, H:i') : '-' }}
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <footer class="footer dark:bg-gray-900 dark:border-gray-800">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo dark:text-white">SILOKER</div>
                    <div class="footer-teal-bar"></div>
                    <p class="dark:text-gray-400">Sistem Informasi Penyewaan Loker Kampus — platform digital terpadu untuk
                        pengelolaan loker di
                        Universitas Jember secara efisien dan transparan.</p>
                </div>
                <div>
                    <div class="footer-col-title dark:text-white">Navigasi</div>
                    <ul class="footer-links">
                        <li><a href="#dashboard" class="dark:text-gray-400 hover:dark:text-white">Dashboard</a></li>
                        <li><a href="#loker" class="dark:text-gray-400 hover:dark:text-white">Data Loker</a></li>
                        <li><a href="#penyewa" class="dark:text-gray-400 hover:dark:text-white">Data Penyewa</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title dark:text-white">Informasi</div>
                    <div class="footer-info-item dark:text-gray-400">
                        <span class="footer-info-item-icon dark:text-gray-400"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-buildings"
                                viewBox="0 0 16 16">
                                <path
                                    d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                <path
                                    d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                            </svg></span>
                        <p><strong>Universitas Jember</strong><br>Fakultas Ilmu Komputer</p>
                    </div>
                    <div class="footer-info-item dark:text-gray-400">
                        <span class="footer-info-item-icon dark:text-gray-400"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-person-heart"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                            </svg></span>
                        <p><strong>Dibuat oleh</strong><br>Talitha Puspitasari</p>
                    </div>
                    <div class="footer-info-item dark:text-gray-400">
                        <span class="footer-info-item-icon dark:text-gray-400"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-journal-code"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708m-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708" />
                                <path
                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                <path
                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                            </svg></span>
                        <p><strong>Mata Kuliah</strong><br>Pemrograman Web · 2025/2026</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom dark:border-gray-800 dark:text-gray-400">
                <p>&copy; 2025 <strong>SILOKER</strong> — Sistem Informasi Penyewaan Loker Kampus</p>
                <p>Universitas Jember · Fakultas Ilmu Komputer</p>
            </div>
        </footer>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            async function fetchWeather() {
                const loadingEl = document.getElementById('weather-loading');
                const contentEl = document.getElementById('weather-content');
                const errorEl = document.getElementById('weather-error');

                const cityEl = document.getElementById('w-city');
                const tempEl = document.getElementById('w-temp');
                const descEl = document.getElementById('w-desc');

                try {
                    const response = await fetch('https://wttr.in/Jember?format=j1');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    const city = data.nearest_area[0].areaName[0].value;
                    const temp = data.current_condition[0].temp_C;
                    const desc = data.current_condition[0].weatherDesc[0].value;

                    cityEl.textContent = `📍 ${city}`;
                    tempEl.textContent = temp;
                    descEl.textContent = desc;

                    loadingEl.style.display = 'none';
                    contentEl.style.display = 'block';

                } catch (error) {
                    console.error('Error fetching weather:', error);
                    loadingEl.style.display = 'none';
                    errorEl.style.display = 'block';
                }
            }


            fetchWeather();
            const modalOverlay = document.getElementById("modal-overlay");
            const modalIsi = document.getElementById("modal-isi");
            const modalTutup = document.getElementById("modal-tutup");
            const loadingOverlay = document.getElementById("loading-overlay");


            document.addEventListener("click", function(e) {

                const targetBtn = e.target.closest(".btn-card-detail");

                if (targetBtn) {
                    const lokerId = targetBtn.getAttribute("data-id");


                    if (loadingOverlay) loadingOverlay.style.display = "flex";


                    fetch(`/loker/${lokerId}`)
                        .then(response => {
                            if (!response.ok) throw new Error("Gagal mengambil data");
                            return response.json();
                        })
                        .then(data => {

                            const hargaFormatted = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(data.harga);

                            // Mengubah inline style HTML Modal di JS agar ramah Dark Mode
                            modalIsi.innerHTML = `
                        <div class="modal-detail-wrapper" style="padding: 15px 0; font-family: 'Segoe UI', sans-serif;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b; width: 35%;">Kode Loker</td>
                                    <td class="dark:!text-blue-400" style="padding: 10px; font-weight: 700; color: #1e3a8a;">${data.kode}</td>
                                </tr>
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b;">Lokasi / Gedung</td>
                                    <td class="dark:!text-gray-200" style="padding: 10px; color: #334155;">${data.lokasi}</td>
                                </tr>
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b;">Ukuran</td>
                                    <td class="dark:!text-gray-200" style="padding: 10px; text-transform: capitalize; color: #334155;">${data.ukuran}</td>
                                </tr>
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b;">Pengelola</td>
                                    <td class="dark:!text-gray-200" style="padding: 10px; color: #334155;">${data.pengelola}</td>
                                </tr>
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b;">Harga Sewa</td>
                                    <td style="padding: 10px; color: #16a34a; font-weight: 600;">${hargaFormatted} <span class="dark:!text-gray-500" style="color:#64748b; font-size:12px; font-weight:normal;">/ hari</span></td>
                                </tr>
                                <tr class="dark:!border-gray-700" style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b;">Status</td>
                                    <td style="padding: 10px;">
                                        <span style="display:inline-block; padding:4px 10px; font-size:12px; font-weight:600; border-radius:12px; text-transform:capitalize;
                                            background-color: ${data.status === 'tersedia' ? '#e2f5ea' : data.status === 'disewa' ? '#fff3cd' : '#fde8e8'};
                                            color: ${data.status === 'tersedia' ? '#15803d' : data.status === 'disewa' ? '#854d0e' : '#991b1b'};">
                                            ${data.status}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark:!text-gray-400" style="padding: 10px; font-weight: 600; color: #64748b; vertical-align: top;">Keterangan</td>
                                    <td class="dark:!text-gray-400" style="padding: 10px; color: #64748b; font-style: italic;">${data.keterangan ? data.keterangan : 'Tidak ada catatan tambahan.'}</td>
                                </tr>
                            </table>
                        </div>
                    `;


                            if (loadingOverlay) loadingOverlay.style.display = "none";
                            modalOverlay.classList.add(
                                "active"
                            );
                            modalOverlay.style.display =
                                "flex";
                        })
                        .catch(error => {
                            console.error(error);
                            if (loadingOverlay) loadingOverlay.style.display = "none";
                            alert("Gagal memuat detail data loker.");
                        });
                }
            });


            if (modalTutup) {
                modalTutup.addEventListener("click", function() {
                    modalOverlay.classList.remove("active");
                    modalOverlay.style.display = "none";
                });
            }


            window.addEventListener("click", function(e) {
                if (e.target === modalOverlay) {
                    modalOverlay.classList.remove("active");
                    modalOverlay.style.display = "none";
                }
            });
        });
    </script>

    @push('scripts')
        <script src="{{ asset('script.js') }}"></script>
    @endpush
@endsection
