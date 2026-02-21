@extends('layouts.app')
@section('title', 'Eventify Manager')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <h1 class="text-2xl font-bold text-gray-800 font-display">Eventify Manager</h1>
                <a href="{{ auth()->user()->isSuperAdmin() ? route('super-admin.events.create') : route('admin.events.create') }}" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Post New Event
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Event</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date & Location</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Organizer</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($events as $event)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-xl bg-gray-50 overflow-hidden flex-shrink-0">
                                                @if($event->image)
                                                    <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-xl">📅</div>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-bold text-gray-800 text-sm truncate">{{ $event->title }}</div>
                                                <div class="text-[10px] text-gray-400 font-medium truncate">{{ Str::limit($event->description, 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-[10px] font-bold text-gray-700">{{ $event->event_date->format('M d, Y') }}</div>
                                        <div class="text-[10px] text-gray-400">{{ $event->location }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-[10px] font-bold text-gray-800">{{ $event->organizer->name }}</div>
                                        <div class="text-[9px] text-gray-400 uppercase">{{ $event->organizer->role }}</div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($event->is_approved)
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-bold uppercase tracking-widest">Live</span>
                                        @else
                                            <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-[9px] font-bold uppercase tracking-widest animate-pulse">Pending Review</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('events.show', $event->id) }}" target="_blank" class="p-2 text-gray-300 hover:text-blue-500 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if(!$event->is_approved)
                                                <form action="{{ route('admin.events.approve', $event->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="px-4 py-1.5 bg-slate-800 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-slate-900 shadow-md">Approve</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No events to manage.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($events->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
