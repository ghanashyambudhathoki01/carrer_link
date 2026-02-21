<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Models\JobListing;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{


    public function index()
    {
        $savedJobs = SavedJob::with(['job.employer.employerProfile', 'job.category'])
            ->where('user_id', auth()->id())
            ->latest()->paginate(12);

        return view('seeker.saved-jobs', compact('savedJobs'));
    }

    public function toggle(int $jobId)
    {
        $job = JobListing::findOrFail($jobId);
        $existing = SavedJob::where('user_id', auth()->id())->where('job_id', $jobId)->first();

        if ($existing) {
            $existing->delete();
            $message = 'Job removed from saved list.';
        } else {
            SavedJob::create(['user_id' => auth()->id(), 'job_id' => $jobId]);
            $message = 'Job saved successfully!';
        }

        return back()->with('success', $message);
    }
}
