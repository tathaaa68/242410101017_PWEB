# 🔐 SiLoker

### Sistem Peminjaman Loker Berbasis Web

SiLoker (Sistem Peminjaman Loker) adalah platform berbasis web yang dirancang untuk mendigitalisasi proses penyewaan dan pengelolaan loker secara modern, cepat, dan efisien. Sistem ini memungkinkan pengguna untuk melihat ketersediaan loker secara real-time, melakukan reservasi secara online, serta memantau status peminjaman tanpa harus melalui proses administrasi manual.

Dengan antarmuka yang responsif dan pengalaman pengguna yang intuitif, SiLoker hadir sebagai solusi digital untuk pengelolaan fasilitas penyimpanan barang di lingkungan kampus, perpustakaan, pusat kegiatan mahasiswa, maupun area publik lainnya.

---

## ✨ Highlights

* 🔍 Pencarian loker secara real-time menggunakan AJAX
* 📦 Informasi ketersediaan loker secara langsung
* 📝 Sistem reservasi loker secara online
* 📋 Riwayat peminjaman pengguna
* 🌙 Dark Mode untuk kenyamanan penggunaan
* 📊 Dashboard administrasi yang informatif
* 👥 Manajemen pengguna dan peminjaman
* 📱 Responsive design untuk desktop maupun mobile

---

## 🎯 Tujuan Pengembangan

Proses peminjaman loker yang masih dilakukan secara manual sering menimbulkan berbagai kendala, seperti:

* Kesulitan memantau ketersediaan loker
* Risiko kesalahan pencatatan data peminjaman
* Proses administrasi yang memakan waktu
* Sulitnya melakukan monitoring penggunaan loker

SiLoker dikembangkan untuk menjawab permasalahan tersebut melalui sistem digital yang terintegrasi sehingga proses reservasi, pengelolaan, dan monitoring loker dapat dilakukan secara lebih efektif dan efisien.

---

# 🚀 Fitur Utama

## 👤 Fitur Pengguna

### 🔐 Autentikasi Pengguna

Pengguna dapat membuat akun, melakukan login, serta mengelola informasi profil secara aman menggunakan sistem autentikasi Laravel.

### 📦 Katalog Loker

Menampilkan daftar loker lengkap dengan informasi:

* Nomor loker
* Lokasi loker
* Kapasitas atau ukuran
* Status ketersediaan
* Informasi penggunaan

### 🔍 Smart Search & Filtering

Pencarian dan filter dilakukan menggunakan teknologi AJAX sehingga pengguna dapat menemukan loker yang sesuai tanpa perlu melakukan refresh halaman.

### 📝 Reservasi Loker

Pengguna dapat melakukan peminjaman loker secara online dengan mengisi formulir reservasi yang telah disediakan.

### 📋 Riwayat Peminjaman

Menampilkan seluruh aktivitas peminjaman pengguna beserta statusnya, seperti:

* Pending
* Disetujui
* Ditolak
* Sedang Digunakan
* Selesai

### 🌙 Dark Mode

Pengguna dapat beralih antara mode terang dan gelap sesuai preferensi penggunaan.

---

## 👨‍💼 Fitur Administrator

### 📊 Dashboard Monitoring

Dashboard menyediakan ringkasan informasi penting seperti:

* Total pengguna
* Total loker
* Total transaksi peminjaman
* Loker tersedia
* Loker sedang digunakan

### 📦 Manajemen Loker

Administrator dapat:

* Menambah data loker
* Mengubah informasi loker
* Menghapus data loker
* Mengatur status ketersediaan

### 📑 Manajemen Peminjaman

Administrator memiliki kontrol penuh terhadap seluruh transaksi peminjaman:

* Meninjau pengajuan
* Menyetujui peminjaman
* Menolak pengajuan
* Menyelesaikan transaksi

### 👥 Manajemen Pengguna

Fitur pengelolaan akun pengguna meliputi:

* Melihat data pengguna
* Mengubah status akun
* Mengelola hak akses

### 📬 Manajemen Pesan

Administrator dapat membaca dan menindaklanjuti kritik, saran, maupun pertanyaan yang dikirimkan pengguna melalui halaman kontak.

---

# 🗄️ Struktur Database

Database menggunakan MySQL dengan beberapa entitas utama:

| Tabel       | Deskripsi                            |
| ----------- | ------------------------------------ |
| users       | Data akun pengguna dan administrator |
| lokers      | Data loker yang tersedia             |
| peminjamans | Data transaksi peminjaman loker      |
| pembayarans | Data pembayaran peminjaman           |
| kontaks     | Pesan dan masukan pengguna           |

---

# 🛠️ Teknologi yang Digunakan

## Backend

* Laravel 12
* PHP 8.2+

## Frontend

* Blade Template Engine
* Bootstrap 
* JavaScript
* AJAX

## Database

* MySQL

## Development Tools

* Composer
* Node.js
* NPM
* Git
* Visual Studio Code

---

# ⚙️ Instalasi dan Menjalankan Proyek

## 1. Clone Repository

```bash
git clone https://github.com/tathaaa68/242410101017_PWEB
cd siloker
```

## 2. Install Dependencies

```bash
composer install
npm install
```

## 3. Konfigurasi Environment

Salin file konfigurasi:

```bash
cp .env.example .env
```

Atur konfigurasi database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siloker
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Generate Application Key

```bash
php artisan key:generate
```

## 5. Import Database

Buat database baru dengan nama:

```sql
CREATE DATABASE siloker;
```

Kemudian import file:

```text
siloker.sql
```

menggunakan phpMyAdmin atau MySQL Workbench.

## 6. Jalankan Aplikasi

Terminal pertama:

```bash
npm run dev
```

Terminal kedua:

```bash
php artisan serve
```

## 7. Akses Aplikasi

Buka browser dan kunjungi:

```text
https://silokerunej.my.id/login
```

---


# 👨‍💻 Developer

**Talitha**
Sistem Informasi
Universitas Jember

---

## 📄 License

Project ini dikembangkan untuk keperluan akademik dan pembelajaran pengembangan aplikasi berbasis web menggunakan Laravel.

⭐ Jika proyek ini bermanfaat, jangan lupa berikan star pada repository ini.

