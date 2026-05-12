<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SILOKER - Sistem Informasi Loker Kampus</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #020c1b;
        }
        .glow-cyan {
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.2);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }
        /* Custom scrollbar untuk estetika */
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #020c1b;
        }
        ::-webkit-scrollbar-thumb {
            background: #0891b2;
            border-radius: 10px;
        }
    </style>
</head>
<body class="antialiased text-slate-800">

    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-cyan-600/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="mb-10 text-center">
            <div class="inline-flex items-center gap-3 bg-white/5 p-3 px-6 rounded-2xl border border-white/10 glow-cyan">
                <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="text-2xl font-extrabold text-white tracking-tighter uppercase">
                    SI<span class="text-cyan-400">LOKER</span>
                </span>
            </div>
        </div>

        <main class="w-full max-w-[500px] glass-effect rounded-[2.5rem] shadow-2xl border border-white/20 overflow-hidden">
            <div class="p-8 sm:p-12">
                
                <header class="mb-8">
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Buat Akun</h1>
                    <p class="text-slate-500 text-sm mt-2">Daftarkan diri Anda untuk akses layanan loker kampus Universitas Jember.</p>
                </header>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="Masukkan nama lengkap Anda">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Email Mahasiswa</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="nama@mail.unej.ac.id">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="password" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Password</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                                placeholder="••••••••">
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                                placeholder="••••••••">
                        </div>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    <div class="pt-6">
                        <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-extrabold rounded-2xl shadow-xl shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 active:scale-95 transition-all duration-300 uppercase tracking-widest text-xs">
                            Daftar Akun
                        </button>
                    </div>
                </form>

                <footer class="mt-10 pt-8 border-t border-slate-100 text-center">
                    <p class="text-slate-500 text-sm">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-cyan-600 font-bold hover:text-cyan-700 transition-colors">Login Sekarang</a>
                    </p>
                </footer>
            </div>
        </main>

        <footer class="mt-12 text-center">
            <p class="text-slate-500 text-[10px] uppercase tracking-[0.4em] font-bold">
                &copy; 2026 FASILKOM UNIVERSITAS JEMBER
            </p>
            <div class="flex justify-center gap-2 mt-3">
                <div class="w-1 h-1 bg-cyan-500 rounded-full"></div>
                <div class="w-1 h-1 bg-blue-500 rounded-full"></div>
                <div class="w-1 h-1 bg-indigo-500 rounded-full"></div>
            </div>
        </footer>
    </div>

</body>
</html>