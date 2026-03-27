<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Paiement;

class ApprenantController extends Controller
{
    /**
     * Display the apprenant dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // تحقق من وجود Apprenant مرتبط بالمستخدم
        $apprenant = $user->apprenant;

        // الحصول على جميع الدورات التي شارك فيها
        $myFormations = $apprenant
            ? Formation::whereHas('sessions.inscriptions', function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id);
            })->get()
            : collect();

        // جميع التسجيلات
        $inscriptions = $apprenant ? $apprenant->inscriptions()->with('session.formation')->get() : collect();

        // جميع المدفوعات
        $paiements = $apprenant ? $apprenant->paiements()->with('formation')->get() : collect();

        return view('apprenant.dashboard', compact('myFormations', 'inscriptions', 'paiements'));
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
        return view('apprenant.inscriptions');
    }
}
