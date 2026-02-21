<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'image', 'location',
        'event_date', 'event_end_date', 'organizer_name', 'organizer_email',
        'organizer_phone', 'registration_link', 'fee', 'max_attendees',
        'type', 'status', 'is_approved', 'views',
    ];

    protected $casts = [
        'event_date'     => 'datetime',
        'event_end_date' => 'datetime',
        'is_approved'    => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(5);
            }
        });
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imageUrl(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function isFree(): bool
    {
        return $this->fee == 0;
    }
}
