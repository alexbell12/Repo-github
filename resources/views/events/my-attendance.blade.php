@extends('layouts.app')

@section('title', 'QR Absensi - ' . $event->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('events.show', $event->slug) }}" class="text-white/90 hover:text-white inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Event
    </a>
</div>

<div class="card-glass rounded-2xl p-8 max-w-md mx-auto text-center">
    <h1 class="text-2xl font-bold mb-2">QR Absensi Peserta</h1>
    <p class="text-white/80 text-sm mb-6">{{ $event->title }}</p>
    <p class="text-sm text-white/70 mb-4">Tunjukkan QR code berikut kepada panitia untuk absensi.</p>

    <div class="inline-block p-4 bg-white rounded-xl">
        {!! QrCode::size(220)->margin(1)->generate(route('attendance.scan', $registration->attendance_token)) !!}
    </div>

    <p class="mt-4 text-xs text-white/60">Token: {{ Str::limit($registration->attendance_token, 12) }}</p>
</div>
@endsection
