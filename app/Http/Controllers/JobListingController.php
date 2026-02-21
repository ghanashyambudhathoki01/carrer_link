<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    // ── Public: Browse all jobs ────────────────────────────────────────
    public function index(Request $request)
    {
        $query = JobListing::active()->with(['employer.employerProfile', 'category']);

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%$q%")
                        ->orWhere('description', 'like', "%$q%")
                        ->orWhere('location', 'like', "%$q%");
            });
        }

        // Filters
        if ($request->filled('category'))  { $query->where('category_id', $request->category); }
        if ($request->filled('type'))      { $query->where('type', $request->type); }
        if ($request->filled('location'))  { $query->where('location', 'like', "%{$request->location}%"); }
        if ($request->filled('experience')){ $query->where('experience_level', $request->experience); }

        if ($request->filled('salary')) {
            match ($request->salary) {
                'under_30k'  => $query->where('salary_min', '<', 30000),
                '30k_60k'    => $query->whereBetween('salary_min', [30000, 60000]),
                '60k_100k'   => $query->whereBetween('salary_min', [60000, 100000]),
                'above_100k' => $query->where('salary_min', '>', 100000),
                default      => null,
            };
        }

        $jobs       = $query->latest()->paginate(12)->withQueryString();
        $categories = JobCategory::where('is_active', true)->orderBy('name')->get();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    // ── Public: Job detail ─────────────────────────────────────────────
    public function show(int $id)
    {
        $job = JobListing::with(['employer.employerProfile', 'category'])->findOrFail($id);
        $job->increment('views');

        $relatedJobs = JobListing::active()
            ->where('id', '!=', $job->id)
            ->where(fn($q) => $q->where('category_id', $job->category_id)->orWhere('employer_id', $job->employer_id))
            ->with(['employer.employerProfile', 'category'])
            ->take(4)->get();

        $hasSaved   = auth()->check() ? auth()->user()->hasSavedJob($job->id) : false;
        $hasApplied = auth()->check() ? auth()->user()->hasApplied($job->id) : false;

        return view('jobs.show', compact('job', 'relatedJobs', 'hasSaved', 'hasApplied'));
    }

    // ── Public: Internship listing ──────────────────────────────────────
    public function internships(Request $request)
    {
        $jobs = JobListing::active()->where('type', 'internship')->with(['employer.employerProfile', 'category'])->latest()->paginate(12);
        return view('jobs.internships', compact('jobs'));
    }
}
