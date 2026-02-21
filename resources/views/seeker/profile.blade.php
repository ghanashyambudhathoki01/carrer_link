@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('seeker.partials.sidebar')

        <div class="flex-1">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                <div class="p-8 -mt-12 text-center sm:text-left sm:flex sm:items-end sm:gap-6 border-b border-gray-50 pb-8">
                    <div class="inline-block relative">
                        <div class="w-32 h-32 rounded-3xl border-4 border-white bg-gray-100 shadow-lg overflow-hidden mx-auto">
                            <img src="{{ auth()->user()->avatarUrl() }}" class="w-full h-full object-cover">
                        </div>
                        <button class="absolute bottom-2 right-2 p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>
                    </div>
                    <div class="mt-4 sm:mt-0 pb-2">
                        <h1 class="text-2xl font-black text-gray-800">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-500 font-medium">{{ $profile->headline ?? 'Set your professional headline' }}</p>
                    </div>
                </div>

                <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        {{-- Headline --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Headline</label>
                            <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="e.g. Senior Laravel Developer | 5 Years Experience">
                        </div>

                        {{-- Bio --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Bio / Professional Summary</label>
                            <textarea name="bio" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Tell companies about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                        </div>

                        {{-- Experience --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Years of Experience</label>
                            <input type="number" name="experience_years" value="{{ old('experience_years', $profile->experience_years) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm">
                        </div>

                        {{-- Location --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Current Location</label>
                            <input type="text" name="current_location" value="{{ old('current_location', $profile->current_location) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="e.g. Kathmandu, Nepal">
                        </div>

                        {{-- Skills --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Skills (Comma separated)</label>
                            <input type="text" name="skills" value="{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Laravel, PHP, Vue.js, MySQL">
                        </div>

                        {{-- Resume Upload --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Resume / CV (PDF preferred)</label>
                            <div class="flex items-center gap-4">
                                @if($profile->resume_path)
                                    <a href="{{ asset('storage/' . $profile->resume_path) }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 rounded-xl text-xs font-bold hover:bg-blue-100 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                                        View Current Resume
                                    </a>
                                @endif
                                <input type="file" name="resume" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-600 hover:file:bg-gray-200">
                            </div>
                        </div>

                        {{-- Availability --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Availability</label>
                            <select name="availability" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="immediately" {{ $profile->availability === 'immediately' ? 'selected' : '' }}>Immediately</option>
                                <option value="within_month" {{ $profile->availability === 'within_month' ? 'selected' : '' }}>Within a Month</option>
                                <option value="negotiable" {{ $profile->availability === 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
