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
                                <th>Nom</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Capacité</th>
                                <th>État</th>
                                <th>Formations</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->id }}</td>
                                    <td>{{ $session->nom ?? '—' }}</td>
                                    <td>{{ optional($session->debut)->format('Y-m-d') ?? '—' }}</td>
                                    <td>{{ optional($session->fin)->format('Y-m-d') ?? '—' }}</td>
                                    <td>{{ $session->capacite }}</td>
                                    <td>{{ ucfirst($session->etat) }}</td>
                                    <td>{{ $session->formations->pluck('titre')->join(', ') }}</td>
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
