<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\FormationSession;
use App\Models\Inscription;

class ApprenantController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('apprenant.dashboard');
    }

    /**
     * Mes Formations + Available + Sessions
     */
    public function inscriptions()
    {
        $apprenant = auth()->user()->apprenant;

        if (!$apprenant) {
            return redirect()->route('dashboard')
                ->with('error', 'Profil apprenant non trouvé.');
        }

        // Formations inscrites (via sessions)
        $inscriptions = $apprenant->inscriptions()
            ->with('session.formation')
            ->latest()
            ->get();

        // Formations disponibles
        $formations = Formation::latest()->get();

        // Sessions
        $sessions = FormationSession::with('formation')->latest()->get();

        return view('apprenant.formations', compact(
            'inscriptions',
            'formations',
            'sessions'
        ));
    }

    /**
     * Inscription à une session
     */
    public function inscrire(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:formation_sessions,id',
        ]);

        $apprenant = auth()->user()->apprenant;

        if (!$apprenant) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous devez avoir un profil apprenant.');
        }

        // Vérifier inscription existante
        $already = Inscription::where('apprenant_id', $apprenant->id)
            ->where('session_id', $request->session_id)
            ->exists();

        if ($already) {
            return back()->with('warning', 'Déjà inscrit à cette session.');
        }

        // Création inscription
        Inscription::create([
            'apprenant_id' => $apprenant->id,
            'session_id' => $request->session_id,
            'statut' => 'en_attente',
            'date_inscription' => now(),
        ]);

        return back()->with('success', 'Inscription réussie 🎉');
    }

    /**
     * Courses (optionnel)
     */
    public function courses()
    {
        return view('apprenant.courses');
    }

    /**
     * Progress
     */
    public function progress()
    {
        return view('apprenant.progress');
    }

    /**
     * Materials
     */
    public function materials()
    {
        return view('apprenant.materials');
    }
}