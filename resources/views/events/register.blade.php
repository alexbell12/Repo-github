@extends('layouts.app')

@section('title', 'Daftar Event - ' . $event->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('events.show', $event->slug) }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Event
    </a>
</div>

<div class="card-glass rounded-2xl p-8 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-1 text-gray-900">Form Pendaftaran</h1>
    <p class="text-gray-600 mb-6">{{ $event->title }}</p>

    <form method="POST" action="{{ route('events.register', $event->slug) }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap *</label>
            <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name ?? '') }}" required class="form-input">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1 text-gray-700">NIM</label>
            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 2303027475" class="form-input">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1 text-gray-700">Instansi</label>
            <input type="text" name="instansi" value="{{ old('instansi', 'Universitas Riau') }}" placeholder="Universitas Riau" class="form-input">
        </div>
        <button type="submit" class="w-full py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            Daftar Sekarang
        </button>
    </form>
</div>
@endsection
