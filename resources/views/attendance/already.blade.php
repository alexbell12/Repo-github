<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudah Hadir - Absensi Seminar</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #4c1d95 0%, #5b21b6 50%, #6366f1 100%); min-height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; color: #fff; }
        .card { background: rgba(255,255,255,0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 1rem; padding: 2rem; max-width: 400px; width: 100%; text-align: center; }
        h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        p { opacity: 0.9; font-size: 0.95rem; }
        .name { font-size: 1.25rem; font-weight: 600; margin: 1rem 0; }
        .badge { display: inline-block; padding: 0.5rem 1rem; background: rgba(34, 197, 94, 0.3); border-radius: 9999px; margin-top: 1rem; font-weight: 500; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Sudah Tercatat Hadir</h1>
        <p>Event: {{ $event->title }}</p>
        <p class="name">{{ $registration->full_name }}</p>
        <span class="badge">Peserta ini sudah melakukan absensi.</span>
        <p style="margin-top: 1.25rem;">
            <a href="{{ route('certificates.by-token', $registration->attendance_token) }}"
                style="display: inline-block; padding: 0.65rem 1.25rem; background: #fff; color: #5b21b6; border-radius: 0.5rem; font-weight: 600; text-decoration: none;">
                Unduh Sertifikat (PDF)
            </a>
        </p>
    </div>
</body>
</html>
