<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILOKER - Form Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-[#1e3a8a] text-white px-6 py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xl font-bold tracking-wider">SILOKER</span>
            </div>
            <a href="/dashboard" class="text-sm bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto my-10 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-5">
            
            <div class="md:col-span-2 bg-gradient-to-br from-blue-50 to-indigo-50 p-8 border-b md:border-b-0 md:border-r border-gray-100">
                <h2 class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-4">Loker Yang Dipilih</h2>
                
                <div class="space-y-4">
                    <div>
                        <span class="block text-xs text-gray-500">Kode Loker</span>
                        <span class="text-2xl font-black text-gray-800 tracking-tight">{{ $loker->kode }}</span>
                    </div>
                    
                    <div>
                        <span class="block text-xs text-gray-500">Lokasi</span>
                        <span class="text-sm font-medium text-gray-700">{{ $loker->lokasi }}</span>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Ukuran</span>
                        <span class="inline-block text-xs px-2.5 py-1 font-semibold rounded-full bg-blue-100 text-blue-800 uppercase mt-1">
                            {{ $loker->ukuran }}
                        </span>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <span class="block text-xs text-gray-500">Tarif Sewa</span>
                        <span class="text-xl font-bold text-gray-800">Rp {{ number_format($loker->harga, 0, ',', '.') }}<span class="text-xs font-normal text-gray-500"> / hari</span></span>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 p-8">
                <h1 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Peminjaman</h1>
                <p class="text-xs text-gray-500 mb-6">Silakan tentukan durasi sewa loker. Data peminjam akan otomatis dicatat atas nama Anda.</p>

                <form action="{{ route('pinjam.loker.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="loker_id" value="{{ $loker->id }}">
                    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">

                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Identitas Peminjam</label>
                        <p class="text-sm font-bold text-gray-800">{{ $mahasiswa->nama }}</p>
                        <p class="text-xs text-gray-600">NIM: {{ $mahasiswa->nim }} ({{ $mahasiswa->prodi }})</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Rencana Tanggal Pengembalian</label>
                        <input type="date" name="tgl_kembali" id="tgl_kembali" 
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm" required>
                    </div>

                    <div class="p-4 bg-blue-50 rounded-xl flex justify-between items-center border border-blue-100">
                        <div>
                            <span class="block text-xs font-bold text-blue-600 uppercase tracking-wider">Estimasi Total</span>
                            <span class="text-xs text-blue-500" id="text_durasi">0 hari masa sewa</span>
                        </div>
                        <span class="text-xl font-black text-blue-900">Rp <span id="text_total_biaya">0</span></span>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <a href="/dashboard" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-100 transition">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputTglKembali = document.getElementById('tgl_kembali');
            const textDurasi = document.getElementById('text_durasi');
            const textTotalBiaya = document.getElementById('text_total_biaya');
            
            const hargaPerHari = {{ $loker->harga }};

            inputTglKembali.addEventListener('change', function() {
                const tglPinjam = new Date();
                const tglKembali = new Date(this.value);
                
                const selisihWaktu = tglKembali.getTime() - tglPinjam.getTime();
                let selisihHari = Math.ceil(selisihWaktu / (1000 * 3600 * 24));
                
                if (selisihHari <= 0) selisihHari = 1;

                const totalBiaya = selisihHari * hargaPerHari;

                textDurasi.innerText = `${selisihHari} hari masa sewa`;
                textTotalBiaya.innerText = totalBiaya.toLocaleString('id-ID');
            });
        });
    </script>
</body>
</html>