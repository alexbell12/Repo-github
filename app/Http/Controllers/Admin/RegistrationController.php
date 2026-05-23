<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Event $event)
    {
        $registrations = $event->registrations()->with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.registrations.index', compact('event', 'registrations'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::findOrFail($validated['user_id']);
        $exists = $event->registrations()->where('user_id', $user->id)->exists();
        if ($exists) {
            return back()->with('error', 'Peserta sudah terdaftar.');
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'status' => 'verified',
        ]);

        return back()->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function verify(EventRegistration $registration)
    {
        $registration->update(['status' => 'verified']);
        return back()->with('success', 'Peserta berhasil diverifikasi.');
    }

    public function destroy(EventRegistration $registration)
    {
        $event = $registration->event;
        $registration->delete();
        return redirect()->route('admin.events.registrations.index', $event)
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
