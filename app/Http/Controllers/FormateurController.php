<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Inscription;
use App\Models\CourseMaterial;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('formateur.dashboard');
    }

    /**
     * Courses (FIXED ✅)
     */
    public function courses()
    {
        $formateur = Auth::user()->formateur;

        if (!$formateur) {
            abort(403);
        }

        $courses = $formateur->formations()
            ->with('sessions')
            ->latest()
            ->get();

        return view('formateur.courses', compact('courses'));
    }

    /**
     * Students (FIXED ✅)
     */
    public function students()
    {
        $formateur = Auth::user()->formateur;

        if (!$formateur) {
            abort(403);
        }

        $formationIds = $formateur->formations()->pluck('id');

        $students = Inscription::with(['apprenant.user', 'session.formation'])
            ->whereHas('session.formation', function ($q) use ($formationIds) {
                $q->whereIn('id', $formationIds);
            })
            ->latest()
            ->get();

        return view('formateur.students', compact('students'));
    }

    /**
     * Materials (FIXED ✅)
     */
    public function materials()
    {
        $formateur = Auth::user()->formateur;

        if (!$formateur) {
            abort(403);
        }

        $formationIds = $formateur->formations()->pluck('id');

        $materials = CourseMaterial::whereHas('formation', function ($q) use ($formationIds) {
            $q->whereIn('id', $formationIds);
        })
        ->latest()
        ->get();

        return view('formateur.materials', compact('materials'));
    }

    /**
     * Show course
     */
    public function show($id)
    {
        $formateur = Auth::user()->formateur;

        if (!$formateur) {
            abort(403);
        }

        $course = $formateur->formations()
            ->where('formations.id', $id)
            ->with('sessions')
            ->firstOrFail();

        return view('formateur.course-show', compact('course'));
    }
}