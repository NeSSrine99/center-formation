<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            overflow-x: hidden;
        }

        /* Sidebar */
        .admin-sidebar {
            background: linear-gradient(135deg, #246b77, #032d33);
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s;
            z-index: 1030;
            overflow-y: auto;
        }

        .admin-sidebar h5 {
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(6px);
        }

        .admin-sidebar .nav-link.active {
            background: white;
            color: #57d8e9;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Main content */
        .admin-content {
            margin-left: 250px;
            transition: margin-left 0.3s;
            min-height: 100vh;
        }

        header {
            border-radius: 0 0 20px 20px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        header h4 {
            font-weight: 700;
            color: #1e293b;
        }

        /* Avatar */
        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #286570, #033238);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .btn-logout {
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #57d8e9;
            color: white;
        }

        /* Responsive for mobile */
        @media (max-width: 768px) {
            .admin-sidebar {
                left: -260px;
            }

            .admin-sidebar.show {
                left: 0;
            }

            .admin-content {
                margin-left: 0;
            }

            /* Overlay */
            body.overlay-active::before {
                content: '';
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1020;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="admin-sidebar" id="sidebar">
        <h5 class="mb-4"><i class="bi bi-shield-check"></i> Admin Panel</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                    href="{{ route('admin.users') }}"><i class="bi bi-people"></i> Utilisateurs</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.formations') ? 'active' : '' }}"
                    href="{{ route('admin.formations') }}"><i class="bi bi-book"></i> Formations</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.sessions') ? 'active' : '' }}"
                    href="{{ route('admin.sessions') }}"><i class="bi bi-calendar"></i> Sessions</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                    href="{{ route('admin.settings') }}"><i class="bi bi-gear"></i> Paramètres</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> Retour
                    au site</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <main class="admin-content">
        <header class="p-3 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $header ?? 'Administration' }}</h4>
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-bell fs-5 text-muted"></i>

                <!-- User dropdown -->
                <div class="dropdown">
                    <button class="btn d-flex align-items-center gap-2 dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">
                        <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <span class="fw-semibold">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li class="px-3 py-2"><small class="text-muted">{{ auth()->user()->email }}</small></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i>
                                    Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Mobile toggle -->
                <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle"><i
                        class="bi bi-list"></i></button>
            </div>
        </header>

        <div class="p-4">{{ $slot }}</div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');

        // Open/close sidebar
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            document.body.classList.toggle('overlay-active');
        });

        // Close sidebar when clicking outside (mobile)
        document.body.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('show');
                document.body.classList.remove('overlay-active');
            }
        });
    </script>
</body>

</html>
