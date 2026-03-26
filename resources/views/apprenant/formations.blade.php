@extends('layouts.PublicLayout')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">

            <div class="text-center mb-5">
                <h6 class="section-title bg-white text-center text-primary px-3">Mes Formations</h6>
                <h1>Mes Cours & Sessions</h1>
            </div>

            @if ($myFormations->isEmpty())
                <div class="alert alert-info text-center">
                    Vous n'êtes inscrit à aucune formation pour le moment.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($myFormations as $formation)
                        <div class="col-lg-6 col-md-12">
                            <div class="card shadow-sm mb-4">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $formation->title }}</h5>
                                    <span class="badge bg-light text-primary">
                                        {{ $formation->sessions->count() }} Sessions
                                    </span>
                                </div>
                                <div class="card-body">

                                    <!-- Session List -->
                                    @if ($formation->sessions->isEmpty())
                                        <p class="text-muted">Aucune session disponible pour cette formation.</p>
                                    @else
                                        <ul class="list-group mb-3">
                                            @foreach ($formation->sessions as $session)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $session->title }}</strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            Du {{ $session->start_date->format('d/m/Y') }} au
                                                            {{ $session->end_date->format('d/m/Y') }}
                                                        </small>
                                                    </div>

                                                    <div class="text-end">
                                                        @php
                                                            $inscribed = $myFormations
                                                                ->where('id', $formation->id)
                                                                ->first()
                                                                ->inscriptions->contains('session_id', $session->id);
                                                        @endphp

                                                        @if ($inscribed)
                                                            <span class="badge bg-success">Inscrit</span>
                                                            <a href="{{ route('apprenant.progress', $formation->id) }}"
                                                                class="btn btn-sm btn-outline-primary ms-2">
                                                                Voir Progression
                                                            </a>
                                                        @else
                                                            <form method="POST" action="{{ route('apprenant.inscrire') }}"
                                                                class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="session_id"
                                                                    value="{{ $session->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary">S'inscrire</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <!-- Formation Details -->
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="text-muted">Prix: €{{ number_format($formation->price, 2) }}</span>
                                        <span class="text-muted">Durée: {{ $formation->duration }} heures</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection
