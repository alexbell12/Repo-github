@extends('layouts.app')

@section('title', 'Presensi - ' . $event->title)

@section('content')
<div class="max-w-md mx-auto">
    <div class="card-glass rounded-2xl p-8">
        <h1 class="text-2xl font-bold mb-2 text-gray-900">Presensi Event</h1>
        <p class="text-gray-600 text-sm mb-1">{{ $event->title }}</p>
        <p class="text-gray-800 font-medium mb-4">{{ $registration->full_name }}</p>

        <div id="geo-status" class="mb-4 p-3 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-600">
            Mengambil lokasi perangkat...
        </div>

        <form method="POST" action="{{ route('events.check-in.submit', $event->slug) }}" id="checkin-form">
            @csrf
            <input type="hidden" name="sig" value="{{ $request->sig }}">
            <input type="hidden" name="slot" value="{{ $request->slot }}">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit" id="submit-btn" disabled class="w-full py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
                Catat Presensi Saya
            </button>
        </form>
    </div>
</div>

<script>
(function () {
    var status = document.getElementById('geo-status');
    var latInput = document.getElementById('latitude');
    var lngInput = document.getElementById('longitude');
    var submitBtn = document.getElementById('submit-btn');

    if (!navigator.geolocation) {
        status.textContent = 'Browser tidak mendukung geolokasi. Presensi tidak dapat dilakukan.';
        status.className = 'mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700';
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function (pos) {
            latInput.value = pos.coords.latitude;
            lngInput.value = pos.coords.longitude;
            status.textContent = 'Lokasi berhasil dideteksi. Anda dapat melanjutkan presensi.';
            status.className = 'mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700';
            submitBtn.disabled = false;
        },
        function () {
            status.textContent = 'Izin lokasi ditolak. Aktifkan GPS dan izinkan akses lokasi untuk presensi.';
            status.className = 'mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700';
        },
        { enableHighAccuracy: true, timeout: 15000 }
    );
})();
</script>
@endsection
