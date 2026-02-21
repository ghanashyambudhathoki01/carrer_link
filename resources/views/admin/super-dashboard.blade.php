@extends('layouts.app')
@section('title', 'Super Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 font-display">Super Admin <span class="text-purple-600">Console</span></h1>
            <p class="text-sm text-gray-500 font-medium">System-wide overview and management</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('super-admin.internships.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post Internship
            </a>
            <a href="{{ route('super-admin.events.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post New Event
            </a>
            <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                <span class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></span>
                System Live
            </span>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Total Users</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_users']) }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Active Admins</p>
            <p class="text-3xl font-black text-purple-600">{{ number_format($stats['total_admins']) }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Global Jobs</p>
            <p class="text-3xl font-black text-emerald-600">{{ number_format($stats['total_jobs']) }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Revenue</p>
            <p class="text-3xl font-black text-blue-600">Rs. {{ number_format($stats['total_revenue']) }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-purple-100 shadow-sm hover:shadow-md transition-shadow ring-4 ring-purple-50">
            <p class="text-[10px] text-purple-400 font-bold uppercase tracking-widest mb-1">Pending Pay</p>
            <p class="text-3xl font-black text-purple-600">{{ number_format($stats['pending_payments']) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Users --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="font-black text-gray-800 uppercase tracking-tighter text-lg">System-wide Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-purple-600 hover:underline">Manage All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">User</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Role</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentUsers as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-[10px] font-bold text-purple-600">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
                                            <p class="text-[10px] text-gray-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase
                                        {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : '' }}
                                        {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $user->role === 'employer' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $user->role === 'job_seeker' ? 'bg-gray-100 text-gray-700' : '' }}">
                                        {{ str_replace('_', ' ', $user->role) }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-xs font-medium text-gray-600">{{ $user->status }}</td>
                                <td class="px-8 py-4 text-xs text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pending Subscriptions Moderation --}}
            <div class="bg-white rounded-3xl border border-purple-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-purple-50 flex items-center justify-between bg-purple-50/30">
                    <h2 class="font-black text-purple-900 uppercase tracking-tighter text-lg">Payment Moderation</h2>
                    <a href="{{ route('super-admin.subscriptions.index') }}" class="text-xs font-bold text-purple-600 hover:underline">View All Requests</a>
                </div>
                <div class="p-0">
                    @forelse($pendingPayments as $sub)
                        <div class="flex items-center justify-between px-8 py-4 border-b last:border-0 border-gray-50 hover:bg-purple-50/20 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center text-xs font-bold text-purple-600">
                                    {{ substr($sub->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $sub->user->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest">{{ $sub->plan->name }} • Rs. {{ number_format($sub->plan->price) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('super-admin.subscriptions.verify', $sub->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="text-[10px] font-bold text-emerald-600 px-4 py-2 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">Approve</button>
                                </form>
                                <a href="{{ route('super-admin.subscriptions.index') }}" class="text-[10px] font-bold text-gray-400 px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">Review</a>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center">
                            <p class="text-gray-400 text-sm italic">Clean slate! No pending payments at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        {{-- Admin Roles --}}
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-purple-100">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-white/20 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-black tracking-tight">System Security</h3>
                </div>
                <p class="text-purple-100 text-sm leading-relaxed mb-6">You are viewing the restricted Super Admin panel. All system-wide changes are logged.</p>
                <div class="space-y-3">
                    <button class="w-full py-3 bg-white/10 hover:bg-white/20 rounded-xl text-xs font-bold transition-all flex items-center justify-between px-4">
                        <span>Database Backup</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                    </button>
                    <button class="w-full py-3 bg-white/10 hover:bg-white/20 rounded-xl text-xs font-bold transition-all flex items-center justify-between px-4">
                        <span>View System Logs</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-black text-gray-800 uppercase tracking-tighter">Active Staff</h3>
                    <a href="{{ route('super-admin.admins.index') }}" class="text-[10px] font-bold text-purple-600 hover:underline">Manage Staff</a>
                </div>
                <div class="space-y-4">
                    @foreach($recentAdmins as $adm)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span class="text-xs font-bold text-gray-700">{{ $adm->name }}</span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-medium">{{ $adm->email }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
