<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{


    // ── Apply for a job ────────────────────────────────────────────────
    public function store(Request $request, int $jobId)
    {
        $job = JobListing::active()->findOrFail($jobId);

        if (auth()->user()->hasApplied($jobId)) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:3000',
            'resume'       => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes/' . auth()->id(), 'public');
        } else {
            // Use the seeker's profile resume
            $resumePath = auth()->user()->seekerProfile?->resume_path;
        }

        JobApplication::create([
            'job_id'       => $jobId,
            'user_id'      => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'resume_path'  => $resumePath,
            'status'       => 'applied',
        ]);

        return redirect()->route('seeker.applications.index')->with('success', 'Application submitted successfully!');
    }

    // ── Seeker: My applications ────────────────────────────────────────
    public function index()
    {
        $applications = JobApplication::with(['job.employer.employerProfile', 'job.category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('seeker.applications', compact('applications'));
    }

    // ── Seeker: Withdraw application ───────────────────────────────────
    public function destroy(int $id)
    {
        $application = JobApplication::where('user_id', auth()->id())->findOrFail($id);

        if (!in_array($application->status, ['applied', 'reviewed'])) {
            return back()->with('error', 'You cannot withdraw this application at this stage.');
        }

        $application->delete();
        return back()->with('success', 'Application withdrawn successfully.');
    }
}
