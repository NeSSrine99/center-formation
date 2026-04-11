<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inscription;
use App\Models\FormationSession;
use App\Models\Notification;

class InscriptionController extends Controller
{
    /**
     * Inscrire
     */
    public function inscrire(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions_formations,id',
            'payment_method' => 'required|string|in:card,transfer,cash',
            'payment_reference' => 'required|string|max:255',
            'payment_amount' => 'required|numeric|min:0',
            'payment_notes' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $apprenant = $user->apprenant;

        if (!$apprenant) {
            return back()->with('error', 'Profil apprenant non trouvé.');
        }

        // prevent duplicate
        $exists = Inscription::where('apprenant_id', $apprenant->id)
            ->where('session_formation_id', $request->session_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit à cette session.');
        }

        $inscription = Inscription::create([
            'apprenant_id' => $apprenant->id,
            'session_formation_id' => $request->session_id,
            'statut' => 'en_attente',
            'paiement' => true,
        ]);

        $session = FormationSession::find($request->session_id);

        // Créer une notification pour l'apprenant
        Notification::create([
            'user_id' => $apprenant->user_id,
            'title' => 'Inscription soumise',
            'message' => 'Votre demande d\'inscription à la formation "' . $session->formation->titre . '" a été soumise et est en attente de validation.',
            'type' => 'info',
            'data' => [
                'session_id' => $request->session_id,
                'formation_id' => $session->formation->id,
                'payment_method' => $request->payment_method,
                'payment_reference' => $request->payment_reference,
                'payment_amount' => $request->payment_amount,
                'payment_notes' => $request->payment_notes,
            ]
        ]);

        // Créer une notification pour les administrateurs
        $admins = \App\Models\User::whereHas('role', function($q) {
            $q->where('name', 'administrateur');
        })->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Nouvelle inscription',
                'message' => $user->name . ' s\'est inscrit à la session "' . $session->formation->titre . '" du ' . $session->date_debut->format('d/m/Y') . ' au ' . $session->date_fin->format('d/m/Y') . '.',
                'type' => 'info',
                'data' => [
                    'inscription_id' => $inscription->id,
                    'apprenant_id' => $apprenant->id,
                    'session_id' => $request->session_id,
                    'formation_id' => $session->formation->id,
                    'payment_method' => $request->payment_method,
                    'payment_reference' => $request->payment_reference,
                    'payment_amount' => $request->payment_amount,
                    'payment_notes' => $request->payment_notes,
                ]
            ]);
        }

        // Créer une notification pour les formateurs de cette formation
        $formateurs = $session->formation->formateurs;
        foreach ($formateurs as $formateur) {
            Notification::create([
                'user_id' => $formateur->user_id,
                'title' => 'Nouvel apprenant inscrit',
                'message' => $user->name . ' s\'est inscrit à votre session "' . $session->formation->titre . '" du ' . $session->date_debut->format('d/m/Y') . ' au ' . $session->date_fin->format('d/m/Y') . '.',
                'type' => 'info',
                'data' => [
                    'inscription_id' => $inscription->id,
                    'apprenant_id' => $apprenant->id,
                    'session_id' => $request->session_id,
                    'formation_id' => $session->formation->id,
                    'payment_method' => $request->payment_method,
                    'payment_reference' => $request->payment_reference,
                    'payment_amount' => $request->payment_amount,
                    'payment_notes' => $request->payment_notes,
                ]
            ]);
        }

        return back()->with('success', 'Inscription envoyée avec succès');
    }

    /**
     * Annuler inscription
     */
    public function annuler($id)
    {
        $inscription = Inscription::findOrFail($id);
        $apprenant = Auth::user()->apprenant;

        if ($inscription->apprenant_id !== $apprenant->id) {
            abort(403);
        }

        if (!in_array($inscription->statut, ['en_attente', 'validée'])) {
            return back()->with('error', 'Impossible d\'annuler.');
        }

        $inscription->update([
            'statut' => 'refusée'
        ]);

        // Créer une notification pour l'apprenant
        Notification::create([
            'user_id' => $apprenant->user_id,
            'title' => 'Inscription annulée',
            'message' => 'Votre inscription à la formation "' . $inscription->session->formation->titre . '" a été annulée.',
            'type' => 'warning',
            'data' => [
                'inscription_id' => $inscription->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        return back()->with('success', 'Inscription annulée.');
    }

    /**
     * Valider une inscription (Admin)
     */
    public function valider($id)
    {
        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'en_attente') {
            return back()->with('error', 'Cette inscription ne peut pas être validée.');
        }

        $inscription->update([
            'statut' => 'validée'
        ]);

        // Créer une notification pour l'apprenant
        Notification::create([
            'user_id' => $inscription->apprenant->user_id,
            'title' => 'Inscription validée',
            'message' => 'Votre inscription à la formation "' . $inscription->session->formation->titre . '" a été validée.',
            'type' => 'success',
            'data' => [
                'inscription_id' => $inscription->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Créer une notification de confirmation pour l'admin qui a validé
        Notification::create([
            'user_id' => auth()->id(),
            'title' => 'Inscription validée',
            'message' => 'Vous avez validé l\'inscription de ' . $inscription->apprenant->user->name . ' à la formation "' . $inscription->session->formation->titre . '".',
            'type' => 'success',
            'data' => [
                'inscription_id' => $inscription->id,
                'apprenant_id' => $inscription->apprenant->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Notifier les formateurs de cette session
        $formateurs = $inscription->session->formation->formateurs;
        foreach ($formateurs as $formateur) {
            Notification::create([
                'user_id' => $formateur->user_id,
                'title' => 'Inscription validée',
                'message' => 'L\'inscription de ' . $inscription->apprenant->user->name . ' à votre session "' . $inscription->session->formation->titre . '" a été validée.',
                'type' => 'success',
                'data' => [
                    'inscription_id' => $inscription->id,
                    'apprenant_id' => $inscription->apprenant->id,
                    'formation_id' => $inscription->session->formation->id,
                    'session_id' => $inscription->session->id,
                ]
            ]);
        }

        return back()->with('success', 'Inscription validée avec succès.');
    }

    /**
     * Refuser une inscription (Admin)
     */
    public function refuser($id)
    {
        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'en_attente') {
            return back()->with('error', 'Cette inscription ne peut pas être refusée.');
        }

        $inscription->update([
            'statut' => 'refusée'
        ]);

        // Créer une notification pour l'apprenant
        Notification::create([
            'user_id' => $inscription->apprenant->user_id,
            'title' => 'Inscription refusée',
            'message' => 'Votre inscription à la formation "' . $inscription->session->formation->titre . '" a été refusée.',
            'type' => 'error',
            'data' => [
                'inscription_id' => $inscription->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Créer une notification de confirmation pour l'admin qui a refusé
        Notification::create([
            'user_id' => auth()->id(),
            'title' => 'Inscription refusée',
            'message' => 'Vous avez refusé l\'inscription de ' . $inscription->apprenant->user->name . ' à la formation "' . $inscription->session->formation->titre . '".',
            'type' => 'warning',
            'data' => [
                'inscription_id' => $inscription->id,
                'apprenant_id' => $inscription->apprenant->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Notifier les formateurs de cette session
        $formateurs = $inscription->session->formation->formateurs;
        foreach ($formateurs as $formateur) {
            Notification::create([
                'user_id' => $formateur->user_id,
                'title' => 'Inscription refusée',
                'message' => 'L\'inscription de ' . $inscription->apprenant->user->name . ' à votre session "' . $inscription->session->formation->titre . '" a été refusée.',
                'type' => 'warning',
                'data' => [
                    'inscription_id' => $inscription->id,
                    'apprenant_id' => $inscription->apprenant->id,
                    'formation_id' => $inscription->session->formation->id,
                    'session_id' => $inscription->session->id,
                ]
            ]);
        }

        return back()->with('success', 'Inscription refusée.');
    }

    /**
     * Marquer comme payée (Admin)
     */
    public function marquerPayee($id)
    {
        $inscription = Inscription::findOrFail($id);

        if ($inscription->statut !== 'validée') {
            return back()->with('error', 'Seules les inscriptions validées peuvent être marquées comme payées.');
        }

        $inscription->update([
            'paiement' => true
        ]);

        // Créer une notification pour l'apprenant
        Notification::create([
            'user_id' => $inscription->apprenant->user_id,
            'title' => 'Paiement confirmé',
            'message' => 'Le paiement de votre inscription à la formation "' . $inscription->session->formation->titre . '" a été confirmé.',
            'type' => 'success',
            'data' => [
                'inscription_id' => $inscription->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Créer une notification de confirmation pour l'admin qui a confirmé le paiement
        Notification::create([
            'user_id' => auth()->id(),
            'title' => 'Paiement confirmé',
            'message' => 'Vous avez confirmé le paiement de ' . $inscription->apprenant->user->name . ' pour la formation "' . $inscription->session->formation->titre . '".',
            'type' => 'success',
            'data' => [
                'inscription_id' => $inscription->id,
                'apprenant_id' => $inscription->apprenant->id,
                'formation_id' => $inscription->session->formation->id,
                'session_id' => $inscription->session->id,
            ]
        ]);

        // Notifier les formateurs de cette session
        $formateurs = $inscription->session->formation->formateurs;
        foreach ($formateurs as $formateur) {
            Notification::create([
                'user_id' => $formateur->user_id,
                'title' => 'Paiement confirmé',
                'message' => 'Le paiement de ' . $inscription->apprenant->user->name . ' pour votre session "' . $inscription->session->formation->titre . '" a été confirmé.',
                'type' => 'success',
                'data' => [
                    'inscription_id' => $inscription->id,
                    'apprenant_id' => $inscription->apprenant->id,
                    'formation_id' => $inscription->session->formation->id,
                    'session_id' => $inscription->session->id,
                ]
            ]);
        }

        return back()->with('success', 'Paiement marqué comme effectué.');
    }
}