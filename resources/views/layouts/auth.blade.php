<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - Presensi FK Universitas Riau</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .auth-panel {
            background: linear-gradient(145deg, #312e81 0%, #4338ca 45%, #6366f1 100%);
        }
        .auth-pattern {
            background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.625rem;
            background: #ffffff;
            border: 1px solid #d1d5db;
            color: #1f2937;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
    </style>
</head>
<body class="min-h-screen bg-white text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col lg:flex-row">
        {{-- Panel branding kiri --}}
        <div class="auth-panel auth-pattern relative lg:w-[42%] xl:w-[45%] text-white flex flex-col justify-between p-8 lg:p-12 overflow-hidden">
            <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-white/5"></div>
            <div class="absolute bottom-10 -left-10 w-48 h-48 rounded-full bg-white/5"></div>

            <div class="relative z-10">
                <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 font-semibold text-lg text-white/95 hover:text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Presensi
                </a>
            </div>

            <div class="relative z-10 my-10 lg:my-0">
                <p class="text-indigo-200 text-sm font-medium uppercase tracking-wider mb-3">Fakultas Kedokteran</p>
                <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4">Universitas Riau</h1>
                <p class="text-indigo-100 text-base lg:text-lg leading-relaxed max-w-sm">
                    Sistem presensi digital berbasis QR code &amp; geolokasi untuk event seminar dan kegiatan kampus.
                </p>
                <ul class="mt-8 space-y-3 text-sm text-indigo-100">
                    <li class="flex items-center gap-3">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        </span>
                        QR code dinamis setiap 1 menit
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        Validasi lokasi acara
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </span>
                        Anti presensi palsu
                    </li>
                </ul>
            </div>

            <p class="relative z-10 text-indigo-200/80 text-xs hidden lg:block">
                © {{ date('Y') }} Presensi FK Universitas Riau
            </p>
        </div>

        {{-- Panel form kanan --}}
        <div class="flex-1 flex flex-col justify-center px-6 py-10 lg:px-16 xl:px-24 bg-white">
            <div class="w-full max-w-md mx-auto">
                @if(session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 text-sm">{{ session('error') }}</div>
                @endif
                @if(session('info'))
                    <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-800 text-sm">{{ session('info') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                        <ul class="list-disc list-inside text-red-800 text-sm">
                            @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
