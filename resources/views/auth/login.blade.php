<x-guest-layout>
    <style>
        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f8;
        }

        .login-container {
            display: flex;

        }

        /* ───────── LEFT SIDE (Illustration) ───────── */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-left h1 {
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .login-left p {
            opacity: 0.9;
            max-width: 420px;
            font-size: 0.95rem;
        }

        /* ───────── RIGHT SIDE (Form) ───────── */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #f0f2f8;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);

            /* Animation */
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp 0.6s ease forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #1a1d23;
        }

        .login-sub {
            font-size: 0.85rem;
            color: #9499a8;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            padding: 10px 14px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #4F6EF7;
            box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.1);
        }

        .btn-login {
            background: #4F6EF7;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            color: white;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #3f5ce0;
        }

        .login-footer {
            text-align: center;
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 15px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-left {
                display: none;
            }
        }
    </style>

    <div class="login-container">

        <!-- LEFT -->
        <div class="login-left">
            <h1>Welcome Back 👋</h1>
            <p>
                Manage your formations, users and sessions بسهولة واحترافية
                عبر لوحة تحكم FormaPro الحديثة.
            </p>
        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <div class="login-card">

                <div class="login-title">Sign in</div>
                <div class="login-sub">Access your dashboard</div>

                <x-auth-session-status class="mb-3" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>

                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            required>

                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <label class="form-check-label">Remember me</label>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn-login">
                        Login
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-end mt-2">
                            <a href="{{ route('password.request') }}" class="text-muted small">
                                Forgot password?
                            </a>
                        </div>
                    @endif
                </form>

                <div class="login-footer">
                    © {{ date('Y') }} FormaPro
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
