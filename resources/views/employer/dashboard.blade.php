@extends('layouts.app')
@section('title', 'Employer Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('employer.partials.sidebar')

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 font-display">Employer Dashboard</h1>
                    <div class="flex items-center gap-3 mt-1">
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Plan: <span class="text-blue-600">{{ auth()->user()->activePlan()?->name ?? 'Free' }}</span></p>
                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                            Usage: <span class="text-emerald-600 font-black">{{ \App\Models\JobListing::where('employer_id', auth()->id())->count() }}</span> / {{ auth()->user()->activePlan()?->max_job_posts ?? 1 }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('employer.jobs.create') }}" class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Post a Job
                </a>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $jobsCount }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Active Jobs</p>
                </div>
                
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $applicantsCount }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Total Applicants</p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ number_format($totalViews) }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Job Views</p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $shortlistedCount }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Shortlisted</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Recent Jobs --}}
                <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-50 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                        <h2 class="font-bold text-gray-800">Your Active Jobs</h2>
                        <a href="{{ route('employer.jobs.index') }}" class="text-xs text-emerald-600 font-bold hover:underline">Manage All</a>
                    </div>
                    <div class="p-6">
                        @forelse($recentJobs as $job)
                            <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0 border-b last:border-0 border-gray-50">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="text-sm font-bold text-gray-800 truncate">{{ $job->title }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] font-bold text-gray-400 uppercase">{{ $job->created_at->format('M d, Y') }}</span>
                                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                        <span class="text-[9px] font-bold text-blue-500 uppercase">{{ $job->applications_count }} Applicants</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('employer.applicants.index', ['id' => $job->id]) }}" class="px-3 py-1 bg-gray-50 text-gray-600 rounded-lg text-xs font-bold hover:bg-emerald-50 hover:text-emerald-600 transition-all">View Applicants</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-gray-400 text-sm italic mb-4">No active jobs found.</p>
                                <a href="{{ route('employer.jobs.create') }}" class="text-xs font-bold text-emerald-600 underline">Post your first job</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Subscription / Tips --}}
                <div class="space-y-6">
                    <div class="bg-gray-900 rounded-3xl p-8 text-white">
                        <h3 class="font-bold mb-2">Hiring Tip</h3>
                        <p class="text-gray-400 text-xs leading-relaxed italic">"Adding salary information increases candidate applications by 40%."</p>
                    </div>

                    @if(!auth()->user()->isPro())
                        <div class="bg-gradient-to-br from-blue-600 to-emerald-600 rounded-3xl p-8 text-white relative overflow-hidden">
                            <h3 class="text-xl font-bold mb-2">Upgrade to Pro</h3>
                            <p class="text-blue-100 text-sm mb-6 leading-relaxed">Featured job listings appear at the top of search results and get 10x more visibility.</p>
                            <a href="{{ route('subscriptions.index') }}" class="inline-block px-6 py-2.5 bg-white text-blue-600 text-sm font-bold rounded-xl hover:bg-gray-100 transition-colors shadow-lg">View Plans</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
