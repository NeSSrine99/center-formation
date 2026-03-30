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
                        <div class="col-md-3">
                            <label class="form-label">Durée (jours)</label>
                            <input type="number" name="duree" class="form-control" min="1"
                                value="{{ old('duree') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Niveau</label>
                            <input type="text" name="niveau" class="form-control" value="{{ old('niveau') }}"
                                placeholder="ex: Débutant, Intermédiaire">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tarif</label>
                            <input type="number" step="0.01" name="tarif" class="form-control"
                                value="{{ old('tarif', 0) }}">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Formateurs</label>
                        <select name="formateur_ids[]" class="form-control" multiple>
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}">{{ $formateur->user->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Maintenez Ctrl/Cmd pour sélectionner plusieurs.</small>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
