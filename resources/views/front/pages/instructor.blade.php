@extends('layouts.PublicLayout')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2>Profil du Formateur</h2>
            <p>Découvrez le formateur et ses compétences.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>{{ $instructor['name'] ?? 'Formateur' }}</h4>
                        <p>{{ $instructor['bio'] ?? 'Bio du formateur.' }}</p>
                        <p><strong>Spécialité:</strong> {{ $instructor['title'] ?? '' }}</p>
                        <p><strong>Cours:</strong> {{ $instructor['courses'] ?? '' }}</p>
                        <p><strong>Étudiants:</strong> {{ $instructor['students'] ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
