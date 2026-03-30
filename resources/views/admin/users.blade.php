<x-admin-layout>
    @section('header', 'Gestion des Utilisateurs')

    <style>
        /* Body & card */
        body {
            background-color: #f4f6f8;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: 0.5px;
        }

        /* Table */
        .table {
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .table thead {
            background: #6366f1;
            color: white;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table tbody tr {
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.05);
            transform: scale(1.005);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(243, 244, 246, 0.8);
        }

        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.4rem 0.7rem;
            font-size: 0.85rem;
            border-radius: 10px;
            opacity: 0.95;
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .badge.bg-danger {
            background-color: #f87171 !important;
        }

        .badge.bg-info {
            background-color: #60a5fa !important;
        }

        .badge.bg-success {
            background-color: #34d399 !important;
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background-color: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #4f46e5;
        }

        .btn-success {
            background-color: #34d399;
            border-color: #34d399;
            color: white;
        }

        .btn-success:hover {
            background-color: #22c55e;
        }

        .btn-warning {
            background-color: #facc15;
            border-color: #facc15;
            color: #1e293b;
        }

        .btn-warning:hover {
            background-color: #fcd34d;
        }

        .btn-danger {
            background-color: #f87171;
            border-color: #f87171;
            color: white;
        }

        .btn-danger:hover {
            background-color: #ef4444;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Responsive soft padding */
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>

    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Liste des Utilisateurs</h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('admin.create-user') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Créer un Nouvel Utilisateur
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
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
                                                <span
                                                    class="badge
                                                @if ($user->role->name === 'administrateur') bg-danger
                                                @elseif($user->role->name === 'formateur') bg-info
                                                @else bg-success @endif">
                                                    {{ ucfirst($user->role->name) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.edit-user', $user->id) }}"
                                                    class="btn btn-sm btn-warning" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i> Modifier
                                                </a>
                                                <form action="{{ route('admin.delete-user', $user->id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Supprimer">
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
</x-admin-layout>
