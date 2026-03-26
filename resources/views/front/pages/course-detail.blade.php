@extends('layouts.PublicLayout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $course['title'] }}</h1>
                        <p class="mb-4">{{ $course['description'] ?? 'Description du cours.' }}</p>
                        <p><strong>Formateur:</strong> {{ $course['instructor'] }}</p>
                        <p><strong>Durée:</strong> {{ $course['duration'] }}</p>
                        <p><strong>Tarif:</strong> €{{ number_format($course['price'], 2) }}</p>
                        @auth
                            <form method="POST" action="{{ route('apprenant.inscrire') }}">
                                @csrf
                                <input type="hidden" name="session_id" value="{{ $course['id'] }}">
                                <button class="btn btn-success">S'inscrire à cette formation</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Connectez-vous pour vous inscrire</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
