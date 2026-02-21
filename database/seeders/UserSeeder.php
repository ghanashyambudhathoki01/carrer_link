<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\JobSeekerProfile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@careerlink.com',
            'password' => Hash::make('password'),
            'role'     => 'super_admin',
            'status'   => 'active',
            'phone'    => '9800000001',
        ]);

        // Admin
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@careerlink.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'status'   => 'active',
            'phone'    => '9800000002',
        ]);

        // Employer 1
        $employer1 = User::create([
            'name'     => 'TechCorp Nepal',
            'email'    => 'employer@careerlink.com',
            'password' => Hash::make('password'),
            'role'     => 'employer',
            'status'   => 'active',
            'phone'    => '9800000003',
        ]);
        EmployerProfile::create([
            'user_id'      => $employer1->id,
            'company_name' => 'TechCorp Nepal Pvt. Ltd.',
            'industry'     => 'Information Technology',
            'location'     => 'Kathmandu, Nepal',
            'company_size' => '51-200',
            'website'      => 'https://techcorp.com.np',
            'description'  => 'Leading IT company providing software solutions across Nepal.',
            'founded_year' => 2015,
            'is_verified'  => true,
        ]);

        // Employer 2
        $employer2 = User::create([
            'name'     => 'Digital Dreams',
            'email'    => 'employer2@careerlink.com',
            'password' => Hash::make('password'),
            'role'     => 'employer',
            'status'   => 'active',
            'phone'    => '9800000004',
        ]);
        EmployerProfile::create([
            'user_id'      => $employer2->id,
            'company_name' => 'Digital Dreams Pvt. Ltd.',
            'industry'     => 'Digital Marketing',
            'location'     => 'Lalitpur, Nepal',
            'company_size' => '11-50',
            'description'  => 'Creative digital marketing agency.',
            'is_verified'  => true,
        ]);

        // Job Seeker
        $seeker = User::create([
            'name'     => 'Ram Shrestha',
            'email'    => 'seeker@careerlink.com',
            'password' => Hash::make('password'),
            'role'     => 'job_seeker',
            'status'   => 'active',
            'phone'    => '9800000005',
        ]);
        JobSeekerProfile::create([
            'user_id'          => $seeker->id,
            'headline'         => 'Full Stack Developer | Laravel & Vue.js',
            'bio'              => 'Passionate developer with 3+ years experience building web apps.',
            'skills'           => ['Laravel', 'PHP', 'Vue.js', 'MySQL', 'Tailwind CSS'],
            'experience_years' => 3,
            'current_location' => 'Kathmandu, Nepal',
            'availability'     => 'immediately',
        ]);
    }
}
