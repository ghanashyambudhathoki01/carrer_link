@extends('layouts.app')
@section('title', 'Register — JobPortal')

@section('content')
<section class="min-h-[85vh] flex items-center relative overflow-hidden">
    <div class="orb w-96 h-96 bg-secondary top-[5%] right-[-10%]"></div>
    <div class="orb w-72 h-72 bg-primary bottom-[10%] left-[-5%]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="max-w-md mx-auto w-full lg:mx-0">
                <div class="glass-card p-8">
                    <h2 class="text-2xl font-bold text-white mb-1">Create Account</h2>
                    <p class="text-slate-400 text-sm mb-8">Join thousands of professionals on JobPortal</p>
                    <form>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">I am a</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="glass-card !p-3 !rounded-xl cursor-pointer border-2 border-transparent has-[:checked]:border-primary transition text-center">
                                        <input type="radio" name="role" value="seeker" class="sr-only" checked>
                                        <div class="text-2xl mb-1">🧑‍💻</div>
                                        <span class="text-sm text-white font-medium">Job Seeker</span>
                                    </label>
                                    <label class="glass-card !p-3 !rounded-xl cursor-pointer border-2 border-transparent has-[:checked]:border-primary transition text-center">
                                        <input type="radio" name="role" value="employer" class="sr-only">
                                        <div class="text-2xl mb-1">🏢</div>
                                        <span class="text-sm text-white font-medium">Employer</span>
                                    </label>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
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
                                <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                                <input type="password" class="form-input" placeholder="Min. 8 characters">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                                <input type="password" class="form-input" placeholder="••••••••">
                            </div>
                            <label class="flex items-start gap-2 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 mt-0.5 rounded accent-primary">
                                <span class="text-sm text-slate-400">I agree to the <a href="{{ route('terms') }}" class="text-primary-light hover:underline">Terms</a> and <a href="{{ route('privacy-policy') }}" class="text-primary-light hover:underline">Privacy Policy</a></span>
                            </label>
                            <button type="submit" class="btn-primary w-full justify-center !py-3">Create Account</button>
                        </div>
                    </form>
                    <p class="text-center text-slate-400 text-sm mt-6">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary-light hover:underline font-medium">Sign In</a>
                    </p>
                </div>
            </div>
            <div class="hidden lg:block text-center">
                <div class="glass-card p-10 inline-block">
                    <div class="text-7xl mb-6">🚀</div>
                    <h2 class="text-2xl font-bold text-white mb-3">Start Your Journey</h2>
                    <p class="text-slate-400 max-w-sm mb-8">Create your profile and start applying to thousands of opportunities.</p>
                    <div class="space-y-4 text-left">
                        @foreach(['Access 10,000+ job listings', 'Get personalized job alerts', 'Track your applications', 'Connect with top employers'] as $b)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-green-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-slate-300 text-sm">{{ $b }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
