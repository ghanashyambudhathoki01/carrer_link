@extends('layouts.app')
@section('title', 'Global Applicants Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 font-display">Global Applicants</h1>
            <p class="text-sm font-medium text-gray-500 mt-1">Monitor and moderate all job applications across the platform.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3">
            {{-- Search --}}
            <form action="{{ route('admin.applicants.index') }}" method="GET" class="relative group w-full sm:w-64">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name/email..." 
                    class="w-full pl-10 pr-4 py-2 bg-white border-gray-100 rounded-xl text-sm focus:ring-blue-500 group-hover:border-blue-200 transition-all">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>

            {{-- Status Filter --}}
            <form action="{{ route('admin.applicants.index') }}" method="GET">
                <select name="status" onchange="this.form.submit()" class="border-gray-100 bg-white rounded-xl text-xs font-bold text-gray-600 focus:ring-blue-500">
                    <option value="">All Statuses</option>
                    @foreach(['applied', 'reviewed', 'shortlisted', 'interviewed', 'rejected', 'hired'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
            </form>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Seeker</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Details</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Employer</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($applications as $app)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-lg overflow-hidden border-2 border-white shadow-sm font-bold text-blue-400">
                                        @if($app->applicant->avatar)
                                            <img src="{{ $app->applicant->avatarUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($app->applicant->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800 text-sm">{{ $app->applicant->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-medium">{{ $app->applicant->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-800 text-xs">{{ $app->job->title }}</div>
                                <div class="text-[10px] text-gray-400 font-medium italic mt-0.5">Applied on {{ $app->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-[11px] font-bold text-blue-600">{{ $app->job->employer->employerProfile?->company_name ?? $app->job->employer->name }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="dropdown relative group">
                                    <button class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $app->statusColor() }} flex items-center gap-1 group-hover:ring-2 ring-gray-100 transition-all">
                                        {{ $app->statusLabel() }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <div class="absolute z-20 left-0 top-full mt-1 w-32 bg-white rounded-xl shadow-xl border border-gray-100 hidden group-hover:block overflow-hidden">
                                        @foreach(['applied', 'reviewed', 'shortlisted', 'interviewed', 'rejected', 'hired'] as $status)
                                            <form action="{{ route('admin.applicants.update', $app->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ $status }}">
                                                <button type="submit" class="w-full text-left px-4 py-2 text-[10px] font-bold uppercase hover:bg-gray-50 {{ $app->status === $status ? 'text-blue-600 bg-blue-50' : 'text-gray-500' }}">
                                                    {{ ucfirst($status) }}
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-right flex items-center justify-end gap-1">
                                <a href="mailto:{{ $app->applicant->email }}" class="p-2 text-gray-400 hover:text-blue-500 rounded-lg transition-all" title="Email Applicant">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </a>
                                @if($app->resume_path)
                                    <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="p-2 text-gray-400 hover:text-emerald-500 rounded-lg transition-all" title="View CV">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No applications found matching your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($applications->hasPages())
            <div class="px-6 py-4 border-t border-gray-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
