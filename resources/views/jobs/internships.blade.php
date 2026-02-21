@extends('layouts.app')
@section('title', 'Internships in Nepal')

@section('content')
<div class="bg-emerald-600 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-white mb-4">Start Your Career Journey</h1>
        <p class="text-emerald-50 text-lg max-w-2xl mx-auto">Explore the best internship opportunities in Nepal. Gain real-world experience and build your resume.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Showing {{ $jobs->total() }} Internships</h2>
        <div class="flex gap-4">
            {{-- Quick Filter buttons can go here --}}
        </div>
    </div>

    @if($jobs->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
                @include('partials.job-card', ['job' => $job])
            @endforeach
        </div>

        <div class="mt-12">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl border border-dashed border-gray-300 py-20 text-center">
            <div class="text-6xl mb-4">🌱</div>
            <h3 class="text-xl font-bold text-gray-800">No internships available right now</h3>
            <p class="text-gray-500 mt-2">Check back later or browse other job types.</p>
            <a href="{{ route('jobs.index') }}" class="mt-6 inline-block px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700">Browse All Jobs</a>
        </div>
    @endif
</div>
@endsection
