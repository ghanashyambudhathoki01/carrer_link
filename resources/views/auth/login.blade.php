<x-guest-layout>
    <style>
        .login-card {
            background: #fff;
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 30px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.04);
        }
        .login-title {
            font-size: 1.625rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.03em;
            margin-bottom: 0.25rem;
        }
        .login-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 2rem;
        }
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
        .form-group { margin-bottom: 1.25rem; }
        .form-error {
            font-size: 0.75rem;
            color: #ef4444;
            margin-top: 0.375rem;
        }

        .login-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: #475569;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 16px; height: 16px;
            border-radius: 4px;
            accent-color: #3b82f6;
        }
        .forgot-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #1d4ed8; }

        .btn-login {
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
            position: relative;
            overflow: hidden;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
        }
        .btn-login:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.75rem 0;
        }
        .divider-line {
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }
        .divider-text {
            font-size: 0.7rem;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.1em;
        }

        .register-cta {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }
        .register-cta a {
            color: #3b82f6;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .register-cta a:hover { color: #1d4ed8; }



        .session-status {
            text-align: center;
            font-size: 0.8rem;
            color: #059669;
            background: #ecfdf5;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid #a7f3d0;
        }
    </style>

    <div class="login-card">
        <h1 class="login-title">Welcome back</h1>
        <p class="login-subtitle">Sign in to continue to your account</p>

        <!-- Session Status -->
        @if(session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    class="form-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@company.com"
                >
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    class="form-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="login-row">
                <label for="remember_me" class="remember-label">
                    <input id="remember_me" type="checkbox" name="remember">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">Sign in</button>
        </form>

        <!-- Divider + Register CTA -->
        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">New here?</span>
            <div class="divider-line"></div>
        </div>

        <p class="register-cta">
            Don't have an account? <a href="{{ route('register') }}">Create one free</a>
        </p>


    </div>
</x-guest-layout>