@extends('layouts.PublicLayout')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="section-title bg-white text-center text-primary px-3">Cours</h6>
                <h1>Cours Populaires</h1>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ $course['image'] }}" alt="{{ $course['title'] }}">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="{{ route('course.detail', $course['id']) }}"
                                        class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                        style="border-radius: 30px 0 0 30px;">En savoir plus</a>
                                    @auth
                                        <form method="POST" action="{{ route('apprenant.inscrire') }}" class="m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="session_id" value="{{ $course['id'] }}">
                                            <button type="submit" class="btn btn-sm btn-success px-3"
                                                style="border-radius: 0 30px 30px 0;">S'inscrire</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="flex-shrink-0 btn btn-sm btn-success px-3"
                                            style="border-radius: 0 30px 30px 0;">Se connecter</a>
                                    @endauth
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">€{{ number_format($course['price'], 2) }}</h3>
                                <div class="mb-3">
                                    @for ($i = 0; $i < $course['rating']; $i++)
                                        <small class="fa fa-star text-primary"></small>
                                    @endfor
                                    <small>({{ $course['reviews'] }})</small>
                                </div>
                                <h5 class="mb-4">{{ $course['title'] }}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $course['instructor'] }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{ $course['duration'] }}</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $course['students'] }} Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
