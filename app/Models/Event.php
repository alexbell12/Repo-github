<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_time',
        'end_time',
        'location',
        'latitude',
        'longitude',
        'location_radius',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'latitude' => 'float',
            'longitude' => 'float',
            'location_radius' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . strtolower(Str::random(6));
            }
        });
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getStatusLabelAttribute(): string
    {
        $now = now();
        if ($now->lt($this->start_time)) {
            return 'Akan dimulai ' . $this->start_time->diffForHumans();
        }
        if ($now->gt($this->end_time)) {
            return 'Event selesai';
        }
        return 'Sedang berlangsung';
    }

    public function getTimeRemainingAttribute(): string
    {
        $now = now();
        if ($now->lt($this->start_time)) {
            return $this->start_time->diffForHumans();
        }
        if ($now->gt($this->end_time)) {
            return 'Selesai';
        }
        return 'Berlangsung';
    }

    public function hasEnded(): bool
    {
        return now()->gt($this->end_time);
    }

    public function canShowAttendanceQr(): bool
    {
        return $this->hasEnded();
    }
}
