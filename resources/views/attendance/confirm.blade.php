<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Absensi - Absensi Seminar</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #4c1d95 0%, #5b21b6 50%, #6366f1 100%); min-height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; color: #fff; }
        .card { background: rgba(255,255,255,0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 1rem; padding: 2rem; max-width: 400px; width: 100%; }
        h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        p { opacity: 0.9; font-size: 0.95rem; }
        .name { font-size: 1.25rem; font-weight: 600; margin: 1rem 0; }
        form { margin-top: 1.5rem; }
        button { width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer; border: none; font-size: 1rem; }
        .btn-confirm { background: #22c55e; color: #fff; }
        .btn-confirm:hover { background: #16a34a; }
        .btn-cancel { display: block; text-align: center; margin-top: 0.75rem; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; }
        .btn-cancel:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Konfirmasi Absensi</h1>
        <p>Event: {{ $event->title }}</p>
        <p class="name">{{ $registration->full_name }}</p>
        <p>Catat kehadiran peserta ini?</p>
        <form method="POST" action="{{ route('attendance.confirm') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $registration->attendance_token }}">
            <button type="submit" class="btn-confirm">Ya, Catat Hadir</button>
        </form>
        <a href="javascript:history.back()" class="btn-cancel">Batal</a>
    </div>
</body>
</html>
