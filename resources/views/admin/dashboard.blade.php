<x-admin-layout>
    @section('header', 'Dashboard')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body,
        .admin-content {
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f8;
            color: #1a1d23;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       WRAPPER
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .dash-wrapper {
            padding: 24px 22px;
            max-width: 1650px;
            margin: 0 auto;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       TOP BAR
    ━━━━━━━━━━━━━━━━━━━━━━ */
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

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 0.82rem;
            font-weight: 500;
            color: #4b5563;
        }

        .date-badge svg {
            width: 14px;
            height: 14px;
            color: #9499a8;
        }

        .notif-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff;
            border: 1.5px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all 0.18s;
        }

        .notif-btn:hover {
            border-color: #4F6EF7;
        }

        .notif-btn svg {
            width: 16px;
            height: 16px;
            color: #6b7280;
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #fff;
            position: absolute;
            top: 6px;
            right: 6px;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       GRADIENT STAT CARDS
    ━━━━━━━━━━━━━━━━━━━━━━ */
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
            background: linear-gradient(135deg, #f76c8f, #ee4266);
        }

        .stat-card-4 {
            background: linear-gradient(135deg, #f79f57, #f7776c);
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

        .stat-card-icon svg {
            width: 22px;
            height: 22px;
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

        .stat-card-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 0.72rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .stat-card-trend svg {
            width: 10px;
            height: 10px;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       MAIN GRID (chart + donut + quick nav)
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 16px;
            margin-bottom: 16px;
        }

        /* ── White Card base ── */
        .w-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            padding: 22px;
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

        /* ── Chart area ── */
        .chart-card {}

        .chart-tabs {
            display: flex;
            gap: 4px;
            background: #f0f2f8;
            border-radius: 8px;
            padding: 3px;
        }

        .chart-tab {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: transparent;
            color: #9499a8;
            transition: all 0.18s;
            font-family: 'DM Sans', sans-serif;
        }

        .chart-tab.active {
            background: #fff;
            color: #4F6EF7;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        }

        .chart-summary {
            display: flex;
            gap: 28px;
            margin-bottom: 16px;
        }

        .chart-kpi-label {
            font-size: 0.72rem;
            color: #9499a8;
            margin-bottom: 3px;
        }

        .chart-kpi-value {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1a1d23;
            letter-spacing: -0.5px;
        }

        .chart-canvas-wrap {
            position: relative;
            height: 180px;
            width: 100%;
        }

        canvas#activityChart {
            width: 100% !important;
            height: 100% !important;
        }

        .chart-legend {
            display: flex;
            gap: 16px;
            margin-top: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        /* ── Donut / analytics card ── */
        .donut-card {}

        .donut-wrap {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 16px;
        }

        canvas#donutChart {
            width: 100% !important;
            height: 100% !important;
        }

        .donut-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .donut-center-val {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1d23;
        }

        .donut-center-lbl {
            font-size: 0.65rem;
            color: #9499a8;
        }

        .donut-legend {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .donut-leg-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.78rem;
        }

        .donut-leg-left {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
        }

        .donut-leg-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
        }

        .donut-leg-val {
            font-weight: 700;
            color: #1a1d23;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       QUICK NAV BUTTONS
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .quick-nav {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
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
        }

        .nav-btn:hover {
            border-color: transparent;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
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
            background: linear-gradient(90deg, #7c6ff7, #5d5fef);
        }

        .nav-btn-2::before {
            background: linear-gradient(90deg, #3db9e5, #2196f3);
        }

        .nav-btn-3::before {
            background: linear-gradient(90deg, #f76c8f, #ee4266);
        }

        .nav-btn-4::before {
            background: linear-gradient(90deg, #0ea5e9, #0284c7);
        }

        .nav-btn-5::before {
            background: linear-gradient(90deg, #f79f57, #f7776c);
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

        /* ━━━━━━━━━━━━━━━━━━━━━━
       BOTTOM GRID
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Activity list */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #f5f6fa;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon svg {
            width: 16px;
            height: 16px;
        }

        .activity-icon-blue {
            background: #eff3ff;
            color: #4F6EF7;
        }

        .activity-icon-green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .activity-icon-red {
            background: #fef2f2;
            color: #dc2626;
        }

        .activity-icon-amber {
            background: #fef3c7;
            color: #f59e0b;
        }

        .activity-icon-purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .activity-body {
            flex: 1;
            min-width: 0;
        }

        .activity-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1a1d23;
        }

        .activity-desc {
            font-size: 0.75rem;
            color: #9499a8;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .activity-time {
            font-size: 0.72rem;
            color: #c1c5cf;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* Sessions table */
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

        .badge-ouverte {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-ouverte .dot {
            background: #16a34a;
        }

        .badge-fermee {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-fermee .dot {
            background: #dc2626;
        }

        .view-all-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #4F6EF7;
            text-decoration: none;
            transition: gap 0.18s;
        }

        .view-all-link:hover {
            gap: 8px;
        }

        .view-all-link svg {
            width: 13px;
            height: 13px;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━
       RESPONSIVE
    ━━━━━━━━━━━━━━━━━━━━━━ */
        @media (max-width: 1100px) {
            .stat-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            .quick-nav {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dash-wrapper {
                padding: 16px 14px;
            }

            .top-bar-left h1 {
                font-size: 1.3rem;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .quick-nav {
                grid-template-columns: repeat(2, 1fr);
            }

            .chart-summary {
                gap: 16px;
            }
        }

        @media (max-width: 540px) {
            .stat-cards {
                grid-template-columns: 1fr;
            }

            .quick-nav {
                grid-template-columns: 1fr 1fr;
            }

            .top-bar-right {
                gap: 6px;
            }

            .date-badge span {
                display: none;
            }
        }

        @media (max-width: 380px) {
            .quick-nav {
                grid-template-columns: 1fr;
            }

            .stat-card-value {
                font-size: 1.6rem;
            }
        }
    </style>

    @php
        $totalUsers = \App\Models\User::count();
        $formateurs = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'formateur'))->count();
        $apprenants = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'apprenant'))->count();
        $formations = \App\Models\Formation::count();
        $sessions = \App\Models\FormationSession::with('formation')->latest()->limit(5)->get();
        $topFormations = \App\Models\Formation::withCount('sessions')
            ->orderBy('sessions_count', 'desc')
            ->limit(5)
            ->get();
        $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6'];
    @endphp

    <div class="dash-wrapper">

        {{-- ── TOP BAR ── --}}
        <div class="top-bar">
            <div class="top-bar-left">
                <h1>Dashboard</h1>
                <p>Bienvenue sur votre centre de formation 👋</p>
            </div>
            <div class="top-bar-right">
                <div class="date-badge">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
                <div class="notif-btn">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="notif-dot"></span>
                </div>
            </div>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="stat-cards">
            {{-- Users --}}
            <div class="stat-card stat-card-1">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="stat-card-label">Total Utilisateurs</div>
                <div class="stat-card-value">{{ $totalUsers }}</div>
                <div class="stat-card-trend">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
                    </svg>
                    Active
                </div>
            </div>

            {{-- Formateurs --}}
            <div class="stat-card stat-card-2">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <div class="stat-card-label">Formateurs</div>
                <div class="stat-card-value">{{ $formateurs }}</div>
                <div class="stat-card-trend">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
                    </svg>
                    Certifiés
                </div>
            </div>

            {{-- Apprenants --}}
            <div class="stat-card stat-card-3">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <div class="stat-card-label">Apprenants</div>
                <div class="stat-card-value">{{ $apprenants }}</div>
                <div class="stat-card-trend">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
                    </svg>
                    Inscrits
                </div>
            </div>

            {{-- Formations --}}
            <div class="stat-card stat-card-4">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="stat-card-label">Formations Actives</div>
                <div class="stat-card-value">{{ $formations }}</div>
                <div class="stat-card-trend">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
                    </svg>
                    Disponibles
                </div>
            </div>
        </div>

        {{-- ── CHART + DONUT ── --}}
        <div class="main-grid">
            {{-- Activity Chart --}}
            <div class="w-card chart-card">
                <div class="w-card-header">
                    <div>
                        <div class="w-card-title">Aperçu de l'activité</div>
                        <div class="w-card-sub">Évolution des inscriptions et sessions</div>
                    </div>
                    <div class="chart-tabs">
                        <button class="chart-tab">Jour</button>
                        <button class="chart-tab active">Semaine</button>
                        <button class="chart-tab">Mois</button>
                        <button class="chart-tab">Année</button>
                    </div>
                </div>
                <div class="chart-summary">
                    <div>
                        <div class="chart-kpi-label">Sessions totales</div>
                        <div class="chart-kpi-value">{{ \App\Models\FormationSession::count() }}</div>
                    </div>
                    <div>
                        <div class="chart-kpi-label">Inscriptions</div>
                        <div class="chart-kpi-value">
                            {{ \App\Models\FormationSession::withCount('inscriptions')->get()->sum('inscriptions_count') }}
                        </div>
                    </div>
                    <div>
                        <div class="chart-kpi-label">Formations</div>
                        <div class="chart-kpi-value">{{ $formations }}</div>
                    </div>
                </div>
                <div class="chart-canvas-wrap">
                    <canvas id="activityChart"></canvas>
                </div>
                <div class="chart-legend">
                    <div class="legend-item"><span class="legend-dot" style="background:#4F6EF7;"></span> Sessions
                    </div>
                    <div class="legend-item"><span class="legend-dot" style="background:#06b6d4;"></span>
                        Inscriptions</div>
                </div>
            </div>

            {{-- Donut Chart --}}
            <div class="w-card donut-card">
                <div class="w-card-header">
                    <div>
                        <div class="w-card-title">Répartition</div>
                        <div class="w-card-sub">Par type d'utilisateur</div>
                    </div>
                </div>
                <div class="donut-wrap">
                    <canvas id="donutChart"></canvas>
                    <div class="donut-center">
                        <div class="donut-center-val">{{ $totalUsers }}</div>
                        <div class="donut-center-lbl">Total</div>
                    </div>
                </div>
                <div class="donut-legend">
                    <div class="donut-leg-item">
                        <div class="donut-leg-left"><span class="donut-leg-dot"
                                style="background:#4F6EF7;"></span>Formateurs</div>
                        <div class="donut-leg-val">{{ $formateurs }}</div>
                    </div>
                    <div class="donut-leg-item">
                        <div class="donut-leg-left"><span class="donut-leg-dot"
                                style="background:#f76c8f;"></span>Apprenants</div>
                        <div class="donut-leg-val">{{ $apprenants }}</div>
                    </div>
                    <div class="donut-leg-item">
                        <div class="donut-leg-left"><span class="donut-leg-dot"
                                style="background:#f79f57;"></span>Admins</div>
                        <div class="donut-leg-val">{{ max(0, $totalUsers - $formateurs - $apprenants) }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── QUICK NAV ── --}}
        <div class="quick-nav">
            <a href="{{ route('admin.users') }}" class="nav-btn nav-btn-1">
                <div class="nav-btn-icon" style="background:#eff3ff;">
                    <svg fill="none" stroke="#4F6EF7" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Utilisateurs</div>
                    <div class="nav-btn-desc">Gérer les comptes</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.formations') }}" class="nav-btn nav-btn-2">
                <div class="nav-btn-icon" style="background:#eff8ff;">
                    <svg fill="none" stroke="#3db9e5" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Formations</div>
                    <div class="nav-btn-desc">Gérer le catalogue</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.sessions') }}" class="nav-btn nav-btn-3">
                <div class="nav-btn-icon" style="background:#fff0f4;">
                    <svg fill="none" stroke="#f76c8f" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Sessions</div>
                    <div class="nav-btn-desc">Planifier & gérer</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.inscriptions') }}" class="nav-btn nav-btn-4">
                <div class="nav-btn-icon" style="background:#f0f9ff;">
                    <svg fill="none" stroke="#0ea5e9" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Inscriptions</div>
                    <div class="nav-btn-desc">Valider & gérer</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.settings') }}" class="nav-btn nav-btn-5">
                <div class="nav-btn-icon" style="background:#fff7ed;">
                    <svg fill="none" stroke="#f79f57" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Paramètres</div>
                    <div class="nav-btn-desc">Configuration</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>

        {{-- ── BOTTOM GRID ── --}}
        <div class="bottom-grid">

            {{-- Recent Sessions --}}
            <div class="w-card">
                <div class="w-card-header">
                    <div>
                        <div class="w-card-title">Sessions Récentes</div>
                        <div class="w-card-sub">Dernières sessions planifiées</div>
                    </div>
                    <a href="{{ route('admin.sessions') }}" class="view-all-link">
                        Voir tout
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <table class="sessions-table">
                    <thead>
                        <tr>
                            <th>Formation</th>
                            <th>Période</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $idx => $session)
                            @php
                                $sc = $session->statut === 'ouverte' ? 'badge-ouverte' : 'badge-fermee';
                                $ic = $colors[$idx % count($colors)];
                                $lt = strtoupper(substr($session->formation->titre ?? 'S', 0, 1));
                            @endphp
                            <tr>
                                <td>
                                    <div class="sess-formation">
                                        <div class="sess-icon" style="background:{{ $ic }}">
                                            {{ $lt }}</div>
                                        <span
                                            class="sess-name">{{ Str::limit($session->formation->titre ?? '—', 22) }}</span>
                                    </div>
                                </td>
                                <td style="font-size:0.78rem;color:#6b7280;">
                                    {{ optional($session->date_debut)->format('d/m') }} →
                                    {{ optional($session->date_fin)->format('d/m/Y') ?? '—' }}
                                </td>
                                <td>
                                    <span class="status-badge {{ $sc }}">
                                        <span class="dot"></span>{{ ucfirst($session->statut) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;color:#9499a8;padding:24px;">Aucune
                                    session</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Top Formations --}}
            <div class="w-card">
                <div class="w-card-header">
                    <div>
                        <div class="w-card-title">Top Formations</div>
                        <div class="w-card-sub">Par nombre de sessions</div>
                    </div>
                    <a href="{{ route('admin.formations') }}" class="view-all-link">
                        Voir tout
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="activity-list">
                    @forelse($topFormations as $idx => $formation)
                        @php
                            $ic = $colors[$idx % count($colors)];
                            $lt = strtoupper(substr($formation->titre, 0, 1));
                            $iconClasses = [
                                'activity-icon-blue',
                                'activity-icon-green',
                                'activity-icon-red',
                                'activity-icon-amber',
                                'activity-icon-purple',
                            ];
                            $cls = $iconClasses[$idx % count($iconClasses)];
                        @endphp
                        <div class="activity-item">
                            <div class="activity-icon {{ $cls }}"
                                style="background:{{ $ic }}22; color:{{ $ic }};">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="activity-body">
                                <div class="activity-title">{{ Str::limit($formation->titre, 32) }}</div>
                                <div class="activity-desc">{{ $formation->sessions_count }} sessions ·
                                    {{ number_format($formation->tarif, 0, ',', ' ') }} DH ·
                                    {{ $formation->duree ?? '—' }} jours</div>
                            </div>
                            <div
                                style="display:flex;flex-direction:column;align-items:flex-end;gap:3px;flex-shrink:0;">
                                <span
                                    style="font-size:0.78rem;font-weight:700;color:{{ $ic }};">#{{ $idx + 1 }}</span>
                                <span style="font-size:0.7rem;color:#c1c5cf;">{{ $formation->sessions_count }}
                                    sess.</span>
                            </div>
                        </div>
                    @empty
                        <p style="text-align:center;color:#9499a8;padding:24px 0;">Aucune formation</p>
                    @endforelse
                </div>
            </div>

        </div>{{-- /.bottom-grid --}}
    </div>{{-- /.dash-wrapper --}}

    {{-- Chart.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        // ── Activity Line Chart ──
        const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        const now = new Date();
        const labels = [];
        for (let i = 5; i >= 0; i--) {
            const d = new Date(now.getFullYear(), now.getMonth() - i, 1);
            labels.push(months[d.getMonth()]);
        }

        // Simulated monthly data (replace with real Eloquent queries if desired)
        const sessData = [3, 5, 4, 7, 6, {{ \App\Models\FormationSession::count() }}];
        const insData = [8, 12, 10, 18, 15,
            {{ \App\Models\FormationSession::withCount('inscriptions')->get()->sum('inscriptions_count') }}
        ];

        const ctx = document.getElementById('activityChart').getContext('2d');

        const gradBlue = ctx.createLinearGradient(0, 0, 0, 160);
        gradBlue.addColorStop(0, 'rgba(79,110,247,0.25)');
        gradBlue.addColorStop(1, 'rgba(79,110,247,0)');

        const gradCyan = ctx.createLinearGradient(0, 0, 0, 160);
        gradCyan.addColorStop(0, 'rgba(6,182,212,0.18)');
        gradCyan.addColorStop(1, 'rgba(6,182,212,0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                        label: 'Sessions',
                        data: sessData,
                        borderColor: '#4F6EF7',
                        backgroundColor: gradBlue,
                        fill: true,
                        tension: 0.45,
                        pointBackgroundColor: '#4F6EF7',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2.5,
                    },
                    {
                        label: 'Inscriptions',
                        data: insData,
                        borderColor: '#06b6d4',
                        backgroundColor: gradCyan,
                        fill: true,
                        tension: 0.45,
                        pointBackgroundColor: '#06b6d4',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2.5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1d23',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 12,
                        cornerRadius: 10,
                        borderColor: 'rgba(255,255,255,0.05)',
                        borderWidth: 1,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'DM Sans',
                                size: 11
                            },
                            color: '#9499a8'
                        }
                    },
                    y: {
                        grid: {
                            color: '#f0f2f8',
                            drawBorder: false
                        },
                        border: {
                            display: false,
                            dash: [4, 4]
                        },
                        ticks: {
                            font: {
                                family: 'DM Sans',
                                size: 11
                            },
                            color: '#9499a8',
                            stepSize: 5
                        }
                    }
                }
            }
        });

        // ── Donut Chart ──
        const dCtx = document.getElementById('donutChart').getContext('2d');
        const formateurs = {{ $formateurs }};
        const apprenants = {{ $apprenants }};
        const admins = {{ max(0, $totalUsers - $formateurs - $apprenants) }};

        new Chart(dCtx, {
            type: 'doughnut',
            data: {
                labels: ['Formateurs', 'Apprenants', 'Admins'],
                datasets: [{
                    data: [formateurs || 1, apprenants || 1, admins || 1],
                    backgroundColor: ['#4F6EF7', '#f76c8f', '#f79f57'],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1d23',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 10,
                        cornerRadius: 10,
                    }
                }
            }
        });

        // Chart tab toggle
        document.querySelectorAll('.chart-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</x-admin-layout>
