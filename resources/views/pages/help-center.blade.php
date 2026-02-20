@extends('layouts.app')
@section('title', 'Help Center — JobPortal')

@section('content')
<section class="min-h-[85vh] relative overflow-hidden">
    <div class="orb w-96 h-96 bg-secondary top-[5%] right-[-10%]"></div>
    <div class="orb w-72 h-72 bg-primary bottom-[10%] left-[-5%]"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="w-16 h-16 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Help Center</h1>
            <p class="text-slate-400 max-w-xl mx-auto">Find answers to common questions and get the support you need.</p>
        </div>

        {{-- FAQ Accordions --}}
        <div class="space-y-4">
            @php
                $faqs = [
                    ['q' => 'How do I create an account?', 'a' => 'Click the "Register" button in the top navigation bar. Choose whether you are a Job Seeker or Employer, fill in your details, and submit. You will receive a confirmation email to activate your account.'],
                    ['q' => 'How do I search for jobs?', 'a' => 'Navigate to the "Jobs" page from the main menu. Use the search bar and filters to narrow down results by title, location, category, or experience level. Click on any listing to view full details and apply.'],
                    ['q' => 'How do I apply for a job?', 'a' => 'Once you find a job you are interested in, click "Apply Now" on the job detail page. Make sure your profile and resume are up to date before applying. You can track all your applications from your dashboard.'],
                    ['q' => 'How do I post a job as an employer?', 'a' => 'Register as an Employer, then navigate to your dashboard. Click "Post a Job", fill in the job details including title, description, requirements, and salary range. Your listing will be reviewed and published shortly.'],
                    ['q' => 'How do I find internships?', 'a' => 'Visit the "Internship" page from the navigation menu. Browse available internships filtered by field, duration, and location. Each listing includes details about the company and application requirements.'],
                    ['q' => 'How can I reset my password?', 'a' => 'Click "Login" and then select "Forgot Password". Enter your registered email address and we will send you a password reset link. Follow the link to set a new password.'],
                    ['q' => 'How do I contact support?', 'a' => 'You can reach our support team through the Contact Us page. Fill out the contact form with your query and we will respond within 24-48 business hours. You can also email us at support@jobportal.com.'],
                    ['q' => 'What are Subscriptions?', 'a' => 'Subscriptions give you access to premium features like priority job alerts, advanced search filters, resume boosting, and direct messaging with employers. Visit the Subscriptions page to explore available plans.'],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="glass-card overflow-hidden" x-data="{ open: false }">
                <button onclick="this.parentElement.classList.toggle('faq-open'); this.querySelector('.faq-icon').classList.toggle('rotate-45')"
                    class="w-full flex items-center justify-between p-5 text-left">
                    <span class="text-white font-medium pr-4">{{ $faq['q'] }}</span>
                    <svg class="faq-icon w-5 h-5 text-primary-light shrink-0 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <div class="faq-answer px-5 pb-0 max-h-0 overflow-hidden transition-all duration-300">
                    <p class="text-slate-400 text-sm leading-relaxed pb-5">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Still need help --}}
        <div class="glass-card p-8 text-center mt-12">
            <h3 class="text-xl font-bold text-white mb-2">Still need help?</h3>
            <p class="text-slate-400 text-sm mb-5">Our support team is ready to assist you.</p>
            <a href="{{ route('contact') }}" class="btn-primary inline-flex items-center gap-2 no-underline">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Contact Us
            </a>
        </div>
    </div>
</section>

<style>
    .faq-open .faq-answer { max-height: 200px; }
</style>
@endsection
