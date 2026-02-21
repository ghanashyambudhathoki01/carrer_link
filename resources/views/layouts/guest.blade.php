<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CareerLink') }} – Auth</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, sans-serif; margin: 0; }

        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left Hero Panel ─────────────────────────────────── */
        .auth-hero {
            display: none;
            position: relative;
            width: 45%;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #0f172a 100%);
            overflow: hidden;
            padding: 3rem;
            flex-direction: column;
            justify-content: space-between;
        }
        @media (min-width: 1024px) {
            .auth-hero { display: flex; }
        }

        .hero-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            pointer-events: none;
        }
        .hero-glow-1 {
            width: 300px; height: 300px;
            top: -60px; left: -60px;
            background: #3b82f6;
        }
        .hero-glow-2 {
            width: 250px; height: 250px;
            bottom: 40px; right: -40px;
            background: #10b981;
        }
        .hero-glow-3 {
            width: 180px; height: 180px;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: #6366f1;
            opacity: 0.15;
        }

        .hero-brand {
            position: relative;
            z-index: 2;
        }
        .hero-brand-name {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
        }
        .hero-brand-name span { color: #34d399; }
        .hero-brand-tag {
            margin-top: 0.375rem;
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        .hero-center {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 2rem;
        }
        .hero-headline {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -0.03em;
        }
        .hero-headline .gradient-text {
            background: linear-gradient(135deg, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
        }
        .hero-stat {
            padding: 1rem 0;
        }
        .hero-stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
        }
        .hero-stat-label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 0.125rem;
        }

        .hero-footer {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .hero-dot { width: 6px; height: 6px; border-radius: 50%; }
        .hero-dot-green { background: #34d399; }
        .hero-footer-text {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* ── Floating icons ──────────────────────────────────── */
        .floating-icons {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }
        .float-icon {
            position: absolute;
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatY 6s ease-in-out infinite;
        }
        .float-icon svg { width: 18px; height: 18px; color: rgba(255,255,255,0.2); }
        .float-icon:nth-child(1){ top:18%; left:70%; animation-delay:0s; }
        .float-icon:nth-child(2){ top:35%; left:82%; animation-delay:1.5s; }
        .float-icon:nth-child(3){ top:60%; left:12%; animation-delay:3s; }
        .float-icon:nth-child(4){ top:75%; left:65%; animation-delay:2s; }
        .float-icon:nth-child(5){ top:25%; left:30%; animation-delay:4s; }

        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }

        /* ── Right Form Panel ────────────────────────────────── */
        .auth-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            background: #f8fafc;
            position: relative;
            transition: background-color 0.3s;
        }
        .dark .auth-form-panel {
            background: #0f172a;
        }
        .auth-form-panel::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
            pointer-events: none;
        }
        .dark .auth-form-panel::before {
            background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);
        }

        .auth-form-inner {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }

        /* ── Mobile brand (visible < 1024px) ─────────────────── */
        .mobile-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .mobile-brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mobile-brand-icon svg { width: 20px; height: 20px; color: #fff; }
        .mobile-brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            transition: color 0.3s;
        }
        .dark .mobile-brand-text {
            color: #f8fafc;
        }
        .mobile-brand-text span { color: #10b981; }
        @media (min-width: 1024px) {
            .mobile-brand { display: none; }
        }

        /* ── Fade-in animation ───────────────────────────────── */
        .fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: fadeUp 0.5s ease forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased">
    <div class="auth-wrapper">

        {{-- ═══ Left Hero Panel ═══ --}}
        <div class="auth-hero">
            <div class="hero-glow hero-glow-1"></div>
            <div class="hero-glow hero-glow-2"></div>
            <div class="hero-glow hero-glow-3"></div>

            <div class="floating-icons">
                <div class="float-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                <div class="float-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div class="float-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                <div class="float-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg></div>
                <div class="float-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
            </div>

            <div class="hero-brand">
                <div class="hero-brand-name">Career<span>Link</span></div>
                <div class="hero-brand-tag">Nepal's Premier Job Portal</div>
            </div>

            <div class="hero-center">
                <h1 class="hero-headline">
                    Your next <br><span class="gradient-text">opportunity</span><br>starts here.
                </h1>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number">5K+</div>
                        <div class="hero-stat-label">Active Jobs</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">2K+</div>
                        <div class="hero-stat-label">Companies</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">50K+</div>
                        <div class="hero-stat-label">Job Seekers</div>
                    </div>
                </div>
            </div>

            <div class="hero-footer">
                <div class="hero-dot hero-dot-green"></div>
                <span class="hero-footer-text">Trusted by top employers across Nepal</span>
            </div>
        </div>

        {{-- ═══ Right Form Panel ═══ --}}
        <div class="auth-form-panel">
            <div class="auth-form-inner fade-up">

                {{-- Mobile-only brand --}}
                <div class="mobile-brand">
                    <div class="mobile-brand-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="mobile-brand-text">Career<span>Link</span></span>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>
