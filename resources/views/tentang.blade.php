<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - SILOKER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-gray-50 font-sans">

    <nav class="navbar">
    <div class="navbar-logo">
      <img src="{{asset('ikon logo.png')}}" alt="logo" class="logo-img">
      <span class="logo-text">SILOKER</span>
    </div>
    <ul class="navbar-menu">
      <li><a href="/dashboard" >Dashboard</a></li>
      <li><a href="{{ route('tentang') }}" class="active">Tentang</a></li>
      <li><a href="/dashboard#loker">Daftar Loker</a>
      <li><a href="/dashboard#transaksi">Transaksi</a></li>
      <li><a href="/dashboard#penyewa">Penyewa</a></li>
    </ul>
    <button class="navbar-toggle" id="navToggle" type="button" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

    <header class="glass-gradient text-white py-20 px-6 text-center">
        <div class="mb-4 inline-block px-4 py-1 rounded-full bg-blue-400/20 text-sm tracking-widest border border-blue-300/30">
            UNIVERSITAS JEMBER · FAKULTAS ILMU KOMPUTER
        </div>
        <h1 class="text-5xl font-black tracking-[0.2em] mb-4">SILOKER</h1>
        <p class="max-w-2xl mx-auto text-blue-100 text-lg opacity-90">
            Sistem Informasi Penyewaan Loker Kampus
        </p>
    </header>

    <main class="max-w-6xl mx-auto px-6 -mt-12 mb-20">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-blue-900 mb-6">Modernitas dalam <span class="text-blue-500">Penyimpanan</span></h2>
                    <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                        <strong>SILOKER</strong> hadir sebagai solusi digital terpadu untuk pengelolaan loker kampus, pemantauan ketersediaan, pencatatan transaksi, dan manajemen penyewa secara real-time.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-blue-100 p-2 rounded-full text-blue-600"><i class="fas fa-check text-xs"></i></div>
                            <p class="text-gray-700">Efisiensi birokrasi penyewaan loker.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-blue-100 p-2 rounded-full text-blue-600"><i class="fas fa-check text-xs"></i></div>
                            <p class="text-gray-700">Transparansi data bagi pengelola dan mahasiswa.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-blue-500/10 rounded-full blur-3xl"></div>
                    <img src="{{ asset('logounej.png') }}" alt="Illustration" class="relative w-full max-w-sm mx-auto">
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 card-hover text-center">
                <i class="fas fa-chart-line text-4xl text-blue-500 mb-6"></i>
                <h4 class="font-bold text-xl text-gray-800 mb-3">Monitoring</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Pantau status loker (Tersedia, Disewa, Maintenance) secara instan.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 card-hover text-center">
                <i class="fas fa-university text-4xl text-blue-500 mb-6"></i>
                <h4 class="font-bold text-xl text-gray-800 mb-3">Terintegrasi</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Khusus dikembangkan untuk lingkungan civitas akademika UNEJ.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 card-hover text-center">
                <i class="fas fa-mobile-alt text-4xl text-blue-500 mb-6"></i>
                <h4 class="font-bold text-xl text-gray-800 mb-3">Responsive</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Akses dashboard dari perangkat mana saja dengan mudah.</p>
            </div>
        </div>
    </main>

    <footer class="bg-white py-10 border-t border-gray-200 text-center">
        <p class="text-gray-400 text-sm">© 2026 SILOKER · Fakultas Ilmu Komputer Universitas Jember</p>
    </footer>

    <script>
        // Toggle Mobile Menu
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.querySelector('.navbar-menu');

        navToggle.addEventListener('click', () => {
            navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
            if(navMenu.style.display === 'flex') {
                navMenu.style.flexDirection = 'column';
                navMenu.style.position = 'absolute';
                navMenu.style.top = '70px';
                navMenu.style.left = '0';
                navMenu.style.width = '100%';
                navMenu.style.backgroundColor = '#1a2a4d';
                navMenu.style.padding = '20px';
            }
        });
    </script>
</body>
</html>