<x-admin-layout>
    @section('header', 'Gestion des Inscriptions')

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

        .filters-section {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1.5px solid #f0f1f5;
        }

        .filters-form {
            display: flex;
            gap: 16px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 200px;
        }

        .filter-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1d23;
        }

        .filter-input {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
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

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 8px 12px;
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

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            padding: 8px 12px;
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
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            padding: 8px 12px;
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

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .table-container {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            overflow: hidden;
        }

        .table-header {
            padding: 24px;
            border-bottom: 1px solid #f0f1f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0;
        }

        .table-subtitle {
            font-size: 0.85rem;
            color: #9499a8;
            margin: 4px 0 0;
        }

        .inscriptions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inscriptions-table th,
        .inscriptions-table td {
            padding: 16px 24px;
            text-align: left;
            border-bottom: 1px solid #f0f1f5;
        }

        .inscriptions-table th {
            font-weight: 700;
            color: #1a1d23;
            font-size: 0.9rem;
            background: #fafbff;
        }

        .inscriptions-table tbody tr:hover {
            background: #fafbff;
        }

        .apprenant-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .apprenant-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .apprenant-details h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1d23;
            margin: 0 0 2px;
        }

        .apprenant-details p {
            font-size: 0.8rem;
            color: #9499a8;
            margin: 0;
        }

        .formation-info {
            max-width: 200px;
        }

        .formation-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1d23;
            margin: 0 0 4px;
        }

        .formation-meta {
            font-size: 0.8rem;
            color: #9499a8;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-en_attente {
            background: #fef3c7;
            color: #d97706;
        }

        .status-validée {
            background: #f0fdf4;
            color: #16a34a;
        }

        .status-refusée {
            background: #fef2f2;
            color: #dc2626;
        }

        .payment-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .payment-paid {
            color: #16a34a;
        }

        .payment-pending {
            color: #dc2626;
        }

        .actions-column {
            min-width: 200px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination-container {
            padding: 24px;
            display: flex;
            justify-content: between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .per-page-selector select {
            padding: 4px 8px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-bar {
                flex-direction: column;
            }

            .stat-item {
                min-width: auto;
            }

            .filters-form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
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

            .table-header {
                padding: 16px;
            }

            .inscriptions-table th,
            .inscriptions-table td {
                padding: 12px 16px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .actions-column {
                min-width: auto;
            }
        }
    </style>

    <div class="page-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Gestion des Inscriptions</h1>
                <p class="page-subtitle">Validez, refusez et gérez les demandes d'inscription</p>
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
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total des inscriptions</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $stats['en_attente'] }}</h3>
                    <p>En attente</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $stats['validée'] }}</h3>
                    <p>Validées</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                    <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>{{ $stats['payée'] }}</h3>
                    <p>Payées</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-section">
            <form method="GET" action="{{ route('admin.inscriptions') }}" class="filters-form">
                <div class="filter-group">
                    <label class="filter-label">Rechercher</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom ou email de l'apprenant" class="filter-input">
                </div>

                <div class="filter-group">
                    <label class="filter-label">Statut</label>
                    <select name="status" class="filter-input">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('status') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="validée" {{ request('status') === 'validée' ? 'selected' : '' }}>Validée</option>
                        <option value="refusée" {{ request('status') === 'refusée' ? 'selected' : '' }}>Refusée</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Formation</label>
                    <select name="formation_id" class="filter-input">
                        <option value="">Toutes les formations</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                                {{ $formation->titre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-primary">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Inscriptions Table -->
        <div class="table-container">
            <div class="table-header">
                <div>
                    <h2 class="table-title">Demandes d'Inscription</h2>
                    <p class="table-subtitle">{{ $inscriptions->total() }} résultat(s) trouvé(s)</p>
                </div>
            </div>

            <table class="inscriptions-table">
                <thead>
                    <tr>
                        <th>Apprenant</th>
                        <th>Formation & Session</th>
                        <th>Date de demande</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscriptions as $inscription)
                        <tr>
                            <td>
                                <div class="apprenant-info">
                                    <div class="apprenant-avatar">
                                        {{ strtoupper(substr($inscription->apprenant->user->name, 0, 1)) }}
                                    </div>
                                    <div class="apprenant-details">
                                        <h4>{{ $inscription->apprenant->user->name }}</h4>
                                        <p>{{ $inscription->apprenant->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="formation-info">
                                    <div class="formation-title">{{ $inscription->session->formation->titre }}</div>
                                    <div class="formation-meta">
                                        Session: {{ \Carbon\Carbon::parse($inscription->session->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($inscription->session->date_fin)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($inscription->created_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($inscription->statut === 'en_attente')
                                    <span class="status-badge status-en_attente">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        En attente
                                    </span>
                                @elseif($inscription->statut === 'validée')
                                    <span class="status-badge status-validée">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                                        </svg>
                                        Validée
                                    </span>
                                @elseif($inscription->statut === 'refusée')
                                    <span class="status-badge status-refusée">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Refusée
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($inscription->statut === 'validée')
                                    @if($inscription->paiement)
                                        <span class="payment-status payment-paid">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                                            </svg>
                                            Payé
                                        </span>
                                    @else
                                        <span class="payment-status payment-pending">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            En attente
                                        </span>
                                    @endif
                                @else
                                    <span class="payment-status">-</span>
                                @endif
                            </td>
                            <td class="actions-column">
                                <div class="action-buttons">
                                    @if($inscription->statut === 'en_attente')
                                        <form method="POST" action="{{ route('admin.inscriptions.valider', $inscription->id) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-success" onclick="return confirm('Confirmer la validation de cette inscription ?')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                                                </svg>
                                                Valider
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.inscriptions.refuser', $inscription->id) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-danger" onclick="return confirm('Confirmer le refus de cette inscription ?')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Refuser
                                            </button>
                                        </form>
                                    @elseif($inscription->statut === 'validée' && !$inscription->paiement)
                                        <form method="POST" action="{{ route('admin.inscriptions.payer', $inscription->id) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-warning" onclick="return confirm('Marquer cette inscription comme payée ?')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                                Marquer payé
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 60px 20px; color: #9499a8;">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 64px; height: 64px; opacity: 0.3; margin-bottom: 16px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v15a2 2 0 01-2 2h-2"/>
                                </svg>
                                <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1d23; margin: 0 0 8px;">Aucune inscription trouvée</h3>
                                <p style="margin: 0;">Aucune demande d'inscription ne correspond à vos critères de recherche.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-container">
                <div class="per-page-selector">
                    <span>Afficher:</span>
                    <select onchange="changePerPage(this.value)">
                        <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                        <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span>par page</span>
                </div>

                {{ $inscriptions->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <script>
        function changePerPage(perPage) {
            const url = new URL(window.location);
            url.searchParams.set('per_page', perPage);
            window.location = url;
        }
    </script>
</x-admin-layout>