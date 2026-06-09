@extends('layouts.app')

@section('title', 'QR Presensi - ' . $event->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('events.show', $event->slug) }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Event
    </a>
</div>

<div class="card-glass rounded-2xl p-8 max-w-md mx-auto text-center">
    <h1 class="text-2xl font-bold mb-2 text-gray-900">QR Presensi Peserta</h1>
    <p class="text-gray-600 text-sm mb-2">{{ $event->title }}</p>
    <p class="text-sm text-gray-500 mb-4">Tunjukkan QR ini kepada panitia. QR berubah setiap 1 menit untuk mencegah presensi palsu.</p>

    <div class="inline-block p-4 bg-white border border-gray-200 rounded-xl" id="qr-container">
        {!! QrCode::format('svg')->size(220)->margin(1)->generate($qrUrl) !!}
    </div>

    <p class="mt-4 text-xs text-gray-400" id="qr-countdown">QR diperbarui dalam {{ $expiresIn }} detik</p>

    @if($registration->hasAttended())
        <a href="{{ route('events.certificate', $event->slug) }}"
            class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Unduh Sertifikat (PDF)
        </a>
    @else
        <p class="mt-6 text-sm text-gray-500">Sertifikat tersedia setelah presensi tercatat.</p>
    @endif
</div>

<script>
(function () {
    var refreshUrl = @json(route('events.qr-refresh', $event->slug));
    var container = document.getElementById('qr-container');
    var countdown = document.getElementById('qr-countdown');
    var secondsLeft = {{ $expiresIn }};

    function tick() {
        secondsLeft--;
        if (secondsLeft <= 0) {
            refreshQr();
            return;
        }
        countdown.textContent = 'QR diperbarui dalam ' + secondsLeft + ' detik';
    }

    function refreshQr() {
        fetch(refreshUrl, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                container.innerHTML = data.svg;
                secondsLeft = data.expires_in;
                countdown.textContent = 'QR diperbarui dalam ' + secondsLeft + ' detik';
            })
            .catch(function () { secondsLeft = 5; });
    }

    setInterval(tick, 1000);
})();
</script>
@endsection
