<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SILOKER - Sistem Informasi Loker Kampus</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #020c1b;
        }
        .glow-cyan {
            box-shadow: 0 0 25px rgba(6, 182, 212, 0.15);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <div class="absolute top-0 right-1/4 w-80 h-80 bg-cyan-500/10 rounded-full blur-[100px] -z-10"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px] -z-10"></div>

        <div class="mb-8 text-center">
            <div class="inline-flex items-center gap-3 bg-white/5 p-3 px-6 rounded-2xl border border-white/10 glow-cyan">
                <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                <span class="text-2xl font-extrabold text-white tracking-tighter uppercase">
                    SI<span class="text-cyan-400">LOKER</span>
                </span>
            </div>
        </div>

        <main class="w-full max-w-[450px] glass-effect rounded-[2.5rem] shadow-2xl border border-white/20 overflow-hidden">
            <div class="p-8 sm:p-12">
                
                <header class="mb-10">
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h1>
                    <p class="text-slate-500 text-sm mt-2 font-medium">Silakan masuk untuk mengelola loker Anda.</p>
                </header>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm rounded-2xl font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2 group">
                        <label for="email" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within:text-cyan-500 transition-colors">Email Mahasiswa</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="nama@mail.unej.ac.id">
                        @error('email') <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2 group">
                        <div class="flex justify-between items-center px-1">
                            <label for="password" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] group-focus-within:text-cyan-500 transition-colors">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-cyan-600 hover:text-blue-600 uppercase tracking-wider transition-colors">Lupa?</a>
                            @endif
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full px-5 py-4 bg-slate-100/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="••••••••">
                        @error('password') <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="remember_me" type="checkbox" name="remember" 
                            class="w-4 h-4 text-cyan-600 border-slate-300 rounded focus:ring-cyan-500 transition-all cursor-pointer">
                        <label for="remember_me" class="ms-3 text-sm text-slate-500 font-medium cursor-pointer select-none">Ingat saya di perangkat ini</label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-extrabold rounded-2xl shadow-xl shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 active:scale-95 transition-all duration-300 uppercase tracking-widest text-xs">
                            Masuk Ke Sistem
                        </button>
                    </div>
                </form>

                <footer class="mt-10 pt-8 border-t border-slate-100 text-center">
                    <p class="text-slate-500 text-sm">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-cyan-600 font-bold hover:text-cyan-700 transition-colors">Daftar Sekarang</a>
                    </p>
                </footer>
            </div>
        </main>

        <footer class="mt-12 text-center">
            <p class="text-slate-500 text-[10px] uppercase tracking-[0.4em] font-bold">
                &copy; 2026 FASILKOM UNIVERSITAS JEMBER
            </p>
        </footer>
    </div>

</body>
</html>