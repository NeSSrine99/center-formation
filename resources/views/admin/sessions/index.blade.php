<x-admin-layout>
    @section('header', 'Gestion des Sessions')

    <div class="container-fluid mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.create-session') }}" class="btn btn-success">Nouvelle session</a>
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
                                <th>Formation</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Lieu</th>
                                <th>Capacité</th>
                                <th>Statut</th>
                                <th>Inscriptions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->id }}</td>
                                    <td>{{ $session->formation->titre ?? '—' }}</td>
                                    <td>{{ optional($session->date_debut)->format('Y-m-d') ?? '—' }}</td>
                                    <td>{{ optional($session->date_fin)->format('Y-m-d') ?? '—' }}</td>
                                    <td>{{ $session->lieu ?? '—' }}</td>
                                    <td>{{ $session->capacite }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $session->statut === 'ouverte' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($session->statut) }}
                                        </span>
                                    </td>
                                    <td>{{ $session->inscriptions->count() }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.edit-session', $session->id) }}"
                                            class="btn btn-sm btn-primary">Éditer</a>
                                        <form action="{{ route('admin.delete-session', $session->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
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
