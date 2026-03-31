<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\FormationSession;
use App\Models\Inscription;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    /**
     * Display the formateur dashboard.
     */
    public function dashboard()
    {
        return view('formateur.dashboard');
    }

    /**
     * Show the courses list.
     */
    public function courses()
    {
        // Fetch all courses created by this formateur
        $courses = Formation::where('formateur_id', auth()->id())
            ->latest()
            ->get();

        return view('formateur.courses', compact('courses'));
    }

    /**
     * Show the students list.
     */
    public function students()
    {

        $students = Inscription::with(['apprenant', 'session.formation'])
            ->whereHas('session.formation', function ($q) {
                $q->where('formateur_id', auth()->id());
            })
            ->latest()
            ->get();


        return view('formateur.students', compact('students'));
    }

    /**
     * Show course materials.
     */
    public function materials()
    {
        // Fetch materials of courses created by this formateur
        $materials = CourseMaterial::whereHas('formation', fn($q) => $q->where('formateur_id', auth()->id()))
            ->latest()
            ->get();

        return view('formateur.materials', compact('materials'));
    }

    public function show($id)
    {
        $course = Formation::where('id', $id)
            ->where('formateur_id', auth()->id()) // Only allow viewing your own courses
            ->firstOrFail();

        return view('formateur.course-show', compact('course'));
    }
}
