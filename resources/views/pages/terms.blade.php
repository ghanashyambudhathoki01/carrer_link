@extends('layouts.app')
@section('title', 'Terms of Service')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-black text-gray-900 font-display mb-4">Terms of <span class="text-emerald-600">Service</span></h1>
            <p class="text-gray-500 font-medium">Last updated: February 21, 2026</p>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-12 leading-relaxed text-gray-600">
            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">1</span>
                    Agreement to Terms
                </h2>
                <p>
                    By accessing or using CareerLink Nepal, you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, you may not access the service.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm">2</span>
                    User Responsibilities
                </h2>
                <div class="space-y-4">
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-2">Accurate Information</h3>
                        <p class="text-xs">Users must provide accurate, current, and complete information during the registration process and maintain the accuracy of such information.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-2">Account Security</h3>
                        <p class="text-xs">You are responsible for safeguarding the password that you use to access CareerLink and for any activities or actions under your password.</p>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm">3</span>
                    Subscription & Payments
                </h2>
                <p class="mb-4">
                    Employers must subscribe to a plan to post job listings. Payments are processed through verified channels and are non-refundable unless otherwise stated.
                </p>
                <ul class="space-y-3 list-disc pl-6 marker:text-emerald-500">
                    <li>Subscriptions are billed according to the plan selected.</li>
                    <li>We reserve the right to change our fees at any time.</li>
                    <li>Failure to pay may result in suspension of employer privileges.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">4</span>
                    Prohibited Conduct
                </h2>
                <p>
                    You agree not to use CareerLink for any unlawful purpose or to solicit others to perform or participate in any unlawful acts. Posting fraudulent jobs or resumes is strictly prohibited and will lead to permanent account termination.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-sm">5</span>
                    Limitation of Liability
                </h2>
                <p>
                    CareerLink Nepal shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of the platform or any job applications processed through our system.
                </p>
            </section>

            <section class="pt-8 border-t border-gray-100">
                <p class="text-sm text-gray-400 text-center italic">
                    By using CareerLink, you acknowledge that you have read and understood these Terms of Service.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
