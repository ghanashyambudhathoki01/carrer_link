<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 hover:shadow-md dark:hover:shadow-blue-900/10 hover:border-blue-200 dark:hover:border-blue-500/30 transition-all group">
    <div class="flex items-start justify-between gap-3">
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 mb-1">
                @if($job->is_featured)
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full font-medium">⭐ Featured</span>
                @endif
                <span class="text-xs bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-2 py-0.5 rounded-full">{{ $job->typeLabel() }}</span>
            </div>
            <a href="{{ route('jobs.show', $job->id) }}" class="block font-semibold text-gray-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors truncate">{{ $job->title }}</a>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
        </div>
        {{-- Company logo placeholder --}}
        <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex-shrink-0 overflow-hidden">
            @if($job->employer?->employerProfile?->logo)
                <img src="{{ asset('storage/' . $job->employer->employerProfile->logo) }}" alt="" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-xl">🏢</div>
            @endif
        </div>
    </div>

    <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-400">
        <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $job->location }}
        </span>
        <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ $job->salaryRange() }}
        </span>
        @if($job->deadline)
            <span class="flex items-center gap-1 {{ $job->isExpired() ? 'text-red-400' : '' }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Deadline: {{ $job->deadline->format('M d, Y') }}
            </span>
        @endif
    </div>

    @if($job->skills && count($job->skills))
        <div class="mt-3 flex flex-wrap gap-1.5">
            @foreach(array_slice($job->skills, 0, 4) as $skill)
                <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-0.5 rounded-full">{{ $skill }}</span>
            @endforeach
            @if(count($job->skills) > 4)
                <span class="text-xs text-gray-400">+{{ count($job->skills) - 4 }} more</span>
            @endif
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
        <a href="{{ route('jobs.show', $job->id) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">View Details →</a>
    </div>
</div>
