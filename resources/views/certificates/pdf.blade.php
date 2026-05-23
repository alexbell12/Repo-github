@php
    $eventDate = $event->start_time->copy()->locale('id')->translatedFormat('d F Y');
    $attendDate = $attendedAt->copy()->locale('id')->translatedFormat('d F Y, H:i');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat - {{ $registration->full_name }}</title>
    <style>
        @page { size: A4 landscape; margin: 12mm; }
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #1e1b4b;
        }
        table { border-collapse: collapse; }
        .cert-wrap {
            width: 100%;
            border: 4px double #4c1d95;
            background: #ffffff;
        }
        .cert-inner {
            border: 2px solid #6366f1;
            padding: 24px 28px;
            text-align: center;
        }
        .logo-line {
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #5b21b6;
            margin-bottom: 6px;
        }
        h1 {
            font-size: 30px;
            margin: 0 0 4px;
            color: #4c1d95;
        }
        .subtitle {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 18px;
        }
        .presented {
            font-size: 11px;
            color: #4b5563;
            margin-bottom: 6px;
        }
        .name {
            font-size: 26px;
            font-weight: bold;
            color: #312e81;
            margin: 6px 0 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid #c4b5fd;
        }
        .body-text {
            font-size: 12px;
            line-height: 1.6;
            color: #374151;
            margin: 0 auto 16px;
            max-width: 90%;
        }
        .event-title {
            font-size: 15px;
            font-weight: bold;
            color: #4c1d95;
        }
        .meta-table {
            width: 100%;
            margin-top: 16px;
            font-size: 10px;
            color: #4b5563;
        }
        .meta-table td {
            width: 33%;
            text-align: center;
            vertical-align: top;
            padding: 8px 6px 0;
        }
        .meta-label {
            font-weight: bold;
            color: #4c1d95;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }
        .seal-cell {
            width: 90px;
            vertical-align: bottom;
            text-align: center;
        }
        .seal {
            display: inline-block;
            width: 76px;
            height: 76px;
            border: 3px solid #7c3aed;
            border-radius: 38px;
            font-size: 9px;
            color: #6d28d9;
            font-weight: bold;
            line-height: 1.25;
            padding-top: 26px;
        }
        .footer-row td {
            font-size: 8px;
            color: #9ca3af;
            padding-top: 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table class="cert-wrap" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="cert-inner">
                <div class="logo-line">Fakultas Kedokteran — Universitas Riau</div>
                <h1>SERTIFIKAT</h1>
                <div class="subtitle">Kehadiran Seminar / Event</div>

                <div class="presented">Diberikan kepada</div>
                <div class="name">{{ $registration->full_name }}</div>

                <p class="body-text">
                    Atas partisipasi dan kehadiran pada kegiatan
                    <span class="event-title">{{ $event->title }}</span>
                    @if($event->location)
                        yang diselenggarakan di <strong>{{ $event->location }}</strong>
                    @endif
                </p>

                <table class="meta-table" width="100%">
                    <tr>
                        <td>
                            <span class="meta-label">Tanggal Event</span>
                            {{ $eventDate }}
                        </td>
                        <td>
                            <span class="meta-label">Waktu</span>
                            {{ $event->start_time->format('H:i') }} – {{ $event->end_time->format('H:i') }} WIB
                        </td>
                        <td>
                            <span class="meta-label">Tercatat Hadir</span>
                            {{ $attendDate }} WIB
                        </td>
                    </tr>
                    @if($registration->nim || $registration->instansi)
                    <tr>
                        <td colspan="3" style="padding-top: 10px;">
                            @if($registration->nim)
                                <span class="meta-label">NIM / ID</span>{{ $registration->nim }}
                            @endif
                            @if($registration->nim && $registration->instansi)
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            @endif
                            @if($registration->instansi)
                                <span class="meta-label">Instansi</span>{{ $registration->instansi }}
                            @endif
                        </td>
                    </tr>
                    @endif
                </table>

                <table width="100%" style="margin-top: 8px;">
                    <tr>
                        <td class="footer-row" style="text-align: left; width: 70%;">
                            No. Sertifikat: {{ strtoupper(\Illuminate\Support\Str::substr($registration->attendance_token, 0, 12)) }}
                        </td>
                        <td class="seal-cell">
                            <div class="seal">TELAH<br>HADIR</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
