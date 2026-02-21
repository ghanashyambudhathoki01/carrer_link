<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Notifications\ApplicationStatusNotification;

class EmployerController extends Controller
{


    // ── Dashboard ──────────────────────────────────────────────────────
    public function dashboard()
    {
        $user = auth()->user();
        
        // Stats
        $jobsCount         = JobListing::where('employer_id', $user->id)->where('status', 'approved')->count();
        $applicantsCount   = JobApplication::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->count();
        $totalViews        = JobListing::where('employer_id', $user->id)->sum('views');
        $shortlistedCount  = JobApplication::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->where('status', 'shortlisted')->count();

        // Recent Activity
        $recentJobs = JobListing::where('employer_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact(
            'jobsCount', 
            'applicantsCount', 
            'totalViews', 
            'shortlistedCount', 
            'recentJobs'
        ));
    }

    // ── My Job Listings ────────────────────────────────────────────────
    public function jobs(Request $request)
    {
        $query = JobListing::where('employer_id', auth()->id())
            ->with(['category'])
            ->withCount('applications');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        $categories = JobCategory::where('is_active', true)->orderBy('name')->get();

        return view('employer.jobs.index', compact('jobs', 'categories'));
    }

    // ── Create Job ─────────────────────────────────────────────────────
    public function createJob()
    {
        $user = auth()->user();
        $plan = $user->activePlan();
        $currentJobs = JobListing::where('employer_id', $user->id)->count();

        if ($plan && $currentJobs >= $plan->max_job_posts) {
            return redirect()->route('employer.jobs.index')->with('error', "Limit reached: Your '{$plan->name}' plan allows only {$plan->max_job_posts} job post(s). Please upgrade to post more.");
        }

        $categories = JobCategory::where('is_active', true)->orderBy('name')->get();
        return view('employer.jobs.create', compact('categories'));
    }

    public function storeJob(Request $request)
    {
        $user = auth()->user();
        $plan = $user->activePlan();
        $currentJobs = JobListing::where('employer_id', $user->id)->count();

        if ($plan && $currentJobs >= $plan->max_job_posts) {
            return redirect()->route('employer.jobs.index')->with('error', "Limit reached. Please upgrade your plan.");
        }

        $data = $request->validate([
            'title'              => 'required|string|max:255',
            'category_id'        => 'required|exists:job_categories,id',
            'description'        => 'required|string',
            'location'           => 'required|string|max:255',
            'type'               => 'required|in:full_time,part_time,internship,remote,contract,freelance',
            'salary_min'         => 'nullable|numeric|min:0',
            'salary_max'         => 'nullable|numeric|min:0',
            'experience_level'   => 'required|in:entry,mid,senior,executive',
            'experience_years_min'=> 'nullable|integer|min:0',
            'skills'             => 'nullable|string',
            'requirements'       => 'nullable|string',
            'benefits'           => 'nullable|string',
            'vacancies'          => 'required|integer|min:1',
            'deadline'           => 'nullable|date|after_or_equal:today',
            'is_featured'        => 'nullable|boolean',
        ]);

        $data['employer_id'] = auth()->id();
        $data['status']      = 'approved'; // immediately live
        $data['skills']      = $request->skills ? array_filter(array_map('trim', explode(',', $request->skills))) : [];
        $data['requirements']= $request->requirements ? array_filter(explode("\n", str_replace("\r", "", $request->requirements))) : [];
        $data['benefits']    = $request->benefits ? array_filter(explode("\n", str_replace("\r", "", $request->benefits))) : [];
        $data['is_featured'] = $request->has('is_featured');

        $data['experience_years_min'] = $data['experience_years_min'] ?? 0;
        JobListing::create($data);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully and is now live!');
    }

    // ── Edit Job ───────────────────────────────────────────────────────
    public function editJob(int $id)
    {
        $job        = JobListing::where('employer_id', auth()->id())->findOrFail($id);
        $categories = JobCategory::where('is_active', true)->orderBy('name')->get();
        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    public function updateJob(Request $request, int $id)
    {
        $job = JobListing::where('employer_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'category_id'      => 'required|exists:job_categories,id',
            'description'      => 'required|string',
            'location'         => 'required|string|max:255',
            'type'             => 'required|in:full_time,part_time,internship,remote,contract,freelance',
            'salary_min'       => 'nullable|numeric|min:0',
            'salary_max'       => 'nullable|numeric|min:0',
            'experience_level'   => 'required|in:entry,mid,senior,executive',
            'experience_years_min'=> 'nullable|integer|min:0',
            'skills'             => 'nullable|string',
            'requirements'       => 'nullable|string',
            'benefits'           => 'nullable|string',
            'vacancies'          => 'required|integer|min:1',
            'deadline'           => 'nullable|date|after_or_equal:today',
            'is_featured'        => 'nullable|boolean',
        ]);
        $data['skills'] = $request->skills ? array_filter(array_map('trim', explode(',', $request->skills))) : [];
        $data['requirements'] = $request->requirements ? array_filter(explode("\n", str_replace("\r", "", $request->requirements))) : [];
        $data['benefits'] = $request->benefits ? array_filter(explode("\n", str_replace("\r", "", $request->benefits))) : [];
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = 'approved'; // keep it live

        $data['experience_years_min'] = $data['experience_years_min'] ?? 0;
        $job->update($data);
        return redirect()->route('employer.jobs.index')->with('success', 'Job updated and re-submitted for approval.');
    }

    public function destroyJob(int $id)
    {
        JobListing::where('employer_id', auth()->id())->findOrFail($id)->delete();
        return back()->with('success', 'Job listing deleted.');
    }

    // ── All Applicants (Centralized) ──────────────────────────────────
    public function allApplicants(Request $request)
    {
        $query = JobApplication::whereHas('job', function($q) {
            $q->where('employer_id', auth()->id());
        })
        ->with(['applicant.seekerProfile', 'job']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(20)->withQueryString();

        return view('employer.applicants.all', compact('applications'));
    }

    // ── Applicants by Job ──────────────────────────────────────────────
    public function applicants(Request $request, int $jobId)
    {
        $job = JobListing::where('employer_id', auth()->id())->findOrFail($jobId);
        
        $query = JobApplication::with(['applicant.seekerProfile'])->where('job_id', $jobId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(20)->withQueryString();
        
        return view('employer.applicants.index', compact('job', 'applications'));
    }

    public function updateApplicationStatus(Request $request, int $appId)
    {
        $request->validate(['status' => 'required|in:reviewed,shortlisted,interviewed,rejected,hired']);

        $app = JobApplication::whereHas('job', fn($q) => $q->where('employer_id', auth()->id()))->findOrFail($appId);
        $app->update(['status' => $request->status, 'reviewed_at' => now(), 'employer_notes' => $request->notes]);

        // Notify the applicant
        $app->applicant->notify(new ApplicationStatusNotification($app, $request->status));

        return back()->with('success', 'Applicant status updated and notification sent.');
    }

    // ── Company Profile ────────────────────────────────────────────────
    public function profile()
    {
        $profile = auth()->user()->employerProfile ?? new \App\Models\EmployerProfile();
        return view('employer.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry'     => 'nullable|string|max:100',
            'location'     => 'nullable|string|max:255',
            'website'      => 'nullable|url|max:255',
            'description'  => 'nullable|string',
            'company_size' => 'nullable|string',
            'founded_year' => 'nullable|digits:4',
            'logo'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        auth()->user()->employerProfile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return back()->with('success', 'Company profile updated.');
    }

    // ── Events ─────────────────────────────────────────────────────────
    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'location'         => 'required|string|max:255',
            'event_date'       => 'required|date|after_or_equal:today',
            'event_end_date'   => 'nullable|date|after_or_equal:event_date',
            'organizer_name'   => 'required|string|max:255',
            'organizer_email'  => 'nullable|email|max:255',
            'organizer_phone'  => 'nullable|string|max:20',
            'registration_link'=> 'nullable|url|max:255',
            'fee'              => 'nullable|numeric|min:0',
            'max_attendees'    => 'nullable|integer|min:1',
            'type'             => 'required|in:job_fair,workshop,seminar,networking,webinar,other',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'user_id'           => auth()->id(),
            'title'             => $request->title,
            'description'       => $request->description,
            'location'          => $request->location,
            'event_date'        => $request->event_date,
            'event_end_date'    => $request->event_end_date,
            'organizer_name'    => $request->organizer_name,
            'organizer_email'   => $request->organizer_email,
            'organizer_phone'   => $request->organizer_phone,
            'registration_link' => $request->registration_link,
            'fee'               => $request->fee ?? 0,
            'max_attendees'     => $request->max_attendees,
            'type'              => $request->type,
            'image'             => $imagePath,
            'status'            => 'upcoming',
            'is_approved'       => false, // Pending admin approval for employers
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Event submitted successfully! It will be live after admin review.');
    }
}
