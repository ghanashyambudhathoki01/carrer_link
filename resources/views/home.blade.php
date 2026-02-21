@extends('layouts.app')
@section('title', 'Network & Hire – Nepal\'s Modern Job Portal')

@section('content')

<div class="relative overflow-hidden bg-white dark:bg-gray-950 transition-colors duration-500">
    {{-- Background Auras --}}
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400/20 dark:bg-blue-600/10 rounded-full blur-[120px] animate-aura"></div>
        <div class="absolute top-1/2 -right-24 w-80 h-80 bg-emerald-400/20 dark:bg-emerald-600/10 rounded-full blur-[100px] animate-aura-slow"></div>
        <div class="absolute -bottom-24 left-1/4 w-72 h-72 bg-purple-400/10 dark:bg-purple-600/5 rounded-full blur-[100px] animate-aura"></div>
    </div>

    <div class="relative z-10">
        {{-- Hero Section --}}
        <section class="pt-24 pb-20 px-4">
            <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 mb-6 animate-fade-in">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-xs font-bold text-blue-700 dark:text-blue-400 uppercase tracking-wider">Nepal's #1 Career Network</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-[1.1] tracking-tight text-gray-900 dark:text-white">
                    Unlock Your <br>
                    <span class="text-gradient">Professional Future</span>
                </h1>
                
                <p class="text-gray-600 dark:text-gray-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                    Connect with over <span class="text-gray-900 dark:text-white font-semibold">5,000+</span> top-tier companies in Nepal and take the next step in your career journey today.
                </p>

                {{-- Search Bar - Glassmorphism --}}
                <div class="w-full max-w-3xl mx-auto p-1.5 glass dark:glass-dark rounded-[2rem] shadow-2xl shadow-blue-500/10 transition-all duration-300 hover:shadow-blue-500/20 backdrop-blur-3xl">
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row items-stretch gap-1">
                        <div class="flex-1 flex items-center px-4 py-3 min-w-0">
                            <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" name="q" placeholder="Job title, skills, or company..." class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-200 placeholder-gray-400 text-base" value="{{ request('q') }}">
                        </div>
                        <div class="hidden md:block w-px h-8 bg-gray-200 dark:bg-gray-700 self-center"></div>
                        <div class="flex-1 flex items-center px-4 py-3 min-w-0">
                            <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <input type="text" name="location" placeholder="Location (e.g. Kathmandu)" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-200 placeholder-gray-400 text-base" value="{{ request('location') }}">
                        </div>
                        <button type="submit" class="md:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-[1.75rem] transition-all duration-300 shadow-lg shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] whitespace-nowrap">
                            Search Opportunities
                        </button>
                    </form>
                </div>

                <div class="flex flex-wrap justify-center gap-3 mt-8 text-sm animate-fade-in-up">
                    <span class="text-gray-400">Popular Searches:</span>
                    @foreach(['Full Stack', 'Designer', 'Marketing', 'Java'] as $keyword)
                        <a href="{{ route('jobs.index', ['q' => $keyword]) }}" class="px-4 py-1.5 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-blue-400 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300">{{ $keyword }}</a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Stats Section --}}
        <section class="py-12 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach([
                        ['label' => 'Active Jobs', 'value' => $stats['total_jobs'], 'color' => 'blue', 'icon' => '💼'],
                        ['label' => 'Companies', 'value' => $stats['total_companies'], 'color' => 'emerald', 'icon' => '🏢'],
                        ['label' => 'Talents', 'value' => $stats['total_seekers'], 'color' => 'purple', 'icon' => '🚀'],
                        ['label' => 'Succeed', 'value' => $stats['jobs_filled'], 'color' => 'orange', 'icon' => '✨']
                    ] as $stat)
                        <div class="glass dark:glass-dark rounded-3xl p-6 transition-all duration-500 hover:-translate-y-1 group">
                            <div class="text-3xl mb-3 group-hover:scale-110 transition-transform duration-300">{{ $stat['icon'] }}</div>
                            <div class="text-3xl font-black text-gray-900 dark:text-white mb-1">{{ number_format($stat['value']) }}+</div>
                            <div class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Featured Jobs Section --}}
        @if($featuredJobs->count())
        <section class="py-20 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white mb-3 tracking-tight">⭐ Premium Listings</h2>
                        <p class="text-gray-500 dark:text-gray-400">Exclusively picked opportunities from top-tier employers.</p>
                    </div>
                    <a href="{{ route('jobs.index') }}" class="group inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold hover:gap-3 transition-all duration-300">
                        Explore All <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredJobs as $job)
                        <div class="transition-all duration-500 hover:-translate-y-2">
                            @include('partials.job-card', ['job' => $job])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Browse by Category --}}
        <section class="py-24 px-4 bg-gray-50/50 dark:bg-gray-900/30 backdrop-blur-sm transition-colors duration-500">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-4 tracking-tight">Explore by Domain</h2>
                    <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">Diverse career paths waiting for your expertise.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($categories as $cat)
                        <a href="{{ route('jobs.index', ['category' => $cat->id]) }}"
                           class="glass dark:glass-dark rounded-3xl p-8 text-center transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-2 group">
                            <div class="text-4xl mb-4 group-hover:scale-125 transition-transform duration-500">{{ $cat->icon }}</div>
                            <div class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $cat->name }}</div>
                            <div class="text-xs font-bold text-gray-400 dark:text-gray-500 mt-2 uppercase tracking-tighter">{{ $cat->job_listings_count }} Open Roles</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Latest Jobs --}}
        <section class="py-20 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white mb-3 tracking-tight">🆕 Fresh Opportunities</h2>
                        <p class="text-gray-500 dark:text-gray-400">Recently updated roles based on your interests.</p>
                    </div>
                    <form action="{{ route('jobs.index') }}" method="GET" class="relative group">
                        <input type="text" name="q" placeholder="Quick search..." class="pl-10 pr-4 py-2.5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </form>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($recentJobs as $job)
                        <div class="transition-all duration-500 hover:-translate-x-1">
                            @include('partials.job-card', ['job' => $job])
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-16">
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-950 font-black rounded-2xl hover:scale-105 active:scale-95 transition-all duration-300 shadow-xl shadow-gray-200 dark:shadow-none">
                        View All Listings
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Upcoming Events (Eventify) --}}
        @if($upcomingEvents->count())
        <section class="py-24 px-4 relative overflow-hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-purple-500/5 rounded-full blur-[150px] pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-8">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-4 tracking-tight">🎟️ Connect & Learn</h2>
                        <p class="text-gray-500 dark:text-gray-400">Networking workshops, job fairs, and webinars.</p>
                    </div>
                    <a href="{{ route('events.index') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg shadow-purple-500/25">
                        Explore Eventify →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($upcomingEvents as $event)
                        <div class="glass dark:glass-dark rounded-3xl p-6 transition-all duration-500 hover:-translate-y-2 group overflow-hidden relative">
                            <div class="flex gap-5">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex flex-col items-center justify-center text-white flex-shrink-0 shadow-lg shadow-purple-500/30">
                                    <span class="text-[11px] leading-none uppercase font-black tracking-tighter opacity-80">{{ $event->event_date->format('M') }}</span>
                                    <span class="text-2xl leading-none font-black">{{ $event->event_date->format('d') }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-[11px] font-black text-purple-600 dark:text-purple-400 uppercase tracking-[0.2em]">{{ $event->type }}</span>
                                    <h3 class="text-xl font-black text-gray-900 dark:text-white truncate mb-2 mt-1">{{ $event->title }}</h3>
                                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400 text-xs font-bold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $event->location }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                <span class="text-sm font-black text-gray-900 dark:text-white">
                                    @if($event->fee > 0) Rs. {{ number_format($event->fee) }} @else <span class="text-emerald-600 dark:text-emerald-500 uppercase tracking-wider">Free Entry</span> @endif
                                </span>
                                <a href="{{ route('events.show', $event->id) }}" class="text-sm font-black text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300">RSVP Now →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Final CTA --}}
        <section class="py-24 px-4 bg-gray-900 dark:bg-white text-white dark:text-gray-950 transition-colors duration-500 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-[100px]"></div>
            
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="text-4xl md:text-6xl font-black mb-6 tracking-tight leading-[1.1]">Ready to Scale Your <br> Hiring Process?</h2>
                <p class="text-gray-400 dark:text-gray-600 text-lg md:text-xl mb-12 max-w-2xl mx-auto">Post your roles where Nepal's top talents are actively looking. Elegant, intuitive, and effective recruitment.</p>
                <div class="flex flex-col sm:flex-row gap-5 justify-center mt-8">
                    <a href="{{ route('subscriptions.index') }}" class="px-10 py-4 bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-black rounded-2xl hover:scale-105 active:scale-95 transition-all duration-300 shadow-2xl">
                        View Premium Plans
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="px-10 py-4 bg-transparent text-white dark:text-gray-950 font-black rounded-2xl hover:bg-white/10 dark:hover:bg-gray-100 transition-all duration-300 border-2 border-white/20 dark:border-gray-300 backdrop-blur-md">
                            Get Started Free
                        </a>
                    @endguest
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

