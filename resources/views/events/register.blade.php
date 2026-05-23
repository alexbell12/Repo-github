@extends('layouts.app')

@section('title', 'Daftar Event - ' . $event->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('events.show', $event->slug) }}" class="text-white/90 hover:text-white inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Event
    </a>
</div>

<div class="card-glass rounded-2xl p-8 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-1">Form Pendaftaran</h1>
    <p class="text-white/80 mb-6">{{ $event->title }}</p>

    <form method="POST" action="{{ route('events.register', $event->slug) }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap *</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/60"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></span>
                <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name ?? '') }}" required
                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">NIM</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/60"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-3 3c0 1.657 1.343 3 3 3s3-1.343 3-3a3.001 3.001 0 00-3-3z"/></svg></span>
                <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 2303027475"
                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Instansi</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/60"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></span>
                <input type="text" name="instansi" value="{{ old('instansi', 'Universitas Riau') }}" placeholder="Universitas Riau"
                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">
            </div>
        </div>
        <button type="submit" class="w-full py-3 rounded-lg bg-white text-purple-700 font-semibold flex items-center justify-center gap-2 hover:bg-white/90 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Daftar Sekarang
        </button>
    </form>
</div>
@endsection
