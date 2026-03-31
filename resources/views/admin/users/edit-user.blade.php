<x-admin-layout>
    @section('header', 'Modifier: ' . $user->name)

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
        .edit-wrapper {
            padding: 24px 20px;
            max-width: 1100px;
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

        /* ══════════════════════════════
       DESKTOP LAYOUT > 900px
       Sidebar profile + form
    ══════════════════════════════ */
        .layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 20px;
            align-items: start;
        }

        /* ── Profile Card (desktop: vertical) ── */
        .profile-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            padding: 28px 20px;
            text-align: center;
        }

        .profile-avatar {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin: 0 auto 12px;
            flex-shrink: 0;
        }

        .profile-name {
            font-weight: 700;
            font-size: 0.97rem;
            color: #1a1d23;
        }

        .profile-email {
            font-size: 0.76rem;
            color: #9499a8;
            margin-top: 3px;
            word-break: break-all;
        }

        .profile-divider {
            height: 1px;
            background: #f0f1f5;
            margin: 16px 0;
        }

        .profile-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            margin-bottom: 10px;
            text-align: left;
        }

        .meta-label {
            color: #9499a8;
        }

        .meta-value {
            font-weight: 600;
            color: #374151;
        }

        /* Badges */
        .badge-mini {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 16px;
            font-size: 0.74rem;
            font-weight: 600;
        }

        .badge-mini .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .badge-admin {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-admin .dot {
            background: #dc2626;
        }

        .badge-formateur {
            background: #eff6ff;
            color: #2563eb;
        }

        .badge-formateur .dot {
            background: #2563eb;
        }

        .badge-apprenant {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-apprenant .dot {
            background: #16a34a;
        }

        /* Desktop meta: shown only on desktop */
        .desktop-meta {
            display: block;
        }

        /* ── Form Card ── */
        .form-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            padding: 28px 26px;
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
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
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
            margin: 18px 0;
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
            padding: 9px 15px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            font-size: 0.84rem;
            font-weight: 500;
            cursor: pointer;
            color: #4b5563;
            background: #fff;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .role-pill label .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
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
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 12px 22px;
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
       TABLET  ≤ 900px
       Profile becomes horizontal strip
    ══════════════════════════════ */
        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .profile-card {
                display: flex;
                align-items: center;
                gap: 16px;
                text-align: left;
                padding: 18px 20px;
            }

            .profile-avatar {
                margin: 0;
                width: 54px;
                height: 54px;
                font-size: 1.15rem;
            }

            .profile-info {
                flex: 1;
                min-width: 0;
            }

            /* Hide desktop vertical meta on tablet */
            .profile-divider {
                display: none;
            }

            .desktop-meta {
                display: none;
            }

            /* Show horizontal badge strip */
            .mobile-meta-strip {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
                margin-top: 6px;
                align-items: center;
            }

            .mobile-meta-item {
                display: flex;
                flex-direction: column;
                gap: 1px;
            }

            .mobile-meta-item .meta-label {
                font-size: 0.68rem;
                color: #9499a8;
            }

            .mobile-meta-item .meta-value {
                font-size: 0.8rem;
                font-weight: 600;
                color: #374151;
            }

            .form-card {
                padding: 22px 18px;
            }
        }

        /* ══════════════════════════════
       MOBILE  ≤ 580px
    ══════════════════════════════ */
        @media (max-width: 580px) {
            .edit-wrapper {
                padding: 16px 12px;
            }

            .page-title {
                font-size: 1.15rem;
            }

            .page-sub {
                font-size: 0.74rem;
            }

            .profile-card {
                gap: 12px;
                padding: 14px;
                border-radius: 14px;
            }

            .profile-avatar {
                width: 46px;
                height: 46px;
                font-size: 1rem;
            }

            .profile-name {
                font-size: 0.9rem;
            }

            .profile-email {
                font-size: 0.72rem;
            }

            .mobile-meta-strip {
                gap: 10px;
            }

            /* Single column form */
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-card {
                padding: 18px 14px;
                border-radius: 14px;
            }

            /* Role pills grid */
            .role-pills {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(115px, 1fr));
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

        /* ══════════════════════════════
       TINY  ≤ 360px
    ══════════════════════════════ */
        @media (max-width: 360px) {
            .back-btn {
                width: 34px;
                height: 34px;
            }

            .page-title {
                font-size: 1rem;
            }

            .mobile-meta-strip {
                flex-direction: column;
                gap: 6px;
            }
        }

        /* On desktop, hide the mobile meta strip */
        .mobile-meta-strip {
            display: none;
        }
    </style>

    @php
        $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899'];
        $avatarColor = $colors[$user->id % count($colors)];
        $initials = strtoupper(substr($user->name, 0, 1));
        $roleName = $user->role->name ?? 'apprenant';
        $badgeClass = match ($roleName) {
            'administrateur' => 'badge-admin',
            'formateur' => 'badge-formateur',
            default => 'badge-apprenant',
        };
        $dotColors = ['administrateur' => '#dc2626', 'formateur' => '#2563eb', 'apprenant' => '#16a34a'];
    @endphp

    <div class="edit-wrapper">

        {{-- Page Header --}}
        <div class="page-header">
            <a href="{{ route('admin.users') }}" class="back-btn" title="Retour">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <div class="page-title">Modifier l'Utilisateur</div>
                <div class="page-sub">Mettez à jour les informations de <strong>{{ $user->name }}</strong></div>
            </div>
        </div>

        <div class="layout">

            {{-- ════════ PROFILE CARD ════════ --}}
            <div class="profile-card">
                {{-- Avatar --}}
                <div class="profile-avatar" style="background:{{ $avatarColor }}">{{ $initials }}</div>

                {{-- Info block (name + email + mobile meta strip) --}}
                <div class="profile-info">
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-email">{{ $user->email }}</div>

                    {{-- Mobile/tablet: horizontal strip --}}
                    <div class="mobile-meta-strip">
                        <div class="mobile-meta-item">
                            <span class="meta-label">Rôle</span>
                            <span class="badge-mini {{ $badgeClass }}">
                                <span class="dot"></span>{{ ucfirst($roleName) }}
                            </span>
                        </div>
                        <div class="mobile-meta-item">
                            <span class="meta-label">ID</span>
                            <span class="meta-value">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="mobile-meta-item">
                            <span class="meta-label">Créé le</span>
                            <span class="meta-value">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Desktop only: divider + vertical meta --}}
                <div class="profile-divider" style="width:100%;"></div>
                <div class="desktop-meta" style="width:100%;">
                    <div class="profile-meta-row">
                        <span class="meta-label">Rôle</span>
                        <span class="badge-mini {{ $badgeClass }}">
                            <span class="dot"></span>{{ ucfirst($roleName) }}
                        </span>
                    </div>
                    <div class="profile-meta-row">
                        <span class="meta-label">ID</span>
                        <span class="meta-value">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="profile-meta-row">
                        <span class="meta-label">Créé le</span>
                        <span class="meta-value">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- ════════ FORM CARD ════════ --}}
            <div class="form-card">
                <form action="{{ route('admin.update-user', $user->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Personal Info --}}
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
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
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
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="divider"></div>
                    <div class="form-section-title">Rôle & Permissions</div>
                    <div class="form-group">
                        <div class="role-pills">
                            @foreach ($roles as $role)
                                @php $dc = $dotColors[$role->name] ?? '#6b7280'; @endphp
                                <div class="role-pill">
                                    <input type="radio" name="role_id" id="role_{{ $role->id }}"
                                        value="{{ $role->id }}"
                                        {{ old('role_id', $user->role_id) == $role->id ? 'checked' : '' }}>
                                    <label for="role_{{ $role->id }}">
                                        <span class="dot" style="background:{{ $dc }}"></span>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Mettre à Jour
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn-cancel">Annuler</a>
                    </div>
                </form>
            </div>

        </div>{{-- /.layout --}}
    </div>{{-- /.edit-wrapper --}}
</x-admin-layout>
