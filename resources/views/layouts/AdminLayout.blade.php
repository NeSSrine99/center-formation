<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .admin-sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, .75);
        }

        .admin-sidebar .nav-link:hover {
            color: #fff;
        }

        .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }

        .admin-content {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block admin-sidebar text-white p-3">
                <div class="d-flex flex-column">
                    <h5 class="text-white mb-4">
                        <i class="bi bi-shield-check"></i>
                        {{ auth()->user()->isAdministrateur() ? 'Administration' : (auth()->user()->isFormateur() ? 'Espace Formateur' : 'Tableau de bord') }}
                    </h5>

                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>

                        @if (auth()->user()->isAdministrateur())
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                                    href="{{ route('admin.users') }}">
                                    <i class="bi bi-people"></i> Utilisateurs
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                                    href="{{ route('admin.settings') }}">
                                    <i class="bi bi-gear"></i> Paramètres
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->isFormateur())
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ request()->routeIs('formateur.courses') ? 'active' : '' }}"
                                    href="{{ route('formateur.courses') }}">
                                    <i class="bi bi-journal-bookmark"></i> Mes Cours
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ request()->routeIs('formateur.students') ? 'active' : '' }}"
                                    href="{{ route('formateur.students') }}">
                                    <i class="bi bi-people"></i> Mes Apprenants
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ request()->routeIs('formateur.materials') ? 'active' : '' }}"
                                    href="{{ route('formateur.materials') }}">
                                    <i class="bi bi-folder2-open"></i> Matériel
                                </a>
                            </li>
                        @endif
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                                href="{{ route('admin.settings') }}">
                                <i class="bi bi-gear"></i> Paramètres
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-arrow-left"></i> Retour au site
                            </a>
                        </li>
                    </ul>

                    <hr class="my-4">

                    <!-- User Info -->
                    <div class="mt-auto">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <small class="text-white-50">{{ auth()->user()->name }}</small><br>
                                <small class="text-white-50">{{ auth()->user()->email }}</small>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 admin-content bg-light">
                <!-- Header -->
                <header class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $header ?? 'Administration' }}</h4>

                    <!-- Mobile menu toggle -->
                    <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#adminSidebar">
                        <i class="bi bi-list"></i>
                    </button>
                </header>

                <!-- Page Content -->
                <div class="p-4">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Custom JavaScript for admin layout
        let myModalEl = document.querySelector('[data-modal="1"]');
        if (myModalEl) {
            const myModal = new bootstrap.Modal(myModalEl);
            myModal.show();
        }
    </script>
</body>

</html>
