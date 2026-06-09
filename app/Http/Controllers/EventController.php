<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\AttendanceQrService;
use App\Services\GeolocationService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function __construct(
        private AttendanceQrService $qrService,
        private GeolocationService $geoService
    ) {}

    public function index()
    {
        $events = Event::where('is_active', true)
            ->orderBy('start_time')
            ->get();

        return view('events.index', compact('events'));
    }

    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $userRegistration = null;
        if (auth()->check()) {
            $userRegistration = $event->registrations()
                ->with('attendance')
                ->where('user_id', auth()->id())
                ->first();
        }
        return view('events.show', compact('event', 'userRegistration'));
    }

    public function showRegisterForm(string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('events.register', compact('event'));
    }

    public function register(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'nim' => ['nullable', 'string', 'max:50'],
            'instansi' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['event_id'] = $event->id;
        $validated['user_id'] = auth()->id();
        $validated['email'] = auth()->check() ? auth()->user()->email : null;

        $existing = $event->registrations()
            ->when(auth()->check(), fn ($q) => $q->where('user_id', auth()->id()))
            ->when(!auth()->check(), fn ($q) => $q->where('full_name', $validated['full_name'])->where('nim', $validated['nim'] ?? ''))
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah terdaftar di event ini.');
        }

        EventRegistration::create($validated);

        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Pendaftaran berhasil. Menunggu verifikasi admin.');
    }

    public function showMyAttendance(string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $registration = $event->registrations()
            ->with('attendance')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $qrUrl = $this->qrService->buildAttendanceUrl($registration);
        $expiresIn = $this->qrService->secondsUntilNextSlot();

        return view('events.my-attendance', compact('event', 'registration', 'qrUrl', 'expiresIn'));
    }

    public function attendanceQrRefresh(string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $registration = $event->registrations()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $qrUrl = $this->qrService->buildAttendanceUrl($registration);

        return response()->json([
            'url' => $qrUrl,
            'svg' => (string) QrCode::format('svg')->size(220)->margin(1)->generate($qrUrl),
            'expires_in' => $this->qrService->secondsUntilNextSlot(),
        ]);
    }

    public function checkInForm(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $request->validate([
            'slot' => ['required', 'integer'],
            'sig' => ['required', 'string'],
        ]);

        $payload = 'event:' . $event->id;
        if (!$this->qrService->validateSignature($payload, $request->sig)) {
            return redirect()->route('events.show', $event->slug)
                ->with('error', 'QR code sudah tidak berlaku. Silakan scan QR terbaru.');
        }

        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('info', 'Silakan login terlebih dahulu untuk melakukan presensi.');
        }

        $registration = $event->registrations()
            ->with('attendance')
            ->where('user_id', auth()->id())
            ->first();

        if (!$registration) {
            return redirect()->route('events.show', $event->slug)
                ->with('error', 'Anda belum terdaftar di event ini.');
        }

        if (!$registration->isVerified()) {
            return redirect()->route('events.show', $event->slug)
                ->with('error', 'Pendaftaran Anda belum diverifikasi admin.');
        }

        if ($registration->attendance) {
            return view('attendance.already', compact('event', 'registration'));
        }

        return view('attendance.check-in', compact('event', 'registration', 'request'));
    }

    public function checkInSubmit(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $request->validate([
            'slot' => ['required', 'integer'],
            'sig' => ['required', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $payload = 'event:' . $event->id;
        if (!$this->qrService->validateSignature($payload, $request->sig)) {
            return back()->with('error', 'QR code sudah tidak berlaku. Silakan scan QR terbaru.');
        }

        if (!$this->geoService->isWithinRadius($event, (float) $request->latitude, (float) $request->longitude)) {
            return back()->with('error', 'Anda berada di luar area acara. Presensi hanya dapat dilakukan di lokasi event.');
        }

        $registration = $event->registrations()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($registration->attendance) {
            return redirect()->route('events.my-attendance', $event->slug)
                ->with('info', 'Anda sudah tercatat hadir.');
        }

        $registration->attendance()->create([
            'event_id' => $event->id,
            'scanned_at' => now(),
        ]);

        return redirect()->route('events.my-attendance', $event->slug)
            ->with('success', 'Presensi berhasil dicatat.');
    }

    public function scan(Request $request, string $token)
    {
        $registration = EventRegistration::where('attendance_token', $token)->firstOrFail();
        $event = $registration->event;

        if (!$request->has('sig') || !$this->qrService->validateSignature($token, $request->sig)) {
            return redirect()->route('events.show', $event->slug)
                ->with('error', 'QR code tidak valid atau sudah kadaluarsa. Minta peserta menampilkan QR terbaru.');
        }

        if ($registration->attendance) {
            return view('attendance.already', compact('event', 'registration'));
        }

        return view('attendance.confirm', compact('event', 'registration', 'request'));
    }

    public function confirmScan(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'sig' => ['required', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $registration = EventRegistration::where('attendance_token', $request->token)->firstOrFail();
        $event = $registration->event;

        if (!$this->qrService->validateSignature($request->token, $request->sig)) {
            return back()->with('error', 'QR code sudah tidak berlaku. Minta peserta menampilkan QR terbaru.');
        }

        if (!$this->geoService->isWithinRadius($event, (float) $request->latitude, (float) $request->longitude)) {
            return back()->with('error', 'Lokasi tidak valid. Presensi hanya dapat dilakukan di area acara.');
        }

        if ($registration->attendance) {
            return redirect()->route('attendance.scan', [
                'token' => $request->token,
                'slot' => $request->slot,
                'sig' => $request->sig,
            ])->with('info', 'Peserta sudah tercatat hadir.');
        }

        $registration->attendance()->create([
            'event_id' => $registration->event_id,
            'scanned_at' => now(),
        ]);

        return redirect()->route('attendance.scan', [
            'token' => $request->token,
            'slot' => $request->slot,
            'sig' => $request->sig,
        ])->with('success', 'Presensi berhasil dicatat.');
    }
}
