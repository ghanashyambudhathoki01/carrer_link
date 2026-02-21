@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">System Overview</h1>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-3xl font-black text-gray-800">{{ $stats['total_users'] }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Total Users</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-3xl font-black text-blue-600">{{ $stats['total_jobs'] }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Active Jobs</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-3xl font-black text-emerald-600">{{ $stats['total_subscriptions'] }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Active Subs</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-3xl font-black text-purple-600">{{ $stats['pending_verifications'] }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Pending Pay</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Pending Payments --}}
                <div class="bg-white rounded-3xl border border-gray-50 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between bg-purple-50">
                        <h2 class="font-bold text-purple-900">Pending QR Payments</h2>
                        <a href="{{ route('admin.subscriptions.index') }}" class="text-xs text-purple-600 font-bold hover:underline">Verify All</a>
                    </div>
                    <div class="p-0">
                        @forelse($pendingPayments as $sub)
                            <div class="flex items-center justify-between px-6 py-4 border-b last:border-0 border-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center text-xs font-bold text-purple-600">
                                        {{ substr($sub->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-800">{{ $sub->user->name }}</p>
                                        <p class="text-[9px] text-gray-400 uppercase">{{ $sub->plan->name }} • Rs. {{ number_format($sub->plan->price) }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.subscriptions.index') }}" class="text-[10px] font-bold text-blue-600 px-3 py-1 bg-blue-50 rounded-lg">Review</a>
                            </div>
                        @empty
                            <p class="text-center py-10 text-gray-400 text-sm italic">Clean slate! No pending payments.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Jobs to Approve --}}
                <div class="bg-white rounded-3xl border border-gray-50 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between bg-blue-50">
                        <h2 class="font-bold text-blue-900">Job Moderation</h2>
                        <a href="{{ route('admin.jobs.index') }}" class="text-xs text-blue-600 font-bold hover:underline">View All</a>
                    </div>
                    <div class="p-0">
                        @forelse($pendingJobs as $job)
                            <div class="flex items-center justify-between px-6 py-4 border-b last:border-0 border-gray-50">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="text-xs font-bold text-gray-800 truncate">{{ $job->title }}</p>
                                    <p class="text-[9px] text-gray-400 uppercase">{{ $job->employer?->employerProfile?->company_name }}</p>
                                </div>
                                <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="text-[10px] font-bold text-emerald-600 px-3 py-1 bg-emerald-50 rounded-lg">Approve</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center py-10 text-gray-400 text-sm italic">No jobs pending moderation.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
