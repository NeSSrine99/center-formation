<x-admin-layout>
    @section('header', 'Dashboard Apprenant')

    <div class="container-fluid my-5">
        <!-- Welcome Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="alert alert-light border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #06BBCC 0%, #0098b5 100%); color: white; padding: 2rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1"><i class="bi bi-book-half"></i> Bienvenue, {{ auth()->user()->name }}!</h4>
                            <p class="mb-0">Découvrez nos formations et suivez votre apprentissage</p>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #06BBCC;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Formations Disponibles</h6>
                                <h2 class="mb-0" style="color: #06BBCC;">
                                    <strong>{{ $myFormations->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #06BBCC; opacity: 0.2;">
                                <i class="bi bi-book-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #28a745;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Inscriptions Actives</h6>
                                <h2 class="mb-0" style="color: #28a745;">
                                    <strong>{{ $inscriptions->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #28a745; opacity: 0.2;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #0d6efd;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Sessions Restantes</h6>
                                <h2 class="mb-0" style="color: #0d6efd;">
                                    <strong>{{ \App\Models\FormationSession::where('statut', 'ouverte')->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #0d6efd; opacity: 0.2;">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #ffc107;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Mon Niveau</h6>
                                <h2 class="mb-0" style="color: #ffc107;">
                                    <strong>{{ auth()->user()->apprenant?->niveau ?? 'N/A' }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #ffc107; opacity: 0.2;">
                                <i class="bi bi-trophy-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <ul class="nav nav-tabs card-header-tabs mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="formations-tab" data-bs-toggle="tab"
                            data-bs-target="#formations" type="button" role="tab" aria-controls="formations"
                            aria-selected="true">
                            <i class="bi bi-book-fill"></i> Formations
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="inscriptions-tab" data-bs-toggle="tab"
                            data-bs-target="#inscriptions" type="button" role="tab" aria-controls="inscriptions"
                            aria-selected="false">
                            <i class="bi bi-bookmark-check-fill"></i> Mes Inscriptions
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <!-- Mes Formations Tab -->
                    <div class="tab-pane fade show active" id="formations" role="tabpanel"
                        aria-labelledby="formations-tab">
                        @if ($myFormations->isEmpty())
                            <div class="alert alert-info mb-0" role="alert">
                                <i class="bi bi-info-circle"></i> Aucune formation disponible pour le moment.
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach ($myFormations as $formation)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card border-0 shadow-sm h-100 formation-card"
                                            style="transition: all 0.3s ease;">
                                            <div class="card-header border-0"
                                                style="background: linear-gradient(135deg, #06BBCC 0%, #0098b5 100%); color: white; padding: 1.5rem;">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h5 class="mb-2">{{ $formation->titre }}</h5>
                                                        <p class="mb-0 small">
                                                            <i class="bi bi-bar-chart-fill"></i>
                                                            Niveau: <strong>{{ $formation->niveau }}</strong>
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-white text-primary">
                                                        {{ $formation->sessions->count() }} Sessions
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted mb-3">
                                                    {{ Str::limit($formation->description, 100) ?? 'Pas de description' }}
                                                </p>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div>
                                                        <small class="text-muted">Tarif</small>
                                                        <div class="h6 mb-0" style="color: #06BBCC;">
                                                            {{ number_format($formation->tarif, 2) }} DH
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <small class="text-muted">Durée</small>
                                                        <div class="h6 mb-0" style="color: #28a745;">
                                                            {{ $formation->duree }} jours
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-light border-0">
                                                <a href="{{ route('apprenant.inscriptions') }}"
                                                    class="btn btn-sm btn-primary w-100">
                                                    <i class="bi bi-pencil-square"></i> S'inscrire
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Mes Inscriptions Tab -->
                    <div class="tab-pane fade" id="inscriptions" role="tabpanel" aria-labelledby="inscriptions-tab">
                        @if ($inscriptions->isEmpty())
                            <div class="alert alert-warning mb-0" role="alert">
                                <i class="bi bi-exclamation-triangle"></i> Vous n'êtes inscrit à aucune session pour le
                                moment.
                                <a href="{{ route('apprenant.courses') }}" class="alert-link">Consulter les
                                    formations</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Formation</th>
                                            <th>Formateur</th>
                                            <th>Début</th>
                                            <th>Fin</th>
                                            <th>Lieu</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inscriptions as $inscription)
                                            <tr>
                                                <td>
                                                    <strong>{{ $inscription->session->formation->titre }}</strong>
                                                </td>
                                                <td>
                                                    @if ($inscription->session->formation->formateurs->first())
                                                        {{ $inscription->session->formation->formateurs->first()->user->name }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($inscription->session->date_debut)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($inscription->session->date_fin)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $inscription->session->lieu ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge"
                                                        style="background-color: {{ $inscription->statut === 'valide' ? '#06BBCC' : ($inscription->statut === 'en_attente' ? '#ffc107' : '#dc3545') }};">
                                                        {{ ucfirst(str_replace('_', ' ', $inscription->statut)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> Détails
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .formation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #06BBCC;
            border-bottom-color: #06BBCC;
        }

        .nav-tabs .nav-link:hover {
            border-bottom-color: #06BBCC;
        }
    </style>
</x-admin-layout>
