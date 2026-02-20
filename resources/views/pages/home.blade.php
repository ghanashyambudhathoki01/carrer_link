@extends('layouts.app')
@section('title', 'JobPortal — Your Career Starts Here')

@section('content')
{{-- ========== HERO SECTION ========== --}}
<section class="gradient-hero relative overflow-hidden min-h-[90vh] flex items-center">
    {{-- Background Orbs --}}
    <div class="orb w-96 h-96 bg-primary top-[-10%] left-[-5%]"></div>
    <div class="orb w-72 h-72 bg-secondary top-[50%] right-[-5%]"></div>
    <div class="orb w-64 h-64 bg-accent bottom-[10%] left-[30%] opacity-20"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div class="animate-fade-in-up">
                <div class="badge bg-primary/10 text-primary-light border border-primary/20 mb-6">
                    🚀 #1 Job Platform in Nepal
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Find Your <span class="gradient-text">Dream Career</span> Today
                </h1>
                <p class="text-slate-400 text-lg leading-relaxed mb-8 max-w-lg">
                    Connect with top employers, discover exciting internships, and attend career events that shape your future.
                </p>

                {{-- Search Bar --}}
                <div class="search-container flex flex-col sm:flex-row gap-2 max-w-xl mb-8">
                    <div class="flex-1 flex items-center gap-2 px-4">
                        <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search jobs, companies, skills..." class="w-full py-3 bg-transparent text-white placeholder-slate-500 outline-none text-sm">
                    </div>
                    <button class="btn-primary !rounded-xl whitespace-nowrap">
                        Search Jobs
                    </button>
                </div>

                {{-- Popular Tags --}}
                <div class="flex flex-wrap gap-2">
                    <span class="text-slate-500 text-sm pt-1">Popular:</span>
                    <a href="#" class="tag">Frontend Dev</a>
                    <a href="#" class="tag">UI/UX Design</a>
                    <a href="#" class="tag">Data Science</a>
                    <a href="#" class="tag">Marketing</a>
                </div>
            </div>

            {{-- Right - Stats Cards --}}
            <div class="hidden lg:grid grid-cols-2 gap-4 animate-fade-in-up delay-200">
                <div class="glass-card p-6 animate-float">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="stat-number text-2xl">10+</div>
                    <p class="text-slate-400 text-sm mt-1">Active Jobs</p>
                </div>

                <div class="glass-card p-6 animate-float delay-100" style="animation-delay: 0.5s;">
                    <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="stat-number text-2xl">5+</div>
                    <p class="text-slate-400 text-sm mt-1">Companies</p>
                </div>

                <div class="glass-card p-6 animate-float delay-200" style="animation-delay: 1s;">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="stat-number text-2xl">50+</div>
                    <p class="text-slate-400 text-sm mt-1">Job Seekers</p>
                </div>

                <div class="glass-card p-6 animate-float delay-300" style="animation-delay: 1.5s;">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="stat-number text-2xl">100%</div>
                    <p class="text-slate-400 text-sm mt-1">Success Rate</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== FEATURED CATEGORIES ========== --}}
<section class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Explore by <span class="gradient-text">Category</span></h2>
            <p class="text-slate-400 max-w-2xl mx-auto">Browse through popular categories and find the role that fits your skills and passion.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @php
                $categories = [
                    ['name' => 'Technology', 'count' => '2,540', 'icon' => '💻', 'color' => 'bg-primary/10 text-primary-light'],
                    ['name' => 'Design', 'count' => '1,230', 'icon' => '🎨', 'color' => 'bg-pink-500/10 text-pink-400'],
                    ['name' => 'Marketing', 'count' => '980', 'icon' => '📈', 'color' => 'bg-green-500/10 text-green-400'],
                    ['name' => 'Finance', 'count' => '750', 'icon' => '💰', 'color' => 'bg-accent/10 text-accent'],
                    ['name' => 'Healthcare', 'count' => '620', 'icon' => '🏥', 'color' => 'bg-red-500/10 text-red-400'],
                    ['name' => 'Education', 'count' => '540', 'icon' => '📚', 'color' => 'bg-secondary/10 text-secondary'],
                    ['name' => 'Engineering', 'count' => '890', 'icon' => '⚙️', 'color' => 'bg-slate-500/10 text-slate-300'],
                    ['name' => 'Sales', 'count' => '1,100', 'icon' => '🤝', 'color' => 'bg-violet-500/10 text-violet-400'],
                ];
            @endphp

            @foreach($categories as $cat)
            <div class="glass-card p-5 cursor-pointer group">
                <div class="text-3xl mb-3">{{ $cat['icon'] }}</div>
                <h3 class="text-white font-semibold mb-1">{{ $cat['name'] }}</h3>
                <p class="text-slate-500 text-sm">{{ $cat['count'] }} jobs</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== HOW IT WORKS ========== --}}
<section class="py-20 relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">How It <span class="gradient-text">Works</span></h2>
            <p class="text-slate-400 max-w-xl mx-auto">Get started in three simple steps and land your perfect role.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $steps = [
                    ['step' => '01', 'title' => 'Create Profile', 'desc' => 'Sign up and build a professional profile that stands out to top employers.', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ['step' => '02', 'title' => 'Discover Jobs', 'desc' => 'Browse curated job listings, internships, and events tailored just for you.', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                    ['step' => '03', 'title' => 'Get Hired', 'desc' => 'Apply with a single click and track your applications in real time.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($steps as $stepItem)
            <div class="text-center group">
                <div class="w-16 h-16 rounded-2xl gradient-primary mx-auto mb-5 flex items-center justify-center group-hover:animate-pulse-glow transition-all">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stepItem['icon'] }}" />
                    </svg>
                </div>
                <span class="text-primary-light font-bold text-sm uppercase tracking-widest">Step {{ $stepItem['step'] }}</span>
                <h3 class="text-white text-xl font-semibold mt-2 mb-3">{{ $stepItem['title'] }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed max-w-xs mx-auto">{{ $stepItem['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== CTA SECTION ========== --}}
<section class="py-20 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="gradient-primary rounded-3xl p-10 sm:p-14 text-center relative overflow-hidden">
            <div class="orb w-64 h-64 bg-white/10 top-[-30%] right-[-10%]"></div>
            <div class="orb w-48 h-48 bg-white/5 bottom-[-20%] left-[-5%]"></div>
            <div class="relative z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Start Your Journey?</h2>
                <p class="text-indigo-100 text-lg mb-8 max-w-lg mx-auto">Join thousands of professionals who found their dream careers through JobPortal.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-white text-primary-dark font-semibold py-3 px-8 rounded-xl hover:bg-indigo-50 transition no-underline">Get Started Free</a>
                    <a href="{{ route('jobs') }}" class="border-2 border-white/30 text-white font-semibold py-3 px-8 rounded-xl hover:bg-white/10 transition no-underline">Browse Jobs</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
