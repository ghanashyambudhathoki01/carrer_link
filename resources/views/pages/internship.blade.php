@extends('layouts.app')
@section('title', 'Internships — JobPortal')

@section('content')
{{-- Page Header --}}
<section class="gradient-hero relative overflow-hidden py-20">
    <div class="orb w-80 h-80 bg-primary top-[-20%] right-[10%]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <div class="badge bg-primary/10 text-primary-light border border-primary/20 mb-4">🎓 Kickstart Your Career</div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Find <span class="gradient-text">Internships</span></h1>
            <p class="text-slate-400 text-lg">Gain real-world experience with top companies. Build skills that matter.</p>
        </div>
    </div>
</section>

{{-- Filters & Listings --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Filter Bar --}}
        <div class="glass-card p-4 mb-10 flex flex-col md:flex-row gap-4">
            <div class="flex-1 flex items-center gap-2 px-3">
                <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search internships..." class="w-full py-2 bg-transparent text-white placeholder-slate-500 outline-none text-sm">
            </div>
            <select class="form-input !py-2 !w-auto min-w-[160px]">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Design</option>
                <option>Marketing</option>
                <option>Finance</option>
            </select>
            <select class="form-input !py-2 !w-auto min-w-[140px]">
                <option>All Types</option>
                <option>Paid</option>
                <option>Unpaid</option>
                <option>Remote</option>
            </select>
            <button class="btn-primary !py-2">Filter</button>
        </div>

        {{-- Internship Cards --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $internships = [
                    ['title' => 'Frontend Development Intern', 'company' => 'TechCorp Nepal', 'location' => 'Kathmandu', 'type' => 'Paid', 'duration' => '3 months', 'tags' => ['React', 'Tailwind'], 'color' => 'bg-primary/10 text-primary-light'],
                    ['title' => 'UI/UX Design Intern', 'company' => 'DesignHub', 'location' => 'Remote', 'type' => 'Paid', 'duration' => '6 months', 'tags' => ['Figma', 'Adobe XD'], 'color' => 'bg-pink-500/10 text-pink-400'],
                    ['title' => 'Data Analyst Intern', 'company' => 'DataFlow Inc.', 'location' => 'Lalitpur', 'type' => 'Paid', 'duration' => '4 months', 'tags' => ['Python', 'SQL'], 'color' => 'bg-green-500/10 text-green-400'],
                    ['title' => 'Content Writing Intern', 'company' => 'MediaHouse', 'location' => 'Bhaktapur', 'type' => 'Unpaid', 'duration' => '2 months', 'tags' => ['SEO', 'Blog'], 'color' => 'bg-accent/10 text-accent'],
                    ['title' => 'Mobile App Development', 'company' => 'AppWorks', 'location' => 'Remote', 'type' => 'Paid', 'duration' => '3 months', 'tags' => ['Flutter', 'Firebase'], 'color' => 'bg-secondary/10 text-secondary'],
                    ['title' => 'Digital Marketing Intern', 'company' => 'GrowthLab', 'location' => 'Kathmandu', 'type' => 'Paid', 'duration' => '3 months', 'tags' => ['Ads', 'Analytics'], 'color' => 'bg-violet-500/10 text-violet-400'],
                ];
            @endphp

            @foreach($internships as $intern)
            <div class="glass-card p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl {{ $intern['color'] }} flex items-center justify-center font-bold text-lg">
                        {{ substr($intern['company'], 0, 1) }}
                    </div>
                    <span class="badge {{ $intern['type'] === 'Paid' ? 'bg-green-500/10 text-green-400' : 'bg-slate-500/10 text-slate-400' }}">{{ $intern['type'] }}</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-1">{{ $intern['title'] }}</h3>
                <p class="text-slate-400 text-sm mb-3">{{ $intern['company'] }}</p>
                <div class="flex items-center gap-4 text-slate-500 text-sm mb-4">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ $intern['location'] }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $intern['duration'] }}
                    </span>
                </div>
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($intern['tags'] as $tag)
                    <span class="tag !text-xs">{{ $tag }}</span>
                    @endforeach
                </div>
                <button class="btn-primary w-full justify-center !py-2.5 text-sm">Apply Now</button>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
