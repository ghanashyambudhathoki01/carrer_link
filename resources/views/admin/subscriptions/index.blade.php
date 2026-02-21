@extends('layouts.app')
@section('title', 'Verify Subscriptions')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-8 font-display">Kumari Bank QR Verification</h1>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Subscriber</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Plan & Amount</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Reference/SS</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($subscriptions as $sub)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-800 text-sm">{{ $sub->user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-medium">{{ $sub->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-bold uppercase tracking-widest inline-block mb-1">{{ $sub->plan->name }}</div>
                                        <div class="text-sm font-black text-gray-800">Rs. {{ number_format($sub->plan->price) }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-[10px] font-bold text-gray-500 mb-2">ID: {{ $sub->payment_reference ?? 'N/A' }}</div>
                                        @if($sub->payment_screenshot)
                                            <button onclick="document.getElementById('img-modal-{{ $sub->id }}').classList.remove('hidden')" class="px-3 py-1.5 bg-gray-900 text-white text-[9px] font-bold rounded-lg hover:bg-gray-800 transition-all flex items-center gap-2">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                View Screenshot
                                            </button>

                                            {{-- Screenshot Modal --}}
                                            <div id="img-modal-{{ $sub->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80">
                                                <div class="relative bg-white p-2 rounded-3xl max-w-2xl w-full">
                                                    <button onclick="document.getElementById('img-modal-{{ $sub->id }}').classList.add('hidden')" class="absolute -top-12 right-0 text-white text-3xl">&times;</button>
                                                    <img src="{{ asset('storage/' . $sub->payment_screenshot) }}" class="w-full rounded-2xl shadow-2xl">
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-[9px] italic text-gray-300">No screenshot</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($sub->status === 'active')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Verified</span>
                                        @elseif($sub->status === 'pending')
                                            <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-[9px] font-bold uppercase tracking-widest animate-pulse">Pending Auth</span>
                                        @elseif($sub->status === 'cancelled')
                                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-bold uppercase tracking-widest">Rejected</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg text-[9px] font-bold uppercase tracking-widest">{{ $sub->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        @if($sub->status === 'pending')
                                            <div class="flex items-center justify-end gap-2">
                                                <form action="{{ route('admin.subscriptions.verify', $sub->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-emerald-700 shadow-md shadow-emerald-50">Approve</button>
                                                </form>
                                                <button onclick="const n = prompt('Reason for rejection?'); if(n) { document.getElementById('reject-form-{{ $sub->id }}').querySelector('[name=notes]').value = n; document.getElementById('reject-form-{{ $sub->id }}').submit(); }" class="px-4 py-1.5 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-lg hover:bg-red-50 hover:text-red-500">Reject</button>
                                                <form id="reject-form-{{ $sub->id }}" action="{{ route('admin.subscriptions.reject', $sub->id) }}" method="POST" class="hidden">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="notes">
                                                </form>
                                            </div>
                                        @else
                                            <div class="text-[9px] font-medium text-gray-300 italic">
                                                Verified {{ $sub->verified_at ? $sub->verified_at->diffForHumans() : '' }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No subscription requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($subscriptions->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $subscriptions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
