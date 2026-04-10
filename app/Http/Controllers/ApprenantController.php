<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Formation;
use App\Models\Inscription;

class ApprenantController extends Controller
{
    /**
     * Register the apprenant to a session.
     */
    public function inscrireApprenant(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions_formations,id',
        ]);

        $user = Auth::user();
        $apprenant = $user->apprenant;
        if (!$apprenant) {
            return back()->with('error', 'Aucun apprenant associé à cet utilisateur.');
        }

        $session = \App\Models\FormationSession::findOrFail($request->session_id);

        // Check if session is open
        if ($session->statut !== 'ouverte') {
            return back()->with('error', 'Cette session n\'est pas ouverte aux inscriptions.');
        }

        // Prevent duplicate inscription
        $exists = \App\Models\Inscription::where('apprenant_id', $apprenant->id)
            ->where('session_formation_id', $session->id)
            ->whereNotIn('statut', ['refusée'])
            ->exists();
        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit ou avez une demande en cours pour cette session.');
        }

        // Check capacity
        if ($session->available_places <= 0) {
            return back()->with('error', 'Cette session est complète.');
        }

        DB::transaction(function () use ($apprenant, $session) {
            \App\Models\Inscription::create([
                'apprenant_id' => $apprenant->id,
                'session_formation_id' => $session->id,
                'statut' => 'en_attente',
                'paiement' => false,
            ]);
        });

        return back()->with('success', 'Votre demande d\'inscription a été soumise et est en attente de validation.');
    }

    /**
     * Cancel/Unregister from an inscription.
     */
    public function annulerInscription($inscriptionId)
    {
        $inscription = Inscription::findOrFail($inscriptionId);
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
     * Display the apprenant dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $apprenant = $user->apprenant;

        if (!$apprenant) {
            return redirect('/')->with('error', 'Profil apprenant non trouvé.');
        }

        // Formations where the apprenant has valid inscriptions
        $enrolledFormations = Formation::whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
            $q->where('apprenant_id', $apprenant->id)->where('statut', 'validée');
        })->get();

        // Active inscriptions (validée)
        $activeInscriptions = $apprenant->inscriptions()->where('statut', 'validée')->with('session.formation')->get();

        // Available sessions (open and have available places)
        $availableSessions = \App\Models\FormationSession::where('statut', 'ouverte')
            ->whereDoesntHave('inscriptions', function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id)->where('statut', 'validée');
            })
            ->get()
            ->filter(function ($session) {
                return $session->available_places > 0;
            });

        // User level
        $userLevel = $apprenant->niveau;

        return view('apprenant.dashboard', compact('enrolledFormations', 'activeInscriptions', 'availableSessions', 'userLevel'));
    }

    /**
     * Show the list of courses.
     */
    public function courses()
    {
        return view('apprenant.courses');
    }

    /**
     * Show the progress of the apprenant.
     */
    public function progress()
    {
        return view('apprenant.progress');
    }

    /**
     * Show course materials.
     */
    public function materials()
    {
        return view('apprenant.materials');
    }

    /**
     * Show inscriptions.
     */
    public function inscriptions()
    {
        $user = Auth::user();
        $apprenant = $user->apprenant;
        $myFormations = $apprenant
            ? Formation::with('formateurs.user', 'sessions.inscriptions')
            ->whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id);
            })->get()
            : collect();
        $inscriptions = $apprenant ? $apprenant->inscriptions()->with('session.formation')->get() : collect();

        // Get formations the apprenant is NOT already registered for
        $registeredFormationIds = $myFormations->pluck('id')->toArray();
        $formations = Formation::with('formateurs.user')->whereNotIn('id', $registeredFormationIds)->get();

        // Get sessions for formations the apprenant is not registered for, and only open sessions
        $sessions = \App\Models\FormationSession::with('formation.formateurs.user')
            ->whereHas('formation', function ($q) use ($registeredFormationIds) {
                $q->whereNotIn('id', $registeredFormationIds);
            })
            ->where('statut', 'ouverte')
            ->get();
        return view('apprenant.inscriptions', compact('myFormations', 'inscriptions', 'formations', 'sessions'));
    }
}
