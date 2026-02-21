<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;

class SeekerProfileController extends Controller
{


    public function show()
    {
        $profile = auth()->user()->seekerProfile ?? new JobSeekerProfile();
        return view('seeker.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'headline'         => 'nullable|string|max:255',
            'bio'              => 'nullable|string',
            'skills'           => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'current_location' => 'nullable|string|max:255',
            'preferred_location'=> 'nullable|string|max:255',
            'expected_salary'  => 'nullable|string|max:100',
            'availability'     => 'nullable|in:immediately,within_month,negotiable',
            'linkedin'         => 'nullable|url|max:255',
            'github'           => 'nullable|url|max:255',
            'portfolio'        => 'nullable|url|max:255',
            'resume'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('resume')) {
            $data['resume_path'] = $request->file('resume')->store('resumes/' . auth()->id(), 'public');
        }
        unset($data['resume']);

        $data['skills'] = $request->skills ? array_filter(array_map('trim', explode(',', $request->skills))) : [];

        auth()->user()->seekerProfile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return back()->with('success', 'Profile updated successfully.');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $totalApplications = $user->applications()->count();
        $shortlisted       = $user->applications()->where('status', 'shortlisted')->count();
        $savedJobs         = $user->savedJobs()->count();
        $recentApplications= $user->applications()->with(['job.employer.employerProfile'])->latest()->take(5)->get();

        return view('seeker.dashboard', compact('totalApplications', 'shortlisted', 'savedJobs', 'recentApplications'));
    }
}
