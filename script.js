// ----------------------------------------------------------------
// BAB 1 - VARIABEL
// pakai const buat yang nilainya gak berubah,
// pakai let buat yang nilainya bisa berubah-ubah
// ----------------------------------------------------------------

const NAMA_APLIKASI = 'SILOKER';
const VERSI         = '1.0.0';
const MAX_LOKER     = 120;

// harga default tiap ukuran loker (disimpan dalam object)
const HARGA_MAP = {
  kecil  : 3000,
  sedang : 5000,
  besar  : 8000
};

// data loker awal bentuknya array berisi object2
let daftarLoker = [
  { id: 1, kode: 'LKR-A101', lokasi: 'Gedung A / Lantai 1', ukuran: 'sedang', harga: 5000, pengelola: 'Budi Santoso',   status: 'tersedia'   },
  { id: 2, kode: 'LKR-B204', lokasi: 'Gedung B / Lantai 2', ukuran: 'besar',  harga: 8000, pengelola: 'Sari Dewi',     status: 'disewa'      },
  { id: 3, kode: 'LKR-C305', lokasi: 'Gedung C / Lantai 3', ukuran: 'kecil',  harga: 3000, pengelola: 'Ahmad Fauzi',   status: 'tersedia'    },
  { id: 4, kode: 'LKR-D112', lokasi: 'Gedung D / Lantai 1', ukuran: 'besar',  harga: 8000, pengelola: 'Rina Wati',     status: 'maintenance' },
  { id: 5, kode: 'LKR-E408', lokasi: 'Gedung E / Lantai 4', ukuran: 'sedang', harga: 5000, pengelola: 'Dian Pratama',  status: 'disewa'      },
  { id: 6, kode: 'LKR-F215', lokasi: 'Gedung F / Lantai 2', ukuran: 'kecil',  harga: 3000, pengelola: 'Hendra Kusuma', status: 'tersedia'    },
];

// variabel penanda kalau lagi edit, isi idEditAktif dengan id lokernya
// kalau lagi tambah baru, nilainya null
let idEditAktif = null;

// hasilFilter menyimpan data yang sedang ditampilkan (bisa berubah saat filter/cari)
let hasilFilter = [...daftarLoker];

// cek di konsol browser kalau aplikasi sudah jalan
console.log(`Aplikasi ${NAMA_APLIKASI} v${VERSI} berhasil dimuat`);
console.log(`Jumlah loker terdaftar: ${daftarLoker.length} dari ${MAX_LOKER} total kapasitas`);


// ----------------------------------------------------------------
// BAB 2 - FUNGSI, ARRAY, OBJECT
// ----------------------------------------------------------------

// fungsi untuk mengubah angka jadi format rupiah
// contoh: 5000 -> "Rp 5.000"
const formatRupiah = (angka) =>
  'Rp ' + Number(angka).toLocaleString('id-ID');

// fungsi untuk membuat huruf pertama kapital, sisanya kecil
// contoh: "TERSEDIA" -> "Tersedia"
const kapitalisasi = (str) =>
  str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();

// fungsi untuk menentukan nama class badge berdasarkan status
// pakai ternary operator berantai (if-else pendek)
const getBadgeClass = (status) =>
  status === 'tersedia'   ? 'badge-tersedia'    :
  status === 'disewa'     ? 'badge-disewa'       :
                            'badge-maintenance';

// fungsi untuk menghitung statistik loker
// pakai .filter() dan .reduce() dari array methods
function hitungStatistik(arr) {
  const total       = arr.length;
  const tersedia    = arr.filter(l => l.status === 'tersedia').length;
  const disewa      = arr.filter(l => l.status === 'disewa').length;
  const maintenance = arr.filter(l => l.status === 'maintenance').length;

  // .reduce() untuk menjumlahkan harga semua loker yang tersedia
  const totalHarga = arr
    .filter(l => l.status === 'tersedia')
    .reduce((total, l) => total + l.harga, 0);

  return { total, tersedia, disewa, maintenance, totalHarga };
}

// fungsi untuk mencari loker berdasarkan kata kunci dan status
// pakai .filter() + .includes() untuk mengecek kecocokan teks
function cariLoker(arr, katakunci, statusFilter) {
  const kw = katakunci.trim().toLowerCase();

  return arr.filter(loker => {
    // cek apakah kode, lokasi, atau nama pengelola mengandung kata kunci
    const cocokTeks = !kw ||
      loker.kode.toLowerCase().includes(kw) ||
      loker.lokasi.toLowerCase().includes(kw) ||
      loker.pengelola.toLowerCase().includes(kw);

    // cek apakah statusnya sesuai filter
    const cocokStatus = !statusFilter || loker.status === statusFilter;

    return cocokTeks && cocokStatus;
  });
}

