<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 'user_id', 'cover_letter', 'resume_path',
        'status', 'employer_notes', 'reviewed_at',
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'applied'      => 'Applied',
            'reviewed'     => 'Under Review',
            'shortlisted'  => 'Shortlisted',
            'interviewed'  => 'Interviewed',
            'rejected'     => 'Not Selected',
            'hired'        => 'Hired',
            default        => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'applied'     => 'bg-blue-100 text-blue-700',
            'reviewed'    => 'bg-yellow-100 text-yellow-700',
            'shortlisted' => 'bg-purple-100 text-purple-700',
            'interviewed' => 'bg-indigo-100 text-indigo-700',
            'rejected'    => 'bg-red-100 text-red-700',
            'hired'       => 'bg-green-100 text-green-700',
            default       => 'bg-gray-100 text-gray-700',
        };
    }
}
