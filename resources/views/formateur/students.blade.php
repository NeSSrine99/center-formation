<x-admin-layout>
    @section('header', 'Mes Apprenants')

    <div class="container-fluid my-5">
        @if ($students->isEmpty())
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Aucun apprenant inscrit pour vos cours.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Apprenant</th>
                            <th>Email</th>
                            <th>Cours</th>
                            <th>Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $inscription)
                            <tr>
                                <td>{{ $inscription->apprenant->name }}</td>
                                <td>{{ $inscription->apprenant->email }}</td>
                                <td>{{ $inscription->session->formation->titre }}</td>
                                <td>{{ \Carbon\Carbon::parse($inscription->date_inscription)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-admin-layout>
