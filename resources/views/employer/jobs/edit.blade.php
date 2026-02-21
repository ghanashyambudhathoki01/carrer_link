@extends('layouts.app')
@section('title', isset($job) ? 'Edit Job' : 'Post New Job')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('employer.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">{{ isset($job) ? 'Edit Job' : 'Post New Job' }}</h1>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <form action="{{ isset($job) ? route('employer.jobs.update', $job->id) : route('employer.jobs.store') }}" method="POST" class="p-8">
                    @csrf
                    @if(isset($job)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        {{-- Title --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Job Title</label>
                            <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="e.g. Senior Laravel Developer">
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Category</label>
                            <select name="category_id" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (isset($job) && $job->category_id == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->icon }} {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Employment Type</label>
                            <select name="type" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                                @foreach(['full_time' => 'Full Time', 'part_time' => 'Part Time', 'internship' => 'Internship', 'remote' => 'Remote', 'contract' => 'Contract'] as $val => $lab)
                                    <option value="{{ $val }}" {{ (isset($job) && $job->type == $val) ? 'selected' : '' }}>{{ $lab }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Location --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Location</label>
                            <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="e.g. Kathmandu or Remote">
                        </div>

                        {{-- Vacancies --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">No. of Vacancies</label>
                            <input type="number" name="vacancies" value="{{ old('vacancies', $job->vacancies ?? 1) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>

                        {{-- Salary --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Salary Min (Monthly)</label>
                            <input type="number" name="salary_min" value="{{ old('salary_min', $job->salary_min ?? '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Salary Max (Monthly)</label>
                            <input type="number" name="salary_max" value="{{ old('salary_max', $job->salary_max ?? '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>

                        {{-- Experience --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Experience Level</label>
                            <select name="experience_level" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                                @foreach(['entry' => 'Entry Level', 'mid' => 'Mid Level', 'senior' => 'Senior Level', 'executive' => 'Executive'] as $val => $lab)
                                    <option value="{{ $val }}" {{ (isset($job) && $job->experience_level == $val) ? 'selected' : '' }}>{{ $lab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Min Years Exp</label>
                            <input type="number" name="experience_years_min" value="{{ old('experience_years_min', $job->experience_years_min ?? 0) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>

                        {{-- Deadline --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Application Deadline</label>
                            <input type="date" name="deadline" value="{{ old('deadline', isset($job->deadline) ? $job->deadline->format('Y-m-d') : '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        </div>

                        {{-- Skills --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Skills Needed (Comma separated)</label>
                            <input type="text" name="skills" value="{{ old('skills', isset($job->skills) ? implode(', ', $job->skills) : '') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="Laravel, PHP, Vue.js">
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Job Description</label>
                            <textarea name="description" rows="10" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium" placeholder="Describe the role, responsibilities, and qualifications...">{{ old('description', $job->description ?? '') }}</textarea>
                        </div>

                        {{-- Lists: Requirements, responsibilities, benefits (JSON handled in controller) --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Additional Info (One per line)</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold mb-1">Requirements</p>
                                    <textarea name="requirements" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-xs font-medium">{{ old('requirements', isset($job->requirements) ? implode("\n", $job->requirements) : '') }}</textarea>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold mb-1">Benefits</p>
                                    <textarea name="benefits" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-xs font-medium">{{ old('benefits', isset($job->benefits) ? implode("\n", $job->benefits) : '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Status & Visibility --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Visibility Status</label>
                            <select name="status" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                                <option value="approved" {{ (isset($job) && $job->status === 'approved') ? 'selected' : '' }}>Approved</option>
                                <option value="draft" {{ (isset($job) && $job->status === 'draft') ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        @if(auth()->user()->isPro())
                            <div class="flex items-center gap-2 pt-6">
                                <input type="checkbox" name="is_featured" value="1" {{ (isset($job) && $job->is_featured) ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 rounded-lg">
                                <label class="text-sm font-bold text-gray-700">⭐ Mark as Featured Listing</label>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                        <a href="{{ route('employer.jobs.index') }}" class="px-8 py-3 border border-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-50 transition-all">Cancel</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all">
                            {{ isset($job) ? 'Update Listing' : 'Publish Job' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
