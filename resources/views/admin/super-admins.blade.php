@extends('layouts.app')
@section('title', 'Manage Admin Staff')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 font-display">Administrative <span class="text-purple-600">Staff</span></h1>
            <p class="text-sm text-gray-500 font-medium">Manage system administrators and their access levels</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('super-admin.admins.create') }}" class="px-6 py-2 bg-purple-600 text-white text-xs font-bold rounded-xl hover:bg-purple-700 shadow-lg shadow-purple-100 transition-all uppercase tracking-widest">
                Register New Staff
            </a>
            <a href="{{ route('super-admin.dashboard') }}" class="px-6 py-2 bg-gray-100 text-gray-600 text-xs font-bold rounded-xl hover:bg-gray-200 transition-all uppercase tracking-widest">
                Back to Dashboard
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Admin Name</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Permissions</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                                    {{ substr($admin->name, 0, 1) }}
                                </div>
                                <p class="text-sm font-bold text-gray-800">{{ $admin->name }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-sm text-gray-500">{{ $admin->email }}</td>
                        <td class="px-8 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $admin->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $admin->status }}
                            </span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex flex-wrap gap-1">
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[9px] font-bold">Manage Users</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[9px] font-bold">Approve Jobs</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <button class="text-gray-400 hover:text-purple-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 bg-gray-50/50">
            {{ $admins->links() }}
        </div>
    </div>
</div>
@endsection
