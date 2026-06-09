<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Presensi') - Fakultas Kedokteran Universitas Riau</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #ffffff; color: #1f2937; }
        .card-glass {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: background 0.2s;
            background: #4f46e5;
            color: #fff;
            text-decoration: none;
        }
        .btn-primary:hover { background: #4338ca; }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            background: #ffffff;
            border: 1px solid #d1d5db;
            color: #1f2937;
        }
        .form-input:focus {
            outline: none;
            ring: 2px;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .marquee-container {
            overflow: hidden;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 25s linear infinite;
        }
        .marquee-track span {
            padding: 0.6rem 2rem;
            white-space: nowrap;
            font-weight: 600;
            color: #4f46e5;
            font-size: 0.95rem;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased min-h-screen flex flex-col">
    <nav class="border-b border-gray-200 bg-white">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('events.index') }}" class="flex items-center gap-2 font-semibold text-lg text-indigo-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Presensi
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('events.index') }}" class="btn-primary inline-flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Daftar Event
                </a>
                @auth
                    <span class="text-sm text-gray-600">Halo, {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}!</span>
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
                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-sm font-medium inline-flex items-center gap-2">
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

    <div class="marquee-container">
        <div class="marquee-track">
            <span>Selamat Datang di Sistem Presensi — Fakultas Kedokteran Universitas Riau</span>
            <span>Selamat Datang di Sistem Presensi — Fakultas Kedokteran Universitas Riau</span>
            <span>Selamat Datang di Sistem Presensi — Fakultas Kedokteran Universitas Riau</span>
            <span>Selamat Datang di Sistem Presensi — Fakultas Kedokteran Universitas Riau</span>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-800">{{ session('info') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                <ul class="list-disc list-inside text-red-800 text-sm">
                    @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="border-t border-gray-200 py-4 text-center text-sm text-gray-500 bg-white">
        © {{ date('Y') }} Presensi - Fakultas Kedokteran Universitas Riau. All rights reserved.
    </footer>
</body>
</html>
