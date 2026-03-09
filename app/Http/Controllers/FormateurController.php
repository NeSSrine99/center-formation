<?php

namespace App\Http\Controllers;

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
        // TODO: Add courses management logic
        return view('formateur.courses');
    }

    /**
     * Show the students list.
     */
    public function students()
    {
        // TODO: Add students management logic
        return view('formateur.students');
    }

    /**
     * Show course materials.
     */
    public function materials()
    {
        // TODO: Add materials management logic
        return view('formateur.materials');
    }
}
