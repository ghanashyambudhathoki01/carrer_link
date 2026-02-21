@extends('layouts.app')
@section('title', $job->title)

@section('content')
<div class="bg-blue-600 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-16 h-16 bg-white rounded-xl shadow-sm overflow-hidden flex-shrink-0 flex items-center justify-center text-3xl">
                    @if($job->employer?->employerProfile?->logo)
                        <img src="{{ asset('storage/' . $job->employer->employerProfile->logo) }}" alt="{{ $job->employer->employerProfile->company_name }}" class="w-full h-full object-cover">
                    @else
                        🏢
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $job->typeLabel() }}</span>
                        <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full">{{ $job->category->name }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-1">{{ $job->title }}</h1>
                    <p class="text-blue-100 flex items-center gap-2">
                        <span class="font-medium">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</span>
                        <span>•</span>
                        <span>{{ $job->location }}</span>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->isJobSeeker())
                        <form action="{{ route('seeker.saved-jobs.toggle', $job->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-3 rounded-xl border border-blue-400 text-white hover:bg-blue-500 transition-colors">
                                @if($hasSaved)
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                @endif
                            </button>
                        </form>
                        
                        @if(!$hasApplied)
                            <button onclick="document.getElementById('apply-modal').classList.remove('hidden')" class="px-8 py-3 bg-white text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition-colors shadow-lg">
                                Apply Now
                            </button>
                        @else
                            <button class="px-8 py-3 bg-emerald-500 text-white font-bold rounded-xl cursor-default flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Applied
                            </button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-white text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition-colors shadow-lg">
                        Login to Apply
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="flex-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Job Description</h2>
                <div class="prose prose-blue max-w-none text-gray-600 space-y-4">
                    {!! nl2br(e($job->description)) !!}
                </div>

                @if($job->requirements)
                    <h2 class="text-xl font-bold text-gray-800 mt-10 mb-4">Requirements</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        @foreach($job->requirements as $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </ul>
                @endif

                @if($job->responsibilities)
                    <h2 class="text-xl font-bold text-gray-800 mt-10 mb-4">Responsibilities</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        @foreach($job->responsibilities as $res)
                            <li>{{ $res }}</li>
                        @endforeach
                    </ul>
                @endif

                @if($job->benefits)
                    <h2 class="text-xl font-bold text-gray-800 mt-10 mb-4">Benefits</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($job->benefits as $benefit)
                            <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg text-sm font-medium">✓ {{ $benefit }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Related Jobs --}}
            @if($relatedJobs->count())
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Jobs</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($relatedJobs as $rJob)
                            @include('partials.job-card', ['job' => $rJob])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-800 mb-4">Job Overview</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Date Posted</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $job->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Salary</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $job->salaryRange() }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Location</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $job->location }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Experience</p>
                            <p class="text-sm font-semibold text-gray-700">{{ ucfirst($job->experience_level) }} ({{ $job->experience_years_min }}+ yrs)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Deadline</p>
                            <p class="text-sm font-semibold {{ $job->isExpired() ? 'text-red-500' : 'text-gray-700' }}">
                                {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open until filled' }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-6 border-gray-100">

                <h3 class="font-bold text-gray-800 mb-4">Required Skills</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($job->skills as $skill)
                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Apply Modal --}}
@auth
    @if(auth()->user()->isJobSeeker())
    <div id="apply-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="document.getElementById('apply-modal').classList.add('hidden')"></div>
        <div class="bg-white rounded-3xl p-8 max-w-lg w-full relative z-10 shadow-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Apply for this position</h2>
            <p class="text-gray-500 mb-6 text-sm">Review your details before submitting your application to <strong>{{ $job->employer?->employerProfile?->company_name }}</strong>.</p>
            
            <form action="{{ route('seeker.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cover Letter (Optional)</label>
                    <textarea name="cover_letter" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Write a brief cover letter..."></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Resume / CV</label>
                    @if(auth()->user()->seekerProfile?->resume_path)
                        <div class="flex items-center gap-3 bg-blue-50 border border-blue-100 p-3 rounded-xl mb-3">
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-blue-700 font-bold truncate">Default Resume</p>
                                <p class="text-[10px] text-blue-500">Will be used if no new file is uploaded</p>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="resume" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-[10px] text-gray-400 mt-2">Max 5MB. PDF, DOC, DOCX allowed.</p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('apply-modal').classList.add('hidden')" class="flex-1 px-6 py-3 border border-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 shadow-lg">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endauth

@endsection
