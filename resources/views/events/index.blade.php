@extends('layouts.app')
@section('title', 'Eventify – Career Events in Nepal')

@section('content')
<div class="bg-purple-600 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-white mb-4">Eventify</h1>
        <p class="text-purple-100 text-lg max-w-2xl mx-auto">Join workshops, seminars, and networking events to accelerate your career growth.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden hover:shadow-xl transition-all group">
                    <div class="aspect-video bg-gray-100 relative overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl bg-purple-50 text-purple-200">📅</div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-purple-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ ucfirst($event->type) }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex flex-col items-center justify-center font-bold">
                                <span class="text-[10px] leading-none uppercase">{{ $event->event_date->format('M') }}</span>
                                <span class="text-lg leading-none">{{ $event->event_date->format('d') }}</span>
                            </div>
                            <div class="text-sm">
                                <p class="text-gray-800 font-semibold">{{ $event->event_date->format('l') }}</p>
                                <p class="text-gray-400 text-xs">{{ $event->event_date->format('g:i A') }}</p>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 truncate group-hover:text-purple-600 transition-colors">{{ $event->title }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                        
                        <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $event->location }}
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="font-bold text-gray-800">
                                @if($event->fee > 0)
                                    Rs. {{ number_format($event->fee) }}
                                @else
                                    <span class="text-emerald-500 uppercase tracking-wider text-xs">Free</span>
                                @endif
                            </span>
                            <a href="{{ route('events.show', $event->id) }}" class="px-5 py-2 bg-purple-600 text-white text-sm font-bold rounded-xl hover:bg-purple-700 transition-colors shadow-md shadow-purple-200">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $events->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl border border-dashed border-gray-300 py-20 text-center">
            <div class="text-6xl mb-4">🎟️</div>
            <h3 class="text-xl font-bold text-gray-800">No events scheduled yet</h3>
            <p class="text-gray-500 mt-2">Check back soon for upcoming workshops and seminars.</p>
        </div>
    @endif
</div>
@endsection
