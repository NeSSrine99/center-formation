<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">
            {{ __('Gestion des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Liste des Utilisateurs</h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('admin.create-user') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Créer un Nouvel Utilisateur
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Date de Création</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge
                                                @if ($user->role === 'administrateur') bg-danger
                                                @elseif($user->role === 'formateur') bg-info
                                                @else bg-success @endif">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.edit-user', $user->id) }}"
                                                    class="btn btn-sm btn-warning" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i> Modifier
                                                </a>
                                                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                        <i class="bi bi-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Aucun utilisateur trouvé.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
