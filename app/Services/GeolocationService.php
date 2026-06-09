<?php

namespace App\Services;

use App\Models\Event;

class GeolocationService
{
    public function distanceInMeters(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000;
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
        ));

        return $angle * $earthRadius;
    }

    public function isWithinRadius(Event $event, float $latitude, float $longitude): bool
    {
        if ($event->latitude === null || $event->longitude === null) {
            return true;
        }

        $distance = $this->distanceInMeters(
            (float) $event->latitude,
            (float) $event->longitude,
            $latitude,
            $longitude
        );

        return $distance <= ($event->location_radius ?? 100);
    }
}
