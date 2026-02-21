@extends('layouts.app')
@section('title', 'Job Moderation')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">Job Moderation</h1>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row gap-4 items-end">
                <form method="GET" action="{{ route('admin.jobs.index') }}" id="filter-form" class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Search</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm" placeholder="Job title or company...">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved (Active)</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Category</label>
                        <select name="category" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="flex gap-2">
                    <button type="submit" form="filter-form" class="px-6 py-2.5 bg-slate-800 text-white text-xs font-bold rounded-xl hover:bg-slate-900 shadow-lg shadow-slate-200 transition-all">Filter</button>
                    <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2.5 border border-gray-100 text-gray-400 text-xs font-bold rounded-xl hover:bg-gray-50 flex items-center">Reset</a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Title & Employer</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Posted On</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Category</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Featured</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($jobs as $job)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-800 text-sm mb-1">{{ $job->title }}</div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 bg-gray-50 rounded flex items-center justify-center text-[10px]">🏢</div>
                                            <span class="text-[10px] text-gray-500 font-bold uppercase">{{ $job->employer?->employerProfile?->company_name ?? $job->employer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-xs text-gray-400 font-medium">
                                        {{ $job->created_at->format('M d, Y') }}
                                        <p class="text-[9px]">{{ $job->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <form action="{{ route('admin.jobs.category', $job->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <select name="category_id" onchange="this.form.submit()" class="text-[10px] font-bold text-gray-600 uppercase bg-gray-50 border border-gray-100 rounded-lg px-2 py-1 focus:ring-2 focus:ring-blue-500 max-w-[120px]">
                                                <option value="">None</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ $job->category_id == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($job->status === 'approved')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Active</span>
                                        @elseif($job->status === 'pending')
                                            <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-[9px] font-bold uppercase tracking-widest animate-pulse">Pending</span>
                                        @elseif($job->status === 'rejected')
                                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Rejected</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg text-[9px] font-bold uppercase tracking-widest">{{ $job->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <form action="{{ route('admin.jobs.feature', $job->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button type="submit" class="p-2 transition-all {{ $job->is_featured ? 'text-yellow-500' : 'text-gray-200 hover:text-yellow-300' }}">
                                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="p-2 text-gray-300 hover:text-blue-500 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if($job->status === 'pending')
                                                <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST" class="inline">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-emerald-700 shadow-md shadow-emerald-50">Approve</button>
                                                </form>
                                            @endif
                                            <div class="dropdown relative group inline-block">
                                                <button class="p-2 text-gray-300 hover:text-slate-800 rounded-lg transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                                </button>
                                                <div class="absolute right-0 top-full mt-1 w-32 bg-white rounded-xl shadow-xl border border-gray-100 hidden group-hover:block z-20 overflow-hidden">
                                                    @foreach(['approved', 'pending', 'rejected', 'closed'] as $st)
                                                        @if($job->status !== $st)
                                                            <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="status" value="{{ $st }}">
                                                                <button type="submit" class="w-full text-left px-4 py-2 text-[10px] font-bold uppercase hover:bg-gray-50 text-gray-600">
                                                                    {{ ucfirst($st) }}
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No job listings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($jobs->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