// fungsi untuk mengurutkan data loker
// pakai spread [...arr] biar array aslinya tidak ikut berubah
const urutkanLoker = (arr, kolom = 'kode', arah = 'asc') => {
  return [...arr].sort((a, b) => {
    const nilaiA = typeof a[kolom] === 'string' ? a[kolom].toLowerCase() : a[kolom];
    const nilaiB = typeof b[kolom] === 'string' ? b[kolom].toLowerCase() : b[kolom];
    if (nilaiA < nilaiB) return arah === 'asc' ? -1 : 1;
    if (nilaiA > nilaiB) return arah === 'asc' ?  1 : -1;
    return 0;
  });
};

// fungsi untuk membuat id baru secara otomatis
// ambil id terbesar yang sudah ada, lalu tambah 1
const buatIdBaru = () => Math.max(0, ...daftarLoker.map(l => l.id)) + 1;


// ----------------------------------------------------------------
// BAB 3, DOM QUERY
// ambil semua elemen HTML yang akan dipakai
// ----------------------------------------------------------------

const elNavToggle      = document.getElementById('navToggle');
const elMobileMenu     = document.getElementById('mobileMenu');
const elSidebarToggle  = document.getElementById('sidebarToggle');
const elSidebarContent = document.getElementById('sidebarContent');
const elLokerGrid      = document.getElementById('loker-grid');
const elTbody          = document.getElementById('tabel-tbody');
const elTabelTotal     = document.getElementById('tabel-total');
const elFormLoker      = document.getElementById('form-loker');
const elFormTitle      = document.getElementById('form-title');
const elBtnSubmit      = document.getElementById('btn-submit');
const elBtnReset       = document.getElementById('btn-reset-form');
const elNotifBox       = document.getElementById('notif-box');
const elModalOverlay   = document.getElementById('modal-overlay');
const elModalIsi       = document.getElementById('modal-isi');
const elModalTutup     = document.getElementById('modal-tutup');
const elLoadingOverlay = document.getElementById('loading-overlay');

// ambil semua angka statistik di hero (pakai querySelectorAll -> NodeList)
const elStatNums = document.querySelectorAll('.hero-stat-num');

// kumpulkan semua input form dalam satu object biar gampang diakses
const INPUT = {
  kode       : document.getElementById('kodeLoker'),
  lokasi     : document.getElementById('lokasiLoker'),
  ukuran     : document.getElementById('ukuranLoker'),
  jumlah     : document.getElementById('jumlahLoker'),
  harga      : document.getElementById('hargaSewa'),
  tanggal    : document.getElementById('tanggalTersedia'),
  pengelola  : document.getElementById('namaPengelola'),
  keterangan : document.getElementById('keterangan'),
  status     : document.getElementById('statusLoker'),
};

// input di bagian pencarian
const CARI = {
  kode   : document.getElementById('searchKode'),
  lokasi : document.getElementById('searchLokasi'),
  status : document.getElementById('searchStatus'),
};


// ----------------------------------------------------------------
// BAB 3, MANIPULASI DOM
// fungsi2 untuk menampilkan data ke halaman
// ----------------------------------------------------------------

// fungsi render kartu loker ke dalam grid
// pakai .map() untuk ubah array jadi deretan HTML, lalu .join('') untuk gabungkan
function renderKartu(arr) {
  if (!elLokerGrid) return;

  // kalau datanya kosong, tampilkan pesan
  if (arr.length === 0) {
    elLokerGrid.innerHTML = `
      <div style="grid-column:1/-1; text-align:center; padding:40px; color:var(--gray-400)">
        <div style="font-size:48px; margin-bottom:12px">📭</div>
        <p style="font-size:15px; font-weight:600">Tidak ada loker ditemukan</p>
        <p style="font-size:13px">Coba ubah kata kunci atau filter pencarian</p>
      </div>`;
    return;
  }

  // buat HTML untuk setiap loker pakai template literal + .map()
  elLokerGrid.innerHTML = arr.map((loker, i) => `
    <div class="loker-card" data-id="${loker.id}" style="animation-delay:${i * 0.06}s">
      <div class="loker-card-header">
        <span class="loker-card-code">${loker.kode}</span>
        <span class="badge ${getBadgeClass(loker.status)}">${kapitalisasi(loker.status)}</span>
      </div>
      <div class="loker-card-body">
        <div class="loker-info-row">
          <span class="loker-info-icon">📍</span>
          <span class="loker-info-key">Lokasi</span>
          <span class="loker-info-val">${loker.lokasi}</span>
        </div>
        <div class="loker-info-row">
          <span class="loker-info-icon">📦</span>
          <span class="loker-info-key">Ukuran</span>
          <span class="loker-info-val">${kapitalisasi(loker.ukuran)}</span>
        </div>
        <div class="loker-info-row">
          <span class="loker-info-icon">👤</span>
          <span class="loker-info-key">Pengelola</span>
          <span class="loker-info-val">${loker.pengelola}</span>
        </div>
      </div>
      <div class="loker-card-footer">
        <div class="loker-price">${formatRupiah(loker.harga)} <small>/ hari</small></div>
        <div style="display:flex; gap:6px">
          <button class="btn-card-detail" data-id="${loker.id}" title="Lihat Detail">🔍</button>
          <button class="btn-card-edit"   data-id="${loker.id}" title="Edit">✏️</button>
          <button class="btn-card-hapus"  data-id="${loker.id}" title="Hapus">🗑️</button>
        </div>
      </div>
    </div>`).join('');
}

