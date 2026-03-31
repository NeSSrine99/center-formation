<x-admin-layout>
    @section('header', 'Mes Cours')

    <div class="container-fluid my-5">
        @php
            $courses = \App\Models\Formation::where('formateur_id', auth()->id())
                ->latest()
                ->get();
        @endphp

        @if ($courses->isEmpty())
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Vous n'avez encore aucun cours.
            </div>
        @else
            <div class="row g-4">
                @foreach ($courses as $course)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->titre }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($course->description, 80) }}</p>
                                <a href="{{ route('formateur.courses.show', $course->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-arrow-right-circle"></i> Détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-admin-layout>
