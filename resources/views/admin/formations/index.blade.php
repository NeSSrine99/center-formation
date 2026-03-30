<x-admin-layout>
    @section('header', 'Gestion des Formations')

    <div class="container-fluid mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.create-formation') }}" class="btn btn-success">Nouvelle formation</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour dashboard</a>
        </div>

        @include('partials.alerts')

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Durée (jours)</th>
                                <th>Niveau</th>
                                <th>Tarif</th>
                                <th>Formateurs</th>
                                <th>Sessions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formations as $formation)
                                <tr>
                                    <td>{{ $formation->id }}</td>
                                    <td>{{ $formation->titre }}</td>
                                    <td>{{ $formation->duree ?? '-' }}</td>
                                    <td>{{ $formation->niveau ?? '-' }}</td>
                                    <td>{{ number_format($formation->tarif, 2, ',', ' ') }} DH</td>
                                    <td>
                                        @forelse($formation->formateurs as $formateur)
                                            <span class="badge bg-secondary">{{ $formateur->user->name }}</span>
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td>{{ $formation->sessions->count() }} session(s)</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.edit-formation', $formation->id) }}"
                                            class="btn btn-sm btn-primary">Éditer</a>
                                        <form action="{{ route('admin.delete-formation', $formation->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Confirmer la suppression ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
