<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid my-4">
        <!-- Stats Row -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2>{{ \App\Models\User::count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Formateurs</h5>
                        <h2>{{ \App\Models\User::where('role', 'formateur')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Apprenants</h5>
                        <h2>{{ \App\Models\User::where('role', 'apprenant')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Administrateurs</h5>
                        <h2>{{ \App\Models\User::where('role', 'administrateur')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Gestion de Plateforme</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('admin.users') }}" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-people-fill"></i> Gérer les Utilisateurs
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('admin.settings') }}" class="btn btn-secondary btn-lg w-100">
                                    <i class="bi bi-gear-fill"></i> Paramètres
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-info btn-lg w-100" disabled>
                                    <i class="bi bi-bar-chart-fill"></i> Statistiques
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
