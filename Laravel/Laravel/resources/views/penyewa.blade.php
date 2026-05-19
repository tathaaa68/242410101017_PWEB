@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <title>SILOKER – Data Penyewa Loker Kampus</title>
        <meta name="description" content="SILOKER — Manajemen Data Penyewa Loker Kampus Universitas Jember" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('ikon logo.png') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </x-slot>

    {{-- KODE DUMMY @php SUDAH DIHAPUS KARENA SEKARANG DATA DIAMBIL DARI CONTROLLER --}}

    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    {{-- Modal Box untuk Detail Penyewa --}}
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--blue-dark)">
                    Detail Transaksi Penyewa
                </span>
                <button class="modal-tutup" id="modal-tutup" type="button" title="Tutup">✕</button>
            </div>
            <div id="modal-isi"></div>
        </div>
    </div>

    <div class="page-body">

        {{-- HERO SECTION DATA PENYEWA --}}
        <section class="hero" id="penyewa-hero">
            <div class="hero-badge">
                Universitas Jember · Fakultas Ilmu Komputer
            </div>
            <h1>MANAJEMEN PENYEWA</h1>
            <h2>Sistem Informasi Penyewaan Loker Kampus</h2>
            <p>
                Halaman pencatatan, pemantauan status aktif, masa tenggang sewa,
                serta riwayat identitas mahasiswa yang melakukan peminjaman fasilitas loker.
            </p>
        </section>

        <div class="content-area" style="display: block;">
            <main style="width: 100%;">

                {{-- WRAPPER PENCARIAN PENYEWA --}}
                <div class="search-bar-wrapper" style="margin-bottom: 24px;">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                        Cari &amp; Filter Data Penyewa
                    </h4>
                    <form id="form-search-penyewa" class="search-row">
                        <div class="search-field" style="flex: 2;">
                            <label for="searchPenyewa">Nama / NIM Mahasiswa</label>
                            <input type="text" id="searchPenyewa" name="searchPenyewa"
                                value="{{ request('searchPenyewa') }}" placeholder="Contoh: Fabyan atau 24241010..." />
                        </div>

                        <div class="search-field">
                            <label for="searchLoker">Kode Loker</label>
                            <input type="text" id="searchLoker" name="searchLoker" value="{{ request('searchLoker') }}"
                                placeholder="Contoh: LKR-A101" />
                        </div>

                        <div class="search-field">
                            <label for="statusSewa">Status Kontrak</label>
                            <select id="statusSewa" name="statusSewa">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('statusSewa') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="selesai" {{ request('statusSewa') == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </div>

                        <button class="btn-search" type="submit">Cari Penyewa</button>
                        <a href="{{ url()->current() }}" class="btn-secondary"
                            style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Reset</a>
                    </form>
                </div>

                {{-- TABEL DATA PENYEWA --}}
                <section id="penyewa-list">
                    <div class="section-heading">
                        <h3 class="section-title">Daftar Penyewa Aktif &amp; Riwayat</h3>
                        <span class="section-subtitle">Menampilkan total <span
                                id="total-penyewa">{{ count($penyewa) }}</span> catatan data peminjaman</span>
                    </div>

                    <div
                        style="background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);">
                        <table
                            style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; font-family: 'Segoe UI', sans-serif;">
                            <thead>
                                <tr style="background-color: #1e3a8a; color: #ffffff;">
                                    <th style="padding: 14px 16px; font-weight: 600;">No</th>
                                    <th style="padding: 14px 16px; font-weight: 600;">NIM</th>
                                    <th style="padding: 14px 16px; font-weight: 600;">Nama Mahasiswa</th>
                                    <th style="padding: 14px 16px; font-weight: 600;">Program Studi</th>
                                    <th style="padding: 14px 16px; font-weight: 600; text-align: center;">Kode Loker</th>
                                    <th style="padding: 14px 16px; font-weight: 600;">Tgl Mulai</th>
                                    <th style="padding: 14px 16px; font-weight: 600;">Tgl Selesai</th>
                                    <th style="padding: 14px 16px; font-weight: 600; text-align: center;">Status</th>
                                    <th style="padding: 14px 16px; font-weight: 600; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-penyewa" style="color: #334155;">
                                @forelse ($penyewa as $index => $item)
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;"
                                        onmouseover="this.style.backgroundColor='#f8fafc'"
                                        onmouseout="this.style.backgroundColor='transparent'">
                                        <td style="padding: 14px 16px; font-weight: 600; color: #64748b;">
                                            {{ $index + 1 }}</td>
                                        <td style="padding: 14px 16px; font-family: monospace; font-size: 13px;">
                                            {{ $item->nim }}</td>

                                        {{-- NAMA DIAMBIL DARI RELASI TABEL USERS --}}
                                        <td style="padding: 14px 16px; font-weight: 600; color: #1e293b;">
                                            {{ $item->user->name ?? 'User Tidak Diketahui' }}
                                        </td>

                                        <td style="padding: 14px 16px;">{{ $item->prodi }}</td>
                                        <td style="padding: 14px 16px; text-align: center;"><span
                                                style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 6px; font-weight: 700; font-size: 12px;">{{ $item->kode_loker }}</span>
                                        </td>
                                        <td style="padding: 14px 16px;">{{ date('d M Y', strtotime($item->tgl_mulai)) }}
                                        </td>
                                        <td style="padding: 14px 16px;">{{ date('d M Y', strtotime($item->tgl_selesai)) }}
                                        </td>
                                        <td style="padding: 14px 16px; text-align: center;">
                                            <span
                                                style="
                                                display: inline-block;
                                                padding: 4px 10px;
                                                font-size: 12px;
                                                font-weight: 600;
                                                border-radius: 20px;
                                                text-transform: capitalize;
                                                background-color: {{ $item->status === 'aktif' ? '#e2f5ea' : '#f1f5f9' }};
                                                color: {{ $item->status === 'aktif' ? '#15803d' : '#475569' }};
                                            ">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td style="padding: 14px 16px; text-align: center;">
                                            <div style="display: inline-flex; gap: 6px;">
                                                <button class="btn-card-detail btn-view-penyewa"
                                                    data-id="{{ $item->id }}" title="Lihat Transaksi"
                                                    style="padding: 6px 10px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                    </svg>
                                                </button>
                                                @if (Auth::check() && Auth::user()->role === 'admin')
                                                    <button class="btn-card-edit" title="Edit Data"
                                                        style="padding: 6px 10px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" fill="currentColor" class="bi bi-pencil-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" style="padding: 20px; text-align: center; color: #64748b;">
                                            Belum ada data penyewa / Data tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </main>
        </div>

        {{-- FOOTER SETEMA --}}
        <footer class="footer" style="margin-top: 40px;">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">SILOKER</div>
                    <div class="footer-teal-bar"></div>
                    <p>Sistem Informasi Penyewaan Loker Kampus — platform digital terpadu untuk pengelolaan loker di
                        Universitas Jember secara efisien dan transparan.</p>
                </div>
                <div>
                    <div class="footer-col-title">Navigasi</div>
                    <ul class="footer-links">
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/dashboard#loker">Data Loker</a></li>
                        <li><a href="#penyewa-hero">Data Penyewa</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Informasi</div>
                    <div class="footer-info-item">
                        <span class="footer-info-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-buildings" viewBox="0 0 16 16">
                                <path
                                    d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                            </svg>
                        </span>
                        <p><strong>Universitas Jember</strong><br>Fakultas Ilmu Komputer</p>
                    </div>
                    <div class="footer-info-item">
                        <span class="footer-info-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-heart" viewBox="0 0 16 16">
                                <path
                                    d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                            </svg>
                        </span>
                        <p><strong>Dibuat oleh</strong><br>Talitha Puspitasari</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 <strong>SILOKER</strong> — Sistem Informasi Penyewaan Loker Kampus</p>
                <p>Universitas Jember · Fakultas Ilmu Komputer</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalOverlay = document.getElementById("modal-overlay");
            const modalIsi = document.getElementById("modal-isi");
            const modalTutup = document.getElementById("modal-tutup");


            const formSearch = document.getElementById('form-search-penyewa');
            const tbodyPenyewa = document.getElementById('tbody-penyewa');
            const totalPenyewa = document.getElementById('total-penyewa');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


            let penyewaDetails = {};
            @foreach ($penyewa as $p)
                penyewaDetails[{{ $p->id }}] = {
                    nim: '{{ $p->nim }}',
                    nama: '{{ addslashes($p->user->name ?? 'User Tidak Diketahui') }}',
                    prodi: '{{ $p->prodi }}',
                    loker: '{{ $p->kode_loker }}',
                    mulai: '{{ date('d M Y', strtotime($p->tgl_mulai)) }}',
                    selesai: '{{ date('d M Y', strtotime($p->tgl_selesai)) }}',
                    status: '{{ $p->status }}',
                    jaminan: 'KTM / KTP',
                    pengelola: 'Admin Fasilkom'
                };
            @endforeach


            async function fetchPenyewa() {

                const formData = new FormData(formSearch);
                const searchParams = new URLSearchParams(formData).toString();

                try {

                    const loadingOverlay = document.getElementById('loading-overlay');
                    if (loadingOverlay) loadingOverlay.style.display = 'flex';

                    const response = await fetch(`{{ url()->current() }}?${searchParams}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (!response.ok) throw new Error('Network error');

                    const result = await response.json();


                    if (totalPenyewa) totalPenyewa.textContent = result.total;

                    let html = '';


                    penyewaDetails = {};

                    if (result.data.length === 0) {
                        html =
                            `<tr><td colspan="9" style="padding: 20px; text-align: center; color: #64748b;">Data tidak ditemukan.</td></tr>`;
                    } else {
                        result.data.forEach((item, index) => {

                            penyewaDetails[item.id] = {
                                nim: item.nim,
                                nama: item.nama,
                                prodi: item.prodi,
                                loker: item.kode_loker,
                                mulai: item.tgl_mulai,
                                selesai: item.tgl_selesai,
                                status: item.status,
                                jaminan: 'KTM / KTP',
                                pengelola: 'Admin Fasilkom'
                            };

                            const bgStatus = item.status === 'aktif' ? '#e2f5ea' : '#f1f5f9';
                            const colorStatus = item.status === 'aktif' ? '#15803d' : '#475569';

                            const adminButtons = item.is_admin ? `
                            <button class="btn-card-edit" title="Edit Data" style="padding: 6px 10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/></svg>
                            </button>
                        ` : '';


                            html += `
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 14px 16px; font-weight: 600; color: #64748b;">${index + 1}</td>
                                <td style="padding: 14px 16px; font-family: monospace; font-size: 13px;">${item.nim}</td>
                                <td style="padding: 14px 16px; font-weight: 600; color: #1e293b;">${item.nama}</td>
                                <td style="padding: 14px 16px;">${item.prodi}</td>
                                <td style="padding: 14px 16px; text-align: center;"><span style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 6px; font-weight: 700; font-size: 12px;">${item.kode_loker}</span></td>
                                <td style="padding: 14px 16px;">${item.tgl_mulai}</td>
                                <td style="padding: 14px 16px;">${item.tgl_selesai}</td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    <span style="display: inline-block; padding: 4px 10px; font-size: 12px; font-weight: 600; border-radius: 20px; text-transform: capitalize; background-color: ${bgStatus}; color: ${colorStatus};">${item.status}</span>
                                </td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <button class="btn-card-detail btn-view-penyewa" data-id="${item.id}" title="Lihat Transaksi" style="padding: 6px 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                                        </button>
                                        ${adminButtons}
                                    </div>
                                </td>
                            </tr>
                        `;
                        });
                    }


                    tbodyPenyewa.innerHTML = html;

                    if (loadingOverlay) loadingOverlay.style.display = 'none';

                } catch (error) {
                    console.error('Pencarian gagal:', error);
                    if (document.getElementById('loading-overlay')) document.getElementById('loading-overlay')
                        .style.display = 'none';
                }
            }


            if (formSearch) {
                formSearch.addEventListener('submit', function(e) {
                    e.preventDefault();
                    fetchPenyewa();
                });


                const inputs = formSearch.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.addEventListener('input', fetchPenyewa);
                });
            }


            document.addEventListener("click", function(e) {
                const targetBtn = e.target.closest(".btn-view-penyewa");
                if (targetBtn) {
                    const id = targetBtn.getAttribute("data-id");
                    const data = penyewaDetails[id];

                    if (data) {
                        modalIsi.innerHTML = `
                        <div style="padding: 10px 0; font-family: 'Segoe UI', sans-serif;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b; width:40%;">Nama / NIM</td><td style="padding: 10px; font-weight:700;">${data.nama} (${data.nim})</td></tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b;">Program Studi</td><td style="padding: 10px;">${data.prodi}</td></tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b;">Loker Dipinjam</td><td style="padding: 10px; font-weight:700; color:#1e3a8a;">${data.loker}</td></tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b;">Masa Sewa</td><td style="padding: 10px; color:#334155;">${data.mulai} s.d ${data.selesai}</td></tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b;">Dokumen Jaminan</td><td style="padding: 10px; font-style:italic;">${data.jaminan}</td></tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px; font-weight:600; color:#64748b;">Didaftarkan Oleh</td><td style="padding: 10px;">${data.pengelola}</td></tr>
                                <tr>
                                    <td style="padding: 10px; font-weight: 600; color: #64748b;">Status Kontrak</td>
                                    <td style="padding: 10px;">
                                        <span style="display:inline-block; padding:4px 10px; font-size:12px; font-weight:600; border-radius:12px; text-transform:capitalize;
                                            background-color: ${data.status === 'aktif' ? '#e2f5ea' : '#f1f5f9'};
                                            color: ${data.status === 'aktif' ? '#15803d' : '#475569'};">
                                            ${data.status}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    `;
                        modalOverlay.style.display = "flex";
                    }
                }
            });

            if (modalTutup) {
                modalTutup.addEventListener("click", function() {
                    modalOverlay.style.display = "none";
                });
            }
            window.addEventListener("click", function(e) {
                if (e.target === modalOverlay) modalOverlay.style.display = "none";
            });
        });
    </script>
@endsection
