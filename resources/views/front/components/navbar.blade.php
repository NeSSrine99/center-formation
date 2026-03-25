<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}"
                class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
            <a href="#about" class="nav-item nav-link">À propos</a>
            <a href="#courses" class="nav-item nav-link">Cours</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="#team" class="dropdown-item">Notre Équipe</a>
                    <a href="#testimonial" class="dropdown-item">Témoignages</a>
                    <a href="#contact" class="dropdown-item">Contact</a>
                </div>
            </div>
            <a href="#contact" class="nav-item nav-link">Contact</a>
        </div>

        @guest
            <div class="d-flex px-4 px-lg-0">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">S'inscrire<i
                        class="fa fa-arrow-right ms-3"></i></a>
            </div>
        @else
            <div class="d-flex px-4 px-lg-0 align-items-center">
                <span class="me-3 text-dark">Bienvenue, {{ auth()->user()->name }}</span>
                <a href="{{ route('dashboard') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Mon Espace<i
                        class="fa fa-arrow-right ms-3"></i></a>
            </div>
        @endguest
    </div>
</nav>
<!-- Navbar End -->
