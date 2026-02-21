<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'description', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'category_id');
    }
}
