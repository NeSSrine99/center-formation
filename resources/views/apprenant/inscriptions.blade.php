<x-admin-layout>
    @section('header', 'Mes Formations et Inscriptions')

    <div class="container py-5">
        <h2 class="mb-4"><i class="bi bi-book"></i> Mes Formations et Inscriptions</h2>

    <!-- Alert Messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-check-circle-fill"></i> Succès!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-circle-fill"></i> Erreur!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="formationTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="my-formations-tab" data-bs-toggle="tab" data-bs-target="#my-formations"
                type="button">
                <i class="bi bi-check-circle-fill"></i> Mes Formations ({{ $myFormations->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="available-tab" data-bs-toggle="tab" data-bs-target="#available" type="button">
                <i class="bi bi-plus-circle-fill"></i> Disponibles ({{ $formations->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#sessions" type="button">
                <i class="bi bi-calendar"></i> Sessions ({{ $sessions->count() }})
            </button>
        </li>
    </ul>

    <div class="tab-content" id="formationTabContent">

        <!-- 1. Mes formations (Registered) -->
        <div class="tab-pane fade show active" id="my-formations" role="tabpanel">
            @if ($myFormations->count() > 0)
                <div class="row">
                    @foreach ($myFormations as $formation)
                        @php
                            $inscription = $inscriptions->firstWhere('session.formation_id', $formation->id);
                        @endphp
                        <div class="col-md-4 mb-4">
                            <div class="card formation-card h-100 shadow-sm border-success">
                                <div class="card-header bg-success text-white">
                                    <i class="bi bi-check-lg"></i> Inscrit
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $formation->titre }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($formation->description, 100) }}</p>

                                    <!-- Formation Details -->
                                    <div class="small mb-3">
                                        @if ($formation->duree)
                                            <p><i class="bi bi-clock"></i> <strong>Durée:</strong>
                                                {{ $formation->duree }} heures</p>
                                        @endif
                                        @if ($formation->niveau)
                                            <p><i class="bi bi-graph-up"></i> <strong>Niveau:</strong>
                                                {{ $formation->niveau }}</p>
                                        @endif
                                        @if ($formation->tarif)
                                            <p><i class="bi bi-tag"></i> <strong>Tarif:</strong>
                                                {{ $formation->tarif }} DH</p>
                                        @endif
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ $formation->progress ?? 30 }}%">
                                            {{ $formation->progress ?? 30 }}%
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('course.detail', $formation->id) }}"
                                            class="btn btn-outline-primary btn-sm flex-grow-1">
                                            <i class="bi bi-eye"></i> Voir détails
                                        </a>
                                        @if ($inscription)
                                            <form action="{{ route('apprenant.cancel', $inscription->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr?')">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle-fill"></i> Vous n'êtes inscrit à aucune formation pour le moment. Consultez
                    l'onglet "Disponibles" pour vous inscrire.
                </div>
            @endif
        </div>

        <!-- 2. Formations disponibles -->
        <div class="tab-pane fade" id="available" role="tabpanel">
            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchFormations" class="form-control"
                    placeholder="🔍 Rechercher une formation...">
            </div>

            @if ($formations->count() > 0)
                <div class="row" id="formationsContainer">
                    @foreach ($formations as $formation)
                        <div class="col-md-4 mb-4 formation-item">
                            <div class="card formation-card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <i class="bi bi-star-fill"></i> Disponible
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $formation->titre }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($formation->description, 100) }}</p>

                                    <!-- Formation Details -->
                                    <div class="small mb-3">
                                        @if ($formation->duree)
                                            <p><i class="bi bi-clock"></i> <strong>Durée:</strong>
                                                {{ $formation->duree }} heures</p>
                                        @endif
                                        @if ($formation->niveau)
                                            <p><i class="bi bi-graph-up"></i> <strong>Niveau:</strong>
                                                {{ $formation->niveau }}</p>
                                        @endif
                                        @if ($formation->tarif)
                                            <p><i class="bi bi-tag"></i> <strong>Tarif:</strong>
                                                {{ $formation->tarif }} DH</p>
                                        @endif

                                        <!-- Instructors -->
                                        @if ($formation->formateurs && $formation->formateurs->count() > 0)
                                            <p><i class="bi bi-person-fill"></i> <strong>Instructeur(s):</strong><br>
                                                @foreach ($formation->formateurs as $formateur)
                                                    <span
                                                        class="badge bg-secondary">{{ $formateur->user->name ?? 'N/A' }}</span>
                                                @endforeach
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Registration Form -->
                                    <form method="POST" action="{{ route('apprenant.inscrire') }}" class="w-100">
                                        @csrf
                                        <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-person-plus-fill"></i> S'inscrire
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle-fill"></i> Aucune formation disponible pour le moment.
                </div>
            @endif
        </div>

        <!-- 3. Sessions de formation -->
        <div class="tab-pane fade" id="sessions" role="tabpanel">
            @if ($sessions->count() > 0)
                <div class="row">
                    @foreach ($sessions as $session)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="bi bi-calendar2"></i>
                                        {{ $session->formation->titre }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong><i class="bi bi-calendar-check"></i> Début:</strong><br>
                                                {{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong><i class="bi bi-calendar-x"></i> Fin:</strong><br>
                                                {{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if ($session->lieu)
                                        <p><strong><i class="bi bi-geo-alt-fill"></i> Lieu:</strong>
                                            {{ $session->lieu }}</p>
                                    @endif

                                    @if ($session->capacite)
                                        <p><strong><i class="bi bi-people-fill"></i> Capacité:</strong>
                                            {{ $session->capacite }} places</p>
                                    @endif

                                    <div>
                                        <span
                                            class="badge bg-{{ $session->statut === 'ouverte' ? 'success' : 'danger' }}">
                                            {{ ucfirst($session->statut) }}
                                        </span>
                                    </div>

                                    @if ($session->statut === 'ouverte')
                                        <form method="POST" action="{{ route('apprenant.inscrire') }}"
                                            class="mt-3">
                                            @csrf
                                            <input type="hidden" name="formation_id"
                                                value="{{ $session->formation->id }}">
                                            <button type="submit" class="btn btn-info btn-sm w-100">
                                                <i class="bi bi-person-plus-fill"></i> S'inscrire à cette session
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle-fill"></i> Aucune session disponible.
                </div>
            @endif
        </div>

    </div>
</div>

<!-- Search Script -->
<script>
    document.getElementById('searchFormations')?.addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const formations = document.querySelectorAll('.formation-item');
        formations.forEach(formation => {
            const text = formation.textContent.toLowerCase();
            formation.style.display = text.includes(query) ? '' : 'none';
        });
    });
</script>

<style>
    .formation-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .formation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
    }
</style>
</x-admin-layout>
