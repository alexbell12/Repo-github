<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>@yield('title', 'Absensi Seminar') - Fakultas Kedokteran Universitas Riau</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    
    @if (file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { font-size: 16px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* SVG sizing constraints */
        svg { max-width: 100%; height: auto; }
        .w-4 { width: 1rem !important; }
        .h-4 { height: 1rem !important; }
        .w-6 { width: 1.5rem !important; }
        .h-6 { height: 1.5rem !important; }
        
        /* Image constraints */
        img { max-width: 100%; height: auto; }
        
        .bg-gradient-absensi { background: linear-gradient(135deg, #4c1d95 0%, #5b21b6 30%, #6366f1 70%, #4338ca 100%); min-height: 100vh; }
        .card-glass { background: rgba(255,255,255,0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); }
        .btn-primary { @apply px-4 py-2 rounded-lg font-medium transition; background: rgba(255,255,255,0.2); color: #fff; }
        .btn-primary:hover { background: rgba(255,255,255,0.3); }
    </style>
</head>
<body class="bg-gradient-absensi text-white antialiased">
    <nav class="border-b border-white/10 bg-black/10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('events.index') }}" class="flex items-center gap-2 font-semibold text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Absensi Seminar
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('events.index') }}" class="btn-primary inline-flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Daftar Event
                </a>
                @auth
                    <span class="text-sm opacity-90">Halo, {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}!</span>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.events.index') }}" class="btn-primary inline-flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('events.index') }}" class="btn-primary inline-flex items-center gap-2 text-sm">Dashboard User</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-500/80 hover:bg-red-500 text-white text-sm font-medium inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-primary inline-flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Login Admin
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary inline-flex items-center gap-2 text-sm">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t border-white/10 bg-black/10 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm opacity-75">
            <p>&copy; 2024 Absensi Seminar - Fakultas Kedokteran Universitas Riau</p>
        </div>
    </footer>
</body>
</html>