// fungsi render baris-baris tabel loker
function renderTabel(arr) {
  if (!elTbody) return;

  // update tulisan jumlah loker di pojok kanan header tabel
  if (elTabelTotal) elTabelTotal.textContent = `${arr.length} loker ditampilkan`;

  // kalau kosong, tampilkan satu baris pemberitahuan
  if (arr.length === 0) {
    elTbody.innerHTML = `
      <tr>
        <td colspan="7" style="text-align:center; padding:28px; color:var(--gray-400)">
          Tidak ada data loker yang cocok
        </td>
      </tr>`;
    return;
  }

  // buat setiap baris tabel dari data loker
  elTbody.innerHTML = arr.map((l, i) => `
    <tr data-id="${l.id}">
      <td>${i + 1}</td>
      <td><span class="td-code">${l.kode}</span></td>
      <td>${l.lokasi}</td>
      <td>${kapitalisasi(l.ukuran)}</td>
      <td>${formatRupiah(l.harga)}</td>
      <td><span class="badge ${getBadgeClass(l.status)}">${kapitalisasi(l.status)}</span></td>
      <td>
        <div style="display:flex; gap:6px; flex-wrap:wrap">
          <button class="btn-tbl-detail btn-aksi"              data-id="${l.id}">Detail</button>
          <button class="btn-tbl-edit   btn-aksi btn-aksi-edit" data-id="${l.id}">Edit</button>
          <button class="btn-tbl-hapus  btn-aksi btn-aksi-hapus" data-id="${l.id}">Hapus</button>
        </div>
      </td>
    </tr>`).join('');
}

// fungsi untuk memperbarui angka-angka di bagian hero (total, tersedia, dll)
function updateAngkaHero() {
  const stat = hitungStatistik(daftarLoker);
  const nilai = [stat.total, stat.tersedia, stat.disewa, daftarLoker.length];

  // forEach untuk iterasi NodeList hasil querySelectorAll
  elStatNums.forEach((el, i) => {
    if (nilai[i] !== undefined) el.textContent = nilai[i];
  });
}

// fungsi untuk memperbarui angka di setiap filter sidebar
function updateAngkaSidebar() {
  const stat = hitungStatistik(daftarLoker);
  document.querySelectorAll('[data-stat]').forEach(el => {
    const key = el.dataset.stat;
    if (stat[key] !== undefined) el.textContent = stat[key];
  });
}


// ----------------------------------------------------------------
// BAB 4, VALIDASI FORM
// aturan validasi disimpan dalam object, tiap field punya aturannya sendiri
// ----------------------------------------------------------------

const aturanValidasi = {
  kodeLoker: {
    required  : true,
    pattern   : /^LKR-[A-Z]\d{3}$/i,  // harus format LKR-A101
    pesan     : 'Format kode harus: LKR-A101 (huruf besar + 3 angka)'
  },
  lokasiLoker: {
    required  : true,
    minLength : 5,
    pesan     : 'Lokasi minimal 5 karakter'
  },
  namaPengelola: {
    required  : true,
    minLength : 3,
    pesan     : 'Nama pengelola minimal 3 karakter'
  },
  hargaSewa: {
    required  : true,
    min       : 1000,
    max       : 100000,
    pesan     : 'Harga harus antara Rp 1.000 sampai Rp 100.000'
  }
};

// fungsi untuk menampilkan atau menghapus pesan error di bawah input
function tampilkanError(fieldId, pesan) {
  const input   = document.getElementById(fieldId);
  const errorEl = document.getElementById(`error-${fieldId}`);
  if (!input) return;

  if (pesan) {
    // ada error: kasih border merah + tampilkan pesan
    input.classList.add('input-error');
    input.classList.remove('input-valid');
    if (errorEl) errorEl.textContent = pesan;
  } else {
    // tidak ada error: kasih border hijau + kosongkan pesan
    input.classList.remove('input-error');
    input.classList.add('input-valid');
    if (errorEl) errorEl.textContent = '';
  }
}

