@extends('layouts.app')
@section('title', 'Pricing & Subscriptions')

@section('content')
<div class="bg-gray-50 py-20 px-4">
    <div class="max-w-7xl mx-auto text-center mb-16">
        @if(session('warning'))
            <div class="mb-8 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-2xl flex items-center justify-center gap-3">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <p class="text-sm font-bold">{{ session('warning') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl flex items-center justify-center gap-3">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-4">Choose the Right Plan for You</h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto italic">"Level up your hiring or job search with Career Link Premium."</p>

        {{-- Subscription Status Alerts --}}
        @if(isset($latestAttempt))
            <div class="mt-12 max-w-4xl mx-auto">
                @if($latestAttempt->status === 'pending')
                    <div class="p-6 bg-purple-50 border border-purple-100 rounded-3xl flex items-center justify-between gap-6 shadow-sm shadow-purple-50">
                        <div class="flex items-center gap-4 text-left">
                            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-purple-900 uppercase tracking-tight">Payment Verification Pending</h4>
                                <p class="text-xs text-purple-600 font-medium">Your request for **{{ $latestAttempt->plan->name }}** is currently being reviewed by our Super Admin.</p>
                            </div>
                        </div>
                        <span class="px-4 py-1.5 bg-purple-600 text-white text-[10px] font-bold rounded-xl uppercase tracking-widest animate-pulse">Awaiting Approval</span>
                    </div>
                @elseif($latestAttempt->status === 'cancelled')
                    <div class="p-6 bg-red-50 border border-red-100 rounded-3xl flex items-center justify-between gap-6 shadow-sm shadow-red-50">
                        <div class="flex items-center gap-4 text-left">
                            <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-red-900 uppercase tracking-tight">Payment Declined</h4>
                                <p class="text-xs text-red-600 font-medium">Reason: <span class="italic">"{{ $latestAttempt->notes ?? 'No reason provided.' }}"</span></p>
                            </div>
                        </div>
                        <a href="{{ route('subscriptions.checkout', $latestAttempt->plan_id) }}" class="px-4 py-1.5 bg-red-600 text-white text-[10px] font-bold rounded-xl uppercase tracking-widest hover:bg-red-700 transition-colors">Try Again</a>
                    </div>
                @endif
            </div>
        @endif

        {{-- Active Subscription Success Alert (Shown if recently approved) --}}
        @if($currentSub && $currentSub->verified_at && $currentSub->verified_at->gt(now()->subDays(3)))
            <div class="mt-12 max-w-4xl mx-auto">
                <div class="p-6 bg-emerald-50 border border-emerald-100 rounded-3xl flex items-center justify-between gap-6 shadow-sm shadow-emerald-50">
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-black text-emerald-900 uppercase tracking-tight">Subscription Activated!</h4>
                            <p class="text-xs text-emerald-600 font-medium">Your **{{ $currentSub->plan->name }}** plan is now active. Enjoy your premium features!</p>
                        </div>
                    </div>
                    <span class="px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-bold rounded-xl uppercase tracking-widest">Verified Success</span>
                </div>
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($plans as $plan)
            <div class="bg-white rounded-3xl border {{ $plan->slug === 'basic' ? 'border-blue-500 ring-4 ring-blue-50' : 'border-gray-200' }} p-8 shadow-sm flex flex-col relative overflow-hidden">
                @if($plan->slug === 'basic')
                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] font-bold px-4 py-1.5 rounded-bl-2xl uppercase tracking-widest">Most Popular</div>
                @endif

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $plan->name }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $plan->description }}</p>
                </div>

                <div class="mb-8">
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl font-black text-gray-900">
                            @if($plan->isFree())
                                Free
                            @else
                                Rs. {{ number_format($plan->price) }}
                            @endif
                        </span>
                        @if(!$plan->isFree())
                            <span class="text-gray-400 text-sm">/ {{ $plan->duration_days }} days</span>
                        @endif
                    </div>
                </div>

                <ul class="space-y-4 mb-10 flex-1">
                    @foreach($plan->features as $feature)
                        <li class="flex items-start gap-3 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>

                @auth
                    @if($currentSub && $currentSub->plan_id == $plan->id)
                        <button disabled class="w-full py-4 bg-gray-100 text-gray-400 font-bold rounded-2xl cursor-not-allowed">Current Plan</button>
                    @else
                        <a href="{{ route('subscriptions.checkout', $plan->id) }}" 
                           class="w-full py-4 {{ $plan->slug === 'basic' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-900 text-white hover:bg-gray-800' }} text-center font-bold rounded-2xl transition-all shadow-lg">
                            Get Started
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="w-full py-4 bg-gray-900 text-white text-center font-bold rounded-2xl hover:bg-gray-800 transition-all shadow-lg">Login to Subscribe</a>
                @endauth
            </div>
        @endforeach
    </div>

    {{-- Manual Payment Note --}}
    <div class="max-w-3xl mx-auto mt-20 text-center text-gray-400">
        <p class="text-sm">We currently support manual QR payment verification via Kumari Bank. After payment, please upload your transaction screenshot for activation.</p>
    </div>
</div>
@endsection
