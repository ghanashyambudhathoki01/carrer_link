<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::updateOrCreate(['slug' => 'free'], [
            'name'                       => 'Free',
            'description'                => 'Ideal for freelancers and beginners.',
            'price'                      => 0,
            'duration_days'              => 365,
            'max_job_posts'              => 1,
            'can_feature_jobs'           => false,
            'can_access_premium_filters' => false,
            'can_download_resumes'       => false,
            'features'                   => [
                'Post 1 active job',
                'Basic candidate search',
                'Standard email support',
                'Public profile view',
            ],
            'sort_order' => 1,
        ]);

        SubscriptionPlan::updateOrCreate(['slug' => 'pro'], [
            'name'                       => 'Pro',
            'description'                => 'The professional choice for growing reach.',
            'price'                      => 1499,
            'duration_days'              => 30,
            'max_job_posts'              => 15,
            'can_feature_jobs'           => true,
            'can_access_premium_filters' => true,
            'can_download_resumes'       => true,
            'features'                   => [
                'Post up to 15 jobs',
                '5 Featured job listings',
                'Download 50 resumes/mo',
                'Advanced search filters',
                'Priority email support',
                'Applicant Tracking (Basic)',
            ],
            'sort_order' => 2,
        ]);

        SubscriptionPlan::updateOrCreate(['slug' => 'enterprise'], [
            'name'                       => 'Enterprise',
            'description'                => 'Everything you need for large-scale hiring.',
            'price'                      => 4999,
            'duration_days'              => 90,
            'max_job_posts'              => 999,
            'can_feature_jobs'           => true,
            'can_access_premium_filters' => true,
            'can_download_resumes'       => true,
            'features'                   => [
                'Unlimited job postings',
                'Unlimited featured jobs',
                'Unlimited resume downloads',
                'Company branding & logo',
                'Full ATS features',
                '24/7 Priority Support',
                'Analytics & Reports',
            ],
            'sort_order' => 3,
        ]);
    }
}
