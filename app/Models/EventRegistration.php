<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'full_name',
        'nim',
        'instansi',
        'email',
        'attendance_token',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($reg) {
            if (empty($reg->attendance_token)) {
                $reg->attendance_token = Str::random(64);
            }
            if (empty($reg->status)) {
                $reg->status = 'verified';
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function hasAttended(): bool
    {
        return $this->attendance()->exists();
    }
}
