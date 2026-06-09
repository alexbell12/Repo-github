@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card-glass rounded-2xl p-8">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
        </div>
        <p class="text-gray-600 text-sm mb-6">Perbarui data event di bawah ini</p>

        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Judul Event *</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="form-input">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Deskripsi Event</label>
                <textarea name="description" rows="4" placeholder="Masukkan deskripsi event" class="form-input">{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Waktu Mulai *</label>
                    <input type="datetime-local" name="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required class="form-input">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Waktu Selesai *</label>
                    <input type="datetime-local" name="end_time" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" required class="form-input">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Lokasi Event</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}" class="form-input">
            </div>
            <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 space-y-4">
                <p class="text-sm font-medium text-gray-700">Koordinat Lokasi (untuk validasi geolokasi presensi)</p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-600">Latitude</label>
                        <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $event->latitude) }}" class="form-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-600">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $event->longitude) }}" class="form-input">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-600">Radius (meter)</label>
                    <input type="number" name="location_radius" value="{{ old('location_radius', $event->location_radius ?? 100) }}" min="10" max="5000" class="form-input">
                </div>
                <button type="button" id="btn-get-location" class="text-sm px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 font-medium">
                    Ambil Lokasi Saat Ini
                </button>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600">
                <label for="is_active" class="text-sm text-gray-700">Event aktif (dapat diakses peserta)</label>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">Simpan</button>
                <a href="{{ route('admin.events.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('btn-get-location').addEventListener('click', function () {
    if (!navigator.geolocation) { alert('Browser tidak mendukung geolokasi.'); return; }
    navigator.geolocation.getCurrentPosition(function (pos) {
        document.getElementById('latitude').value = pos.coords.latitude.toFixed(7);
        document.getElementById('longitude').value = pos.coords.longitude.toFixed(7);
    }, function () { alert('Gagal mengambil lokasi. Izinkan akses GPS.'); }, { enableHighAccuracy: true });
});
</script>
@endsection
