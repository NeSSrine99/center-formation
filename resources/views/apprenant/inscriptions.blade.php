<x-admin-layout>
    @section('header', 'Mes Inscriptions')

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
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1d23;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .page-subtitle {
            font-size: 1rem;
            color: #9499a8;
            margin: 4px 0 0;
        }

        .stats-bar {
            display: flex;
            gap: 24px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            border: 1.5px solid #f0f1f5;
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
            min-width: 200px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-info h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1a1d23;
            margin: 0 0 2px;
        }

        .stat-info p {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 0;
        }

        .main-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .content-section {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            overflow: hidden;
        }

        .section-header {
            padding: 24px;
            border-bottom: 1px solid #f0f1f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0;
        }

        .section-subtitle {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 4px 0 0;
        }

        .section-actions {
            display: flex;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 110, 247, 0.3);
        }

        .section-body {
            padding: 0;
        }

        /* Active Inscriptions */
        .inscriptions-list {
            display: flex;
            flex-direction: column;
        }

        .inscription-item {
            padding: 24px;
            border-bottom: 1px solid #f0f1f5;
            transition: background 0.2s;
        }

        .inscription-item:last-child {
            border-bottom: none;
        }

        .inscription-item:hover {
            background: #fafbff;
        }

        .inscription-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .formation-info {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .formation-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .formation-details h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 4px;
        }

        .formation-details p {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 0 0 8px;
        }

        .formation-meta {
            display: flex;
            gap: 16px;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .status-active {
            background: #f0fdf4;
            color: #16a34a;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-active::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #16a34a;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-pending::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #d97706;
        }

        .status-rejected {
            background: #fef2f2;
            color: #dc2626;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-rejected::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #dc2626;
        }

        .session-details {
            background: #f9fafb;
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
        }

        .session-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .session-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0;
        }

        .session-dates {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .session-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            font-size: 0.8rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .info-label {
            color: #9499a8;
            font-weight: 500;
        }

        .info-value {
            color: #1a1d23;
            font-weight: 600;
        }

        .inscription-actions {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #d1d5db;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            border-color: #9ca3af;
        }

        .btn-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-danger:hover {
            background: #fee2e2;
            border-color: #fca5a5;
        }

        /* Available Formations */
        .formations-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .formation-card {
            background: #fff;
            border: 1.5px solid #f0f1f5;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s;
        }

        .formation-card:hover {
            border-color: #d4d8ff;
            box-shadow: 0 4px 16px rgba(79, 110, 247, 0.1);
            transform: translateY(-2px);
        }

        .formation-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .formation-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0;
        }

        .formation-description {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 4px 0 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .availability-badge {
            background: #f0fdf4;
            color: #16a34a;
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .formation-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .stat-box {
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-value {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1d23;
            display: block;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #9499a8;
            margin-top: 2px;
        }

        .formation-action {
            width: 100%;
        }

        .enroll-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            z-index: 50;
        }

        .enroll-modal-backdrop.show {
            display: flex;
        }

        .enroll-modal {
            width: min(100%, 540px);
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.18);
            position: relative;
        }

        .enroll-modal h3 {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }

        .enroll-modal p {
            margin-bottom: 20px;
            color: #6b7280;
            line-height: 1.6;
        }

        .enroll-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 999px;
            background: #f3f4f6;
            color: #111827;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .enroll-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .enroll-form-group label {
            font-weight: 600;
            color: #1f2937;
            font-size: 0.9rem;
        }

        .enroll-form-group input,
        .enroll-form-group select,
        .enroll-form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            color: #111827;
            font-size: 0.95rem;
        }

        .enroll-form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .btn-enroll {
            width: 100%;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: white;
            border: none;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-enroll:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(79, 110, 247, 0.25);
        }

        .session-info-card {
            background: #f9fafb;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .session-dates, .session-location {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: #6b7280;
        }

        /* Empty States */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 64px;
            height: 64px;
            opacity: 0.3;
            margin-bottom: 16px;
            display: block;
            margin-inline: auto;
        }

        .empty-state h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1d23;
            margin: 0 0 8px;
        }

        .empty-state p {
            font-size: 0.9rem;
            margin: 0 0 20px;
        }

        .empty-action {
            color: #4F6EF7;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .empty-action:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .stats-bar {
                flex-direction: column;
            }

            .stat-item {
                min-width: auto;
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .stats-bar {
                gap: 16px;
            }

            .inscription-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .formation-info {
                width: 100%;
            }

            .session-info {
                grid-template-columns: 1fr;
            }

            .formation-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="page-wrapper">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success" style="background: #f0fdf4; color: #16a34a; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" style="background: #fef2f2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fecaca;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Mes Inscriptions</h1>
                <p class="page-subtitle">Gérez vos formations et sessions d'apprentissage</p>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4F6EF7, #06b6d4);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $inscriptions->where('statut', 'validée')->count() }}</h3>
                    <p>Inscriptions validées</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $inscriptions->where('statut', 'en_attente')->count() }}</h3>
                    <p>En attente de validation</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $myFormations->count() }}</h3>
                    <p>Formations suivies</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            <!-- Active Inscriptions -->
            <div class="content-section">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Mes Inscriptions</h2>
                        <p class="section-subtitle">Suivez le statut de vos demandes d'inscription</p>
                    </div>
                </div>

                <div class="section-body">
                    @if ($inscriptions->count() > 0)
                        <div class="inscriptions-list">
                            @foreach ($inscriptions as $inscription)
                                <div class="inscription-item">
                                    <div class="inscription-header">
                                        <div class="formation-info">
                                            <div class="formation-icon">
                                                {{ strtoupper(substr($inscription->session->formation->titre, 0, 1)) }}
                                            </div>
                                            <div class="formation-details">
                                                <h3>{{ $inscription->session->formation->titre }}</h3>
                                                <p>{{ Str::limit($inscription->session->formation->description, 100) }}</p>
                                                <div class="formation-meta">
                                                    <span class="meta-item">
                                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ $inscription->session->formation->duree }} jours
                                                    </span>
                                                    <span class="meta-item">
                                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ $inscription->session->lieu ?? 'Lieu à définir' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($inscription->statut === 'validée')
                                            <span class="status-active">Validée</span>
                                        @elseif($inscription->statut === 'en_attente')
                                            <span class="status-pending">En attente</span>
                                        @elseif($inscription->statut === 'refusée')
                                            <span class="status-rejected">Refusée</span>
                                        @endif
                                    </div>

                                    <div class="session-details">
                                        <div class="session-header">
                                            <h4 class="session-title">Détails de la session</h4>
                                            <span class="session-dates">
                                                {{ \Carbon\Carbon::parse($inscription->session->date_debut)->format('d M Y') }} -
                                                {{ \Carbon\Carbon::parse($inscription->session->date_fin)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="session-info">
                                            <div class="info-item">
                                                <span class="info-label">Formateur</span>
                                                <span class="info-value">
                                                    @if ($inscription->session->formation->formateurs->first())
                                                        {{ $inscription->session->formation->formateurs->first()->user->name }}
                                                    @else
                                                        Non assigné
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Places restantes</span>
                                                <span class="info-value">
                                                    {{ $inscription->session->capacite - $inscription->session->inscriptions()->where('statut', 'validée')->count() }}
                                                </span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Niveau</span>
                                                <span class="info-value">{{ $inscription->session->formation->niveau ?? 'Standard' }}</span>
                                            </div>
                                            @if($inscription->statut === 'validée')
                                            <div class="info-item">
                                                <span class="info-label">Paiement</span>
                                                <span class="info-value">
                                                    @if($inscription->paiement)
                                                        <span style="color: #16a34a; font-weight: 600;">✓ Payé</span>
                                                    @else
                                                        <span style="color: #dc2626; font-weight: 600;">✗ En attente</span>
                                                    @endif
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="inscription-actions">
                                        @if($inscription->statut === 'validée')
                                        <a href="{{ route('apprenant.courses') }}" class="btn-secondary">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            Accéder au cours
                                        </a>
                                        <a href="{{ route('apprenant.materials') }}" class="btn-secondary">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                            </svg>
                                            Matériels
                                        </a>
                                        @endif
                                        @if(in_array($inscription->statut, ['en_attente', 'validée']))
                                        <form method="POST" action="{{ route('apprenant.cancel', $inscription->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette inscription ?')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Annuler
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                            </svg>
                            <h3>Aucune inscription</h3>
                            <p>Vous n'avez pas encore fait de demande d'inscription.</p>
                            <a href="#available-formations" class="empty-action">Voir les sessions disponibles →</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Available Formations -->
            <div class="content-section">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Sessions Disponibles</h2>
                        <p class="section-subtitle">Inscrivez-vous à une session de formation</p>
                    </div>
                    <div class="section-actions">
                        <a href="{{ route('apprenant.inscriptions') }}" class="btn-primary">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 16px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Voir tout
                        </a>
                    </div>
                </div>

                <div class="section-body" id="available-formations">
                    @if ($sessions->where('statut', 'ouverte')->count() > 0)
                        <div class="formations-grid">
                            @foreach ($sessions->where('statut', 'ouverte')->take(6) as $session)
                                <div class="formation-card">
                                    <div class="formation-card-header">
                                        <div>
                                            <h3 class="formation-title">{{ $session->formation->titre }}</h3>
                                            <p class="formation-description">{{ Str::limit($session->formation->description, 80) }}</p>
                                        </div>
                                        <span class="availability-badge">Disponible</span>
                                    </div>

                                    <div class="formation-stats">
                                        <div class="stat-box">
                                            <span class="stat-value">{{ $session->formation->duree }}</span>
                                            <span class="stat-label">Jours</span>
                                        </div>
                                        <div class="stat-box">
                                            <span class="stat-value">{{ $session->capacite - $session->inscriptions()->where('statut', 'validée')->count() }}</span>
                                            <span class="stat-label">Places</span>
                                        </div>
                                    </div>

                                    <div class="session-info-card">
                                        <div class="session-dates">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($session->date_debut)->format('d M') }} - {{ \Carbon\Carbon::parse($session->date_fin)->format('d M Y') }}
                                        </div>
                                        <div class="session-location">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $session->lieu ?? 'Lieu à définir' }}
                                        </div>
                                    </div>

                                    <div class="formation-action">
                                        <button type="button" class="btn-primary open-enroll-modal" style="width: 100%; justify-content: center;"
                                            data-session-id="{{ $session->id }}"
                                            data-session-title="{{ $session->formation->titre }}"
                                            data-session-dates="{{ \Carbon\Carbon::parse($session->date_debut)->format('d M Y') }} - {{ \Carbon\Carbon::parse($session->date_fin)->format('d M Y') }}">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 16px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>
                                            S'inscrire
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($sessions->where('statut', 'ouverte')->count() > 6)
                            <div style="text-align: center; margin-top: 20px;">
                                <a href="{{ route('apprenant.inscriptions') }}" class="btn-primary">
                                    Voir toutes les sessions ({{ $sessions->where('statut', 'ouverte')->count() }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h3>Aucune session disponible</h3>
                            <p>Toutes les sessions sont actuellement complètes ou fermées.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="enroll-modal-backdrop" id="enrollModalBackdrop">
        <div class="enroll-modal">
            <button type="button" class="enroll-modal-close" id="enrollModalClose">×</button>
            <h3>Inscription à la session</h3>
            <p id="enrollModalTitle">Remplissez le formulaire pour finaliser votre inscription.</p>

            <form method="POST" action="{{ route('apprenant.inscrire') }}">
                @csrf
                <input type="hidden" name="session_id" id="enrollSessionId">

                <div class="enroll-form-group">
                    <label for="payment_method">Méthode de paiement</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="">Sélectionnez une option</option>
                        <option value="card">Carte bancaire</option>
                        <option value="transfer">Virement bancaire</option>
                        <option value="cash">Espèces</option>
                    </select>
                </div>

                <div class="enroll-form-group">
                    <label for="payment_reference">Référence de paiement</label>
                    <input type="text" id="payment_reference" name="payment_reference" placeholder="Ex: REF123456" required>
                </div>

                <div class="enroll-form-group">
                    <label for="payment_amount">Montant à payer</label>
                    <input type="number" step="0.01" id="payment_amount" name="payment_amount" placeholder="Ex: 199.99" required>
                </div>

                <div class="enroll-form-group">
                    <label for="payment_notes">Notes</label>
                    <textarea id="payment_notes" name="payment_notes" placeholder="Informations supplémentaires... (facultatif)"></textarea>
                </div>

                <button type="submit" class="btn-enroll">Envoyer l'inscription</button>
            </form>
        </div>
    </div>

    <script>
        const enrollModalBackdrop = document.getElementById('enrollModalBackdrop');
        const enrollModalClose = document.getElementById('enrollModalClose');
        const enrollSessionId = document.getElementById('enrollSessionId');
        const enrollModalTitle = document.getElementById('enrollModalTitle');

        document.querySelectorAll('.open-enroll-modal').forEach(button => {
            button.addEventListener('click', () => {
                const sessionId = button.dataset.sessionId;
                const title = button.dataset.sessionTitle;
                const dates = button.dataset.sessionDates;

                enrollSessionId.value = sessionId;
                enrollModalTitle.textContent = `Session: ${title} — ${dates}`;
                enrollModalBackdrop.classList.add('show');
            });
        });

        enrollModalClose.addEventListener('click', () => {
            enrollModalBackdrop.classList.remove('show');
        });

        enrollModalBackdrop.addEventListener('click', (event) => {
            if (event.target === enrollModalBackdrop) {
                enrollModalBackdrop.classList.remove('show');
            }
        });
    </script>

</x-admin-layout>
