<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'avatar', 'status', 'is_approved',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }

    // ── Role helpers ───────────────────────────────────────────────────
    public function isJobSeeker(): bool  { return $this->role === 'job_seeker'; }
    public function isEmployer(): bool   { return $this->role === 'employer'; }
    public function isAdmin(): bool      { return $this->role === 'admin'; }
    public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
    public function isAdminOrAbove(): bool { return in_array($this->role, ['admin', 'super_admin']); }

    public function isActive(): bool { return $this->status === 'active'; }
    public function isBanned(): bool { return $this->status === 'banned'; }

    // ── Relationships ──────────────────────────────────────────────────
    public function employerProfile()
    {
        return $this->hasOne(EmployerProfile::class);
    }

    public function seekerProfile()
    {
        return $this->hasOne(JobSeekerProfile::class);
    }

    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(SocialLink::class);
    }

    // ── Subscription helpers ───────────────────────────────────────────
    public function hasActiveSubscription(): bool
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->exists();
    }

    public function isPro(): bool
    {
        $plan = $this->activePlan();
        return $plan && !$plan->isFree();
    }

    public function activePlan(): ?SubscriptionPlan
    {
        $sub = $this->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->with('plan')
            ->latest()
            ->first();
        return $sub?->plan;
    }

    public function hasSavedJob(int $jobId): bool
    {
        return $this->savedJobs()->where('job_id', $jobId)->exists();
    }

    public function hasApplied(int $jobId): bool
    {
        return $this->applications()->where('job_id', $jobId)->exists();
    }

    // ── Avatar helper ──────────────────────────────────────────────────
    public function avatarUrl(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=2563EB&color=fff';
    }
}
