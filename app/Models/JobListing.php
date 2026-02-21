<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'category_id', 'title', 'slug', 'description', 'location',
        'type', 'salary_min', 'salary_max', 'salary_currency', 'experience_level',
        'experience_years_min', 'skills', 'requirements', 'responsibilities', 'benefits',
        'vacancies', 'deadline', 'status', 'is_featured', 'views',
    ];

    protected $casts = [
        'skills'           => 'array',
        'requirements'     => 'array',
        'responsibilities' => 'array',
        'benefits'         => 'array',
        'deadline'         => 'date',
        'is_featured'      => 'boolean',
    ];

    // ── Auto-generate slug ─────────────────────────────────────────────
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title) . '-' . Str::random(6);
            }
        });
    }

    // ── Relationships ──────────────────────────────────────────────────
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function savedByUsers()
    {
        return $this->hasMany(SavedJob::class, 'job_id');
    }

    // ── Scopes ─────────────────────────────────────────────────────────
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved')->where(function ($q) {
            $q->whereNull('deadline')->orWhere('deadline', '>=', now()->toDateString());
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ── Helpers ────────────────────────────────────────────────────────
    public function salaryRange(): string
    {
        if ($this->salary_min && $this->salary_max) {
            return number_format($this->salary_min) . ' – ' . number_format($this->salary_max) . ' ' . $this->salary_currency;
        } elseif ($this->salary_min) {
            return number_format($this->salary_min) . '+ ' . $this->salary_currency;
        }
        return 'Negotiable';
    }

    public function typeLabel(): string
    {
        return match ($this->type) {
            'full_time'  => 'Full Time',
            'part_time'  => 'Part Time',
            'internship' => 'Internship',
            'remote'     => 'Remote',
            'contract'   => 'Contract',
            'freelance'  => 'Freelance',
            default      => ucfirst($this->type),
        };
    }

    public function statusBadge(): string
    {
        return match ($this->status) {
            'approved' => 'bg-green-100 text-green-700',
            'pending'  => 'bg-yellow-100 text-yellow-700',
            'rejected' => 'bg-red-100 text-red-700',
            'closed'   => 'bg-gray-100 text-gray-700',
            'draft'    => 'bg-blue-100 text-blue-700',
            default    => 'bg-gray-100 text-gray-700',
        };
    }

    public function isExpired(): bool
    {
        return $this->deadline && $this->deadline->isPast();
    }
}
