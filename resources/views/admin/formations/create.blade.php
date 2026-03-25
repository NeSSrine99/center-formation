<x-admin-layout>
    @section('header', 'Nouvelle Formation')

    <div class="container-fluid mt-4">
        <a href="{{ route('admin.formations') }}" class="btn btn-secondary mb-3">Retour</a>

        @include('partials.alerts')

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.store-formation') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Durée (jours)</label>
                            <input type="number" name="duree_jours" class="form-control" min="1"
                                value="{{ old('duree_jours') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" name="prix" class="form-control"
                                value="{{ old('prix', 0) }}">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Formateurs</label>
                        <select name="formateur_ids[]" class="form-control" multiple>
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}">{{ $formateur->nom }} ({{ $formateur->email }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Maintenez Ctrl/Cmd pour sélectionner plusieurs.</small>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Sessions</label>
                        <select name="session_ids[]" class="form-control" multiple>
                            @foreach ($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->nom }}
                                    ({{ optional($session->debut)->format('Y-m-d') ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
