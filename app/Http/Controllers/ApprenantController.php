<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\FormationSession;
use App\Models\Notification;

class ApprenantController extends Controller
{
    public function dashboard()
    {
        $apprenant = Auth::user()->apprenant;

        if (!$apprenant) {
            return redirect('/')->with('error', 'Profil apprenant non trouvé.');
        }

        //  inscriptions + formationSession + formation
        $inscriptions = $apprenant->inscriptions()
            ->with('session.formation')
            ->get();

        //  sessions actives
        $activeInscriptions = $inscriptions->whereIn('statut', ['validée', 'en_attente']);

        //  toutes les inscriptions récentes pour le dashboard
        $recentInscriptions = $inscriptions->sortByDesc('created_at')->take(3);

        //  formations validées
        $enrolledFormations = Formation::whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
            $q->where('apprenant_id', $apprenant->id)
              ->where('statut', 'validée');
        })->get();

        //  sessions disponibles
        $availableSessions = FormationSession::with('formation')
            ->withCount([
                'inscriptions as valid_count' => function ($q) {
                    $q->where('statut', 'validée');
                }
            ])
            ->where('statut', 'ouverte')
            ->get()
            ->filter(function ($session) use ($apprenant) {

                $alreadyRegistered = $session->inscriptions()
                    ->where('apprenant_id', $apprenant->id)
                    ->exists();

                return !$alreadyRegistered &&
                    ($session->capacite > $session->valid_count);
            });

        //  LEVEL
        $userLevel = match (true) {
            $enrolledFormations->count() >= 5 => 'Avancé',
            $enrolledFormations->count() >= 2 => 'Intermédiaire',
            default => 'Débutant',
        };

        $totalFormations = $enrolledFormations->count();

        $completedSessions = $inscriptions->filter(function ($inscription) {
            return $inscription->statut === 'validée'
                && $inscription->formationSession
                && $inscription->formationSession->date_fin < now();
        })->count();

        $progressPercent = $totalFormations > 0
            ? round(($completedSessions / $totalFormations) * 100)
            : 0;

        return view('apprenant.dashboard', compact(
            'inscriptions',
            'activeInscriptions',
            'recentInscriptions',
            'enrolledFormations',
            'availableSessions',
            'userLevel',
            'progressPercent'
        ));
    }

    public function courses()
    {
        return view('apprenant.courses');
    }

    public function progress()
    {
        return view('apprenant.progress');
    }

    public function materials()
    {
        return view('apprenant.materials');
    }

    public function inscriptions()
    {
        $apprenant = Auth::user()->apprenant;

        if (!$apprenant) {
            return back()->with('error', 'Profil apprenant non trouvé.');
        }

        $inscriptions = $apprenant->inscriptions()
            ->with('session.formation')
            ->get();

        $myFormations = Formation::whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
            $q->where('apprenant_id', $apprenant->id);
        })->get();

        $sessions = FormationSession::where('statut', 'ouverte')->get();

        return view('apprenant.inscriptions', compact(
            'inscriptions',
            'myFormations',
            'sessions'
        ));
    }

    /**
     * Marquer une notification comme lue
     */
    public function markNotificationRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);

        $notification->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marquer toutes les notifications comme lues
     */
    public function markAllNotificationsRead()
    {
        Notification::where('user_id', auth()->id())
            ->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}