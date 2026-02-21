@extends('layouts.app')
@section('title', 'Seeker Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('seeker.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">Welcome back, {{ auth()->user()->name }}! 👋</h1>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $totalApplications }}</p>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Total Applied</p>
                </div>
                
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $shortlisted }}</p>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Shortlisted</p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $savedJobs }}</p>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Saved Jobs</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Recent Applications --}}
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                        <h2 class="font-bold text-gray-800">Recent Applications</h2>
                        <a href="{{ route('seeker.applications.index') }}" class="text-xs text-blue-600 font-bold hover:underline">View All</a>
                    </div>
                    <div class="p-6">
                        @forelse($recentApplications as $app)
                            <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0 border-b last:border-0 border-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-xl">
                                        @if($app->job->employer?->employerProfile?->logo)
                                            <img src="{{ asset('storage/' . $app->job->employer->employerProfile->logo) }}" class="w-full h-full object-cover rounded-xl">
                                        @else
                                            🏢
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 truncate max-w-[150px]">{{ $app->job->title }}</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $app->job->employer?->employerProfile?->company_name }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $app->statusColor() }}">{{ $app->statusLabel() }}</span>
                            </div>
                        @empty
                            <p class="text-center py-10 text-gray-400 text-sm italic">No applications found.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Profile Completion / Career Tips --}}
                <div class="space-y-6">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-2">Enhance your profile</h3>
                            <p class="text-blue-100 text-sm mb-6 leading-relaxed">Profiles with a professional summary and resume are 5x more likely to get noticed by recruiters.</p>
                            <a href="{{ route('seeker.profile') }}" class="inline-block px-6 py-2.5 bg-white text-blue-600 text-sm font-bold rounded-xl hover:bg-gray-100 transition-colors shadow-lg">Complete Profile</a>
                        </div>
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute right-12 top-0 w-16 h-16 bg-white/5 rounded-full"></div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Recommended for you</h3>
                        <p class="text-xs text-gray-400 leading-relaxed italic">"We are matching your profile with active jobs. Keep your skills updated to see relevant listings here."</p>
                        <a href="{{ route('jobs.index') }}" class="inline-block mt-4 text-xs font-bold text-blue-600 hover:underline">Browse newest jobs →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
