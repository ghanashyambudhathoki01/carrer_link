@extends('layouts.app')
@section('title', 'Post New Event')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 font-display">Post New Event</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Create a new community event or workshop.</p>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ auth()->user()->isSuperAdmin() ? route('super-admin.events.store') : (auth()->user()->isAdmin() ? route('admin.events.store') : route('employer.events.store')) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Basic Info --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Event Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="e.g. Kathmandu Tech Expo 2026">
                </div>

                {{-- Type & Category --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Event Type</label>
                    <select name="type" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                        <option value="job_fair">Job Fair</option>
                        <option value="workshop">Workshop</option>
                        <option value="seminar">Seminar</option>
                        <option value="networking">Networking</option>
                        <option value="webinar">Webinar</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="e.g. Hotel Annapurna, KTM or Online">
                </div>

                {{-- Dates --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Start Date & Time</label>
                    <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">End Date & Time (Optional)</label>
                    <input type="datetime-local" name="event_end_date" value="{{ old('event_end_date') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>

                {{-- Organizer Info --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Organizer Name</label>
                    <input type="text" name="organizer_name" value="{{ old('organizer_name') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Company or Individual Name">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Organizer Email</label>
                    <input type="email" name="organizer_email" value="{{ old('organizer_email') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="contact@organizer.com">
                </div>

                {{-- Registration & Capacity --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Registration Link (URL)</label>
                    <input type="url" name="registration_link" value="{{ old('registration_link') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="https://eventbrite.com/...">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Max Attendees</label>
                    <input type="number" name="max_attendees" value="{{ old('max_attendees') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Leave blank for unlimited">
                </div>

                {{-- Fee & Image --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Entry Fee (NPR)</label>
                    <input type="number" name="fee" value="{{ old('fee', 0) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="0 for Free">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Event Banner / Image</label>
                    <input type="file" name="image" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Detailed Description</label>
                    <textarea name="description" rows="8" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Provide all necessary details about the event...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                <a href="{{ auth()->user()->isSuperAdmin() ? route('super-admin.dashboard') : (auth()->user()->isAdmin() ? route('admin.dashboard') : route('employer.dashboard')) }}" class="px-8 py-3 border border-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-50 transition-all text-sm">Cancel</a>
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all text-sm">
                    Publish Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
