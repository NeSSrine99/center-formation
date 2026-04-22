<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">
            <i class="fa fa-book me-3"></i>Center Formation
        </h2>
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">

        <!-- LEFT MENU -->
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                Accueil
            </a>

            <a href="#about" class="nav-item nav-link">À propos</a>
            <a href="#courses" class="nav-item nav-link">Cours</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    Pages
                </a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="#team" class="dropdown-item">Notre Équipe</a>
                    <a href="#testimonial" class="dropdown-item">Témoignages</a>
                    <a href="#contact" class="dropdown-item">Contact</a>
                </div>
            </div>

            <a href="#contact" class="nav-item nav-link">Contact</a>

            <!-- AUTH PART -->
            @auth
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                        data-bs-toggle="dropdown">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                            class="rounded-circle me-2" width="35" height="35">

                        {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 mr-0">

                        <li class="px-3 py-2 border-bottom">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('courses') }}">
                                <i class="bi bi-journal-check me-2"></i> Mes Formations
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-credit-card me-2"></i> Paiements
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <!-- GUEST BUTTONS -->
                <div class="d-flex ms-3 align-items-center">

                    <!-- LOGIN -->
                    <a href="{{ route('login') }}"
                        class="btn btn-outline-primary me-2 px-4 py-2 rounded-pill fw-semibold custom-login">
                        Se connecter
                    </a>

                    <!-- REGISTER -->
                    <a href="{{ route('register') }}"
                        class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow custom-register d-none d-lg-block">
                        S'inscrire
                    </a>

                </div>
            @endauth

        </div>
    </div>
</nav>
<!-- Navbar End -->
