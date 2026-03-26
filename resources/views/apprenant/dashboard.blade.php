<!-- Mes Formations -->
<div class="tab-pane fade show active" id="formations" role="tabpanel" aria-labelledby="formations-tab">
    @if ($myFormations->isEmpty())
        <div class="alert alert-info">Vous n'avez aucune formation pour le moment.</div>
    @else
        <div class="row g-4">
            @foreach ($myFormations as $formation)
                <div class="col-md-12">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $formation->title }}</h5>
                            <span class="badge bg-light text-primary">{{ $formation->sessions->count() }}
                                Sessions</span>
                        </div>
                        <div class="card-body">
                            <p>{{ $formation->description ?? 'Pas de description disponible.' }}</p>
                            <div class="d-flex justify-content-between">
                                <span>Prix: €{{ number_format($formation->price, 2) }}</span>
                                <span>Durée: {{ $formation->duration }} heures</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Inscriptions -->
<div class="tab-pane fade" id="inscriptions" role="tabpanel" aria-labelledby="inscriptions-tab">
    @if ($inscriptions->isEmpty())
        <div class="alert alert-info">Vous n'êtes inscrit à aucune session pour le moment.</div>
    @else
        <div class="list-group">
            @foreach ($inscriptions as $inscription)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $inscription->session->formation->title }}</strong><br>
                        <small class="text-muted">
                            Session du {{ \Carbon\Carbon::parse($inscription->session->start_date)->format('d/m/Y') }}
                            au {{ \Carbon\Carbon::parse($inscription->session->end_date)->format('d/m/Y') }}
                        </small>
                    </div>
                    <span class="badge bg-success">Inscrit</span>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Paiements -->
<div class="tab-pane fade" id="paiements" role="tabpanel" aria-labelledby="paiements-tab">
    @if ($paiements->isEmpty())
        <div class="alert alert-info">Aucun paiement effectué pour le moment.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Formation</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paiements as $paiement)
                    <tr>
                        <td>{{ $paiement->formation->title }}</td>
                        <td>€{{ number_format($paiement->amount, 2) }}</td>
                        <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $paiement->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($paiement->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
