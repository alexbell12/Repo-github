<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function download(string $slug)
    {
        $registration = $this->resolveAuthRegistration($slug);

        return $this->pdfResponse($registration);
    }

    public function downloadByToken(string $token)
    {
        $registration = EventRegistration::where('attendance_token', $token)
            ->with(['event', 'attendance'])
            ->firstOrFail();

        abort_unless($registration->hasAttended(), 403, 'Sertifikat hanya tersedia setelah absensi tercatat.');

        return $this->pdfResponse($registration);
    }

    public function adminDownload(EventRegistration $registration)
    {
        $registration->load(['event', 'attendance']);

        abort_unless($registration->hasAttended(), 403, 'Peserta belum hadir.');

        return $this->pdfResponse($registration);
    }

    protected function resolveAuthRegistration(string $slug): EventRegistration
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $registration = $event->registrations()
            ->where('user_id', auth()->id())
            ->with(['event', 'attendance'])
            ->firstOrFail();

        abort_unless($registration->hasAttended(), 403, 'Sertifikat hanya tersedia setelah Anda tercatat hadir.');

        return $registration;
    }

    protected function pdfResponse(EventRegistration $registration): Response
    {
        $registration->loadMissing(['event', 'attendance']);

        $filename = 'Sertifikat-'.Str::slug($registration->full_name).'.pdf';

        return Pdf::loadView('certificates.pdf', [
            'registration' => $registration,
            'event' => $registration->event,
            'attendedAt' => $registration->attendance->scanned_at,
        ])
            ->setPaper('a4', 'landscape')
            ->download($filename);
    }
}
