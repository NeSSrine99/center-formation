<x-guest-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            width: 100%;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .login-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a1d23;
            margin-bottom: 8px;
        }

        .login-sub {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-control {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 12px 14px;
            font-size: 0.95rem;
            background: #fff;
            color: #1a1d23;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f6ef7;
            box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.08);
        }

        .form-control:hover {
            border-color: #ced4da;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
            accent-color: #4f6ef7;
        }

        .form-check-input:hover {
            border-color: #adb5bd;
        }

        .form-check-input:checked {
            border-color: #4f6ef7;
            background: #4f6ef7;
        }

        .form-check-label {
            color: #495057;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background: #4f6ef7;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: #3f5ce0;
            box-shadow: 0 4px 12px rgba(79, 110, 247, 0.25);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .login-footer {
            text-align: center;
            font-size: 0.85rem;
            color: #adb5bd;
            margin-top: 18px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 4px;
            display: block;
        }

        .small {
            font-size: 0.8rem;
        }

        .text-end {
            text-align: right;
            margin-top: 12px;
        }

        .text-end a {
            color: #4f6ef7;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .text-end a:hover {
            color: #3f5ce0;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .login-card {
                padding: 28px 20px;
            }

            .login-title {
                font-size: 1.4rem;
            }
        }
    </style>

    <div class="login-container">
        <div class="login-card">

            <div class="login-title">Sign in</div>
            <div class="login-sub">Access your dashboard</div>

            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required>

                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                        required>

                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <!-- Button -->
                <button type="submit" class="btn-login">
                    Sign in
                </button>

                @if (Route::has('password.request'))
                    <div class="text-end">
                        <a href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    </div>
                @endif
            </form>

            <div class="login-footer">
                © {{ date('Y') }} FormaPro. All rights reserved.
            </div>
        </div>
    </div>
</x-guest-layout>
