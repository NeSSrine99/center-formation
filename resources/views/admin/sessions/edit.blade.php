<x-admin-layout>
    @section('header', 'Éditer Session')

    <div class="container-fluid mt-4">
        <a href="{{ route('admin.sessions') }}" class="btn btn-secondary mb-3">Retour</a>

        @include('partials.alerts')

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.update-session', $session->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Formation</label>
                        <select name="formation_id" class="form-control" required>
                            <option value="">-- Sélectionner une formation --</option>
                            @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}"
                                    {{ old('formation_id', $session->formation_id) == $formation->id ? 'selected' : '' }}>
                                    {{ $formation->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Début</label>
                            <input type="date" name="date_debut" class="form-control"
                                value="{{ old('date_debut', optional($session->date_debut)->format('Y-m-d')) }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fin</label>
                            <input type="date" name="date_fin" class="form-control"
                                value="{{ old('date_fin', optional($session->date_fin)->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="lieu" class="form-control"
                                value="{{ old('lieu', $session->lieu) }}" placeholder="ex: Salle 101, En ligne">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Capacité</label>
                            <input type="number" name="capacite" class="form-control" min="1"
                                value="{{ old('capacite', $session->capacite) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-control" required>
                                <option value="ouverte" @if (old('statut', $session->statut) == 'ouverte') selected @endif>Ouverte
                                </option>
                                <option value="fermee" @if (old('statut', $session->statut) == 'fermee') selected @endif>Fermée</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
