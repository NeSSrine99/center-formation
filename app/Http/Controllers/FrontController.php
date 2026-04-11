<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Formateur;
use App\Models\FormationSession;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display the home page
     */
    public function  index()
    {
        $formations = Formation::with('formateurs.user', 'sessions')->limit(6)->get();
        $formateurs = Formateur::with('user')->limit(4)->get();

        return view('front.layouts.main', compact('formations', 'formateurs'));
    }

    /**
     * Display all courses
     */
    public function courses()
    {
        $formations = Formation::with('formateurs.user', 'sessions')->paginate(12);
        return view('front.pages.courses', compact('formations'));
    }

    /**
     * Display about page
     */
    public function about()
    {
        return view('front.pages.about');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('front.pages.contact');
    }

    /**
     * Handle contact form submission
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Store the contact message in database or send email
        // For now, just redirect with success message
        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès!');
    }

    /**
     * Display course details
     */
    public function courseDetail($id)
    {
        $formation = Formation::with('formateurs.user', 'sessions')->findOrFail($id);
        return view('front.pages.course-detail', compact('formation'));
    }

    /**
     * Display instructor details
     */
    public function instructor($id)
    {
        $formateur = Formateur::with('user')->findOrFail($id);
        $formations = $formateur->formations()->with('sessions')->get();
        return view('front.pages.instructor', compact('formateur', 'formations'));
    }
}
