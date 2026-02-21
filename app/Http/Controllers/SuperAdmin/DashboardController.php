<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Subscription;
use App\Models\JobCategory;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'       => User::count(),
            'total_admins'      => User::where('role', 'admin')->count(),
            'total_jobs'        => JobListing::count(),
            'total_revenue'     => Subscription::where('status', 'active')->with('plan')->get()->sum(fn($s) => $s->plan->price),
            'pending_payments'  => Subscription::where('status', 'pending')->count(),
            'system_health'     => 'Healthy',
            'last_backup'       => 'Today, 10:00 AM',
        ];

        $recentAdmins = User::where('role', 'admin')->latest()->take(5)->get();
        $recentUsers  = User::latest()->take(10)->get();
        $pendingPayments = Subscription::where('status', 'pending')->with(['user', 'plan'])->latest()->take(5)->get();

        return view('admin.super-dashboard', compact('stats', 'recentAdmins', 'recentUsers', 'pendingPayments'));
    }

    public function subscriptions(Request $request)
    {
        $query = Subscription::with(['user', 'plan']);
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $subscriptions = $query->latest()->paginate(20)->withQueryString();
        return view('admin.super-subscriptions', compact('subscriptions'));
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
        return back()->with('success', 'Subscription verified and activated successfully!');
    }

    public function rejectSubscription(Request $request, int $id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'cancelled', 'notes' => $request->notes]);
        return back()->with('success', 'Subscription rejected.');
    }

    public function admins()
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->latest()->paginate(20);
        return view('admin.super-admins', compact('admins'));
    }

    public function createAdmin()
    {
        return view('admin.super-admins-create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,super_admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'     => $request->role,
            'status'   => 'active',
        ]);

        return redirect()->route('super-admin.admins.index')->with('success', 'New staff member registered successfully.');
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
            'status'               => 'approved', // Auto-approved for super admin
            'skills'               => $request->skills ? array_map('trim', explode(',', $request->skills)) : [],
            'requirements'         => $request->requirements ? explode("\n", str_replace("\r", "", $request->requirements)) : [],
            'benefits'             => $request->benefits ? explode("\n", str_replace("\r", "", $request->benefits)) : [],
        ]);

        return redirect()->route('super-admin.dashboard')->with('success', 'Internship posted successfully!');
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
            'is_approved'       => 1, // Auto-approved for Super Admin
        ]);

        return redirect()->route('super-admin.dashboard')->with('success', 'Event published successfully!');
    }
}
