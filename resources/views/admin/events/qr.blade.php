@extends('layouts.app')

@section('title', 'QR Event - ' . $event->title)

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-4">
        <a href="{{ route('admin.events.index') }}" class="text-white/90 hover:text-white inline-flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
    <div class="card-glass rounded-2xl p-8 text-center">
        <h1 class="text-xl font-bold mb-2">QR Code Event</h1>
        <p class="text-white/80 text-sm mb-6">{{ $event->title }}</p>
        <p class="text-sm text-white/70 mb-4">Scan untuk membuka halaman event</p>
        <div class="inline-block p-4 bg-white rounded-xl">
            {!! QrCode::format('svg')->size(220)->generate($eventUrl) !!}
        </div>
        <p class="mt-4 text-xs text-white/60 break-all">{{ $eventUrl }}</p>
    </div>
</div>
@endsection
