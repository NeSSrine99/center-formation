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
        :root {
            --primary: #6366f1;
            --secondary: #1e293b;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #334155;
            --muted: #94a3b8;
        }

        /* Reset */
        body {
            background-color: var(--bg);
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            background: var(--secondary);
            color: white;
            padding: 1.5rem 1rem;
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar-header h5 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        /* Nav links */
        .admin-sidebar .nav-link {
            color: var(--muted);
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .admin-sidebar .nav-link.active {
            background: var(--primary);
            color: white;
        }

        /* Header */
        .admin-header {
            margin-left: 260px;
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h4 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text);
        }

        /* Content */
        .admin-content {
            margin-left: 260px;
            padding: 2rem;
        }

        /* Cards (important for next pages) */
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #4f46e5;
        }

        /* User info */
        .user-info {
            margin-top: auto;
            padding-top: 1rem;
        }

        .user-avatar {
            background: var(--primary);
        }

        /* Role selector */
        .role-selector {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                left: -260px;
                transition: 0.3s;
            }

            .admin-sidebar.show {
                left: 0;
            }

            .admin-header,
            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h5>
                    <i class="bi bi-shield-check"></i>
                    <span
                        id="roleDisplay">{{ auth()->user()->isAdministrateur() ? 'Admin' : (auth()->user()->isFormateur() ? 'Formateur' : 'Apprenant') }}</span>
                </h5>
            </div>

            <ul class="nav flex-column" id="sidebarNav">
                <!-- Main Section -->
                <div class="nav-section-title">Menu Principal</div>

                <li class="nav-item">
                    <a class="nav-link dashboard-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('formateur.dashboard') || request()->routeIs('apprenant.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Dynamic Content will be loaded here -->
                <div id="roleSpecificNav"></div>
            </ul>

            <!-- User Info -->
            <div class="user-info">
                <div class="user-info-header">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info-text">
                        <strong>{{ auth()->user()->name }}</strong><br>
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-sm logout-btn logout-link">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content Wrapper -->
        <div style="flex: 1; width: 100%;">
            <!-- Header -->
            <header class="admin-header">
                <h4>
                    <i class="bi bi-speedometer2"></i>
                    {{ $header ?? 'Administration' }}
                </h4>

                <div class="header-actions">
                    <!-- Role Selector -->
                    <select id="roleSelector" class="role-selector" onchange="changeRole(this.value)">
                        <option value="admin" {{ auth()->user()->isAdministrateur() ? 'selected' : '' }}>Admin
                        </option>
                        <option value="formateur" {{ auth()->user()->isFormateur() ? 'selected' : '' }}>Formateur
                        </option>
                        <option value="apprenant" {{ auth()->user()->isApprenant() ? 'selected' : '' }}>Apprenant
                        </option>
                    </select>

                    <!-- Mobile menu toggle -->
                    <button class="btn btn-outline-secondary d-md-none" type="button"
                        onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <main class="admin-content">
                {{ $slot }}
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

        // Close mobile sidebar on link click
        document.querySelectorAll('.admin-sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    document.querySelector('.admin-sidebar').classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
