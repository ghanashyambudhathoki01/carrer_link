@extends('layouts.app')
@section('title', $event->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Left side: Event Detail --}}
        <div class="flex-1">
            <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="aspect-video relative">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-8xl bg-purple-50 text-purple-200">📅</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div>
                            <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1.5 rounded-full mb-3 inline-block">{{ ucfirst($event->type) }}</span>
                            <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">{{ $event->title }}</h1>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 border-b border-gray-100 pb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Date & Time</p>
                                <p class="text-sm font-bold text-gray-800">{{ $event->event_date->format('M d, Y') }} @ {{ $event->event_date->format('g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Location</p>
                                <p class="text-sm font-bold text-gray-800">{{ $event->location }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Registration Fee</p>
                                <p class="text-sm font-bold text-gray-800">{{ $event->fee > 0 ? 'Rs. ' . number_format($event->fee) : 'Free' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-purple max-w-none text-gray-600 mb-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Event</h2>
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    @if($event->registration_link)
                        <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 text-center">
                            <h3 class="font-bold text-gray-800 mb-2">Want to attend?</h3>
                            <p class="text-sm text-gray-500 mb-4">Click below to register for this event on external platform.</p>
                            <a href="{{ $event->registration_link }}" target="_blank" class="inline-block px-8 py-3 bg-purple-600 text-white font-bold rounded-xl hover:bg-purple-700 transition-colors shadow-lg">Register Now</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right side: Organizer Info --}}
        <div class="lg:w-96 flex-shrink-0">
            <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Organizer Information</h3>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center text-2xl">👤</div>
                    <div>
                        <p class="font-bold text-gray-800">{{ $event->organizer_name }}</p>
                        <p class="text-xs text-gray-400">Event Organizer</p>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    @if($event->organizer_email)
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->organizer_email }}
                        </div>
                    @endif
                    @if($event->organizer_phone)
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $event->organizer_phone }}
                        </div>
                    @endif
                </div>

                <button class="w-full py-3 bg-purple-50 text-purple-700 font-bold rounded-xl hover:bg-purple-100 transition-colors">Contact Organizer</button>
            </div>

            <div class="mt-8 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h4 class="text-xl font-bold mb-2">Host your own event?</h4>
                    <p class="text-indigo-100 text-sm mb-6 leading-relaxed">Reach out to thousands of job seekers and professionals in Nepal.</p>
                    <a href="#" class="inline-block px-6 py-2.5 bg-white text-indigo-700 text-sm font-bold rounded-xl hover:bg-gray-100 transition-colors">Get Started</a>
                </div>
                {{-- Decorative circles --}}
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute right-12 top-0 w-12 h-12 bg-white/5 rounded-full"></div>
            </div>
        </div>
    </div>
</div>
@endsection