// fungsi untuk memvalidasi satu field berdasarkan aturan yang sudah ditentukan
function validasiSatuField(id, aturan) {
  const input = document.getElementById(id);
  if (!input) return true;

  const nilai = input.value.trim();
  let pesanError = '';

  if (aturan.required && !nilai) {
    pesanError = 'Field ini wajib diisi';
  } else if (aturan.pattern && !aturan.pattern.test(nilai)) {
    pesanError = aturan.pesan;
  } else if (aturan.minLength && nilai.length < aturan.minLength) {
    pesanError = aturan.pesan;
  } else if (aturan.min !== undefined && parseFloat(nilai) < aturan.min) {
    pesanError = aturan.pesan;
  } else if (aturan.max !== undefined && parseFloat(nilai) > aturan.max) {
    pesanError = aturan.pesan;
  }

  tampilkanError(id, pesanError);
  return pesanError === ''; // kembalikan true kalau tidak ada error
}

// fungsi untuk validasi semua field sekaligus saat tombol simpan diklik
function validasiSemuaField() {
  // Object.entries() untuk iterasi semua aturan
  // .map() untuk jalankan validasi tiap field
  // .every() untuk cek apakah semuanya valid
  return Object.entries(aturanValidasi)
    .map(([id, aturan]) => validasiSatuField(id, aturan))
    .every(hasilValid => hasilValid === true);
}

// fungsi untuk menampilkan notifikasi pop-up di pojok kanan bawah
function tampilkanNotifikasi(pesan, tipe = 'success') {
  if (!elNotifBox) return;
  elNotifBox.textContent = pesan;
  elNotifBox.className   = `notif-box notif-${tipe}`;
  elNotifBox.classList.add('notif-tampil');

  // notifikasi hilang otomatis setelah 3 detik
  setTimeout(() => elNotifBox.classList.remove('notif-tampil'), 3000);
}

// fungsi untuk mereset form ke kondisi awal (mode tambah, bukan edit)
function resetForm() {
  if (elFormLoker) elFormLoker.reset();
  idEditAktif = null;
  if (elFormTitle) elFormTitle.textContent = 'Tambah Data Loker';
  if (elBtnSubmit) elBtnSubmit.value = 'Simpan Data Loker';

  // hapus semua warna merah/hijau bekas validasi
  document.querySelectorAll('.input-error, .input-valid').forEach(el => {
    el.classList.remove('input-error', 'input-valid');
  });
  document.querySelectorAll('.error-msg').forEach(el => {
    el.textContent = '';
  });
}

