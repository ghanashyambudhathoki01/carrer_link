@extends('layouts.app')
@section('title', 'Jobs — JobPortal')

@section('content')
{{-- Page Header --}}
<section class="gradient-hero relative overflow-hidden py-20">
    <div class="orb w-80 h-80 bg-secondary top-[-20%] left-[10%]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <div class="badge bg-secondary/10 text-secondary border border-secondary/20 mb-4">💼 10,000+ Active Jobs</div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Browse <span class="gradient-text">Jobs</span></h1>
            <p class="text-slate-400 text-lg">Discover opportunities from top companies across Nepal and beyond.</p>
        </div>
    </div>
</section>

{{-- Job Listings --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search & Filter --}}
        <div class="glass-card p-4 mb-10 flex flex-col md:flex-row gap-4">
            <div class="flex-1 flex items-center gap-2 px-3">
                <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Job title, keyword, or company..." class="w-full py-2 bg-transparent text-white placeholder-slate-500 outline-none text-sm">
            </div>
            <select class="form-input !py-2 !w-auto min-w-[150px]">
                <option>All Locations</option>
                <option>Kathmandu</option>
                <option>Lalitpur</option>
                <option>Pokhara</option>
                <option>Remote</option>
            </select>
            <select class="form-input !py-2 !w-auto min-w-[150px]">
                <option>Job Type</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Contract</option>
                <option>Freelance</option>
            </select>
            <button class="btn-primary !py-2">Search</button>
        </div>

        {{-- Job List --}}
        <div class="space-y-4">
            @php
                $jobs = [
                    ['title' => 'Senior Frontend Developer', 'company' => 'CloudTech Pvt. Ltd.', 'location' => 'Kathmandu', 'type' => 'Full-time', 'salary' => 'Rs. 80K - 120K/mo', 'tags' => ['React', 'TypeScript', 'Node.js'], 'posted' => '2 days ago', 'urgent' => true],
                    ['title' => 'Product Manager', 'company' => 'InnovateLab', 'location' => 'Remote', 'type' => 'Full-time', 'salary' => 'Rs. 100K - 150K/mo', 'tags' => ['Agile', 'Roadmap', 'Analytics'], 'posted' => '1 day ago', 'urgent' => false],
                    ['title' => 'Graphic Designer', 'company' => 'CreativeMinds', 'location' => 'Lalitpur', 'type' => 'Full-time', 'salary' => 'Rs. 45K - 65K/mo', 'tags' => ['Photoshop', 'Illustrator', 'Figma'], 'posted' => '3 days ago', 'urgent' => false],
                    ['title' => 'Backend Developer (Laravel)', 'company' => 'SoftNep Solutions', 'location' => 'Kathmandu', 'type' => 'Full-time', 'salary' => 'Rs. 70K - 100K/mo', 'tags' => ['Laravel', 'PHP', 'MySQL'], 'posted' => '5 hours ago', 'urgent' => true],
                    ['title' => 'DevOps Engineer', 'company' => 'ServerMax', 'location' => 'Remote', 'type' => 'Contract', 'salary' => 'Rs. 90K - 130K/mo', 'tags' => ['AWS', 'Docker', 'CI/CD'], 'posted' => '1 week ago', 'urgent' => false],
                    ['title' => 'Digital Marketing Specialist', 'company' => 'BrandGrowth Nepal', 'location' => 'Pokhara', 'type' => 'Part-time', 'salary' => 'Rs. 30K - 50K/mo', 'tags' => ['SEO', 'Google Ads', 'Social Media'], 'posted' => '4 days ago', 'urgent' => false],
                ];
            @endphp

            @foreach($jobs as $job)
            <div class="glass-card p-6 flex flex-col md:flex-row md:items-center gap-4">
                {{-- Company Icon --}}
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <span class="text-primary-light font-bold text-lg">{{ substr($job['company'], 0, 1) }}</span>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-1">
                        <h3 class="text-white font-semibold text-lg">{{ $job['title'] }}</h3>
                        @if($job['urgent'])
                        <span class="badge bg-red-500/10 text-red-400 border border-red-500/20 !text-[10px]">🔥 Urgent</span>
                        @endif
                    </div>
                    <p class="text-slate-400 text-sm mb-2">{{ $job['company'] }}</p>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-slate-500 text-sm">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $job['location'] }}
                        </span>
                        <span>{{ $job['type'] }}</span>
                        <span>{{ $job['salary'] }}</span>
                        <span>{{ $job['posted'] }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($job['tags'] as $tag)
                        <span class="tag !text-xs">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Action --}}
                <div class="shrink-0 flex items-center gap-3">
                    <button class="btn-outline !py-2 !px-4 text-sm">Save</button>
                    <button class="btn-primary !py-2 !px-5 text-sm">Apply</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
