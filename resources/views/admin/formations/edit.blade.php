<x-admin-layout>
    @section('header', 'Modifier Formation')

    <div class="form-wrapper">

        <a href="{{ route('admin.formations') }}" class="btn-back">← Retour</a>

        @include('partials.alerts')

        <div class="form-card">

            <div class="form-title">Modifier la formation</div>

            <form action="{{ route('admin.update-formation', $formation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Titre</label>
                        <input type="text" name="titre" class="form-control" value="{{ $formation->titre }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Niveau</label>
                        <input type="text" name="niveau" class="form-control" value="{{ $formation->niveau }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">
                        {{ $formation->description }}
                    </textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Durée</label>
                        <input type="number" name="duree" class="form-control" value="{{ $formation->duree }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tarif</label>
                        <input type="number" name="tarif" class="form-control" value="{{ $formation->tarif }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Formateurs</label>
                        <select name="formateur_ids[]" class="form-select" multiple>
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" @if ($formation->formateurs->contains($formateur->id)) selected @endif>
                                    {{ $formateur->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button class="btn btn-primary mt-4 w-100">
                    💾 Sauvegarder
                </button>

            </form>

        </div>

    </div>
</x-admin-layout>