// fungsi untuk mengisi form dengan data loker yang mau diedit
function isiFormUntukEdit(loker) {
  // destructuring: ambil properti dari object loker sekaligus
  const { kode, lokasi, ukuran, harga, pengelola, status } = loker;

  if (INPUT.kode)      INPUT.kode.value      = kode;
  if (INPUT.lokasi)    INPUT.lokasi.value    = lokasi;
  if (INPUT.ukuran)    INPUT.ukuran.value    = ukuran;
  if (INPUT.harga)     INPUT.harga.value     = harga;
  if (INPUT.pengelola) INPUT.pengelola.value = pengelola;
  if (INPUT.status)    INPUT.status.value    = status;

  // tandai kalau sekarang sedang mode edit
  idEditAktif = loker.id;
  if (elFormTitle) elFormTitle.textContent = `Edit Loker: ${kode}`;
  if (elBtnSubmit) elBtnSubmit.value = 'Simpan Perubahan';

  // scroll halaman ke bagian form
  elFormLoker?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// fungsi untuk menampilkan pop-up detail loker
function tampilkanModal(loker) {
  if (!elModalOverlay || !elModalIsi) return;

  // spread object: salin semua data loker ke variabel detail
  const detail = { ...loker };

  elModalIsi.innerHTML = `
    <div class="modal-header-inner">
      <span class="loker-card-code" style="font-size:18px">${detail.kode}</span>
      <span class="badge ${getBadgeClass(detail.status)}">${kapitalisasi(detail.status)}</span>
    </div>
    <table class="modal-table">
      <tr><th>Lokasi</th>   <td>${detail.lokasi}</td></tr>
      <tr><th>Ukuran</th>   <td>${kapitalisasi(detail.ukuran)}</td></tr>
      <tr><th>Harga/Hari</th><td>${formatRupiah(detail.harga)}</td></tr>
      <tr><th>Pengelola</th><td>${detail.pengelola}</td></tr>
      <tr><th>Status</th>   <td><span class="badge ${getBadgeClass(detail.status)}">${kapitalisasi(detail.status)}</span></td></tr>
    </table>
    <p style="font-size:12px; color:var(--gray-400); margin-top:12px">
      Estimasi sewa 30 hari: <strong>${formatRupiah(detail.harga * 30)}</strong>
    </p>`;

  elModalOverlay.classList.add('modal-buka');
}


// ----------------------------------------------------------------
// BAB 4, EVENT LISTENER
// pasang "pendengar" di tiap elemen yang butuh interaksi
// ----------------------------------------------------------------

// klik tombol hamburger di mobile -> buka/tutup menu
elNavToggle?.addEventListener('click', () => {
  elNavToggle.classList.toggle('open');
  elMobileMenu.classList.toggle('open');
});

// klik salah satu link di menu mobile -> tutup menu
elMobileMenu?.querySelectorAll('a').forEach(link =>
  link.addEventListener('click', () => {
    elNavToggle.classList.remove('open');
    elMobileMenu.classList.remove('open');
  })
);

// klik tombol "Filter & Navigasi" di sidebar -> buka/tutup isi sidebar
elSidebarToggle?.addEventListener('click', () => {
  elSidebarToggle.classList.toggle('open');
  elSidebarContent.classList.toggle('open');
});

// klik tombol "Reset Filter" -> centang ulang semua checkbox, tampilkan semua data
document.querySelector('.btn-filter-reset')?.addEventListener('click', () => {
  document.querySelectorAll('.sidebar-content input[type="checkbox"]')
    .forEach(cb => { cb.checked = true; });
  hasilFilter = [...daftarLoker];
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
  tampilkanNotifikasi('Filter berhasil direset', 'info');
});

// checkbox status di sidebar berubah -> langsung filter data
document.querySelectorAll('.filter-status').forEach(cb => {
  cb.addEventListener('change', filterBerdasarkanSidebar);
});

function filterBerdasarkanSidebar() {
  // kumpulkan value dari semua checkbox yang dicentang
  const statusDipilih = [...document.querySelectorAll('.filter-status:checked')]
    .map(cb => cb.value);

  // filter data hanya yang statusnya ada di daftar yang dicentang
  hasilFilter = daftarLoker.filter(l => statusDipilih.includes(l.status));
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
}

// fungsi pencarian yang dipanggil oleh beberapa event
function jalankanPencarian() {
  const kata   = CARI.kode?.value   ?? '';
  const lokasi = CARI.lokasi?.value ?? '';
  const status = CARI.status?.value ?? '';

  // gabungkan kata kunci kode dan lokasi
  hasilFilter = cariLoker(daftarLoker, kata + ' ' + lokasi, status);
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
}

// input di kotak pencarian -> langsung cari (real-time)
CARI.kode?.addEventListener('input',   jalankanPencarian);
CARI.lokasi?.addEventListener('input', jalankanPencarian);
CARI.status?.addEventListener('change', jalankanPencarian);

// tombol "Cari Loker"
document.querySelector('.btn-search')?.addEventListener('click', jalankanPencarian);

// tombol "Reset" di form pencarian -> kosongkan pencarian, tampilkan semua data
document.querySelector('.btn-secondary')?.addEventListener('click', () => {
  if (CARI.kode)   CARI.kode.value   = '';
  if (CARI.lokasi) CARI.lokasi.value = '';
  if (CARI.status) CARI.status.value = '';
  hasilFilter = [...daftarLoker];
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
});

// submit form tambah/edit loker
elFormLoker?.addEventListener('submit', function(e) {
  e.preventDefault(); // hentikan reload halaman bawaan browser

  // cek dulu apakah semua field sudah valid
  if (!validasiSemuaField()) {
    tampilkanNotifikasi('Harap perbaiki kesalahan pada form', 'error');
    return;
  }

  // kumpulkan semua nilai dari input form
  const dataForm = {
    kode       : INPUT.kode.value.trim().toUpperCase(),
    lokasi     : INPUT.lokasi.value.trim(),
    ukuran     : INPUT.ukuran.value,
    jumlah     : parseInt(INPUT.jumlah?.value) || 1,
    harga      : parseInt(INPUT.harga.value),
    tanggal    : INPUT.tanggal?.value ?? '',
    pengelola  : INPUT.pengelola.value.trim(),
    keterangan : INPUT.keterangan?.value.trim() ?? '',
    status     : INPUT.status?.value ?? 'tersedia',
  };

  if (idEditAktif !== null) {
    // kalau lagi mode edit: cari index loker yang mau diubah, lalu update
    const index = daftarLoker.findIndex(l => l.id === idEditAktif);
    if (index !== -1) {
      // spread operator: gabung data lama dengan data baru
      daftarLoker[index] = { ...daftarLoker[index], ...dataForm };
    }
    tampilkanNotifikasi(`Loker ${dataForm.kode} berhasil diperbarui`);
  } else {
    // kalau mode tambah: buat object baru lalu push ke array
    const lokerBaru = { id: buatIdBaru(), ...dataForm };
    daftarLoker.push(lokerBaru);
    tampilkanNotifikasi(`Loker ${dataForm.kode} berhasil ditambahkan`);
  }

  // simpan ke localStorage supaya tidak hilang kalau halaman di-refresh
  simpanKeLocalStorage();

  // perbarui tampilan
  hasilFilter = [...daftarLoker];
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
  updateAngkaHero();
  updateAngkaSidebar();
  resetForm();
});

// tombol "Batal / Reset" di form
elBtnReset?.addEventListener('click', resetForm);

// klik tombol di dalam kartu loker (pakai event delegation)
// satu addEventListener di parent, cek siapa yang diklik pakai .closest()
elLokerGrid?.addEventListener('click', function(e) {
  const btnDetail = e.target.closest('.btn-card-detail');
  const btnEdit   = e.target.closest('.btn-card-edit');
  const btnHapus  = e.target.closest('.btn-card-hapus');

  if (btnDetail) {
    const loker = daftarLoker.find(l => l.id === parseInt(btnDetail.dataset.id));
    if (loker) tampilkanModal(loker);
  }
  if (btnEdit) {
    const loker = daftarLoker.find(l => l.id === parseInt(btnEdit.dataset.id));
    if (loker) isiFormUntukEdit(loker);
  }
  if (btnHapus) {
    hapusLoker(parseInt(btnHapus.dataset.id));
  }
});

// klik tombol di dalam tabel (juga pakai event delegation)
elTbody?.addEventListener('click', function(e) {
  const btnDetail = e.target.closest('.btn-tbl-detail');
  const btnEdit   = e.target.closest('.btn-tbl-edit');
  const btnHapus  = e.target.closest('.btn-tbl-hapus');

  if (btnDetail) {
    const loker = daftarLoker.find(l => l.id === parseInt(btnDetail.dataset.id));
    if (loker) tampilkanModal(loker);
  }
  if (btnEdit) {
    const loker = daftarLoker.find(l => l.id === parseInt(btnEdit.dataset.id));
    if (loker) isiFormUntukEdit(loker);
  }
  if (btnHapus) {
    hapusLoker(parseInt(btnHapus.dataset.id));
  }

  // klik cell tabel -> highlight baris yang diklik
  if (e.target.tagName === 'TD') {
    document.querySelectorAll('#tabel-tbody tr').forEach(baris =>
      baris.classList.remove('row-selected')
    );
    e.target.parentElement.classList.add('row-selected');
  }
});

// fungsi hapus loker, minta konfirmasi dulu sebelum benar-benar dihapus
function hapusLoker(id) {
  const loker = daftarLoker.find(l => l.id === id);
  if (!loker) return;

  const setuju = confirm(`Hapus loker ${loker.kode}?\nData yang dihapus tidak bisa dikembalikan.`);
  if (!setuju) return;

  // filter: buang loker yang id-nya sama, sisanya tetap
  daftarLoker = daftarLoker.filter(l => l.id !== id);
  hasilFilter = hasilFilter.filter(l => l.id !== id);

  simpanKeLocalStorage();
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);
  updateAngkaHero();
  updateAngkaSidebar();
  tampilkanNotifikasi(`Loker ${loker.kode} berhasil dihapus`, 'info');
}

