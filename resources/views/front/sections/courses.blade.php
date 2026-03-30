<!-- Courses Start -->
<div class="container-xxl py-5" id="courses">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Formations</h6>
            <h1 class="mb-5">Nos Formations Populaires</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse ($formations ?? [] as $formation)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="{{ asset('img/course-' . (($loop->index % 3) + 1) . '.jpg') }}"
                                alt="{{ $formation->titre }}" style="height: 200px; object-fit: cover;">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="{{ route('course.detail', $formation->id) }}"
                                    class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                    style="border-radius: 30px 0 0 30px;">
                                    <i class="bi bi-eye"></i> En savoir plus
                                </a>
                                <a href="{{ route('apprenant.inscriptions') }}"
                                    class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                    style="border-radius: 0 30px 30px 0;">
                                    <i class="bi bi-bookmark-check"></i> S'inscrire
                                </a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0" style="color: #06BBCC;">{{ number_format($formation->tarif, 2) }} DH</h3>
                            <div class="mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <small class="fa fa-star text-primary"></small>
                                @endfor
                                <small>({{ $formation->sessions->sum(fn($s) => $s->inscriptions->count()) }})</small>
                            </div>
                            <h5 class="mb-4">{{ $formation->titre }}</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-user-tie text-primary me-2"></i>
                                @if ($formation->formateurs->first())
                                    {{ $formation->formateurs->first()->user->name }}
                                @else
                                    N/A
                                @endif
                            </small>
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-clock text-primary me-2"></i>
                                {{ $formation->duree }} jours
                            </small>
                            <small class="flex-fill text-center py-2">
                                <i class="fa fa-users text-primary me-2"></i>
                                {{ $formation->sessions->sum(fn($s) => $s->inscriptions->count()) }} Apprenants
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Aucune formation disponible pour le moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Courses End -->
