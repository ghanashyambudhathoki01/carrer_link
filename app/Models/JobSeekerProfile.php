<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'headline', 'bio', 'resume_path', 'skills', 'experience_years',
        'current_location', 'preferred_location', 'expected_salary', 'availability',
        'linkedin', 'github', 'portfolio',
    ];

    protected $casts = ['skills' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resumeUrl(): ?string
    {
        return $this->resume_path ? asset('storage/' . $this->resume_path) : null;
    }
}
