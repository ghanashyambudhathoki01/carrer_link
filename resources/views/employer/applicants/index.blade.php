@extends('layouts.app')
@section('title', 'Manage Applicants')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('employer.partials.sidebar')

        <div class="flex-1">
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 font-display">Manage Applicants</h1>
                    @if(isset($job))
                        <p class="text-sm font-medium text-gray-500 mt-1">For position: <span class="text-blue-600 font-bold">"{{ $job->title }}"</span></p>
                    @endif
                </div>
                {{-- Status Filter --}}
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Filter Status:</span>
                    <form action="{{ route('employer.applicants.index', $job->id) }}" method="GET" id="filterForm">
                        <select name="status" onchange="this.form.submit()" class="border-gray-100 bg-white rounded-xl text-xs font-bold text-gray-600 focus:ring-emerald-500">
                            <option value="">All Statuses</option>
                            @foreach(['applied', 'reviewed', 'shortlisted', 'interviewed', 'rejected', 'hired'] as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Job Seeker</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Applied Date</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Resume</th>
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
                                                <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $app->applicant->seekerProfile?->headline ?? 'Career Professional' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-gray-500">
                                        {{ $app->created_at->format('M d, Y') }}
                                        <p class="text-[10px] text-gray-300">{{ $app->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="dropdown relative group">
                                            <button class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $app->statusColor() }} flex items-center gap-1 group-hover:ring-2 ring-gray-100 transition-all">
                                                {{ $app->statusLabel() }}
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            </button>
                                            <div class="absolute z-20 left-0 top-full mt-1 w-32 bg-white rounded-xl shadow-xl border border-gray-100 hidden group-hover:block overflow-hidden">
                                                @foreach(['applied', 'shortlisted', 'interviewing', 'rejected'] as $status)
                                                    <form action="{{ route('employer.applicants.update', $app->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="{{ $status }}">
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-[10px] font-bold uppercase hover:bg-gray-50 {{ $app->status === $status ? 'text-blue-600 bg-blue-50' : 'text-gray-500' }}">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($app->resume_path)
                                            <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-bold border border-gray-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100 transition-all">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                                                Download CV
                                            </a>
                                        @else
                                            <span class="text-[10px] font-bold text-gray-300 italic">No resume</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right flex items-center justify-end gap-1">
                                        <a href="mailto:{{ $app->applicant->email }}?subject=Regarding your application for {{ $job->title }}" class="p-2 text-gray-400 hover:text-blue-500 rounded-lg transition-all" title="Contact Applicant">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </a>
                                        <button onclick="alert('Cover Letter:\n\n{{ str_replace(["\r", "\n"], ' ', $app->cover_letter ?? 'No cover letter provided.') }}')" class="p-2 text-gray-400 hover:text-emerald-500 rounded-lg transition-all" title="View Message">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="text-4xl mb-4">⏳</div>
                                        <h3 class="font-bold text-gray-800">Waiting for talent...</h3>
                                        <p class="text-sm text-gray-400 mt-1">No applications have been received for this position yet.</p>
                                    </td>
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
    </div>
</div>
@endsection