// tombol X di modal -> tutup modal
elModalTutup?.addEventListener('click', () => {
  elModalOverlay.classList.remove('modal-buka');
});

// klik area gelap di luar modal -> juga tutup modal
elModalOverlay?.addEventListener('click', (e) => {
  if (e.target === elModalOverlay) {
    elModalOverlay.classList.remove('modal-buka');
  }
});

// validasi real-time: saat user keluar dari input (blur), langsung cek
Object.entries(aturanValidasi).forEach(([id, aturan]) => {
  const input = document.getElementById(id);
  // blur: user pindah ke field lain
  input?.addEventListener('blur', () => validasiSatuField(id, aturan));
  // input: kalau field sudah merah, validasi ulang setiap ketikan
  input?.addEventListener('input', () => {
    if (input.classList.contains('input-error')) validasiSatuField(id, aturan);
  });
});

// kalau pilihan ukuran berubah, isi otomatis harga sesuai harga default-nya
INPUT.ukuran?.addEventListener('change', function() {
  const hargaDefault = HARGA_MAP[this.value];
  if (hargaDefault && INPUT.harga) INPUT.harga.value = hargaDefault;
});


// ----------------------------------------------------------------
// BAB 4, LOCALSTORAGE
// simpan data ke browser supaya tidak hilang saat refresh
// ----------------------------------------------------------------

