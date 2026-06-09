@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 mb-3">
        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900">Daftar Event</h1>
    <p class="text-gray-600 mt-1">Pilih event yang ingin Anda ikuti</p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($events as $event)
        <div class="card-glass rounded-xl p-6 hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2 text-gray-900">{{ $event->title }}</h2>
            @if($event->description)
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $event->description }}</p>
            @endif
            <div class="space-y-2 text-sm text-gray-700">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $event->start_time->format('d M Y, H:i') }} - {{ $event->end_time->format('H:i') }}
                </p>
                @if($event->location)
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $event->location }}
                    </p>
                @endif
            </div>
            <div class="mt-3">
                <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-xs text-gray-700">{{ $event->time_remaining }}</span>
            </div>
            <a href="{{ route('events.show', $event->slug) }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Detail
            </a>
        </div>
    @empty
        <div class="col-span-full card-glass rounded-xl p-12 text-center text-gray-500">
            Belum ada event saat ini.
        </div>
    @endforelse
</div>
@endsection
