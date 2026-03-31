<x-admin-layout>
    @section('header', 'Nouvelle Formation')

    <style>
        .form-wrapper {
            max-width: 900px;
            margin: auto;
            margin-top: 40px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .form-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-back {
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>

    <div class="form-wrapper">

        <a href="{{ route('admin.formations') }}" class="btn-back">← Retour</a>

        @include('partials.alerts')

        <div class="form-card">

            <div class="form-title">Créer une nouvelle formation</div>

            <form action="{{ route('admin.store-formation') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Titre</label>
                        <input type="text" name="titre" class="form-control" placeholder="Nom de la formation">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Niveau</label>
                        <input type="text" name="niveau" class="form-control"
                            placeholder="Débutant / Intermédiaire">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Description..."></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Durée (jours)</label>
                        <input type="number" name="duree" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tarif (DH)</label>
                        <input type="number" name="tarif" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Formateurs</label>
                        <select name="formateur_ids[]" class="form-select" multiple>
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}">
                                    {{ $formateur->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button class="btn btn-primary mt-4 w-100">
                    🚀 Créer Formation
                </button>

            </form>

        </div>

    </div>
</x-admin-layout>