const KUNCI_STORAGE = 'siloker_data';

// simpan array daftarLoker ke localStorage
// harus diubah ke string JSON dulu pakai JSON.stringify()
function simpanKeLocalStorage() {
  try {
    localStorage.setItem(KUNCI_STORAGE, JSON.stringify(daftarLoker));
    console.log(`Data disimpan: ${daftarLoker.length} loker`);
  } catch (err) {
    console.error('Gagal menyimpan:', err);
  }
}

// muat data dari localStorage saat halaman pertama kali dibuka
// JSON.parse() untuk mengubah string JSON kembali ke array
function muatDariLocalStorage() {
  try {
    const dataString = localStorage.getItem(KUNCI_STORAGE);
    const data = JSON.parse(dataString ?? 'null');

    if (Array.isArray(data) && data.length > 0) {
      daftarLoker = data;
      console.log(`Data berhasil dimuat: ${data.length} loker dari localStorage`);
    }
  } catch (err) {
    console.warn('Tidak bisa baca localStorage, pakai data default saja');
  }
}


// ----------------------------------------------------------------
// BAB 5, FETCH API
// ambil data dari server/API menggunakan async/await
// ----------------------------------------------------------------

// tampilkan atau sembunyikan animasi loading
function aturLoading(tampil) {
  if (!elLoadingOverlay) return;
  elLoadingOverlay.style.display = tampil ? 'flex' : 'none';
}

// fungsi utama: ambil data penyewa dari API publik JSONPlaceholder
// async/await supaya bisa "menunggu" tanpa membekukan halaman
async function ambilDataPenyewaAPI() {
  try {
    aturLoading(true); // tampilkan loading spinner

    // Promise.all: jalankan 2 fetch bersamaan, lebih cepat dari satu per satu
    const [resUsers, resPosts] = await Promise.all([
      fetch('https://jsonplaceholder.typicode.com/users'),
      fetch('https://jsonplaceholder.typicode.com/posts?_limit=6')
    ]);

    // cek kalau ada error dari server
    if (!resUsers.ok) throw new Error(`Gagal ambil users: ${resUsers.status}`);
    if (!resPosts.ok) throw new Error(`Gagal ambil posts: ${resPosts.status}`);

    // .json() untuk parsing response jadi object JavaScript
    const users = await resUsers.json();
    const posts = await resPosts.json();

    // tampilkan data ke halaman
    renderPanelPenyewa(users.slice(0, 5));

    console.log(`Fetch selesai: ${users.length} pengguna diterima`);
    tampilkanNotifikasi('Data penyewa berhasil dimuat dari server');

  } catch (error) {
    // kalau fetch gagal (misal tidak ada internet)
    console.error('Fetch gagal:', error.message);
    tampilkanNotifikasi(`Gagal memuat data: ${error.message}`, 'error');
    tampilkanErrorFetch();

  } finally {
    // finally selalu dijalankan, baik berhasil maupun gagal
    aturLoading(false); // sembunyikan loading spinner
  }
}

// tampilkan daftar penyewa hasil fetch ke panel di halaman
function renderPanelPenyewa(users) {
  const el = document.getElementById('panel-penyewa');
  if (!el) return;

  el.innerHTML = `
    <div class="section-heading" style="margin-bottom:14px">
      <h3 class="section-title">Data Penyewa (API)</h3>
      <span class="section-subtitle">Dari JSONPlaceholder</span>
    </div>
    <div class="penyewa-list">
      ${users.map(u => `
        <div class="penyewa-item" data-userid="${u.id}">
          <div class="penyewa-avatar">${u.name.charAt(0)}</div>
          <div class="penyewa-info">
            <strong>${u.name}</strong>
            <span>${u.email}</span>
            <span style="font-size:11px; color:var(--gray-400)">${u.address.city}</span>
          </div>
          <button class="btn-penyewa-detail btn-aksi" data-userid="${u.id}">Detail</button>
        </div>`).join('')}
    </div>`;

  // pasang event delegation untuk tombol detail tiap penyewa
  el.addEventListener('click', async function(e) {
    const btn = e.target.closest('.btn-penyewa-detail');
    if (!btn) return;
    await ambilDetailPenyewa(btn.dataset.userid);
  });
}

