<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Information Technology',   'slug' => 'information-technology',   'icon' => '💻'],
            ['name' => 'Marketing & Sales',        'slug' => 'marketing-sales',          'icon' => '📣'],
            ['name' => 'Design & Creative',        'slug' => 'design-creative',          'icon' => '🎨'],
            ['name' => 'Finance & Accounting',     'slug' => 'finance-accounting',       'icon' => '💰'],
            ['name' => 'Human Resources',          'slug' => 'human-resources',          'icon' => '👥'],
            ['name' => 'Engineering',              'slug' => 'engineering',             'icon' => '⚙️'],
            ['name' => 'Education',                'slug' => 'education',               'icon' => '📚'],
            ['name' => 'Healthcare',               'slug' => 'healthcare',              'icon' => '🏥'],
            ['name' => 'Customer Service',         'slug' => 'customer-service',        'icon' => '🎧'],
            ['name' => 'Administration',           'slug' => 'administration',          'icon' => '📋'],
            ['name' => 'Hospitality & Tourism',    'slug' => 'hospitality-tourism',     'icon' => '🏨'],
            ['name' => 'Legal',                    'slug' => 'legal',                   'icon' => '⚖️'],
            ['name' => 'Media & Journalism',       'slug' => 'media-journalism',        'icon' => '📰'],
            ['name' => 'Research & Development',   'slug' => 'research-development',    'icon' => '🔬'],
            ['name' => 'Other',                    'slug' => 'other',                   'icon' => '📌'],
        ];

        foreach ($categories as $cat) {
            JobCategory::create($cat);
        }
    }
}
