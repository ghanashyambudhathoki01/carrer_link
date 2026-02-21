<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Notifications\ApplicationStatusNotification;

class DashboardController extends Controller
{


    public function index()
    {
        $stats = [
            'total_users'           => User::where('role', 'job_seeker')->count(),
            'total_employers'       => User::where('role', 'employer')->count(),
            'total_jobs'            => JobListing::where('status', 'approved')->count(),
            'pending_jobs'          => JobListing::where('status', 'pending')->count(),
            'total_subscriptions'   => Subscription::where('status', 'active')->count(),
            'pending_verifications' => Subscription::where('status', 'pending')->count(),
        ];
        $recentUsers  = User::latest()->take(5)->get();
        $pendingJobs  = JobListing::where('status', 'pending')->with('employer.employerProfile')->latest()->take(5)->get();
        $pendingPayments = Subscription::where('status', 'pending')->with(['user', 'plan'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'pendingJobs', 'pendingPayments'));
    }

    // ── Users ─────────────────────────────────────────────────────────
    public function users(Request $request)
    {
        $query = User::query();
        if ($request->filled('role'))   { $query->where('role', $request->role); }
        if ($request->filled('status')) { $query->where('status', $request->status); }
        if ($request->filled('q'))      { $query->where(fn($q) => $q->where('name', 'like', "%{$request->q}%")->orWhere('email', 'like', "%{$request->q}%")); }
        $users = $query->latest()->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function updateUserStatus(Request $request, int $id)
    {
        $request->validate(['status' => 'required|in:active,inactive,banned']);
        User::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'User status updated.');
    }

    // ── Job Listings Management ───────────────────────────────────────
    public function jobs(Request $request)
    {
        $query = JobListing::with(['employer.employerProfile', 'category']);
        
        if ($request->filled('status'))   { $query->where('status', $request->status); }
        if ($request->filled('category')) { $query->where('category_id', $request->category); }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($builder) use ($q) {
                $builder->where('title', 'like', "%$q%")
                        ->orWhereHas('employer.employerProfile', fn($eq) => $eq->where('company_name', 'like', "%$q%"));
            });
        }

        $jobs = $query->latest()->paginate(20)->withQueryString();
        $categories = \App\Models\JobCategory::orderBy('name')->get();

        return view('admin.jobs.index', compact('jobs', 'categories'));
    }

    public function updateJobStatus(Request $request, int $id)
    {
        $request->validate(['status' => 'required|in:approved,rejected,closed,pending']);
        JobListing::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Job status updated.');
    }

    public function updateJobCategory(Request $request, int $id)
    {
        $request->validate(['category_id' => 'required|exists:job_categories,id']);
        JobListing::findOrFail($id)->update(['category_id' => $request->category_id]);
        return back()->with('success', 'Job category updated.');
    }

    public function toggleFeatureJob(int $id)
    {
        $job = JobListing::findOrFail($id);
        $job->update(['is_featured' => !$job->is_featured]);
        return back()->with('success', 'Job feature status toggled.');
    }

    // ── Subscription / Payment Verification ───────────────────────────
    public function subscriptions(Request $request)
    {
        $query = Subscription::with(['user', 'plan']);
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $subscriptions = $query->latest()->paginate(20)->withQueryString();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function verifySubscription(Request $request, int $id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update([
            'status'      => 'active',
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
            'starts_at'   => now(),
            'expires_at'  => now()->addDays($sub->plan->duration_days),
            'notes'       => $request->notes,
        ]);
        return back()->with('success', 'Subscription verified and activated!');
    }

    public function rejectSubscription(Request $request, int $id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'cancelled', 'notes' => $request->notes]);
        return back()->with('success', 'Subscription rejected.');
    }

    // ── Events Management ────────────────────────────────────────────
    public function events()
    {
        $events = Event::with('organizer')->latest()->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function approveEvent(int $id)
    {
        Event::findOrFail($id)->update(['is_approved' => true]);
        return back()->with('success', 'Event approved.');
    }

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
            'is_approved'       => 1, // Auto-approved for Admin
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event published successfully!');
    }

    // ── Global Applicant Moderation ───────────────────────────────────
    public function applicants(Request $request)
    {
        $query = JobApplication::with(['applicant.seekerProfile', 'job.employer.employerProfile']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('applicant', function($aq) use ($q) {
                $aq->where('name', 'like', "%$q%")->orWhere('email', 'like', "%$q%");
            });
        }

        $applications = $query->latest()->paginate(20)->withQueryString();

        return view('admin.applicants.index', compact('applications'));
    }

    public function updateApplicantStatus(Request $request, int $id)
    {
        $request->validate(['status' => 'required|in:applied,reviewed,shortlisted,interviewed,rejected,hired']);
        
        $app = JobApplication::with(['applicant', 'job'])->findOrFail($id);
        $app->update(['status' => $request->status]);

        // Notify the applicant
        $app->applicant->notify(new ApplicationStatusNotification($app, $request->status));

        return back()->with('success', 'Applicant status updated and notification sent.');
    }

    // ── Internship Posting ────────────────────────────────────────────
    public function createInternship()
    {
        $categories = JobCategory::orderBy('name')->get();
        return view('admin.internships.create', compact('categories'));
    }

    public function storeInternship(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:job_categories,id',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|min:0',
            'vacancies'   => 'nullable|integer|min:1',
            'deadline'    => 'nullable|date|after_or_equal:today',
            'is_featured' => 'nullable|boolean',
        ]);

        $job = JobListing::create([
            'employer_id'          => auth()->id(),
            'category_id'          => $request->category_id,
            'title'                => $request->title,
            'description'          => $request->description,
            'location'             => $request->location,
            'type'                 => 'internship', // Force internship type
            'salary_min'           => $request->salary_min,
            'salary_max'           => $request->salary_max,
            'vacancies'            => $request->vacancies ?? 1,
            'deadline'             => $request->deadline,
            'is_featured'          => $request->has('is_featured'),
            'status'               => 'approved', // Auto-approved for admin
            'skills'               => $request->skills ? array_map('trim', explode(',', $request->skills)) : [],
            'requirements'         => $request->requirements ? explode("\n", str_replace("\r", "", $request->requirements)) : [],
            'benefits'             => $request->benefits ? explode("\n", str_replace("\r", "", $request->benefits)) : [],
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Internship posted successfully!');
    }
}
