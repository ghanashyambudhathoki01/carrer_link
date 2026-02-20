@extends('layouts.app')
@section('title', 'Subscriptions — JobPortal')

@section('content')
{{-- Header --}}
<section class="gradient-hero relative overflow-hidden py-20">
    <div class="orb w-80 h-80 bg-primary top-[-20%] left-[20%]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <div class="badge bg-primary/10 text-primary-light border border-primary/20 mb-4">⭐ Choose Your Plan</div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Simple <span class="gradient-text">Pricing</span></h1>
            <p class="text-slate-400 text-lg">Pick a plan that fits your needs. Upgrade or cancel anytime.</p>
        </div>
    </div>
</section>

{{-- Pricing Cards --}}
<section class="py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-6">
            {{-- Free --}}
            <div class="pricing-card">
                <h3 class="text-white font-semibold text-lg mb-1">Free</h3>
                <p class="text-slate-500 text-sm mb-6">Get started for free</p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-white">Rs.0</span>
                    <span class="text-slate-500 text-sm">/month</span>
                </div>
                <ul class="space-y-3 mb-8">
                    @foreach(['5 job applications/month', 'Basic profile', 'Job alerts (weekly)', 'Limited search filters'] as $f)
                    <li class="flex items-center gap-2 text-sm text-slate-300">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                    @foreach(['Priority support', 'Resume builder', 'Analytics dashboard'] as $f)
                    <li class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <button class="btn-outline w-full justify-center">Get Started</button>
            </div>

            {{-- Pro (Featured) --}}
            <div class="pricing-card featured">
                <div class="flex items-center justify-between mb-1">
                    <h3 class="text-white font-semibold text-lg">Pro</h3>
                    <span class="badge gradient-primary text-white text-[10px]">Popular</span>
                </div>
                <p class="text-slate-500 text-sm mb-6">For serious job seekers</p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-white">Rs.2120</span>
                    <span class="text-slate-500 text-sm">/month</span>
                </div>
                <ul class="space-y-3 mb-8">
                    @foreach(['Unlimited applications', 'Featured profile badge', 'Job alerts (daily)', 'Advanced search filters', 'Priority support', 'Resume builder'] as $f)
                    <li class="flex items-center gap-2 text-sm text-slate-300">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                    @foreach(['Analytics dashboard'] as $f)
                    <li class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <button class="btn-primary w-full justify-center animate-pulse-glow">Choose Pro</button>
            </div>

            {{-- Enterprise --}}
            <div class="pricing-card">
                <h3 class="text-white font-semibold text-lg mb-1">Enterprise</h3>
                <p class="text-slate-500 text-sm mb-6">For employers & teams</p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-white">Rs.7150</span>
                    <span class="text-slate-500 text-sm">/month</span>
                </div>
                <ul class="space-y-3 mb-8">
                    @foreach(['Everything in Pro', 'Post unlimited jobs', 'Candidate management', 'Advanced search filters', 'Priority support', 'Resume builder', 'Analytics dashboard'] as $f)
                    <li class="flex items-center gap-2 text-sm text-slate-300">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <button class="btn-outline w-full justify-center">Contact Sales</button>
            </div>
        </div>
    </div>
</section>
@endsection
