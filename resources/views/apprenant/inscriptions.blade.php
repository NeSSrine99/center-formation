<x-admin-layout>
    @section('header', 'Mes Formations et Inscriptions')

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

        .page-wrapper {
            padding: 24px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #1a1d23;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .page-meta {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
        }

        .tabs-container {
            display: flex;
            gap: 4px;
            margin-bottom: 24px;
            border-bottom: 2px solid #f0f1f5;
        }

        .tab-btn {
            background: transparent;
            border: none;
            padding: 12px 16px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #9499a8;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
        }

        .tab-btn.active {
            color: #4F6EF7;
            border-bottom-color: #4F6EF7;
        }

        .tab-btn:hover {
            color: #4F6EF7;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .formation-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .formation-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            padding: 20px;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .formation-card:hover {
            border-color: #d4d8ff;
            box-shadow: 0 8px 28px rgba(79, 110, 247, 0.10);
            transform: translateY(-3px);
        }

        .formation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4F6EF7, #06b6d4);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .formation-card:hover::before {
            opacity: 1;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1d23;
        }

        .card-sub {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 12px 0;
            padding: 12px 0;
            border-top: 1px solid #f0f1f5;
            border-bottom: 1px solid #f0f1f5;
            font-size: 0.8rem;
        }

        .detail-item {}

        .detail-label {
            color: #9499a8;
            font-weight: 500;
        }

        .detail-value {
            color: #1a1d23;
            font-weight: 600;
            margin-top: 2px;
        }

        .card-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: #eff3ff;
            color: #4F6EF7;
        }

        .card-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-view {
            background: #eff3ff;
            color: #4F6EF7;
        }

        .btn-view:hover {
            background: #4F6EF7;
            color: #fff;
        }

        .btn-cancel {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-cancel:hover {
            background: #dc2626;
            color: #fff;
        }

        .table-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-responsive-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }

        .table-card thead {
            background: #f9fafb;
            border-bottom: 1px solid #f0f1f5;
        }

        .table-card thead th {
            padding: 13px 18px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #9499a8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }

        .table-card tbody tr {
            border-bottom: 1px solid #f5f6fa;
            transition: background 0.15s;
        }

        .table-card tbody tr:last-child {
            border-bottom: none;
        }

        .table-card tbody tr:hover {
            background: #fafbff;
        }

        .table-card tbody td {
            padding: 13px 18px;
            font-size: 0.86rem;
            color: #374151;
            vertical-align: middle;
        }

        .session-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .session-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .session-name {
            font-weight: 600;
            color: #1a1d23;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            opacity: 0.25;
            margin-bottom: 12px;
            display: block;
            margin-inline: auto;
        }

        @media (max-width: 1024px) {
            .formation-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 540px) {
            .page-header {
                flex-direction: column;
            }
        }
    </style>

    @php
        $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6'];
    @endphp

    <div class="page-wrapper">
        <div class="page-header">
            <div>
                <div class="page-title">Mes Formations et Inscriptions</div>
                <div class="page-meta">Gérez vos inscriptions et suivez votre progression</div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <button class="tab-btn active" onclick="switchTab('my-formations')">
                <i class="bi bi-check-circle-fill"></i> Mes Formations ({{ $myFormations->count() }})
            </button>
            <button class="tab-btn" onclick="switchTab('available')">
                <i class="bi bi-plus-circle-fill"></i> Disponibles ({{ $formations->count() }})
            </button>
            <button class="tab-btn" onclick="switchTab('sessions')">
                <i class="bi bi-calendar"></i> Sessions ({{ $sessions->count() }})
            </button>
        </div>

        <!-- Tab 1: Mes Formations (Registered) -->
        <div id="my-formations" class="tab-content active">
            @if ($myFormations->count() > 0)
                <div class="formation-grid">
                    @foreach ($myFormations as $idx => $formation)
                        @php
                            $inscription = $inscriptions->firstWhere('session.formation_id', $formation->id);
                            $bgColor = $colors[$idx % count($colors)];
                        @endphp
                        <div class="formation-card">
                            <div class="card-header-row">
                                <div>
                                    <div class="card-title">{{ $formation->titre }}</div>
                                    <div class="card-sub">{{ Str::limit($formation->description, 80) }}</div>
                                </div>
                            </div>

                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-label">Niveau</div>
                                    <div class="detail-value">{{ $formation->niveau ?? 'N/A' }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Durée</div>
                                    <div class="detail-value">{{ $formation->duree }} jours</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Tarif</div>
                                    <div class="detail-value">{{ number_format($formation->tarif, 2) }} DH</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Sessions</div>
                                    <div class="detail-value">{{ $formation->sessions->count() }}</div>
                                </div>
                            </div>

                            <div class="card-actions">
                                <a href="{{ route('course.detail', $formation->id) }}" class="btn-action btn-view">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                        style="width: 13px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="table-card">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p>Vous n'êtes inscrit à aucune formation pour le moment</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tab 2: Formations Disponibles -->
        <div id="available" class="tab-content">
            @if ($formations->count() > 0)
                <div class="formation-grid">
                    @foreach ($formations as $idx => $formation)
                        <div class="formation-card">
                            <div class="card-header-row">
                                <div>
                                    <div class="card-title">{{ $formation->titre }}</div>
                                    <div class="card-sub">{{ Str::limit($formation->description, 80) }}</div>
                                </div>
                                <span class="card-badge">Disponible</span>
                            </div>

                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-label">Niveau</div>
                                    <div class="detail-value">{{ $formation->niveau ?? 'N/A' }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Durée</div>
                                    <div class="detail-value">{{ $formation->duree }} jours</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Tarif</div>
                                    <div class="detail-value">{{ number_format($formation->tarif, 2) }} DH</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Sessions</div>
                                    <div class="detail-value">{{ $formation->sessions->count() }}</div>
                                </div>
                            </div>

                            <div class="card-actions">
                                <a href="{{ route('course.detail', $formation->id) }}" class="btn-action btn-view">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                        style="width: 13px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="table-card">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p>Aucune formation disponible pour le moment</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tab 3: Sessions -->
        <div id="sessions" class="tab-content">
            @if ($sessions->count() > 0)
                <div class="table-card">
                    <div class="table-responsive-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Formation</th>
                                    <th>Formateur</th>
                                    <th>Début</th>
                                    <th>Fin</th>
                                    <th>Lieu</th>
                                    <th>Capacité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $idx => $session)
                                    @php
                                        $bgColor = $colors[$idx % count($colors)];
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="session-cell">
                                                <div class="session-icon" style="background:{{ $bgColor }};">
                                                    {{ strtoupper(substr($session->formation->titre, 0, 1)) }}
                                                </div>
                                                <div class="session-name">{{ $session->formation->titre }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($session->formation->formateurs->first())
                                                {{ $session->formation->formateurs->first()->user->name }}
                                            @else
                                                <span style="color: #9499a8;">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}</td>
                                        <td>{{ $session->lieu ?? 'N/A' }}</td>
                                        <td>{{ $session->capacite }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="table-card">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p>Aucune session disponible pour le moment</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked button
            event.target.closest('.tab-btn').classList.add('active');
        }
    </script>
</x-admin-layout>
