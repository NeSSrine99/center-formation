<!-- Team Start -->
<div class="container-xxl py-5" id="team">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Experts</h6>
            <h1 class="mb-5">Nos Formateurs</h1>
        </div>
        <div class="row g-4">
            @forelse ($formateurs ?? [] as $formateur)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden"
                            style="background-color: #f0fbfc; height: 220px; display: flex; align-items: center; justify-content: center;">
                            <div style="text-align: center;">
                                <div
                                    style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #06BBCC 0%, #0098b5 100%); margin: 0 auto; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold;">
                                    {{ strtoupper(substr($formateur->user->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="" title="Facebook"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="" title="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="" title="Instagram"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">{{ $formateur->user->name }}</h5>
                            <small class="text-primary"
                                style="font-weight: 600;">{{ $formateur->specialite ?? 'Expert' }}</small>
                            <p class="mt-2 mb-0" style="font-size: 0.85rem; color: #666;">
                                {{ Str::limit($formateur->bio, 60) ?? 'Formateur expérimenté' }}
                            </p>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-briefcase"></i> {{ $formateur->experience ?? '0' }} ans d'expérience
                            </small>
                        </div>
                        <div class="text-center pb-3">
                            <a href="{{ route('instructor', $formateur->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-right"></i> Voir profil
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Nos formateurs seront bientôt disponibles.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Team End -->
