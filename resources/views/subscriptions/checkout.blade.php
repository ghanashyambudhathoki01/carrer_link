@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        
        {{-- Order Summary --}}
        <div class="flex-1 order-2 md:order-1">
            <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm h-full">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 font-display">Payment Details</h2>
                
                <div class="space-y-6">
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
                        <p class="text-sm text-blue-700 mb-4 font-semibold">1. Scan the QR code below using your bank app or wallet.</p>
                        <div class="bg-white p-4 rounded-xl shadow-inner inline-block mx-auto mb-4 border border-blue-50">
                            <img src="{{ asset('images/kumari_bank_qr.jpg') }}" alt="Kumari Bank QR" class="w-48 h-48 mx-auto">
                        </div>
                        <div class="text-center text-xs text-blue-500 uppercase tracking-widest font-bold">Kumari Bank Ltd.</div>
                    </div>

                    <form action="{{ route('subscriptions.submit', $plan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Transaction Reference / Remark</label>
                                <input type="text" name="payment_reference" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Enter name or reference used in payment">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Payment Screenshot</label>
                                <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-4 text-center">
                                    <input type="file" name="payment_screenshot" required class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2">Upload the confirmation screen of your transaction.</p>
                            </div>

                            <button type="submit" class="w-full py-4 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all mt-4">
                                Confirm & Submit Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="md:w-80 order-1 md:order-2">
            <div class="bg-gray-900 text-white rounded-3xl p-8 sticky top-24">
                <h3 class="text-lg font-bold mb-6">Plan Summary</h3>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-1">Selected Plan</p>
                        <p class="text-xl font-bold">{{ $plan->name }}</p>
                    </div>

                    <div class="border-t border-gray-800 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-400">Duration</span>
                            <span class="text-sm font-bold">{{ $plan->duration_days }} Days</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-400">Job Limits</span>
                            <span class="text-sm font-bold">{{ $plan->max_job_posts == 999 ? 'Unlimited' : $plan->max_job_posts }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-800 pt-6">
                        <div class="flex justify-between items-end">
                            <span class="text-xs text-gray-400 uppercase font-bold">Total Amount</span>
                            <span class="text-3xl font-black text-blue-400">Rs. {{ number_format($plan->price) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10 p-4 bg-white/5 rounded-2xl border border-white/10 text-[10px] text-gray-500 italic leading-relaxed">
                    By confirming, you agree to the payment of Rs. {{ number_format($plan->price) }}. Activation takes up to 24 hours after manual verification.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
