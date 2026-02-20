@extends('layouts.app')
@section('title', 'Privacy Policy — JobPortal')

@section('content')
<section class="min-h-[85vh] relative overflow-hidden">
    <div class="orb w-96 h-96 bg-secondary top-[5%] right-[-10%]"></div>
    <div class="orb w-72 h-72 bg-primary bottom-[10%] left-[-5%]"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="w-16 h-16 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Privacy Policy</h1>
            <p class="text-slate-400">Last updated: {{ date('F d, Y') }}</p>
        </div>

        {{-- Content --}}
        <div class="glass-card p-8 space-y-8">
            <div>
                <h2 class="text-xl font-bold text-white mb-3">1. Information We Collect</h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-3">We collect information you provide directly to us when you create an account, fill out a form, apply for a job, or communicate with us. This includes:</p>
                <ul class="text-slate-400 text-sm leading-relaxed space-y-1 list-disc list-inside">
                    <li>Name, email address, and contact information</li>
                    <li>Resume, cover letter, and professional qualifications</li>
                    <li>Employment history and education details</li>
                    <li>Account preferences and settings</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">2. How We Use Your Information</h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-3">We use the information we collect to:</p>
                <ul class="text-slate-400 text-sm leading-relaxed space-y-1 list-disc list-inside">
                    <li>Provide, maintain, and improve our services</li>
                    <li>Match you with relevant job opportunities</li>
                    <li>Send you notifications about new jobs, internships, and events</li>
                    <li>Process your applications and manage your account</li>
                    <li>Communicate with you about our services</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">3. Information Sharing</h2>
                <p class="text-slate-400 text-sm leading-relaxed">We do not sell your personal information to third parties. We may share your information with employers when you apply for a job, with service providers who assist us in operating our platform, and when required by law.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">4. Data Security</h2>
                <p class="text-slate-400 text-sm leading-relaxed">We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. This includes encryption, secure servers, and regular security audits.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">5. Cookies & Tracking</h2>
                <p class="text-slate-400 text-sm leading-relaxed">We use cookies and similar tracking technologies to enhance your experience, analyze site usage, and assist in our marketing efforts. You can control cookie settings through your browser preferences.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">6. Your Rights</h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-3">You have the right to:</p>
                <ul class="text-slate-400 text-sm leading-relaxed space-y-1 list-disc list-inside">
                    <li>Access and receive a copy of your personal data</li>
                    <li>Rectify or update your information</li>
                    <li>Request deletion of your account and associated data</li>
                    <li>Opt out of marketing communications</li>
                    <li>Withdraw consent at any time</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">7. Contact Us</h2>
                <p class="text-slate-400 text-sm leading-relaxed">If you have questions about this Privacy Policy, please <a href="{{ route('contact') }}" class="text-primary-light hover:underline">contact us</a> or email us at <span class="text-primary-light">privacy@jobportal.com</span>.</p>
            </div>
        </div>
    </div>
</section>
@endsection
