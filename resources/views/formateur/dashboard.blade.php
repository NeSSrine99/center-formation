<x-admin-layout>
    @section('header', 'Dashboard Formateur')

    <div class="container-fluid my-5">
        <!-- Welcome Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="alert alert-light border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #06BBCC 0%, #0098b5 100%); color: white; padding: 2rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1"><i class="bi bi-hand-thumbs-up"></i> Bienvenue, {{ auth()->user()->name }}!
                            </h4>
                            <p class="mb-0">Gérez efficacement vos formations et vos apprenants depuis votre espace</p>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #06BBCC;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Mes Formations</h6>
                                <h2 class="mb-0" style="color: #06BBCC;">
                                    <strong>{{ \App\Models\Formation::count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #06BBCC; opacity: 0.2;">
                                <i class="bi bi-book-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #28a745;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Sessions Actives</h6>
                                <h2 class="mb-0" style="color: #28a745;">
                                    <strong>{{ \App\Models\FormationSession::where('statut', 'ouverte')->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #28a745; opacity: 0.2;">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #0d6efd;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Apprenants</h6>
                                <h2 class="mb-0" style="color: #0d6efd;">
                                    <strong>{{ \App\Models\Inscription::count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #0d6efd; opacity: 0.2;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="mb-0">
                            <i class="bi bi-lightning-charge"></i> Actions Rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('formateur.courses') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-journal-bookmark-fill"
                                        style="font-size: 1.5rem; color: #06BBCC;"></i>
                                    <div class="mt-2">
                                        <strong>Mes Cours</strong>
                                        <div class="small text-muted">Gérer mes formations</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="{{ route('formateur.students') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-people-fill" style="font-size: 1.5rem; color: #28a745;"></i>
                                    <div class="mt-2">
                                        <strong>Mes Apprenants</strong>
                                        <div class="small text-muted">Voir les inscrits</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="{{ route('formateur.materials') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-folder2-open" style="font-size: 1.5rem; color: #0d6efd;"></i>
                                    <div class="mt-2">
                                        <strong>Supports de Cours</strong>
                                        <div class="small text-muted">Gérer les matériels</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Sessions -->
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="mb-0">
                            <i class="bi bi-calendar-event"></i> Mes Sessions Récentes
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $recentSessions = \App\Models\FormationSession::with('formation')
                                ->latest()
                                ->limit(8)
                                ->get();
                        @endphp
                        @if ($recentSessions->isEmpty())
                            <div class="alert alert-info mb-0">
                                <i class="bi bi-info-circle"></i> Vous n'avez pas encore de sessions.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
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
                                        @foreach ($recentSessions as $session)
                                            <tr>
                                                <td>
                                                    <strong>{{ $session->formation->titre }}</strong>
                                                </td>
                                                <td>{{ $session->lieu ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-light text-dark">{{ $session->capacite }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge"
                                                        style="background-color: {{ $session->statut === 'ouverte' ? '#06BBCC' : '#dc3545' }};">
                                                        {{ ucfirst($session->statut) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-info">{{ $session->inscriptions->count() }}</span>
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

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }
    </style>
</x-admin-layout>
