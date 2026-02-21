@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-black text-gray-900 font-display mb-4">Privacy <span class="text-blue-600">Policy</span></h1>
            <p class="text-gray-500 font-medium">Last updated: February 21, 2026</p>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-12 leading-relaxed">
            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm">1</span>
                    Introduction
                </h2>
                <p class="text-gray-600">
                    At CareerLink Nepal, we take your privacy seriously. This Privacy Policy explains how we collect, use, and share your personal information when you use our job portal. By using CareerLink, you agree to the terms of this policy.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">2</span>
                    Information We Collect
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-2">For Job Seekers</h3>
                        <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                            <li>Name, email, and contact details</li>
                            <li>Profile information and resumes</li>
                            <li>Application history</li>
                            <li>Skills and preferences</li>
                        </ul>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-2">For Employers</h3>
                        <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                            <li>Company details and branding</li>
                            <li>Contact information</li>
                            <li>Job posting data</li>
                            <li>Payment history</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm">3</span>
                    How We Use Your Information
                </h2>
                <p class="text-gray-600 mb-4">
                    We use the collected data to provide and improve our services:
                </p>
                <ul class="space-y-3 text-gray-600 list-disc pl-6 marker:text-blue-500">
                    <li>To facilitate job applications between seekers and employers.</li>
                    <li>To personalize your job search experience.</li>
                    <li>To send notifications about application status updates.</li>
                    <li>To process payments and verify subscriptions.</li>
                    <li>To improve our platform's security and performance.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">4</span>
                    Data Security
                </h2>
                <p class="text-gray-600">
                    We implement industry-standard security measures to protect your data. However, no method of transmission over the internet is 100% secure. We strive to use commercially acceptable means to protect your personal information but cannot guarantee its absolute security.
                </p>
            </section>

            <section class="pt-8 border-t border-gray-100">
                <p class="text-sm text-gray-400 text-center italic">
                    If you have any questions about this Privacy Policy, please contact us at <a href="mailto:info@careerlink.com.np" class="text-blue-600 hover:underline">info@careerlink.com.np</a>.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
