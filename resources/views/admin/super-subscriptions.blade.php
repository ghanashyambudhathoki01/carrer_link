@extends('layouts.app')
@section('title', 'Payment Verification - Super Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 font-display">Payment <span class="text-purple-600">Moderation</span></h1>
            <p class="text-sm text-gray-500 font-medium">Verify and approve manual QR transactions</p>
        </div>
        <a href="{{ route('super-admin.dashboard') }}" class="px-6 py-2 bg-gray-100 text-gray-600 text-xs font-bold rounded-xl hover:bg-gray-200 transition-all uppercase tracking-widest">Back to Console</a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Subscriber</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Plan & Amount</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Reference/SS</th>
                        <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-8 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($subscriptions as $sub)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-800 text-sm">{{ $sub->user->name }}</div>
                                <div class="text-[10px] text-gray-400 font-medium">{{ $sub->user->email }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-lg text-[9px] font-bold uppercase tracking-widest inline-block mb-1">{{ $sub->plan->name }}</span>
                                <div class="text-sm font-black text-gray-800">Rs. {{ number_format($sub->plan->price) }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[10px] font-bold text-gray-500 mb-2">ID: {{ $sub->payment_reference ?? 'N/A' }}</div>
                                @if($sub->payment_screenshot)
                                    <button onclick="document.getElementById('img-modal-{{ $sub->id }}').classList.remove('hidden')" class="px-3 py-1.5 bg-gray-900 text-white text-[9px] font-bold rounded-lg hover:bg-gray-800 transition-all flex items-center gap-2">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Inspect
                                    </button>

                                    <div id="img-modal-{{ $sub->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
                                        <div class="relative bg-white p-2 rounded-3xl max-w-2xl w-full shadow-2xl">
                                            <button onclick="document.getElementById('img-modal-{{ $sub->id }}').classList.add('hidden')" class="absolute -top-12 right-0 text-white text-3xl hover:scale-110 transition-transform">&times;</button>
                                            <img src="{{ asset('storage/' . $sub->payment_screenshot) }}" class="w-full rounded-2xl">
                                        </div>
                                    </div>
                                @else
                                    <span class="text-[9px] italic text-gray-300">No screenshot</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($sub->status === 'active')
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Verified</span>
                                @elseif($sub->status === 'pending')
                                    <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-lg text-[9px] font-bold uppercase tracking-widest animate-pulse">Awaiting SuperAdmin</span>
                                @elseif($sub->status === 'cancelled')
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Rejected</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg text-[9px] font-bold uppercase tracking-widest">{{ $sub->status }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                @if($sub->status === 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('super-admin.subscriptions.verify', $sub->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button type="submit" class="px-4 py-1.5 bg-purple-600 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-purple-700 shadow-md shadow-purple-50">Approve</button>
                                        </form>
                                        <button onclick="const n = prompt('Reason for rejection?'); if(n) { document.getElementById('reject-form-{{ $sub->id }}').querySelector('[name=notes]').value = n; document.getElementById('reject-form-{{ $sub->id }}').submit(); }" class="px-4 py-1.5 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-lg hover:bg-red-50 hover:text-red-500">Decline</button>
                                        <form id="reject-form-{{ $sub->id }}" action="{{ route('super-admin.subscriptions.reject', $sub->id) }}" method="POST" class="hidden">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="notes">
                                        </form>
                                    </div>
                                @else
                                    <div class="text-[9px] font-medium text-gray-300 italic">
                                        Done {{ $sub->verified_at ? $sub->verified_at->diffForHumans() : '' }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center text-gray-400 italic">No payments found in history.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($subscriptions->hasPages())
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 italic">
                {{ $subscriptions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
