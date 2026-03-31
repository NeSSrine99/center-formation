<x-admin-layout>
    @section('header', 'Supports de Cours')

    <div class="container-fluid my-5">
        @php
            $materials = \App\Models\CourseMaterial::whereHas(
                'formation',
                fn($q) => $q->where('formateur_id', auth()->id()),
            )
                ->latest()
                ->get();
        @endphp

        @if ($materials->isEmpty())
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Aucun support disponible pour vos cours.
            </div>
        @else
            <div class="row g-4">
                @foreach ($materials as $material)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5>{{ $material->title }}</h5>
                                <p class="text-muted">{{ Str::limit($material->description, 80) }}</p>
                                <a href="{{ asset('storage/' . $material->file_path) }}" class="btn btn-primary btn-sm"
                                    target="_blank">
                                    <i class="bi bi-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-admin-layout>
