@extends('layouts.app')
@section('title', 'Browse Jobs')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Sidebar Filters --}}
        <aside class="lg:w-64 flex-shrink-0">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 sticky top-20 transition-colors">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Filter Jobs</h3>
                <form method="GET" action="{{ route('jobs.index') }}" id="filter-form">
                    <input type="hidden" name="q" value="{{ request('q') }}">

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Category</label>
                        <select name="category" class="w-full text-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->icon }} {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Job Type --}}
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Job Type</label>
                        <div class="space-y-2">
                            @foreach(['full_time' => 'Full Time', 'part_time' => 'Part Time', 'internship' => 'Internship', 'remote' => 'Remote', 'contract' => 'Contract'] as $value => $label)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="type" value="{{ $value }}" {{ request('type') === $value ? 'checked' : '' }} class="text-blue-600 dark:bg-gray-900 dark:border-gray-700" onchange="this.form.submit()">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Experience Level --}}
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Experience</label>
                        <select name="experience" class="w-full text-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg px-3 py-2" onchange="this.form.submit()">
                            <option value="">Any Level</option>
                            <option value="entry" {{ request('experience') === 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ request('experience') === 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ request('experience') === 'senior' ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ request('experience') === 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>

                    {{-- Salary --}}
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Salary Range</label>
                        <select name="salary" class="w-full text-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg px-3 py-2" onchange="this.form.submit()">
                            <option value="">Any Salary</option>
                            <option value="under_30k" {{ request('salary') === 'under_30k' ? 'selected' : '' }}>Under Rs. 30,000</option>
                            <option value="30k_60k" {{ request('salary') === '30k_60k' ? 'selected' : '' }}>Rs. 30,000 – 60,000</option>
                            <option value="60k_100k" {{ request('salary') === '60k_100k' ? 'selected' : '' }}>Rs. 60,000 – 1,00,000</option>
                            <option value="above_100k" {{ request('salary') === 'above_100k' ? 'selected' : '' }}>Above Rs. 1,00,000</option>
                        </select>
                    </div>

                    @if(request()->hasAny(['type', 'category', 'experience', 'salary', 'location']))
                        <a href="{{ route('jobs.index', ['q' => request('q')]) }}" class="text-xs text-red-500 hover:underline">✕ Clear Filters</a>
                    @endif
                </form>
            </div>
        </aside>

        {{-- Job Listings --}}
        <div class="flex-1">
            {{-- Search bar + count --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-5 gap-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $jobs->total() }} Job{{ $jobs->total() != 1 ? 's' : '' }} Found
                        @if(request('q'))<span class="text-blue-600 dark:text-blue-400"> for "{{ request('q') }}"</span>@endif
                    </h1>
                </div>
                <form method="GET" action="{{ route('jobs.index') }}" class="flex gap-2">
                    <input type="text" name="q" placeholder="Search jobs..." value="{{ request('q') }}"
                           class="px-4 py-2 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach(request()->except('q') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Search</button>
                </form>
            </div>

            @forelse($jobs as $job)
                <div class="mb-4">
                    @include('partials.job-card', ['job' => $job])
                </div>
            @empty
                <div class="text-center py-16 text-gray-500 dark:text-gray-400">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">No jobs found</h3>
                    <p class="text-sm mt-1">Try adjusting your filters or search terms</p>
                    <a href="{{ route('jobs.index') }}" class="mt-4 inline-block px-5 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Browse All Jobs</a>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($jobs->hasPages())
                <div class="mt-8">{{ $jobs->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
