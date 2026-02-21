<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_name', 'logo', 'website', 'description',
        'industry', 'location', 'company_size', 'founded_year', 'is_verified',
    ];

    protected $casts = ['is_verified' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'employer_id', 'user_id');
    }

    public function logoUrl(): string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->company_name) . '&background=10B981&color=fff&size=128';
    }
}
