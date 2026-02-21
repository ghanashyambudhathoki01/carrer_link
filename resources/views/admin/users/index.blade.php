@extends('layouts.app')
@section('title', 'User Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">User Registry</h1>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row gap-4 items-end">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Search</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm" placeholder="Name or email...">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Role</label>
                        <select name="role" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm">
                            <option value="">All Roles</option>
                            <option value="job_seeker" {{ request('role') == 'job_seeker' ? 'selected' : '' }}>Job Seeker</option>
                            <option value="employer" {{ request('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-sm">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                    </div>
                </form>
                <div class="flex gap-2">
                    <button type="submit" form="search-form" class="px-6 py-2.5 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-900 transition-all">Filter</button>
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-gray-100 text-gray-400 rounded-xl hover:bg-gray-50">Reset</a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">User Details</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Role</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Joined Date</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-lg overflow-hidden border-2 border-white shadow-sm font-bold text-slate-400">
                                                @if($user->avatar)
                                                    <img src="{{ $user->avatarUrl() }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($user->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800 text-sm">{{ $user->name }}</div>
                                                <div class="text-[9px] text-gray-400 font-medium">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 bg-slate-50 text-slate-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">
                                            {{ str_replace('_', ' ', $user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-xs text-gray-500 font-medium">
                                        {{ $user->created_at->format('M d, Y') }}
                                        <p class="text-[9px] text-gray-300">{{ $user->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($user->status === 'active')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Active</span>
                                        @elseif($user->status === 'banned')
                                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Banned</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-[9px] font-bold uppercase tracking-widest">{{ $user->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="dropdown relative group">
                                            <button class="p-2 text-gray-300 hover:text-slate-800 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                            </button>
                                            <div class="absolute right-0 top-full mt-1 w-32 bg-white rounded-xl shadow-xl border border-gray-100 hidden group-hover:block z-20">
                                                @foreach(['active', 'inactive', 'banned'] as $st)
                                                    @if($user->status !== $st)
                                                        <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="{{ $st }}">
                                                            <button type="submit" class="w-full text-left px-4 py-2 text-[10px] font-bold uppercase hover:bg-gray-50 {{ $st === 'banned' ? 'text-red-500' : 'text-gray-600' }}">
                                                                {{ ucfirst($st) }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No users found matching your criteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
