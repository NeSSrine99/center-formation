<x-admin-layout>
    @section('header', 'Dashboard Administrateur')

    <div class="container-fluid my-5">
        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #06BBCC;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Utilisateurs</h6>
                                <h2 class="mb-0" style="color: #06BBCC;">
                                    <strong>{{ \App\Models\User::count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #06BBCC; opacity: 0.2;">
                                <i class="bi bi-people-fill"></i>
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
                                <h6 class="text-muted mb-2">Formateurs</h6>
                                <h2 class="mb-0" style="color: #28a745;">
                                    <strong>{{ \App\Models\User::whereHas('role', function ($q) {$q->where('name', 'formateur');})->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #28a745; opacity: 0.2;">
                                <i class="bi bi-person-check-fill"></i>
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
                                <h6 class="text-muted mb-2">Apprenants</h6>
                                <h2 class="mb-0" style="color: #0d6efd;">
                                    <strong>{{ \App\Models\User::whereHas('role', function ($q) {$q->where('name', 'apprenant');})->count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #0d6efd; opacity: 0.2;">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #dc3545;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Formations Actives</h6>
                                <h2 class="mb-0" style="color: #dc3545;">
                                    <strong>{{ \App\Models\Formation::count() }}</strong>
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; color: #dc3545; opacity: 0.2;">
                                <i class="bi bi-book-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="mb-0">
                            <i class="bi bi-sliders2"></i> Gestion de la Plateforme
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{ route('admin.users') }}" class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-people-fill" style="font-size: 1.5rem; color: #06BBCC;"></i>
                                    <div class="mt-2">
                                        <strong>Utilisateurs</strong>
                                        <div class="small text-muted">Gérer les utilisateurs</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="{{ route('admin.formations') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-book-fill" style="font-size: 1.5rem; color: #28a745;"></i>
                                    <div class="mt-2">
                                        <strong>Formations</strong>
                                        <div class="small text-muted">Gérer les formations</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="{{ route('admin.sessions') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-calendar-event-fill" style="font-size: 1.5rem; color: #0d6efd;"></i>
                                    <div class="mt-2">
                                        <strong>Sessions</strong>
                                        <div class="small text-muted">Gérer les sessions</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="{{ route('admin.settings') }}"
                                    class="btn btn-light w-100 p-3 text-start border"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-gear-fill" style="font-size: 1.5rem; color: #dc3545;"></i>
                                    <div class="mt-2">
                                        <strong>Paramètres</strong>
                                        <div class="small text-muted">Paramètres système</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="mb-0">
                            <i class="bi bi-calendar-check"></i> Sessions Récentes
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $sessions = \App\Models\FormationSession::with('formation')->latest()->limit(5)->get();
                        @endphp
                        @if ($sessions->isEmpty())
                            <p class="text-muted">Aucune session disponible.</p>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach ($sessions as $session)
                                    <div class="list-group-item px-0 py-3 border-bottom-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $session->formation->titre }}</strong>
                                                <div class="small text-muted">
                                                    {{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }} -
                                                    {{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                            <span class="badge"
                                                style="background-color: {{ $session->statut === 'ouverte' ? '#06BBCC' : '#dc3545' }};">
                                                {{ ucfirst($session->statut) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="mb-0">
                            <i class="bi bi-award"></i> Top Formations
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $formations = \App\Models\Formation::withCount('sessions')->latest()->limit(5)->get();
                        @endphp
                        @if ($formations->isEmpty())
                            <p class="text-muted">Aucune formation disponible.</p>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach ($formations as $formation)
                                    <div class="list-group-item px-0 py-3 border-bottom-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $formation->titre }}</strong>
                                                <div class="small text-muted">
                                                    {{ $formation->sessions_count }} sessions &bull;
                                                    {{ number_format($formation->tarif, 2) }} DH
                                                </div>
                                            </div>
                                            <span class="badge bg-info">{{ $formation->duree }} jours</span>
                                        </div>
                                    </div>
                                @endforeach
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

        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</x-admin-layout>
