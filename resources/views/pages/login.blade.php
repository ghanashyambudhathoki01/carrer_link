@extends('layouts.app')
@section('title', 'Login — JobPortal')

@section('content')
<section class="min-h-[85vh] flex items-center relative overflow-hidden">
    <div class="orb w-96 h-96 bg-primary top-[10%] left-[-10%]"></div>
    <div class="orb w-72 h-72 bg-secondary bottom-[5%] right-[-5%]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left Illustration --}}
            <div class="hidden lg:block text-center">
                <div class="glass-card p-10 inline-block">
                    <div class="text-7xl mb-6">🔐</div>
                    <h2 class="text-2xl font-bold text-white mb-3">Welcome Back!</h2>
                    <p class="text-slate-400 max-w-sm">Log in to access your dashboard, saved jobs, and application status.</p>
                    <div class="mt-8 grid grid-cols-3 gap-4">
                        <div class="stat-card">
                            <div class="stat-number text-lg">10K+</div>
                            <p class="text-slate-500 text-xs">Jobs</p>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number text-lg">5K+</div>
                            <p class="text-slate-500 text-xs">Companies</p>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number text-lg">95%</div>
                            <p class="text-slate-500 text-xs">Success</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Login Form --}}
            <div class="max-w-md mx-auto w-full lg:mx-0 lg:ml-auto">
                <div class="glass-card p-8">
                    <h2 class="text-2xl font-bold text-white mb-1">Sign In</h2>
                    <p class="text-slate-400 text-sm mb-8">Enter your credentials to continue</p>

                    <form>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                                <input type="email" class="form-input" placeholder="you@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                                <input type="password" class="form-input" placeholder="••••••••">
                            </div>
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 rounded bg-dark-card border-white/10 text-primary accent-primary">
                                    <span class="text-sm text-slate-400">Remember me</span>
                                </label>
                                <a href="#" class="text-sm text-primary-light hover:underline">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn-primary w-full justify-center !py-3">Sign In</button>
                        </div>
                    </form>

                    <div class="flex items-center gap-3 my-6">
                        <div class="flex-1 h-px bg-white/5"></div>
                        <span class="text-slate-500 text-xs uppercase tracking-wider">or continue with</span>
                        <div class="flex-1 h-px bg-white/5"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button class="btn-outline !py-2.5 justify-center text-sm">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                            Google
                        </button>
                        <button class="btn-outline !py-2.5 justify-center text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            GitHub
                        </button>
                    </div>

                    <p class="text-center text-slate-400 text-sm mt-6">
                        Don't have an account? <a href="{{ route('register') }}" class="text-primary-light hover:underline font-medium">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
