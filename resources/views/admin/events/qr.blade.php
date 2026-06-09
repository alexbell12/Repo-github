@extends('layouts.app')

@section('title', 'QR Presensi - ' . $event->title)

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-4">
        <a href="{{ route('admin.events.index') }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
    <div class="card-glass rounded-2xl p-8 text-center">
        <h1 class="text-xl font-bold mb-2 text-gray-900">QR Code Presensi</h1>
        <p class="text-gray-600 text-sm mb-2">{{ $event->title }}</p>
        <p class="text-sm text-gray-500 mb-4">Tampilkan QR ini di lokasi acara. QR berubah setiap 1 menit.</p>
        <div class="inline-block p-4 bg-white border border-gray-200 rounded-xl" id="qr-container">
            {!! QrCode::format('svg')->size(220)->generate($qrUrl) !!}
        </div>
        <p class="mt-4 text-xs text-gray-400" id="qr-countdown">QR diperbarui dalam {{ $expiresIn }} detik</p>
        <p class="mt-2 text-xs text-gray-400 break-all" id="qr-url">{{ $qrUrl }}</p>
    </div>
</div>

<script>
(function () {
    var refreshUrl = @json(route('admin.events.qr-refresh', $event));
    var container = document.getElementById('qr-container');
    var countdown = document.getElementById('qr-countdown');
    var urlEl = document.getElementById('qr-url');
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
                urlEl.textContent = data.url;
                secondsLeft = data.expires_in;
                countdown.textContent = 'QR diperbarui dalam ' + secondsLeft + ' detik';
            })
            .catch(function () { secondsLeft = 5; });
    }

    setInterval(tick, 1000);
})();
</script>
@endsection
