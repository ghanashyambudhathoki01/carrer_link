<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobCategory;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = JobListing::active()->featured()->with(['employer.employerProfile', 'category'])->latest()->take(6)->get();
        $recentJobs   = JobListing::active()->with(['employer.employerProfile', 'category'])->latest()->take(8)->get();
        $categories   = JobCategory::where('is_active', true)->withCount(['jobListings' => fn($q) => $q->active()])->orderBy('name')->take(12)->get();
        $upcomingEvents = Event::where('is_approved', true)->where('status', 'upcoming')->latest('event_date')->take(3)->get();

        $stats = [
            'total_jobs'      => JobListing::active()->count(),
            'total_companies' => \App\Models\EmployerProfile::count(),
            'total_seekers'   => \App\Models\User::where('role', 'job_seeker')->count(),
            'jobs_filled'     => \App\Models\JobApplication::where('status', 'hired')->count(),
        ];

        return view('home', compact('featuredJobs', 'recentJobs', 'categories', 'upcomingEvents', 'stats'));
    }
}
