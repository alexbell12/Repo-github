@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="flex items-center gap-2 mb-2">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    <h1 class="text-3xl font-bold">Dashboard Admin</h1>
</div>
<p class="text-white/80 mb-8">Kelola event seminar dan generate QR code</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="card-glass rounded-xl p-6 text-center">
        <svg class="w-10 h-10 mx-auto text-white/80 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="text-3xl font-bold">{{ $totalEvents }}</p>
        <p class="text-white/80 text-sm">Total Events</p>
    </div>
    <div class="card-glass rounded-xl p-6 text-center">
        <svg class="w-10 h-10 mx-auto text-white/80 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <p class="text-3xl font-bold">{{ $activeEvents }}</p>
        <p class="text-white/80 text-sm">Active Events</p>
    </div>
    <div class="card-glass rounded-xl p-6 text-center">
        <svg class="w-10 h-10 mx-auto text-white/80 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
        <p class="text-3xl font-bold">{{ $totalEvents }}</p>
        <p class="text-white/80 text-sm">QR Codes</p>
    </div>
</div>

<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-500/80 hover:bg-blue-500 text-white font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Event Baru
    </a>
    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white/20 hover:bg-white/30 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Lihat Event Public
    </a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $event)
        <div class="card-glass rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-2">{{ $event->title }}</h2>
            @if($event->description)
                <p class="text-white/80 text-sm mb-3 line-clamp-2">{{ $event->description }}</p>
            @endif
            <p class="flex items-center gap-2 text-sm text-white/90 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $event->start_time->format('d M Y, H:i') }} - {{ $event->end_time->format('H:i') }}
            </p>
            @if($event->location)
                <p class="flex items-center gap-2 text-sm text-white/90 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $event->location }}
                </p>
            @endif
            <p class="flex items-center gap-2 text-sm mb-3">
                <span class="w-2 h-2 rounded-full bg-green-400"></span> Active
            </p>
            <p class="text-xs text-white/70 mb-4">{{ $event->time_remaining }}</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.events.qr', $event) }}" class="px-3 py-1.5 rounded-lg bg-blue-500/60 hover:bg-blue-500 text-sm">QR</a>
                <a href="{{ route('admin.events.edit', $event) }}" class="px-3 py-1.5 rounded-lg bg-blue-500/60 hover:bg-blue-500 text-sm">Edit</a>
                <a href="{{ route('admin.events.registrations.index', $event) }}" class="px-3 py-1.5 rounded-lg bg-green-500/60 hover:bg-green-500 text-sm">Peserta</a>
                <form action="{{ route('admin.events.toggle', $event) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-amber-500/60 hover:bg-amber-500 text-sm">Toggle</button>
                </form>
                <a href="{{ route('events.show', $event->slug) }}" class="px-3 py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-sm">View</a>
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Hapus event ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500/60 hover:bg-red-500 text-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
