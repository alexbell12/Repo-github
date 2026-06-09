<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventRegistration;

class AttendanceQrService
{
    public function currentSlot(): int
    {
        return (int) floor(time() / 60);
    }

    public function secondsUntilNextSlot(): int
    {
        return 60 - (time() % 60);
    }

    public function generateSignature(string $payload, ?int $slot = null): string
    {
        $slot = $slot ?? $this->currentSlot();

        return hash_hmac('sha256', $payload . ':' . $slot, config('app.key'));
    }

    public function validateSignature(string $payload, string $signature, int $graceSlots = 1): bool
    {
        $currentSlot = $this->currentSlot();

        for ($i = 0; $i <= $graceSlots; $i++) {
            if (hash_equals($this->generateSignature($payload, $currentSlot - $i), $signature)) {
                return true;
            }
        }

        return false;
    }

    public function buildAttendanceUrl(EventRegistration $registration): string
    {
        $token = $registration->attendance_token;
        $slot = $this->currentSlot();
        $sig = $this->generateSignature($token, $slot);

        return route('attendance.scan', [
            'token' => $token,
            'slot' => $slot,
            'sig' => $sig,
        ]);
    }

    public function buildEventCheckInUrl(Event $event): string
    {
        $payload = 'event:' . $event->id;
        $slot = $this->currentSlot();
        $sig = $this->generateSignature($payload, $slot);

        return route('events.check-in', [
            'slug' => $event->slug,
            'slot' => $slot,
            'sig' => $sig,
        ]);
    }
}
