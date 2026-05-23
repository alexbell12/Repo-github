@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('events.index') }}" class="text-white/90 hover:text-white inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Event
    </a>
</div>

<div class="card-glass rounded-2xl p-8 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-2">{{ $event->title }}</h1>
    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-500/30 text-green-100 text-sm">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        Event Aktif
    </span>

    <div class="grid md:grid-cols-2 gap-8 mt-8">
        <div>
            <h2 class="text-lg font-semibold mb-4">Informasi Event</h2>
            <ul class="space-y-3 text-white/90">
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Waktu Mulai: {{ $event->start_time->format('d F Y, H:i') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Waktu Selesai: {{ $event->end_time->format('d F Y, H:i') }}</span>
                </li>
                @if($event->location)
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>{{ $event->location }}</span>
                    </li>
                @endif
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $event->status_label }}</span>
                </li>
            </ul>
        </div>
        <div>
            <h2 class="text-lg font-semibold mb-4">Deskripsi Event</h2>
            <p class="text-white/90">{{ $event->description ?: 'Tidak ada deskripsi tersedia untuk event ini.' }}</p>
        </div>
    </div>

    <div class="mt-6 p-4 rounded-xl bg-white/10 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
        <p class="text-sm text-white/90">Info: Event {{ strtolower($event->status_label) }}. Pastikan Anda hadir tepat waktu!</p>
    </div>

    <div class="mt-8 flex flex-wrap gap-3">
        @auth
            @php $reg = $userRegistration ?? $event->registrations()->with('attendance')->where('user_id', auth()->id())->first(); @endphp
            @if($reg)
                @if($reg->isVerified())
                    <a href="{{ route('events.my-attendance', $event->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white/20 hover:bg-white/30 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        QR Absensi Saya
                    </a>
                    @if($reg->hasAttended())
                        <a href="{{ route('events.certificate', $event->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white text-purple-700 font-semibold hover:bg-white/90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Unduh Sertifikat
                        </a>
                    @endif
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500/20 text-amber-100 text-sm">Menunggu verifikasi admin</span>
                @endif
            @else
                <a href="{{ route('events.register.form', $event->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white text-purple-700 font-semibold hover:bg-white/90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Daftar Sekarang
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white/20 hover:bg-white/30 font-medium">Login untuk mendaftar</a>
            <a href="{{ route('events.register.form', $event->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white text-purple-700 font-semibold hover:bg-white/90">Daftar sebagai tamu</a>
        @endauth
    </div>
</div>
@endsection
