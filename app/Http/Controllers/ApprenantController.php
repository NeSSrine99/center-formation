<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    /**
     * Display the apprenant dashboard.
     */
    public function dashboard()
    {
        return view('apprenant.dashboard');
    }

    /**
     * Show the enrolled courses.
     */
    public function courses()
    {
        // TODO: Add enrolled courses logic
        return view('apprenant.courses');
    }

    /**
     * Show course progress.
     */
    public function progress()
    {
        // TODO: Add progress tracking logic
        return view('apprenant.progress');
    }

    /**
     * Show course materials.
     */
    public function materials()
    {
        // TODO: Add course materials view
        return view('apprenant.materials');
    }
}
