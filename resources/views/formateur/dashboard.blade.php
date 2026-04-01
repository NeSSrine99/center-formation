<x-admin-layout>
    @section('header', 'Dashboard Formateur')

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
            max-width: 1280px;
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

        /* ━━━━━━━━━━━━━━━━━━━━━━
       GRADIENT STAT CARDS
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
            background: linear-gradient(135deg, #3db9e5, #2196f3);
        }

        .stat-card-2 {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-card-3 {
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

        /* ━━━━━━━━━━━━━━━━━━━━━━
       QUICK NAV BUTTONS
    ━━━━━━━━━━━━━━━━━━━━━━ */
        .quick-nav {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        .nav-btn-3::before {
            background: linear-gradient(90deg, #f59e0b, #f7776c);
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

            .quick-nav {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 540px) {
            .stat-cards {
                grid-template-columns: 1fr;
            }

            .quick-nav {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        $myFormations = \App\Models\Formation::count();
        $activeSessions = \App\Models\FormationSession::where('statut', 'ouverte')->count();
        $totalApprenants = \App\Models\Inscription::count();
        $recentSessions = \App\Models\FormationSession::with('formation')->latest()->limit(5)->get();
    @endphp

    <div class="dash-wrapper">

        {{-- ── TOP BAR ── --}}
        <div class="top-bar">
            <div class="top-bar-left">
                <h1>Dashboard Formateur</h1>
                <p>Bienvenue sur votre espace de formation 👋</p>
            </div>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="stat-cards">
            {{-- Mes Formations --}}
            <div class="stat-card stat-card-1">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="stat-card-label">Mes Formations</div>
                <div class="stat-card-value">{{ $myFormations }}</div>
                <div class="stat-card-sub">Formations créées</div>
            </div>

            {{-- Sessions Actives --}}
            <div class="stat-card stat-card-2">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="stat-card-label">Sessions Actives</div>
                <div class="stat-card-value">{{ $activeSessions }}</div>
                <div class="stat-card-sub">Sessions ouvertes</div>
            </div>

            {{-- Total Apprenants --}}
            <div class="stat-card stat-card-3">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="stat-card-label">Total Apprenants</div>
                <div class="stat-card-value">{{ $totalApprenants }}</div>
                <div class="stat-card-sub">Inscrits</div>
            </div>
        </div>

        {{-- ── QUICK NAV ── --}}
        <div class="quick-nav">
            <a href="{{ route('formateur.courses') }}" class="nav-btn nav-btn-1">
                <div class="nav-btn-icon" style="background:#eff8ff;">
                    <svg fill="none" stroke="#3db9e5" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Mes Formations</div>
                    <div class="nav-btn-desc">Gérer le catalogue</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('formateur.students') }}" class="nav-btn nav-btn-2">
                <div class="nav-btn-icon" style="background:#f0fdf4;">
                    <svg fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Mes Apprenants</div>
                    <div class="nav-btn-desc">Voir les inscrits</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('formateur.materials') }}" class="nav-btn nav-btn-3">
                <div class="nav-btn-icon" style="background:#fff7ed;">
                    <svg fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Supports de Cours</div>
                    <div class="nav-btn-desc">Gérer les matériels</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>

        {{-- ── RECENT SESSIONS ── --}}
        <div class="w-card">
            <div class="w-card-header">
                <div>
                    <div class="w-card-title">Mes Sessions Récentes</div>
                    <div class="w-card-sub">Dernières sessions planifiées</div>
                </div>
                <a href="{{ route('formateur.courses') }}" class="view-all-link">
                    Voir tout
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            @if ($recentSessions->isEmpty())
                <div style="padding: 20px; text-align: center; color: #9499a8;">
                    <svg style="width: 48px; height: 48px; opacity: 0.3; margin-bottom: 10px;" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p style="margin: 0;">Vous n'avez pas encore de sessions</p>
                </div>
            @else
                <table class="sessions-table">
                    <thead>
                        <tr>
                            <th>Formation</th>
                            <th>Lieu</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Capacité</th>
                            <th>Statut</th>
                            <th>Inscrits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentSessions as $idx => $session)
                            @php
                                $colors = ['#3db9e5', '#10b981', '#f59e0b', '#f7776c', '#8b5cf6'];
                                $sessionColor = $colors[$idx % count($colors)];
                            @endphp
                            <tr>
                                <td>
                                    <div class="sess-formation">
                                        <div class="sess-icon" style="background:{{ $sessionColor }};">
                                            {{ strtoupper(substr($session->formation->titre, 0, 1)) }}
                                        </div>
                                        <div class="sess-name">{{ $session->formation->titre }}</div>
                                    </div>
                                </td>
                                <td>{{ $session->lieu ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}</td>
                                <td>{{ $session->capacite }}</td>
                                <td>
                                    <span
                                        class="status-badge {{ $session->statut === 'ouverte' ? 'badge-ouverte' : 'badge-fermee' }}">
                                        <span class="dot"></span>
                                        {{ ucfirst($session->statut) }}
                                    </span>
                                </td>
                                <td>{{ $session->inscriptions->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

</x-admin-layout>
