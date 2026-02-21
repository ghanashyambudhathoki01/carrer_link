@extends('layouts.app')
@section('title', 'Company Profile')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('employer.partials.sidebar')

        <div class="flex-1">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
                <div class="h-32 bg-emerald-600"></div>
                <div class="px-8 -mt-12 flex flex-col sm:flex-row items-end gap-6 mb-8 border-b border-gray-50 pb-8">
                    <div class="inline-block relative">
                        <div class="w-32 h-32 rounded-3xl border-4 border-white bg-gray-100 shadow-lg overflow-hidden flex items-center justify-center text-4xl">
                            @if($profile->logo)
                                <img src="{{ asset('storage/' . $profile->logo) }}" class="w-full h-full object-cover">
                            @else
                                🏢
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 pb-2">
                        <h1 class="text-2xl font-black text-gray-800">{{ $profile->company_name ?? 'Set Company Name' }}</h1>
                        <p class="text-gray-400 font-medium text-sm">{{ $profile->industry ?? 'Industry not set' }} • {{ $profile->location ?? 'Location not set' }}</p>
                    </div>
                    <div class="pb-2">
                        @if($profile->is_verified)
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Verified Account
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-gray-50 text-gray-400 rounded-full text-xs font-bold border border-gray-100 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Verification Pending
                            </span>
                        @endif
                    </div>
                </div>

                <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        {{-- Company Name --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Company Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>

                        {{-- Industry --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Industry</label>
                            <input type="text" name="industry" value="{{ old('industry', $profile->industry) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="e.g. Technology, Finance, Education">
                        </div>

                        {{-- Website --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Website URL</label>
                            <input type="url" name="website" value="{{ old('website', $profile->website) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="https://company.com">
                        </div>

                        {{-- Location --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Headquarters Location</label>
                            <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="e.g. Kathmandu, Nepal">
                        </div>

                        {{-- Logo Upload --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Company Logo</label>
                            <input type="file" name="logo" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">About Company</label>
                            <textarea name="description" rows="5" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="Describe your company's mission, values, and culture...">{{ old('description', $profile->description) }}</textarea>
                        </div>

                        {{-- Additional Fields --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Company Size</label>
                            <select name="company_size" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                                <option value="1-10" {{ $profile->company_size === '1-10' ? 'selected' : '' }}>1-10 Employees</option>
                                <option value="11-50" {{ $profile->company_size === '11-50' ? 'selected' : '' }}>11-50 Employees</option>
                                <option value="51-200" {{ $profile->company_size === '51-200' ? 'selected' : '' }}>51-200 Employees</option>
                                <option value="201-500" {{ $profile->company_size === '201-500' ? 'selected' : '' }}>201-500 Employees</option>
                                <option value="500+" {{ $profile->company_size === '500+' ? 'selected' : '' }}>500+ Employees</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Founded Year</label>
                            <input type="number" name="founded_year" value="{{ old('founded_year', $profile->founded_year) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="e.g. 2020">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
