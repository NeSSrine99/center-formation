<x-admin-layout>
    @section('header', 'Dashboard Apprenant')

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
            max-width: 1280px;
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
        }
    </style>

    <div class="dash-wrapper">

        {{-- ── TOP BAR ── --}}
        <div class="top-bar">
            <div class="top-bar-left">
                <h1>Dashboard Apprenant</h1>
                <p>Bienvenue sur votre espace d'apprentissage 👋</p>
            </div>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="stat-cards">
            {{-- Formations Disponibles --}}
            <div class="stat-card stat-card-1">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="stat-card-label">Formations Disponibles</div>
                <div class="stat-card-value">{{ $myFormations->count() }}</div>
                <div class="stat-card-sub">À découvrir</div>
            </div>

            {{-- Inscriptions Actives --}}
            <div class="stat-card stat-card-2">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2" />
                    </svg>
                </div>
                <div class="stat-card-label">Inscriptions Actives</div>
                <div class="stat-card-value">{{ $inscriptions->count() }}</div>
                <div class="stat-card-sub">En cours</div>
            </div>

            {{-- Sessions Restantes --}}
            <div class="stat-card stat-card-3">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="stat-card-label">Sessions Restantes</div>
                <div class="stat-card-value">{{ \App\Models\FormationSession::where('statut', 'ouverte')->count() }}
                </div>
                <div class="stat-card-sub">Disponibles</div>
            </div>

            {{-- Niveau --}}
            <div class="stat-card stat-card-4">
                <div class="stat-card-icon">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-card-label">Mon Niveau</div>
                <div class="stat-card-value">{{ auth()->user()->apprenant?->niveau ?? 'N/A' }}</div>
                <div class="stat-card-sub">Progression</div>
            </div>
        </div>

        {{-- ── QUICK NAV ── --}}
        <div class="quick-nav">
            <a href="{{ route('apprenant.courses') }}" class="nav-btn nav-btn-1">
                <div class="nav-btn-icon" style="background:#eff8ff;">
                    <svg fill="none" stroke="#3db9e5" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Mes Formations</div>
                    <div class="nav-btn-desc">Consulter les cours</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('apprenant.inscriptions') }}" class="nav-btn nav-btn-2">
                <div class="nav-btn-icon" style="background:#f0fdf4;">
                    <svg fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2" />
                    </svg>
                </div>
                <div>
                    <div class="nav-btn-title">Mes Inscriptions</div>
                    <div class="nav-btn-desc">Voir mes sessions</div>
                </div>
                <div class="nav-btn-arrow">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>

        {{-- ── RECENT INSCRIPTIONS ── --}}
        <div class="w-card">
            <div class="w-card-header">
                <div>
                    <div class="w-card-title">Timeline de mes inscriptions</div>
                    <div class="w-card-sub">Vos sessions récentes</div>
                </div>
            </div>
            @if ($inscriptions->isEmpty())
                <div style="padding: 20px; text-align: center; color: #9499a8;">
                    <svg style="width: 48px; height: 48px; opacity: 0.3; margin-bottom: 10px;" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2" />
                    </svg>
                    <p style="margin: 0;">Vous n'avez pas encore d'inscriptions</p>
                </div>
            @else
                <table class="sessions-table">
                    <thead>
                        <tr>
                            <th>Formation</th>
                            <th>Formateur</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Lieu</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $idx => $inscription)
                            @php
                                $colors = ['#3db9e5', '#10b981', '#f59e0b', '#f7776c', '#8b5cf6'];
                                $sessionColor = $colors[$idx % count($colors)];
                            @endphp
                            <tr>
                                <td>
                                    <div class="sess-formation">
                                        <div class="sess-icon" style="background:{{ $sessionColor }};">
                                            {{ strtoupper(substr($inscription->session->formation->titre, 0, 1)) }}
                                        </div>
                                        <div class="sess-name">{{ $inscription->session->formation->titre }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if ($inscription->session->formation->formateurs->first())
                                        {{ $inscription->session->formation->formateurs->first()->user->name }}
                                    @else
                                        <span style="color: #9499a8;">N/A</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($inscription->session->date_debut)->format('d/m/Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($inscription->session->date_fin)->format('d/m/Y') }}</td>
                                <td>{{ $inscription->session->lieu ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge {{ 'badge-' . $inscription->statut }}">
                                        <span class="dot"></span>
                                        {{ ucfirst(str_replace('_', ' ', $inscription->statut)) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-admin-layout>
