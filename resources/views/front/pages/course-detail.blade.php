@extends('front.layouts.main', ['title' => isset($formation) ? $formation->titre : 'Détails du cours'])

@section('content')
    @if (isset($formation))
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <!-- Course Image -->
                    <div class="col-lg-6">
                        <div class="position-relative overflow-hidden rounded-lg" style="height: 400px;">
                            <img class="img-fluid w-100 h-100" src="{{ asset('img/course-1.jpg') }}"
                                alt="{{ $formation->titre }}" style="object-fit: cover;">
                        </div>
                    </div>

                    <!-- Course Details -->
                    <div class="col-lg-6">
                        <h1 class="mb-4 display-4">{{ $formation->titre }}</h1>

                        <div class="mb-3">
                            <span class="badge bg-primary p-2">{{ $formation->niveau }}</span>
                            <span class="badge bg-success p-2 ms-2">{{ $formation->sessions->count() }} sessions</span>
                        </div>

                        <h2 class="mb-4" style="color: #06BBCC;">{{ number_format($formation->tarif, 2) }} DH</h2>

                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <h6 class="text-muted">Durée</h6>
                                <h5 class="mb-0">
                                    <i class="bi bi-clock-history text-primary me-2"></i>{{ $formation->duree }} jours
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="text-muted">Apprenants Inscrits</h6>
                                <h5 class="mb-0">
                                    <i
                                        class="bi bi-people text-primary me-2"></i>{{ $formation->sessions->sum(fn($s) => $s->inscriptions->count()) }}
                                </h5>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-3">Formateur(s):</h6>
                            @if ($formation->formateurs->isEmpty())
                                <p class="text-muted">À déterminer</p>
                            @else
                                @foreach ($formation->formateurs as $formateur)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            {{ strtoupper(substr($formateur->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $formateur->user->name }}</h6>
                                            <small class="text-muted">{{ $formateur->specialite }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Enrollment -->
                        @auth
                            @if (auth()->user()->isApprenant())
                                <a href="{{ route('apprenant.inscriptions') }}" class="btn btn-primary btn-lg w-100 py-3 mb-3">
                                    <i class="bi bi-bookmark-check-fill me-2"></i>S'inscrire à cette formation
                                </a>
                            @else
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Vous devez être apprenant pour vous inscrire à une formation.
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 py-3 mb-3">
                                <i class="bi bi-door-closed me-2"></i>Se connecter pour s'inscrire
                            </a>
                        @endauth

                        <a href="{{ route('courses') }}" class="btn btn-outline-secondary btn-lg w-100 py-3">
                            <i class="bi bi-arrow-left me-2"></i>Retour aux formations
                        </a>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="row g-5 mt-5">
                    <div class="col-lg-12">
                        <h3 class="mb-4">À propos de cette formation</h3>
                        <p class="fs-5 text-muted mb-4">{{ $formation->description ?? 'Aucune description disponible.' }}
                        </p>

                        @if ($formation->sessions->isNotEmpty())
                            <h4 class="mb-4">Sessions disponibles</h4>
                            <div class="row g-4">
                                @foreach ($formation->sessions as $session)
                                    <div class="col-md-6">
                                        <div class="card border-primary">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $formation->titre }}</h5>
                                                <p class="card-text">
                                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                                    <strong>Début:</strong>
                                                    {{ \Carbon\Carbon::parse($session->date_debut)->format('d/m/Y') }}<br>
                                                    <strong>Fin:</strong>
                                                    {{ \Carbon\Carbon::parse($session->date_fin)->format('d/m/Y') }}<br>
                                                    <strong>Lieu:</strong> {{ $session->lieu ?? 'Ligne' }}<br>
                                                    <strong>Capacité:</strong>
                                                    {{ $session->inscriptions->count() }}/{{ $session->capacite }}
                                                </p>
                                                <span class="badge"
                                                    style="background-color: {{ $session->statut === 'ouverte' ? '#06BBCC' : '#dc3545' }};">
                                                    {{ ucfirst($session->statut) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container py-5">
            <div class="alert alert-danger">
                Formation non trouvée.
            </div>
        </div>
    @endif
@endsection
