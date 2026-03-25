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
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $session->no) }}">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Début</label>
                            <input type="date" name="debut" class="form-control"
                                value="{{ old('debut', optional($session->debut)->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fin</label>
                            <input type="date" name="fin" class="form-control"
                                value="{{ old('fin', optional($session->fin)->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Capacité</label>
                            <input type="number" name="capacite" class="form-control" min="1"
                                value="{{ old('capacite', $session->capacite) }}" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Statut</label>
                        <select name="etat" class="form-control" required>
                            <option value="ouverte" @if (old('etat', $session->etat) == 'ouverte') selected @endif>Ouverte</option>
                            <option value="fermee" @if (old('etat', $session->etat) == 'fermee') selected @endif>Fermée</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Formations liées</label>
                        <select name="formation_ids[]" class="form-control" multiple>
                            @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}" @if ($session->formations->contains($formation->id)) selected @endif>
                                    {{ $formation->titre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