// ambil detail satu penyewa beserta riwayat sewanya
async function ambilDetailPenyewa(userId) {
  try {
    aturLoading(true);

    // fetch dua endpoint sekaligus
    const [resUser, resPosts] = await Promise.all([
      fetch(`https://jsonplaceholder.typicode.com/users/${userId}`),
      fetch(`https://jsonplaceholder.typicode.com/posts?userId=${userId}&_limit=3`)
    ]);

    const user  = await resUser.json();
    const posts = await resPosts.json();

    // tampilkan detail di modal
    if (elModalIsi) {
      elModalIsi.innerHTML = `
        <div class="modal-header-inner">
          <span class="loker-card-code" style="font-size:16px">${user.name}</span>
          <span class="badge badge-tersedia">Penyewa Aktif</span>
        </div>
        <table class="modal-table">
          <tr><th>Email</th>      <td>${user.email}</td></tr>
          <tr><th>Telepon</th>    <td>${user.phone}</td></tr>
          <tr><th>Kota</th>       <td>${user.address.city}</td></tr>
          <tr><th>Website</th>    <td>${user.website}</td></tr>
          <tr><th>Perusahaan</th> <td>${user.company.name}</td></tr>
        </table>
        <div style="margin-top:14px">
          <div style="font-size:11px; font-weight:700; color:var(--gray-400); text-transform:uppercase; letter-spacing:1px; margin-bottom:8px">
            Riwayat Sewa (3 terakhir)
          </div>
          ${posts.map(p => `
            <div style="background:var(--gray-50); border-radius:6px; padding:10px; margin-bottom:6px; border-left:3px solid var(--teal)">
              <div style="font-size:12.5px; font-weight:600; color:var(--gray-800)">
                ${p.title.substring(0, 50)}…
              </div>
            </div>`).join('')}
        </div>`;
    }

    elModalOverlay?.classList.add('modal-buka');

  } catch (err) {
    tampilkanNotifikasi('Gagal memuat detail penyewa', 'error');
  } finally {
    aturLoading(false);
  }
}

// tampilkan pesan error kalau fetch gagal total
function tampilkanErrorFetch() {
  const el = document.getElementById('panel-penyewa');
  if (!el) return;
  el.innerHTML = `
    <div style="text-align:center; padding:32px; color:var(--gray-400)">
      <div style="font-size:40px; margin-bottom:10px">⚠️</div>
      <p style="font-weight:600; margin-bottom:8px">Gagal memuat data penyewa</p>
      <p style="font-size:13px; margin-bottom:14px">Periksa koneksi internet Anda</p>
      <button onclick="ambilDataPenyewaAPI()"
        class="btn-search" style="font-size:13px; padding:8px 20px">
        🔄 Coba Lagi
      </button>
    </div>`;
}

// tombol "Muat Data API" di panel penyewa
document.getElementById('btn-muat-api')?.addEventListener('click', ambilDataPenyewaAPI);


// ----------------------------------------------------------------
// INISIALISASI
// kode ini dijalankan pertama kali saat halaman selesai dimuat
// ----------------------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
  console.log('Halaman selesai dimuat, mulai inisialisasi...');

  // 1. muat data dari localStorage (kalau ada)
  muatDariLocalStorage();

  // 2. tampilkan semua data ke kartu dan tabel
  hasilFilter = [...daftarLoker];
  renderKartu(hasilFilter);
  renderTabel(hasilFilter);

  // 3. update angka statistik di hero
  updateAngkaHero();
  updateAngkaSidebar();

  // 4. jalankan animasi hitung mundur ke angka statistik
  animasiHitungAngka();

  // 5. langsung ambil data penyewa dari API
  ambilDataPenyewaAPI();
});

// animasi angka naik perlahan dari 0 ke nilai tujuan
function animasiHitungAngka() {
  const stat   = hitungStatistik(daftarLoker);
  const target = [stat.total, stat.tersedia, stat.disewa, daftarLoker.length];

  elStatNums.forEach((el, i) => {
    if (target[i] === undefined) return;

    let angkaSaatIni = 0;
    const tujuan     = target[i];
    const langkah    = Math.max(1, Math.floor(tujuan / 30));

    // setInterval: jalankan setiap 40ms sampai angka mencapai tujuan
    const timer = setInterval(() => {
      angkaSaatIni += langkah;
      if (angkaSaatIni >= tujuan) {
        angkaSaatIni = tujuan;
        clearInterval(timer); // hentikan kalau sudah sampai
      }
      el.textContent = angkaSaatIni;
    }, 40);
  });
}