@extends('layouts.app')
@section('title', 'Saved Jobs')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('seeker.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">Saved Jobs</h1>

            @if($savedJobs->count())
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($savedJobs as $item)
                        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all group relative">
                            <form action="{{ route('seeker.saved-jobs.toggle', $item->job_id) }}" method="POST" class="absolute top-6 right-6 z-10">
                                @csrf
                                <button type="submit" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-all">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </button>
                            </form>

                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex-shrink-0 flex items-center justify-center text-2xl overflow-hidden">
                                    @if($item->job->employer?->employerProfile?->logo)
                                        <img src="{{ asset('storage/' . $item->job->employer->employerProfile->logo) }}" class="w-full h-full object-cover">
                                    @else
                                        🏢
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0 pr-10">
                                    <h3 class="font-bold text-gray-800 text-sm group-hover:text-blue-600 transition-colors truncate">{{ $item->job->title }}</h3>
                                    <p class="text-xs text-gray-400 font-medium mt-0.5">{{ $item->job->employer?->employerProfile?->company_name ?? $item->job->employer->name }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-6">
                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full">{{ $item->job->typeLabel() }}</span>
                                <span class="flex items-center gap-1">📍 {{ $item->job->location }}</span>
                                <span class="flex items-center gap-1">💰 {{ $item->job->salaryRange() }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <span class="text-[10px] text-gray-300">Saved {{ $item->created_at->diffForHumans() }}</span>
                                <a href="{{ route('jobs.show', $item->job_id) }}" class="px-5 py-2 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-all">View Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $savedJobs->links() }}
                </div>
            @else
                <div class="bg-white rounded-3xl border border-dashed border-gray-200 py-20 text-center">
                    <div class="text-4xl mb-4">❤️</div>
                    <h3 class="font-bold text-gray-800">No saved jobs</h3>
                    <p class="text-sm text-gray-400 mt-1">Keep track of interesting positions by clicking the heart icon.</p>
                    <a href="{{ route('jobs.index') }}" class="mt-6 inline-block px-8 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-all">Browse Jobs</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
