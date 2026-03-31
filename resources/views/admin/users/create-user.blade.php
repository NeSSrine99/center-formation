<x-admin-layout>
    @section('header', 'Créer un Utilisateur')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body,
        .admin-content {
            font-family: 'DM Sans', sans-serif;
            background: #f5f6fa;
            color: #1a1d23;
        }

        /* ── Wrapper ── */
        .create-wrapper {
            padding: 24px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* ── Page Header ── */
        .page-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .back-btn {
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #4b5563;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.18s;
        }

        .back-btn:hover {
            border-color: #4F6EF7;
            color: #4F6EF7;
        }

        .back-btn svg {
            width: 16px;
            height: 16px;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1d23;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .page-sub {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
        }

        /* ── Form Card ── */
        .form-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            padding: 32px;
        }

        .form-section-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #9499a8;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f1f5;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 11px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            /* prevents iOS zoom */
            color: #1a1d23;
            background: #fff;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s;
            -webkit-appearance: none;
            appearance: none;
        }

        .form-control::placeholder {
            color: #c1c5cf;
        }

        .form-control:focus {
            border-color: #4F6EF7;
            box-shadow: 0 0 0 3px rgba(79, 110, 247, .12);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .12);
        }

        .invalid-feedback {
            font-size: 0.77rem;
            color: #ef4444;
            margin-top: 2px;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #c1c5cf;
            width: 15px;
            height: 15px;
            pointer-events: none;
        }

        .input-icon-wrap .form-control {
            padding-left: 36px;
        }

        .divider {
            height: 1px;
            background: #f0f1f5;
            margin: 20px 0;
        }

        /* Role pills */
        .role-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .role-pill input {
            display: none;
        }

        .role-pill label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            color: #4b5563;
            background: #fff;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .role-pill label .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #6b7280;
        }

        .dot-administrateur {
            background: #dc2626;
        }

        .dot-formateur {
            background: #2563eb;
        }

        .dot-apprenant {
            background: #16a34a;
        }

        .role-pill input:checked+label {
            border-color: #4F6EF7;
            background: #eff3ff;
            color: #4F6EF7;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 26px;
            flex-wrap: wrap;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 12px 24px;
            border-radius: 10px;
            background: #4F6EF7;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.18s;
        }

        .btn-submit:hover {
            background: #3a57e8;
            box-shadow: 0 4px 14px rgba(79, 110, 247, .35);
            transform: translateY(-1px);
        }

        .btn-submit svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #4b5563;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.18s;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #1a1d23;
        }

        /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */

        /* Tablet ≤ 768px */
        @media (max-width: 768px) {
            .create-wrapper {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .form-card {
                padding: 24px 20px;
            }
        }

        /* Mobile ≤ 580px */
        @media (max-width: 580px) {
            .create-wrapper {
                padding: 16px 12px;
            }

            .page-title {
                font-size: 1.15rem;
            }

            .page-sub {
                font-size: 0.74rem;
            }

            .form-card {
                padding: 18px 14px;
                border-radius: 14px;
            }

            /* Single column */
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            /* Role pills grid */
            .role-pills {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .role-pill label {
                justify-content: center;
            }

            /* Buttons full width */
            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }

        /* Tiny ≤ 360px */
        @media (max-width: 360px) {
            .back-btn {
                width: 34px;
                height: 34px;
            }

            .page-title {
                font-size: 1rem;
            }
        }
    </style>

    <div class="create-wrapper">

        {{-- Page Header --}}
        <div class="page-header">
            <a href="{{ route('admin.users') }}" class="back-btn" title="Retour">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <div class="page-title">Nouvel Utilisateur</div>
                <div class="page-sub">Remplissez les champs pour créer un compte</div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('admin.store-user') }}" method="POST" novalidate>
                @csrf

                {{-- Section: Personal --}}
                <div class="form-section-title">Informations Personnelles</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="name">Nom complet</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input type="text" name="name" id="name" autocomplete="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Ahmed Ben Ali">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Adresse Email</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="ahmed@example.com">
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section: Security --}}
                <div class="divider"></div>
                <div class="form-section-title">Sécurité</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Mot de passe</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <input type="password" name="password" id="password" autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirmer</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                autocomplete="new-password" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                {{-- Section: Role --}}
                <div class="divider"></div>
                <div class="form-section-title">Rôle & Permissions</div>
                <div class="form-group">
                    <label class="form-label">Sélectionner un rôle</label>
                    <div class="role-pills">
                        @foreach ($roles as $role)
                            <div class="role-pill">
                                <input type="radio" name="role_id" id="role_{{ $role->id }}"
                                    value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'checked' : '' }}>
                                <label for="role_{{ $role->id }}">
                                    <span class="dot dot-{{ $role->name }}"></span>
                                    {{ ucfirst($role->name) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('role_id')
                        <div class="invalid-feedback" style="display:block;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer l'Utilisateur
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
