<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="JobPortal — Find your dream job, internship, or event. Connect with top employers and opportunities.">
    <title>@yield('title', 'JobPortal — Your Career Starts Here')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-slate-200 min-h-screen flex flex-col">

    {{-- ========== NAVBAR ========== --}}
    <nav class="navbar glass" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 no-underline">
                    <div class="w-9 h-9 rounded-lg gradient-primary flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white tracking-tight">Job<span class="gradient-text">Portal</span></span>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('internship') }}" class="nav-link {{ request()->routeIs('internship') ? 'active' : '' }}">Internship</a>
                    <a href="{{ route('jobs') }}" class="nav-link {{ request()->routeIs('jobs') ? 'active' : '' }}">Jobs</a>
                    <a href="{{ route('eventify') }}" class="nav-link {{ request()->routeIs('eventify') ? 'active' : '' }}">Eventify</a>
                    <a href="{{ route('subscriptions') }}" class="nav-link {{ request()->routeIs('subscriptions') ? 'active' : '' }}">Subscriptions</a>
                </div>

                {{-- Auth Buttons (Desktop) --}}
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm !py-2 !px-5 no-underline">Register</a>
                </div>

                {{-- Mobile Hamburger --}}
                <button class="lg:hidden hamburger flex flex-col gap-1.5 p-2" id="hamburger" aria-label="Toggle menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="mobile-menu lg:hidden" id="mobileMenu">
            <div class="px-4 pb-4 pt-2 space-y-1 border-t border-white/5">
                <a href="{{ route('home') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline {{ request()->routeIs('home') ? 'text-white bg-white/5' : '' }}">Home</a>
                <a href="{{ route('internship') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline {{ request()->routeIs('internship') ? 'text-white bg-white/5' : '' }}">Internship</a>
                <a href="{{ route('jobs') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline {{ request()->routeIs('jobs') ? 'text-white bg-white/5' : '' }}">Jobs</a>
                <a href="{{ route('eventify') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline {{ request()->routeIs('eventify') ? 'text-white bg-white/5' : '' }}">Eventify</a>
                <a href="{{ route('subscriptions') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline {{ request()->routeIs('subscriptions') ? 'text-white bg-white/5' : '' }}">Subscriptions</a>
                <hr class="border-white/5 my-2">
                <a href="{{ route('login') }}" class="block py-2.5 px-3 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition no-underline">Login</a>
                <a href="{{ route('register') }}" class="block py-2.5 px-3 rounded-lg gradient-primary text-white text-center transition no-underline">Register</a>
            </div>
        </div>
    </nav>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="flex-1 pt-16 lg:pt-18">
        @yield('content')
    </main>

    {{-- ========== FOOTER ========== --}}
    <footer class="border-t border-white/5 bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg gradient-primary flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">Job<span class="gradient-text">Portal</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">Your gateway to amazing career opportunities. Find jobs, internships, and events that shape your future.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 list-none p-0">
                        <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                        <li><a href="{{ route('jobs') }}" class="footer-link">Browse Jobs</a></li>
                        <li><a href="{{ route('internship') }}" class="footer-link">Internships</a></li>
                        <li><a href="{{ route('eventify') }}" class="footer-link">Events</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 list-none p-0">
                        <li><a href="{{ route('help-center') }}" class="footer-link">Help Center</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="footer-link">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="footer-link">Terms of Service</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Stay Updated</h4>
                    <p class="text-slate-400 text-sm mb-3">Subscribe for the latest job alerts.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Your email" class="form-input !py-2 !text-sm flex-1">
                        <button class="btn-primary !py-2 !px-4 !text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} JobPortal. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-slate-500 hover:text-primary-light transition" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-slate-500 hover:text-primary-light transition" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-slate-500 hover:text-primary-light transition" aria-label="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ========== SCRIPTS ========== --}}
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('open');
        });

        // Close mobile menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('open');
            });
        });
    </script>
</body>
</html>
