<x-guest-layout>
    <style>
        .register-card {
            background: #fff;
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 30px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.04);
        }
        .register-title {
            font-size: 1.625rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.03em;
            margin-bottom: 0.25rem;
        }
        .register-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 1.75rem;
        }

        /* ── Role Cards ──────────────────────────────────── */
        .role-section-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.625rem;
            letter-spacing: 0.01em;
        }
        .role-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .role-card {
            position: relative;
            border: 2px solid #e2e8f0;
            border-radius: 0.875rem;
            padding: 1.125rem 1rem;
            cursor: pointer;
            transition: all 0.25s;
            background: #f8fafc;
            text-align: center;
        }
        .role-card:hover {
            border-color: #93c5fd;
            background: #eff6ff;
        }
        .role-card.selected {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0; height: 0;
        }
        .role-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.25s;
        }
        .role-icon svg { width: 20px; height: 20px; }
        .role-card-seeker .role-icon {
            background: #dbeafe;
            color: #2563eb;
        }
        .role-card-seeker.selected .role-icon {
            background: #3b82f6;
            color: #fff;
        }
        .role-card-employer .role-icon {
            background: #d1fae5;
            color: #059669;
        }
        .role-card-employer.selected .role-icon {
            background: #10b981;
            color: #fff;
        }
        .role-card-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.125rem;
        }
        .role-card-desc {
            font-size: 0.7rem;
            color: #94a3b8;
            line-height: 1.3;
        }
        .role-check {
            position: absolute;
            top: 8px; right: 8px;
            width: 20px; height: 20px;
            border-radius: 50%;
            background: #3b82f6;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .role-card.selected .role-check { display: flex; }
        .role-check svg { width: 12px; height: 12px; color: #fff; }

        /* ── Form Fields ─────────────────────────────────── */
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.375rem;
            letter-spacing: 0.01em;
        }
        .form-input {
            width: 100%;
            padding: 0.7rem 0.875rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
            font-family: inherit;
        }
        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
            background: #fff;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-group { margin-bottom: 1.125rem; }
        .form-error {
            font-size: 0.75rem;
            color: #ef4444;
            margin-top: 0.375rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .btn-register {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #3b82f6, #4f46e5);
            cursor: pointer;
            transition: all 0.25s;
            font-family: inherit;
            letter-spacing: 0.01em;
            margin-top: 0.5rem;
        }
        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
        }
        .btn-register:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .divider-text {
            font-size: 0.7rem;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.1em;
        }
        .login-cta {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }
        .login-cta a {
            color: #3b82f6;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .login-cta a:hover { color: #1d4ed8; }

        .terms-text {
            text-align: center;
            font-size: 0.7rem;
            color: #94a3b8;
            margin-top: 1rem;
            line-height: 1.5;
        }
    </style>

    <div class="register-card">
        <h1 class="register-title">Create your account</h1>
        <p class="register-subtitle">Join Nepal's largest career community</p>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Role Selection Cards -->
            <div>
                <label class="role-section-label">I am a</label>
                <div class="role-cards">
                    <label class="role-card role-card-seeker {{ old('role', 'job_seeker') == 'job_seeker' ? 'selected' : '' }}" id="card-seeker">
                        <input type="radio" name="role" value="job_seeker" required {{ old('role', 'job_seeker') == 'job_seeker' ? 'checked' : '' }}>
                        <div class="role-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div class="role-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div class="role-card-title">Job Seeker</div>
                        <div class="role-card-desc">Find your dream job</div>
                    </label>
                    <label class="role-card role-card-employer {{ old('role') == 'employer' ? 'selected' : '' }}" id="card-employer">
                        <input type="radio" name="role" value="employer" required {{ old('role') == 'employer' ? 'checked' : '' }}>
                        <div class="role-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div class="role-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="role-card-title">Employer</div>
                        <div class="role-card-desc">Hire top talent</div>
                    </label>
                </div>
                @error('role') <div class="form-error" style="margin-top:-0.75rem;margin-bottom:1rem">{{ $message }}</div> @enderror
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Full name</label>
                <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@company.com">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <!-- Passwords side-by-side -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 chars">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter">
                    @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <p class="terms-text">
            By creating an account, you agree to our Terms of Service and Privacy Policy.
        </p>

        <!-- Divider + Login CTA -->
        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">Already a member?</span>
            <div class="divider-line"></div>
        </div>

        <p class="login-cta">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </p>
    </div>

    <script>
        // Interactive role card selection
        document.querySelectorAll('.role-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                card.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
</x-guest-layout>
