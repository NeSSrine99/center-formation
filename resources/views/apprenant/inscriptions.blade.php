<div class="container py-5">

    <h2 class="mb-4">Mes Formations</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="formationTabs">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#my-formations">
                Mes Formations
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#available">
                Disponibles
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sessions">
                Sessions
            </button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- 1. Mes formations -->
        <div class="tab-pane fade show active" id="my-formations">
            <div class="row">
                @foreach ($myFormations as $formation)
                    <div class="col-md-4 mb-4">
                        <div class="card formation-card h-100 shadow-sm">
                            <div class="card-body">
                                <h5>{{ $formation->title }}</h5>
                                <p class="text-muted">{{ Str::limit($formation->description, 80) }}</p>

                                <!-- Progress -->
                                <div class="progress mb-2">
                                    <div class="progress-bar" style="width: {{ $formation->progress ?? 50 }}%">
                                        {{ $formation->progress ?? 50 }}%
                                    </div>
                                </div>

                                <a href="{{ route('course.detail', $formation->id) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 2. Formations disponibles -->
        <div class="tab-pane fade" id="available">
            <div class="row">
                @foreach ($formations as $formation)
                    <div class="col-md-4 mb-4">
                        <div class="card formation-card h-100 shadow-sm">
                            <div class="card-body">
                                <h5>{{ $formation->title }}</h5>
                                <p>{{ Str::limit($formation->description, 80) }}</p>

                                <form method="POST" action="{{ route('apprenant.inscrire') }}">
                                    @csrf
                                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                                    <button class="btn btn-primary btn-sm w-100">
                                        S'inscrire
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 3. Sessions -->
        <div class="tab-pane fade" id="sessions">
            <div class="list-group">
                @foreach ($sessions as $session)
                    <a href="#" class="list-group-item list-group-item-action">
                        <strong>{{ $session->formation->title }}</strong><br>
                        <small>
                            {{ $session->start_date }} → {{ $session->end_date }}
                        </small>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
