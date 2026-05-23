@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card-glass rounded-2xl p-8">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <h1 class="text-2xl font-bold">Edit Event</h1>
        </div>
        <p class="text-white/80 text-sm mb-6">Perbarui data event di bawah ini</p>

        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1">Judul Event *</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi Event</label>
                <textarea name="description" rows="4" placeholder="Masukkan deskripsi event"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Waktu Mulai *</label>
                    <input type="datetime-local" name="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white focus:ring-2 focus:ring-white/30">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Waktu Selesai *</label>
                    <input type="datetime-local" name="end_time" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white focus:ring-2 focus:ring-white/30">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi Event</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}
                    class="rounded border-white/30 bg-white/10 text-purple-500 focus:ring-white/30">
                <label for="is_active" class="text-sm">Event aktif (dapat diakses peserta)</label>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-white text-purple-700 font-semibold hover:bg-white/90">Simpan</button>
                <a href="{{ route('admin.events.index') }}" class="px-6 py-2.5 rounded-lg bg-white/20 hover:bg-white/30">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
