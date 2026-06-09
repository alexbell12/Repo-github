<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\AttendanceQrService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function __construct(private AttendanceQrService $qrService) {}

    public function index()
    {
        $events = Event::orderBy('start_time', 'desc')->get();
        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();

        return view('admin.events.index', compact('events', 'totalEvents', 'activeEvents'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'location' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'location_radius' => ['nullable', 'integer', 'min:10', 'max:5000'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['slug'] = Str::slug($validated['title']) . '-' . strtolower(Str::random(6));
        $validated['location_radius'] = $validated['location_radius'] ?? 100;

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function show(Event $event)
    {
        return redirect()->route('events.show', $event->slug);
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'location' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'location_radius' => ['nullable', 'integer', 'min:10', 'max:5000'],
            'is_active' => ['boolean'],
        ]);

        $event->update([
            ...$validated,
            'is_active' => $request->boolean('is_active'),
            'location_radius' => $validated['location_radius'] ?? $event->location_radius ?? 100,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function toggleActive(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);
        return back()->with('success', $event->is_active ? 'Event diaktifkan.' : 'Event nonaktifkan.');
    }

    public function qr(Event $event)
    {
        $qrUrl = $this->qrService->buildEventCheckInUrl($event);
        $expiresIn = $this->qrService->secondsUntilNextSlot();

        return view('admin.events.qr', compact('event', 'qrUrl', 'expiresIn'));
    }

    public function qrRefresh(Event $event)
    {
        $qrUrl = $this->qrService->buildEventCheckInUrl($event);

        return response()->json([
            'url' => $qrUrl,
            'svg' => (string) QrCode::format('svg')->size(220)->generate($qrUrl),
            'expires_in' => $this->qrService->secondsUntilNextSlot(),
        ]);
    }
}
