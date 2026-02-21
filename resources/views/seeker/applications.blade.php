@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('seeker.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">My Applications</h1>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Position</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Company</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Applied Date</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($applications as $app)
                                <tr>
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-800 text-sm">{{ $app->job->title }}</div>
                                        <div class="text-[10px] px-2 py-0.5 bg-blue-50 text-blue-600 rounded-full inline-block font-semibold mt-1">{{ $app->job->typeLabel() }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-sm">
                                                @if($app->job->employer?->employerProfile?->logo)
                                                    <img src="{{ asset('storage/' . $app->job->employer->employerProfile->logo) }}" class="w-full h-full object-cover rounded-lg">
                                                @else
                                                    🏢
                                                @endif
                                            </div>
                                            <span class="text-sm text-gray-600 font-medium">{{ $app->job->employer?->employerProfile?->company_name ?? $app->job->employer?->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-400 font-medium">
                                        {{ $app->created_at->format('M d, Y') }}
                                        <p class="text-[10px]">{{ $app->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1.5 rounded-xl text-xs font-bold {{ $app->statusColor() }}">
                                            {{ $app->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('jobs.show', $app->job_id) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="View Job">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if($app->status === 'applied')
                                                <form action="{{ route('seeker.applications.destroy', $app->id) }}" method="POST" onsubmit="return confirm('Withdraw your application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Withdraw">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="text-4xl mb-4">📄</div>
                                        <h3 class="font-bold text-gray-800">No applications yet</h3>
                                        <p class="text-sm text-gray-400 mt-1">Start applying for jobs to see them here.</p>
                                        <a href="{{ route('jobs.index') }}" class="mt-6 inline-block px-8 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-all">Browse Jobs</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($applications->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
