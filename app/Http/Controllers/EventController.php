<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventController extends Controller
{
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
            $userRegistration = $event->registrations()->where('user_id', auth()->id())->first();
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
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('events.my-attendance', compact('event', 'registration'));
    }

    public function scan(string $token)
    {
        $registration = EventRegistration::where('attendance_token', $token)->firstOrFail();
        $event = $registration->event;

        if ($registration->attendance) {
            return view('attendance.already', compact('event', 'registration'));
        }

        return view('attendance.confirm', compact('event', 'registration'));
    }

    public function confirmScan(Request $request)
    {
        $registration = EventRegistration::where('attendance_token', $request->token)->firstOrFail();

        if ($registration->attendance) {
            return redirect()->route('attendance.scan', $request->token)
                ->with('info', 'Peserta sudah tercatat hadir.');
        }

        $registration->attendance()->create([
            'event_id' => $registration->event_id,
            'scanned_at' => now(),
        ]);

        return redirect()->route('attendance.scan', $request->token)
            ->with('success', 'Absensi berhasil dicatat.');
    }
}
