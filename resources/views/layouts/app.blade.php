<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Absensi Seminar') - Fakultas Kedokteran Universitas Riau</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-500/20 border border-green-400/50 text-green-100">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-400/50 text-red-100">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="mb-4 p-4 rounded-lg bg-blue-500/20 border border-blue-400/50 text-blue-100">{{ session('info') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-400/50">
                <ul class="list-disc list-inside text-red-100 text-sm">
                    @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="border-t border-white/10 py-4 text-center text-sm text-white/70">
        © {{ date('Y') }} Absensi Seminar - Fakultas Kedokteran Universitas Riau. All rights reserved.
    </footer>
</body>
</html>
