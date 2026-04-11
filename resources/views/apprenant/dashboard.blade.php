<x-admin-layout>
    @section('header', 'Dashboard Apprenant')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body,
        .admin-content {
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f8;
            color: #1a1d23;
        }

        .dash-wrapper {
            padding: 24px 22px;
            max-width: 1650px;
            margin: 0 auto;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .top-bar-left h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1a1d23;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .top-bar-left p {
            font-size: 0.8rem;
            color: #9499a8;
            margin: 3px 0 0;
        }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }

        .stat-card {
            border-radius: 20px;
            padding: 22px 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: transform 0.22s, box-shadow 0.22s;
            cursor: default;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card-1 {
            background: linear-gradient(135deg, #7c6ff7, #5d5fef);
        }

        .stat-card-2 {
            background: linear-gradient(135deg, #3db9e5, #2196f3);
        }

        .stat-card-3 {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-card-4 {
            background: linear-gradient(135deg, #f59e0b, #f7776c);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .stat-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .stat-card-label {
            font-size: 0.78rem;
            font-weight: 500;
            opacity: 0.85;
            margin-bottom: 4px;
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-card-sub {
            font-size: 0.72rem;
            opacity: 0.7;
            margin-top: 6px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #4F6EF7 0%, #06b6d4 100%);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
        }

        .welcome-content h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 8px;
            letter-spacing: -0.5px;
        }

        .welcome-content p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        .welcome-stats {
            display: flex;
            gap: 24px;
        }

        .welcome-stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            display: block;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        /* Quick Actions */
        .quick-actions {
            margin-bottom: 32px;
        }

        .quick-actions h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 20px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .action-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            border: 1.5px solid #f0f1f5;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s;
            color: #1a1d23;
        }

        .action-card:hover {
            border-color: #d4d8ff;
            box-shadow: 0 8px 24px rgba(79, 110, 247, 0.1);
            transform: translateY(-2px);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .action-content h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .action-content p {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 0;
        }

        .action-arrow {
            margin-left: auto;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .action-card:hover .action-arrow {
            background: #4F6EF7;
            color: #fff;
        }

        /* Dashboard Content Layout */
        .dashboard-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .content-left {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .content-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .content-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f0f1f5;
        }

        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 4px;
        }

        .card-header p {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Sessions List */
        .sessions-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .session-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: #f9fafb;
            border-radius: 12px;
            border: 1px solid #f0f1f5;
            transition: background 0.2s;
        }

        .session-item:hover {
            background: #f3f4f8;
        }

        .session-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .session-info h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 4px;
        }

        .session-info p {
            font-size: 0.8rem;
            color: #9499a8;
            margin: 0 0 4px;
        }

        .session-location {
            font-size: 0.75rem;
            color: #4F6EF7;
            font-weight: 600;
        }

        .session-status {
            margin-left: auto;
        }

        /* Available Sessions */
        .available-sessions {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .available-session {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 16px;
            background: #f9fafb;
            border-radius: 12px;
            border: 1px solid #f0f1f5;
        }

        .session-details h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 6px;
        }

        .session-details p {
            font-size: 0.8rem;
            color: #9499a8;
            margin: 0 0 8px;
        }

        .session-meta {
            display: flex;
            gap: 12px;
            font-size: 0.75rem;
            color: #4F6EF7;
            font-weight: 600;
        }

        .btn-enroll {
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-enroll:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 110, 247, 0.3);
        }

        /* Progress Overview */
        .progress-overview {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .progress-circle {
            position: relative;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .progress-percent {
            font-size: 1.4rem;
            font-weight: 800;
            color: #4F6EF7;
            display: block;
        }

        .progress-label {
            font-size: 0.75rem;
            color: #9499a8;
            font-weight: 600;
        }

        .progress-stats {
            display: flex;
            gap: 16px;
            width: 100%;
        }

        .progress-stat {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .progress-stat .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #4F6EF7;
            display: block;
        }

        .progress-stat .stat-label {
            font-size: 0.75rem;
            color: #9499a8;
            font-weight: 600;
        }

        /* Stats List */
        .stats-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-info .stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1d23;
            display: block;
        }

        .stat-info .stat-label {
            font-size: 0.8rem;
            color: #9499a8;
        }

        /* View More */
        .view-more {
            text-align: center;
            margin-top: 16px;
        }

        .view-more a {
            color: #4F6EF7;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .view-more a:hover {
            text-decoration: underline;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            opacity: 0.3;
            margin-bottom: 12px;
            display: block;
            margin-inline: auto;
        }

        .empty-state p {
            margin: 0 0 12px;
        }

        .btn-link {
            color: #4F6EF7;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .w-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            padding: 22px;
            margin-bottom: 16px;
        }

        .w-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .w-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1d23;
        }

        .w-card-sub {
            font-size: 0.75rem;
            color: #9499a8;
            margin-top: 2px;
        }

        .quick-nav {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .nav-btn {
            background: #fff;
            border-radius: 16px;
            padding: 18px 16px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            border: 1.5px solid #f0f1f5;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
            color: #1a1d23 !important;
        }

        .nav-btn:hover {
            border-color: transparent;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            color: #1a1d23 !important;
        }

        .nav-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .nav-btn:hover::before {
            opacity: 1;
        }

        .nav-btn-1::before {
            background: linear-gradient(90deg, #3db9e5, #2196f3);
        }

        .nav-btn-2::before {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .nav-btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn-icon svg {
            width: 20px;
            height: 20px;
        }

        .nav-btn-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1a1d23;
        }

        .nav-btn-desc {
            font-size: 0.72rem;
            color: #9499a8;
            margin-top: 1px;
        }

        .nav-btn-arrow {
            margin-top: auto;
            align-self: flex-end;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.18s;
        }

        .nav-btn:hover .nav-btn-arrow {
            background: #4F6EF7;
            color: #fff;
        }

        .nav-btn-arrow svg {
            width: 12px;
            height: 12px;
        }

        .sessions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sessions-table thead th {
            padding: 8px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #9499a8;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 1px solid #f0f1f5;
            text-align: left;
        }

        .sessions-table tbody tr {
            border-bottom: 1px solid #f5f6fa;
            transition: background 0.12s;
        }

        .sessions-table tbody tr:last-child {
            border-bottom: none;
        }

        .sessions-table tbody tr:hover {
            background: #fafbff;
        }

        .sessions-table tbody td {
            padding: 11px 12px;
            font-size: 0.82rem;
            vertical-align: middle;
        }

        .sess-formation {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sess-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: #fff;
        }

        .sess-name {
            font-weight: 600;
            font-size: 0.82rem;
            color: #1a1d23;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .status-badge .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .badge-valide {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-valide .dot {
            background: #16a34a;
        }

        .badge-en_attente {
            background: #fffbeb;
            color: #b45309;
        }

        .badge-en_attente .dot {
            background: #b45309;
        }

        .badge-rejetee {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-rejetee .dot {
            background: #dc2626;
        }

        @media (max-width: 1100px) {
            .stat-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-content {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dash-wrapper {
                padding: 16px 14px;
            }

            .top-bar-left h1 {
                font-size: 1.3rem;
            }

            .stat-cards {
                grid-template-columns: 1fr;
            }

            .welcome-section {
                padding: 24px;
                flex-direction: column;
                text-align: center;
            }

            .welcome-content h1 {
                font-size: 1.6rem;
            }

            .welcome-stats {
                justify-content: center;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .available-session {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .session-action {
                width: 100%;
            }

            .btn-enroll {
                width: 100%;
            }

            .progress-stats {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>

    <div class="dash-wrapper">

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success" style="background: #f0fdf4; color: #16a34a; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 8px; display: inline;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" style="background: #fef2f2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fecaca;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 8px; display: inline;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if(isset($notifications) && $notifications->count() > 0)
            <div class="w-card" style="margin-bottom: 24px;">
                <div class="w-card-header">
                    <div>
                        <h3 class="w-card-title">Notifications récentes</h3>
                        <div class="w-card-sub">Suivez l'état de vos inscriptions et paiements.</div>
                    </div>
                </div>
                <div class="card-body" style="padding: 16px;">
                    @foreach($notifications as $notification)
                        @php
                            $isInscription = str_contains($notification->title, 'Inscription') || str_contains($notification->title, 'Paiement');
                        @endphp
                        <div class="notif-item {{ $isInscription ? 'inscription-notification' : '' }}" style="margin-bottom: 10px;">
                            <div class="notif-icon {{ $isInscription ? 'inscription-icon' : '' }}" style="min-width: 36px; min-height: 36px;">
                                @if($isInscription)
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                @else
                                    🔔
                                @endif
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">{{ $notification->title }}</div>
                                <div class="notif-msg">{{ $notification->message }}</div>
                                <div class="notif-time">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ── WELCOME SECTION ── --}}
        <div class="welcome-section">
            <div class="welcome-content">
                <h1>Bonjour, {{ auth()->user()->name }} ! 👋</h1>
                <p>Bienvenue sur votre espace d'apprentissage. Voici un aperçu de votre progression.</p>
            </div>
            <div class="welcome-stats">
                <div class="welcome-stat">
                    <div class="stat-number">{{ $enrolledFormations->count() }}</div>
                    <div class="stat-label">Formations actives</div>
                </div>
                <div class="welcome-stat">
                    <div class="stat-number">{{ $activeInscriptions->count() }}</div>
                    <div class="stat-label">Sessions en cours</div>
                </div>
                <div class="welcome-stat">
                    <div class="stat-number">{{ $availableSessions->count() }}</div>
                    <div class="stat-label">Sessions disponibles</div>
                </div>
            </div>
        </div>

        {{-- ── QUICK ACTIONS ── --}}
        <div class="quick-actions">
            <h2>Actions rapides</h2>
            <div class="actions-grid">
                <a href="{{ route('apprenant.inscriptions') }}" class="action-card">
                    <div class="action-icon" style="background: linear-gradient(135deg, #3db9e5, #2196f3);">
                        <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3>S'inscrire à une formation</h3>
                        <p>Découvrez et rejoignez de nouvelles formations</p>
                    </div>
                    <div class="action-arrow">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <a href="{{ route('apprenant.courses') }}" class="action-card">
                    <div class="action-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3>Mes cours</h3>
                        <p>Accédez à vos formations en cours</p>
                    </div>
                    <div class="action-arrow">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <a href="{{ route('apprenant.materials') }}" class="action-card">
                    <div class="action-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3>Matériels de cours</h3>
                        <p>Téléchargez vos ressources pédagogiques</p>
                    </div>
                    <div class="action-arrow">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <a href="{{ route('apprenant.progress') }}" class="action-card">
                    <div class="action-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                        <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3>Ma progression</h3>
                        <p>Suivez vos avancées et résultats</p>
                    </div>
                    <div class="action-arrow">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        {{-- ── DASHBOARD CONTENT ── --}}
        <div class="dashboard-content">

            {{-- LEFT COLUMN --}}
            <div class="content-left">

                {{-- UPCOMING SESSIONS --}}
                <div class="content-card">
                    <div class="card-header">
                        <h3>Sessions à venir</h3>
                        <p>Vos prochaines formations</p>
                    </div>
                    <div class="card-body">
                        @if ($recentInscriptions->isNotEmpty())
                            <div class="sessions-list">
                                @foreach ($recentInscriptions as $inscription)
                                    <div class="session-item">
                                        <div class="session-icon">
                                            <span>{{ strtoupper(substr($inscription->session->formation->titre, 0, 1)) }}</span>
                                        </div>
                                        <div class="session-info">
                                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                                <h4>{{ $inscription->session->formation->titre }}</h4>
                                                @if($inscription->statut === 'validée')
                                                    <span class="status-badge badge-valide">
                                                        <span class="dot"></span>
                                                        Validée
                                                    </span>
                                                @elseif($inscription->statut === 'en_attente')
                                                    <span class="status-badge badge-en_attente">
                                                        <span class="dot"></span>
                                                        En attente
                                                    </span>
                                                @elseif($inscription->statut === 'refusée')
                                                    <span class="status-badge badge-rejetee">
                                                        <span class="dot"></span>
                                                        Refusée
                                                    </span>
                                                @endif
                                            </div>

                                            <p>
                                                {{ \Carbon\Carbon::parse($inscription->session->date_debut)->format('d M Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($inscription->session->date_fin)->format('d M Y') }}
                                            </p>

                                            <span class="session-location">
                                                {{ $inscription->session->lieu ?? 'Lieu non défini' }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($inscriptions->count() > 3)
                                <div class="view-more">
                                    <a href="{{ route('apprenant.inscriptions') }}">Voir toutes mes inscriptions →</a>
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p>Aucune inscription</p>
                                <a href="{{ route('apprenant.inscriptions') }}" class="btn-link">S'inscrire
                                    maintenant</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- AVAILABLE SESSIONS --}}
                <div class="content-card">
                    <div class="card-header">
                        <h3>Formations disponibles</h3>
                        <p>Nouvelles opportunités d'apprentissage</p>
                    </div>
                    <div class="card-body">
                        @if ($availableSessions->isNotEmpty())
                            <div class="available-sessions">
                                @foreach ($availableSessions->take(2) as $session)
                                    <div class="available-session">
                                        <div class="session-details">
                                            <h4>{{ $session->formation->titre }}</h4>
                                            <p>{{ $session->formation->description ? Str::limit($session->formation->description, 60) : 'Formation complète' }}
                                            </p>
                                            <div class="session-meta">
                                                <span>{{ \Carbon\Carbon::parse($session->date_debut)->format('d M Y') }}</span>
                                                <span>{{ $session->capacite - $session->inscriptions()->where('statut', 'valide')->count() }}
                                                    places restantes</span>
                                            </div>
                                        </div>
                                        <div class="session-action">
                                            <form method="POST" action="{{ route('apprenant.inscrire') }}">
                                                @csrf
                                                <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                <button type="submit" class="btn-enroll">S'inscrire</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($availableSessions->count() > 2)
                                <div class="view-more">
                                    <a href="{{ route('apprenant.inscriptions') }}">Voir toutes les formations →</a>
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p>Aucune formation disponible actuellement</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="content-right">

                {{-- PROGRESS OVERVIEW --}}
                <div class="content-card">
                    <div class="card-header">
                        <h3>Ma progression</h3>
                        <p>Aperçu de vos avancées</p>
                    </div>
                    <div class="card-body">
                        <div class="progress-overview">
                            <div class="progress-circle">
                                <svg width="120" height="120" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" stroke="#f0f1f5" stroke-width="8"
                                        fill="none" />

                                    <circle cx="60" cy="60" r="50" stroke="#4F6EF7" stroke-width="8"
                                        fill="none" stroke-dasharray="{{ 2 * 3.14159 * 50 }}"
                                        stroke-dashoffset="{{ 2 * 3.14159 * 50 * (1 - ($progressPercent ?? 0) / 100) }}"
                                        transform="rotate(-90 60 60)" />

                                </svg>

                                <div class="progress-text">
                                    <span class="progress-percent">{{ $progressPercent ?? 0 }}%</span>
                                    <span class="progress-label">Complet</span>
                                </div>
                            </div>
                            <div class="progress-stats">
                                <div class="progress-stat">
                                    <span class="stat-value">{{ $enrolledFormations->count() }}</span>
                                    <span class="stat-label">Formations</span>
                                </div>
                                <div class="progress-stat">
                                    <span class="stat-value">{{ $activeInscriptions->count() }}</span>
                                    <span class="stat-label">Sessions</span>
                                </div>
                                <div class="progress-stat">
                                    <span class="stat-value">{{ $userLevel ?? 'Débutant' }}</span>
                                    <span class="stat-label">Niveau</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- QUICK STATS --}}
                <div class="content-card">
                    <div class="card-header">
                        <h3>Statistiques</h3>
                        <p>Résumé de votre activité</p>
                    </div>
                    <div class="card-body">
                        <div class="stats-list">
                            <div class="stat-item">
                                <div class="stat-icon" style="background: #eff3ff; color: #4F6EF7;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">{{ $enrolledFormations->count() }}</span>
                                    <span class="stat-label">Formations inscrites</span>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon" style="background: #f0fdf4; color: #10b981;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2" />
                                    </svg>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">{{ $activeInscriptions->count() }}</span>
                                    <span class="stat-label">Sessions actives</span>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon" style="background: #fef3e2; color: #f59e0b;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">{{ $availableSessions->count() }}</span>
                                    <span class="stat-label">Sessions disponibles</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</x-admin-layout>
