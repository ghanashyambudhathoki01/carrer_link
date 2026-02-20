@extends('layouts.app')
@section('title', 'Terms of Service — JobPortal')

@section('content')
<section class="min-h-[85vh] relative overflow-hidden">
    <div class="orb w-96 h-96 bg-secondary top-[5%] right-[-10%]"></div>
    <div class="orb w-72 h-72 bg-primary bottom-[10%] left-[-5%]"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="w-16 h-16 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Terms of Service</h1>
            <p class="text-slate-400">Last updated: {{ date('F d, Y') }}</p>
        </div>

        {{-- Content --}}
        <div class="glass-card p-8 space-y-8">
            <div>
                <h2 class="text-xl font-bold text-white mb-3">1. Acceptance of Terms</h2>
                <p class="text-slate-400 text-sm leading-relaxed">By accessing and using JobPortal, you accept and agree to be bound by these Terms of Service and our Privacy Policy. If you do not agree to these terms, please do not use our platform.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">2. User Accounts</h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-3">When creating an account, you agree to:</p>
                <ul class="text-slate-400 text-sm leading-relaxed space-y-1 list-disc list-inside">
                    <li>Provide accurate, current, and complete registration information</li>
                    <li>Maintain the security of your password and account</li>
                    <li>Accept responsibility for all activities under your account</li>
                    <li>Notify us immediately of any unauthorized use of your account</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">3. Job Listings & Applications</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Employers are responsible for the accuracy of their job listings. Job seekers understand that JobPortal acts as an intermediary and does not guarantee employment. We reserve the right to remove any listing that violates our policies.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">4. Prohibited Conduct</h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-3">Users must not:</p>
                <ul class="text-slate-400 text-sm leading-relaxed space-y-1 list-disc list-inside">
                    <li>Post false, misleading, or fraudulent content</li>
                    <li>Harass, abuse, or discriminate against other users</li>
                    <li>Use automated tools to scrape or collect data from the platform</li>
                    <li>Attempt to gain unauthorized access to other accounts or our systems</li>
                    <li>Violate any applicable local, state, national, or international law</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">5. Intellectual Property</h2>
                <p class="text-slate-400 text-sm leading-relaxed">All content and materials on JobPortal, including logos, design, text, graphics, and software, are the property of JobPortal or its licensors and are protected by intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written consent.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">6. Limitation of Liability</h2>
                <p class="text-slate-400 text-sm leading-relaxed">JobPortal is provided on an "as is" and "as available" basis. We do not warrant that the service will be uninterrupted, secure, or error-free. To the fullest extent permitted by law, JobPortal shall not be liable for any indirect, incidental, special, or consequential damages.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">7. Termination</h2>
                <p class="text-slate-400 text-sm leading-relaxed">We reserve the right to suspend or terminate your account at our sole discretion, without notice, for conduct that we believe violates these Terms or is harmful to other users, us, or third parties, or for any other reason.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">8. Changes to Terms</h2>
                <p class="text-slate-400 text-sm leading-relaxed">We may update these Terms from time to time. We will notify you of any changes by posting the new Terms on this page and updating the "Last Updated" date. Continued use of the platform after changes constitutes acceptance of the modified Terms.</p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-3">9. Contact</h2>
                <p class="text-slate-400 text-sm leading-relaxed">For questions about these Terms, please <a href="{{ route('contact') }}" class="text-primary-light hover:underline">contact us</a> or email <span class="text-primary-light">legal@jobportal.com</span>.</p>
            </div>
        </div>
    </div>
</section>
@endsection
