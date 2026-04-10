<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use App\Models\Inscription;
use App\Models\FormationSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /**
     * Inscrire un apprenant à une session de formation.
     */
    public function inscrire(InscriptionRequest $request)
    {
        $user = Auth::user();
        $apprenant = $user->apprenant;

        if (!$apprenant) {
            return back()->with('error', 'Profil apprenant non trouvé.');
        }

        $session = FormationSession::findOrFail($request->session_formation_id);

        // Vérifier si la session est ouverte
        if ($session->statut !== 'ouverte') {
            return back()->with('error', 'Cette session n\'est pas ouverte aux inscriptions.');
        }

        // Vérifier les doublons
        $exists = Inscription::where('apprenant_id', $apprenant->id)
            ->where('session_formation_id', $session->id)
            ->whereNotIn('statut', ['refusée'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit ou avez une demande en cours pour cette session.');
        }

        // Vérifier la capacité
        if ($session->available_places <= 0) {
            return back()->with('error', 'Cette session est complète.');
        }

        DB::transaction(function () use ($apprenant, $session) {
            Inscription::create([
                'apprenant_id' => $apprenant->id,
                'session_formation_id' => $session->id,
                'statut' => 'en_attente',
                'paiement' => false,
            ]);
        });

        return back()->with('success', 'Votre demande d\'inscription a été soumise et est en attente de validation.');
    }

    /**
     * Annuler une inscription.
     */
    public function annuler($id)
    {
        $inscription = Inscription::findOrFail($id);
        $user = Auth::user();
        $apprenant = $user->apprenant;

        if (!$apprenant || $inscription->apprenant_id !== $apprenant->id) {
            return back()->with('error', 'Non autorisé.');
        }

        if (!in_array($inscription->statut, ['en_attente', 'validée'])) {
            return back()->with('error', 'Cette inscription ne peut pas être annulée.');
        }

        DB::transaction(function () use ($inscription) {
            $inscription->update(['statut' => 'refusée']);
        });

        return back()->with('success', 'Inscription annulée avec succès.');
    }

    /**
     * Valider une inscription (Admin seulement).
     */
    public function valider($id)
    {
        $this->authorize('admin');

        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'en_attente') {
            return back()->with('error', 'Cette inscription ne peut pas être validée.');
        }

        // Vérifier la capacité
        $session = $inscription->session;
        if ($session->available_places <= 0) {
            return back()->with('error', 'La session est complète.');
        }

        DB::transaction(function () use ($inscription) {
            $inscription->update(['statut' => 'validée']);
        });

        return back()->with('success', 'Inscription validée avec succès.');
    }

    /**
     * Refuser une inscription (Admin seulement).
     */
    public function refuser($id)
    {
        $this->authorize('admin');

        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'en_attente') {
            return back()->with('error', 'Cette inscription ne peut pas être refusée.');
        }

        DB::transaction(function () use ($inscription) {
            $inscription->update(['statut' => 'refusée']);
        });

        return back()->with('success', 'Inscription refusée.');
    }

    /**
     * Marquer le paiement comme effectué (Admin seulement).
     */
    public function marquerPayee($id)
    {
        $this->authorize('admin');

        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'validée') {
            return back()->with('error', 'Seules les inscriptions validées peuvent être marquées comme payées.');
        }

        DB::transaction(function () use ($inscription) {
            $inscription->update(['paiement' => true]);
        });

        return back()->with('success', 'Paiement marqué comme effectué.');
    }

    /**
     * Vérifier les autorisations admin.
     */
    private function authorize($role)
    {
        if (!Auth::check() || !Auth::user()->isAdministrateur()) {
            abort(403, 'Accès non autorisé.');
        }
    }
}
