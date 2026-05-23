<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat - {{ $registration->full_name }}</title>
    <style>
        @page { margin: 0; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #1e1b4b;
            background: #f5f3ff;
        }
        .page {
            width: 100%;
            height: 100%;
            padding: 28px 36px;
            position: relative;
        }
        .border-outer {
            border: 6px double #4c1d95;
            padding: 6px;
            height: 520px;
        }
        .border-inner {
            border: 2px solid #6366f1;
            height: 100%;
            padding: 28px 32px;
            text-align: center;
            background: #ffffff;
        }
        .logo-line {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #5b21b6;
            margin-bottom: 8px;
        }
        h1 {
            font-size: 32px;
            margin: 0 0 6px;
            color: #4c1d95;
            letter-spacing: 1px;
        }
        .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 24px;
        }
        .presented {
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 8px;
        }
        .name {
            font-size: 28px;
            font-weight: bold;
            color: #312e81;
            margin: 8px 0 16px;
            border-bottom: 2px solid #c4b5fd;
            display: inline-block;
            padding: 0 24px 8px;
            min-width: 360px;
        }
        .body-text {
            font-size: 13px;
            line-height: 1.7;
            color: #374151;
            max-width: 620px;
            margin: 0 auto 20px;
        }
        .event-title {
            font-size: 16px;
            font-weight: bold;
            color: #4c1d95;
        }
        .meta-table {
            width: 100%;
            margin-top: 24px;
            font-size: 11px;
            color: #6b7280;
        }
        .meta-table td {
            width: 33.33%;
            vertical-align: top;
            padding: 0 8px;
        }
        .meta-label {
            font-weight: bold;
            color: #4c1d95;
            display: block;
            margin-bottom: 4px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .seal {
            position: absolute;
            bottom: 52px;
            right: 72px;
            width: 88px;
            height: 88px;
            border: 3px solid #7c3aed;
            border-radius: 50%;
            text-align: center;
            font-size: 9px;
            color: #6d28d9;
            padding-top: 28px;
            line-height: 1.3;
            font-weight: bold;
            opacity: 0.85;
        }
        .cert-no {
            position: absolute;
            bottom: 36px;
            left: 72px;
            font-size: 9px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="border-outer">
            <div class="border-inner">
                <div class="logo-line">Fakultas Kedokteran — Universitas Riau</div>
                <h1>SERTIFIKAT</h1>
                <div class="subtitle">Kehadiran Seminar / Event</div>

                <div class="presented">Diberikan kepada</div>
                <div class="name">{{ $registration->full_name }}</div>

                <p class="body-text">
                    Atas partisipasi dan kehadiran pada kegiatan<br>
                    <span class="event-title">{{ $event->title }}</span>
                    @if($event->location)
                        <br>yang diselenggarakan di <strong>{{ $event->location }}</strong>
                    @endif
                </p>

                <table class="meta-table">
                    <tr>
                        <td>
                            <span class="meta-label">Tanggal Event</span>
                            {{ $event->start_time->translatedFormat('d F Y') }}
                        </td>
                        <td>
                            <span class="meta-label">Waktu</span>
                            {{ $event->start_time->format('H:i') }} – {{ $event->end_time->format('H:i') }} WIB
                        </td>
                        <td>
                            <span class="meta-label">Tercatat Hadir</span>
                            {{ $attendedAt->translatedFormat('d F Y, H:i') }} WIB
                        </td>
                    </tr>
                    @if($registration->nim || $registration->instansi)
                    <tr>
                        <td colspan="3" style="padding-top: 12px;">
                            @if($registration->nim)
                                <span class="meta-label">NIM / ID</span>{{ $registration->nim }}
                            @endif
                            @if($registration->instansi)
                                @if($registration->nim) &nbsp;|&nbsp; @endif
                                <span class="meta-label">Instansi</span>{{ $registration->instansi }}
                            @endif
                        </td>
                    </tr>
                    @endif
                </table>

                <div class="seal">
                    TELAH<br>HADIR
                </div>
            </div>
        </div>
        <div class="cert-no">
            No. Sertifikat: {{ strtoupper(\Illuminate\Support\Str::substr($registration->attendance_token, 0, 12)) }}
        </div>
    </div>
</body>
</html>
