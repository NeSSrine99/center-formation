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
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Début</label>
                            <input type="date" name="debut" class="form-control" value="{{ old('debut') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fin</label>
                            <input type="date" name="fin" class="form-control" value="{{ old('fin') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Capacité</label>
                            <input type="number" name="capacite" class="form-control" min="1"
                                value="{{ old('capacite', 20) }}" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Statut</label>
                        <select name="etat" class="form-control" required>
                            <option value="ouverte" @if (old('etat') == 'ouverte') selected @endif>Ouverte</option>
                            <option value="fermee" @if (old('etat') == 'fermee') selected @endif>Fermée</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Formations liées</label>
                        <select name="formation_ids[]" class="form-control" multiple>
                            @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
