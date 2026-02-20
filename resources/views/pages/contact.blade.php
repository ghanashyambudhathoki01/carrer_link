@extends('layouts.app')
@section('title', 'Contact Us — JobPortal')

@section('content')
<section class="min-h-[85vh] relative overflow-hidden">
    <div class="orb w-96 h-96 bg-secondary top-[5%] right-[-10%]"></div>
    <div class="orb w-72 h-72 bg-primary bottom-[10%] left-[-5%]"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="w-16 h-16 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Contact Us</h1>
            <p class="text-slate-400 max-w-xl mx-auto">Have a question or feedback? We'd love to hear from you.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">
            {{-- Contact Form --}}
            <div class="glass-card p-8">
                <h2 class="text-xl font-bold text-white mb-6">Send us a Message</h2>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">First Name</label>
                            <input type="text" class="form-input" placeholder="John">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Last Name</label>
                            <input type="text" class="form-input" placeholder="Doe">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input type="email" class="form-input" placeholder="you@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Subject</label>
                        <select class="form-input">
                            <option value="">Select a topic</option>
                            <option>General Inquiry</option>
                            <option>Account Issue</option>
                            <option>Job Listing Problem</option>
                            <option>Technical Support</option>
                            <option>Billing & Subscriptions</option>
                            <option>Report a Bug</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                        <textarea rows="5" class="form-input resize-none" placeholder="Tell us how we can help..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center !py-3">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Send Message
                    </button>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="space-y-6">
                <div class="glass-card p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-1">Email Us</h3>
                        <p class="text-slate-400 text-sm">support@jobportal.com</p>
                        <p class="text-slate-400 text-sm">careers@jobportal.com</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-1">Call Us</h3>
                        <p class="text-slate-400 text-sm">+977 9800000000</p>
                        <p class="text-slate-400 text-sm">Mon - Fri, 9am - 6pm</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-1">Visit Us</h3>
                        <p class="text-slate-400 text-sm">Kathmandu, Nepal</p>
                        <p class="text-slate-400 text-sm">Bagmati Province</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-1">Business Hours</h3>
                        <p class="text-slate-400 text-sm">Sunday - Friday: 9:00 AM - 6:00 PM</p>
                        <p class="text-slate-400 text-sm">Saturday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
