<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Bienvenue sur eLEARNING
                            </h5>
                            <h1 class="display-3 text-white animated slideInDown">La meilleure plateforme
                                d'apprentissage en ligne</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Découvrez des cours de qualité dispensés par des
                                experts dans leur domaine. Apprenez à votre rythme et obtenez des certifications
                                reconnues.</p>
                            <a href="{{ route('register') }}"
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">S'inscrire</a>
                            <a href="#about" class="btn btn-light py-md-3 px-md-5 animated slideInRight">En savoir
                                plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Apprentissage Flexible
                            </h5>
                            <h1 class="display-3 text-white animated slideInDown">Apprenez n'importe où, n'importe quand
                            </h1>
                            <p class="fs-5 text-white mb-4 pb-2">Accédez à vos cours depuis votre ordinateur, tablette
                                ou smartphone. Notre plateforme est conçue pour s'adapter à votre emploi du temps.</p>
                            <a href="{{ route('login') }}"
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Se connecter</a>
                            <a href="#courses" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Voir les
                                cours</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->
