<x-admin-layout>
    @section('header', 'Dashboard Formateur')

    <div class="container-fluid my-4">
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-success">
                    <div class="card-body text-center">
                        <h6>Mes Formations</h6>
                        <h1>{{ \App\Models\Formation::count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-info">
                    <div class="card-body text-center">
                        <h6>Sessions Actives</h6>
                        <h1>{{ \App\Models\Session::where('etat', 'ouverte')->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body text-center">
                        <h6>Inscriptions</h6>
                        <h1>{{ \App\Models\Inscription::count() }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success">
            Bienvenue sur votre espace formateur ! Gérez vos formations, sessions et apprenants depuis le menu.
        </div>
    </div>
</x-admin-layout>
