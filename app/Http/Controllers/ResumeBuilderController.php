<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class ResumeBuilderController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['seekerProfile', 'workExperiences', 'educations', 'certifications', 'languages', 'socialLinks']);
        return view('seeker.resume.builder', compact('user'));
    }

    public function storeExperience(Request $request)
    {
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
        ]);

        auth()->user()->workExperiences()->create($data);

        return back()->with('success', 'Experience added successfully.');
    }

    public function deleteExperience(WorkExperience $experience)
    {
        if ($experience->user_id !== auth()->id()) {
            abort(403);
        }
        $experience->delete();
        return back()->with('success', 'Experience deleted.');
    }

    public function storeEducation(Request $request)
    {
        $data = $request->validate([
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
        ]);

        auth()->user()->educations()->create($data);

        return back()->with('success', 'Education added successfully.');
    }

    public function deleteEducation(Education $education)
    {
        if ($education->user_id !== auth()->id()) {
            abort(403);
        }
        $education->delete();
        return back()->with('success', 'Education deleted.');
    }

    public function storeCertification(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
        ]);

        auth()->user()->certifications()->create($data);
        return back()->with('success', 'Certification added.');
    }

    public function deleteCertification(\App\Models\Certification $certification)
    {
        if ($certification->user_id !== auth()->id()) {
            abort(403);
        }
        $certification->delete();
        return back()->with('success', 'Certification deleted.');
    }

    public function storeLanguage(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'required|string|in:Native,Fluent,Intermediate,Basic',
        ]);

        auth()->user()->languages()->create($data);
        return back()->with('success', 'Language added.');
    }

    public function deleteLanguage(\App\Models\Language $language)
    {
        if ($language->user_id !== auth()->id()) {
            abort(403);
        }
        $language->delete();
        return back()->with('success', 'Language deleted.');
    }

    public function storeSocial(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        auth()->user()->socialLinks()->create($data);
        return back()->with('success', 'Social link added.');
    }

    public function deleteSocial(\App\Models\SocialLink $social)
    {
        if ($social->user_id !== auth()->id()) {
            abort(403);
        }
        $social->delete();
        return back()->with('success', 'Social link deleted.');
    }

    public function preview()
    {
        $user = auth()->user()->load(['seekerProfile', 'workExperiences', 'educations', 'certifications', 'languages', 'socialLinks']);
        return view('seeker.resume.templates.modern', compact('user'));
    }
}
