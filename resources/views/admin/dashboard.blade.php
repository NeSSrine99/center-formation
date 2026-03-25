<x-admin-layout>
    @section('header', 'Dashboard Administrateur')

    <div class="container-fluid my-4">

        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card card-primary shadow-lg">
                    <div class="card-body text-center">
                        <h6>Total Users</h6>
                        <h1>{{ \App\Models\User::count() }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-info shadow-lg">
                    <div class="card-body text-center">
                        <h6>Formateurs</h6>
                        <h1>{{ \App\Models\User::where('role', 'formateur')->count() }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-success shadow-lg">
                    <div class="card-body text-center">
                        <h6>Apprenants</h6>
                        <h1>{{ \App\Models\User::where('role', 'apprenant')->count() }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-danger shadow-lg">
                    <div class="card-body text-center">
                        <h6>Administrateurs</h6>
                        <h1>{{ \App\Models\User::where('role', 'administrateur')->count() }}</h1>
                    </div>
                </div>
            </div>

        </div>

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 ">Gestion de Plateforme</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-people-fill"></i> Gérer les Utilisateurs
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.formations') }}" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-book-fill"></i> Gérer les Formations
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.sessions') }}" class="btn btn-warning btn-lg w-100">
                            <i class="bi bi-calendar-event-fill"></i> Gérer les Sessions
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.settings') }}" class="btn btn-secondary btn-lg w-100">
                            <i class="bi bi-gear-fill"></i> Paramètres
                        </a>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-info btn-lg w-100" disabled>
                            <i class="bi bi-bar-chart-fill"></i> Statistiques
                        </button>
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-admin-layout>
