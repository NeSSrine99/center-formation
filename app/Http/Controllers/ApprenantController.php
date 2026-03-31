<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Inscription;

class ApprenantController extends Controller
{
    /**
     * Register the apprenant to a formation.
     */
    public function inscrire(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
        ]);

        $user = Auth::user();
        $apprenant = $user->apprenant;
        if (!$apprenant) {
            return back()->with('error', 'Aucun apprenant associé à cet utilisateur.');
        }

        $formation = Formation::findOrFail($request->formation_id);

        // Find an available session for this formation
        $session = \App\Models\FormationSession::where('formation_id', $formation->id)
            ->where('statut', 'ouverte')
            ->first();

        if (!$session) {
            return back()->with('error', 'Aucune session disponible pour cette formation.');
        }

        // Prevent duplicate inscription
        $exists = \App\Models\Inscription::where('apprenant_id', $apprenant->id)
            ->where('session_id', $session->id)
            ->exists();
        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit à une session de cette formation.');
        }

        \App\Models\Inscription::create([
            'apprenant_id' => $apprenant->id,
            'session_id' => $session->id,
        ]);

        return back()->with('success', 'Inscription réussie à la formation.');
    }

    /**
     * Cancel/Unregister from an inscription.
     */
    public function cancel($inscriptionId)
    {
        $inscription = Inscription::findOrFail($inscriptionId);
        $user = Auth::user();
        $apprenant = $user->apprenant;

        if (!$apprenant || $inscription->apprenant_id !== $apprenant->id) {
            return back()->with('error', 'Non autorisé.');
        }

        $inscription->delete();
        return back()->with('success', 'Inscription annulée avec succès.');
    }

    /**
     * Display the apprenant dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();


        $apprenant = $user->apprenant;


        $myFormations = $apprenant
            ? Formation::whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id);
            })->get()
            : collect();


        $inscriptions = $apprenant ? $apprenant->inscriptions()->with('session.formation')->get() : collect();

        return view('apprenant.dashboard', compact('myFormations', 'inscriptions'));
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

        $sessions = \App\Models\FormationSession::with('formation.formateurs.user')->get();
        return view('apprenant.inscriptions', compact('myFormations', 'inscriptions', 'formations', 'sessions'));
    }
}
