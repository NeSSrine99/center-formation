@extends('front.layouts.main', ['title' => isset($formateur) ? $formateur->user->name : 'Profil Formateur'])

@section('content')
    @if (isset($formateur))
        <div class="container-xxl py-5">
            <div class="container">
                <!-- Formateur Header -->
                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <div class="text-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4"
                                style="width: 200px; height: 200px; font-size: 80px; font-weight: bold;">
                                {{ strtoupper(substr($formateur->user->name, 0, 1)) }}
                            </div>
                            <h2 class="mb-2">{{ $formateur->user->name }}</h2>
                            <h5 class="text-primary mb-4">{{ $formateur->specialite ?? 'Formateur' }}</h5>

                            <div class="d-flex justify-content-center gap-2 mb-4">
                                <a href="#" class="btn btn-sm btn-primary rounded-circle p-2" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary rounded-circle p-2" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary rounded-circle p-2" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary rounded-circle p-2" title="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h4 class="mb-3">À propos</h4>
                                <p class="text-muted fs-5">
                                    {{ $formateur->bio ?? 'Formateur expérimenté et passionné par l\'enseignement.' }}</p>

                                <div class="row g-4 mt-4">
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h3 class="text-primary mb-0">{{ $formateur->experience ?? '0' }}</h3>
                                            <small class="text-muted">Ans d'expérience</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h3 class="text-primary mb-0">{{ count($formations ?? []) }}</h3>
                                            <small class="text-muted">Formations</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h3 class="text-primary mb-0">
                                                @php
                                                    $totalStudents = 0;
                                                    foreach ($formations ?? [] as $formation) {
                                                        $totalStudents += $formation->sessions->sum(
                                                            fn($s) => $s->inscriptions->count(),
                                                        );
                                                    }
                                                @endphp
                                                {{ $totalStudents }}
                                            </h3>
                                            <small class="text-muted">Apprenants</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3">Coordonnées</h5>
                                <p class="mb-2">
                                    <strong>Email:</strong> {{ $formateur->user->email }}
                                </p>
                                <p class="mb-0">
                                    <strong>Tél:</strong> N/A
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formations du Formateur -->
                <h3 class="mb-4">Formations de {{ $formateur->user->name }}</h3>

                @if ($formations && $formations->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($formations as $formation)
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div
                                        style="background: linear-gradient(135deg, #06BBCC 0%, #0098b5 100%); height: 150px; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                        <i class="bi bi-book-fill"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-2">{{ $formation->titre }}</h5>
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($formation->description, 60) }}</p>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="text-muted">Durée</small>
                                                <small class="fw-bold">{{ $formation->duree }} jours</small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">Tarif</small>
                                                <small class="fw-bold"
                                                    style="color: #06BBCC;">{{ number_format($formation->tarif, 2) }}
                                                    DH</small>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <a href="{{ route('course.detail', $formation->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye me-1"></i> Voir détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Ce formateur n'a pas encore de formations disponibles.
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="container py-5">
            <div class="alert alert-danger">
                Formateur non trouvé.
            </div>
        </div>
    @endif
@endsection
