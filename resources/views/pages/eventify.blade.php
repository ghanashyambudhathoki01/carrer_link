@extends('layouts.app')
@section('title', 'Eventify — Career Events & Meetups')

@section('content')
{{-- Page Header --}}
<section class="gradient-hero relative overflow-hidden py-20">
    <div class="orb w-80 h-80 bg-accent top-[-20%] right-[15%]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <div class="badge bg-accent/10 text-accent border border-accent/20 mb-4">🎉 Career Events & Meetups</div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Discover <span class="gradient-text">Events</span></h1>
            <p class="text-slate-400 text-lg">Attend career fairs, tech meetups, and networking events to level up your career.</p>
        </div>
    </div>
</section>

{{-- Events Grid --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Tabs --}}
        <div class="flex flex-wrap gap-2 mb-10">
            <button class="tag !bg-primary/20 !border-primary/40 !text-primary-light">All Events</button>
            <button class="tag">Career Fairs</button>
            <button class="tag">Tech Meetups</button>
            <button class="tag">Workshops</button>
            <button class="tag">Webinars</button>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $events = [
                    ['title' => 'Nepal Tech Career Fair 2026', 'date' => 'Mar 15, 2026', 'time' => '10:00 AM', 'location' => 'Hyatt Regency, Kathmandu', 'type' => 'Career Fair', 'attendees' => '500+', 'color' => 'from-primary to-secondary', 'free' => true],
                    ['title' => 'React & Next.js Workshop', 'date' => 'Mar 22, 2026', 'time' => '2:00 PM', 'location' => 'Online (Zoom)', 'type' => 'Workshop', 'attendees' => '200+', 'color' => 'from-secondary to-cyan-400', 'free' => false],
                    ['title' => 'Women in Tech Meetup', 'date' => 'Apr 5, 2026', 'time' => '4:00 PM', 'location' => 'Bhatbhateni Plaza, Lalitpur', 'type' => 'Meetup', 'attendees' => '120+', 'color' => 'from-pink-500 to-rose-400', 'free' => true],
                    ['title' => 'AI & Machine Learning Webinar', 'date' => 'Apr 12, 2026', 'time' => '11:00 AM', 'location' => 'Online (YouTube Live)', 'type' => 'Webinar', 'attendees' => '1000+', 'color' => 'from-green-500 to-emerald-400', 'free' => true],
                    ['title' => 'Startup Pitch Night', 'date' => 'Apr 20, 2026', 'time' => '6:00 PM', 'location' => 'Durbarmarg, Kathmandu', 'type' => 'Networking', 'attendees' => '80+', 'color' => 'from-accent to-orange-400', 'free' => false],
                    ['title' => 'UI/UX Design Sprint', 'date' => 'May 2, 2026', 'time' => '9:00 AM', 'location' => 'Remote', 'type' => 'Workshop', 'attendees' => '150+', 'color' => 'from-violet-500 to-purple-400', 'free' => false],
                ];
            @endphp

            @foreach($events as $event)
            <div class="glass-card overflow-hidden group">
                {{-- Color Banner --}}
                <div class="h-2 bg-gradient-to-r {{ $event['color'] }}"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="badge bg-dark-lighter/60 text-slate-300 border border-white/10">{{ $event['type'] }}</span>
                        @if($event['free'])
                        <span class="badge bg-green-500/10 text-green-400">Free</span>
                        @else
                        <span class="badge bg-accent/10 text-accent">Paid</span>
                        @endif
                    </div>
                    <h3 class="text-white font-semibold text-lg mb-3 group-hover:text-primary-light transition">{{ $event['title'] }}</h3>

                    <div class="space-y-2 text-sm text-slate-400 mb-5">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $event['date'] }} · {{ $event['time'] }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $event['location'] }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $event['attendees'] }} Attendees
                        </div>
                    </div>

                    <button class="btn-primary w-full justify-center !py-2.5 text-sm">Register Now</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
