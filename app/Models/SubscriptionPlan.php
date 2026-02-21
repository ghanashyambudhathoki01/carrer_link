<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'duration_days',
        'max_job_posts', 'can_feature_jobs', 'can_access_premium_filters',
        'can_download_resumes', 'features', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'features'                   => 'array',
        'can_feature_jobs'           => 'boolean',
        'can_access_premium_filters' => 'boolean',
        'can_download_resumes'       => 'boolean',
        'is_active'                  => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }

    public function isFree(): bool
    {
        return $this->price == 0;
    }
}
