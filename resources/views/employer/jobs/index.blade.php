@extends('layouts.app')
@section('title', 'Manage Jobs')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('employer.partials.sidebar')

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <h1 class="text-2xl font-bold text-gray-800 font-display">Manage Your Listings</h1>
                <div class="flex items-center gap-3">
                    <form action="{{ route('employer.jobs.index') }}" method="GET" class="flex gap-2">
                        <select name="category" onchange="this.form.submit()" class="px-4 py-2 bg-white border border-gray-100 text-sm font-medium rounded-xl focus:ring-2 focus:ring-emerald-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->icon }} {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <a href="{{ route('employer.jobs.create') }}" class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Post New Job
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Information</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Applicants</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Expiration</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($jobs as $job)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-800 text-sm">{{ $job->title }}</div>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[9px] font-bold text-blue-500 uppercase">{{ $job->typeLabel() }}</span>
                                            <span class="text-[9px] font-bold text-gray-300">•</span>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase">{{ $job->category?->name ?? 'Uncategorized' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="{{ route('employer.applicants.index', ['id' => $job->id]) }}" class="inline-flex flex-col items-center group">
                                            <span class="text-lg font-black text-gray-800 group-hover:text-emerald-500 transition-colors">{{ $job->applications_count }}</span>
                                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">Total</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($job->status === 'approved')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                                        @elseif($job->status === 'draft')
                                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-bold uppercase tracking-wider">Draft</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ ucfirst($job->status) }}</span>
                                        @endif
                                        @if($job->is_featured)
                                            <div class="text-[8px] text-yellow-600 font-bold mt-1 uppercase">⭐ Featured</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium {{ $job->isExpired() ? 'text-red-500' : 'text-gray-700' }}">
                                            {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}
                                        </div>
                                        <p class="text-[10px] text-gray-300">{{ $job->deadline ? $job->deadline->diffForHumans() : 'No deadline' }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="p-2 text-gray-400 hover:text-blue-500 rounded-lg transition-all" title="View Publicly">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('employer.jobs.edit', $job->id) }}" class="p-2 text-gray-400 hover:text-emerald-500 rounded-lg transition-all" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Delete this listing permanently?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg transition-all" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="text-4xl mb-4">🚀</div>
                                        <h3 class="font-bold text-gray-800">Ready to hire?</h3>
                                        <p class="text-sm text-gray-400 mt-1 mb-6">Post your first job listing and reach thousands of candidates.</p>
                                        <a href="{{ route('employer.jobs.create') }}" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all">Create Listing</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($jobs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-50">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
