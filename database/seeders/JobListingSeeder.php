<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\User;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        $employer1 = User::where('email', 'employer@careerlink.com')->first();
        $employer2 = User::where('email', 'employer2@careerlink.com')->first();

        $jobs = [
            [
                'employer_id'       => $employer1->id,
                'category_id'       => 1, // IT
                'title'             => 'Senior Laravel Developer',
                'description'       => 'We are looking for a Senior Laravel Developer to join our team. You will be responsible for building and maintaining web applications.',
                'location'          => 'Kathmandu, Nepal',
                'type'              => 'full_time',
                'salary_min'        => 80000,
                'salary_max'        => 120000,
                'experience_level'  => 'senior',
                'experience_years_min' => 4,
                'skills'            => ['Laravel', 'PHP', 'MySQL', 'Vue.js', 'REST API'],
                'vacancies'         => 2,
                'deadline'          => now()->addDays(30)->toDateString(),
                'status'            => 'approved',
                'is_featured'       => true,
            ],
            [
                'employer_id'       => $employer1->id,
                'category_id'       => 1,
                'title'             => 'React.js Frontend Developer',
                'description'       => 'Join our dynamic frontend team and help build beautiful user interfaces using React.js.',
                'location'          => 'Kathmandu, Nepal',
                'type'              => 'full_time',
                'salary_min'        => 60000,
                'salary_max'        => 90000,
                'experience_level'  => 'mid',
                'experience_years_min' => 2,
                'skills'            => ['React.js', 'JavaScript', 'TypeScript', 'CSS', 'Redux'],
                'vacancies'         => 3,
                'deadline'          => now()->addDays(25)->toDateString(),
                'status'            => 'approved',
            ],
            [
                'employer_id'       => $employer1->id,
                'category_id'       => 1,
                'title'             => 'Flutter Mobile Developer Intern',
                'description'       => 'Great opportunity for students to learn Flutter development in a professional environment.',
                'location'          => 'Kathmandu, Nepal',
                'type'              => 'internship',
                'salary_min'        => 10000,
                'salary_max'        => 15000,
                'experience_level'  => 'entry',
                'experience_years_min' => 0,
                'skills'            => ['Flutter', 'Dart', 'Firebase'],
                'vacancies'         => 2,
                'deadline'          => now()->addDays(15)->toDateString(),
                'status'            => 'approved',
            ],
            [
                'employer_id'       => $employer2->id,
                'category_id'       => 2, // Marketing
                'title'             => 'Digital Marketing Specialist',
                'description'       => 'We are seeking an experienced Digital Marketing Specialist to develop and execute marketing strategies.',
                'location'          => 'Lalitpur, Nepal',
                'type'              => 'full_time',
                'salary_min'        => 50000,
                'salary_max'        => 75000,
                'experience_level'  => 'mid',
                'experience_years_min' => 2,
                'skills'            => ['SEO', 'Google Ads', 'Facebook Ads', 'Content Marketing', 'Analytics'],
                'vacancies'         => 1,
                'deadline'          => now()->addDays(20)->toDateString(),
                'status'            => 'approved',
            ],
            [
                'employer_id'       => $employer2->id,
                'category_id'       => 3, // Design
                'title'             => 'UI/UX Designer',
                'description'       => 'Create stunning user interfaces and experiences for our digital products.',
                'location'          => 'Remote',
                'type'              => 'remote',
                'salary_min'        => 55000,
                'salary_max'        => 85000,
                'experience_level'  => 'mid',
                'experience_years_min' => 2,
                'skills'            => ['Figma', 'Adobe XD', 'Photoshop', 'Illustrator', 'Prototyping'],
                'vacancies'         => 1,
                'deadline'          => now()->addDays(30)->toDateString(),
                'status'            => 'approved',
                'is_featured'       => true,
            ],
            [
                'employer_id'       => $employer1->id,
                'category_id'       => 1,
                'title'             => 'DevOps Engineer',
                'description'       => 'Manage our cloud infrastructure, CI/CD pipelines, and ensure system reliability.',
                'location'          => 'Kathmandu, Nepal',
                'type'              => 'full_time',
                'salary_min'        => 90000,
                'salary_max'        => 140000,
                'experience_level'  => 'senior',
                'experience_years_min' => 4,
                'skills'            => ['AWS', 'Docker', 'Kubernetes', 'CI/CD', 'Linux'],
                'vacancies'         => 1,
                'deadline'          => now()->addDays(45)->toDateString(),
                'status'            => 'approved',
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create($job);
        }
    }
}
