<x-admin-layout>
    @section('header', 'Nouvelle Session')

    <div class="container-fluid mt-4">
        <a href="{{ route('admin.sessions') }}" class="btn btn-secondary mb-3">Retour</a>

        @include('partials.alerts')

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.store-session') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Formation</label>
                        <select name="formation_id" class="form-control" required>
                            <option value="">-- Sélectionner une formation --</option>
                            @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}"
                                    {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                    {{ $formation->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Début</label>
                            <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fin</label>
                            <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="lieu" class="form-control" value="{{ old('lieu') }}"
                                placeholder="ex: Salle 101, En ligne">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Capacité</label>
                            <input type="number" name="capacite" class="form-control" min="1"
                                value="{{ old('capacite', 20) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-control" required>
                                <option value="ouverte" @if (old('statut') == 'ouverte') selected @endif>Ouverte
                                </option>
                                <option value="fermee" @if (old('statut') == 'fermee') selected @endif>Fermée</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
