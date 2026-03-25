<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        return view('front.pages.home');
    }

    /**
     * Display all courses
     */
    public function courses()
    {
        $courses = [
            [
                'id' => 1,
                'title' => 'Développement Web',
                'price' => 29.00,
                'image' => asset('img/course-1.jpg'),
                'instructor' => 'John Doe',
                'duration' => '1.49 Hrs',
                'students' => 30,
                'rating' => 5,
                'reviews' => 123,
            ],
            [
                'id' => 2,
                'title' => 'Data Science',
                'price' => 49.00,
                'image' => asset('img/course-2.jpg'),
                'instructor' => 'Jane Smith',
                'duration' => '2.30 Hrs',
                'students' => 45,
                'rating' => 5,
                'reviews' => 456,
            ],
            [
                'id' => 3,
                'title' => 'Design Graphique',
                'price' => 39.00,
                'image' => asset('img/course-3.jpg'),
                'instructor' => 'Bob Johnson',
                'duration' => '1.80 Hrs',
                'students' => 28,
                'rating' => 5,
                'reviews' => 234,
            ],
        ];

        return view('front.pages.courses', compact('courses'));
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
        // This would typically fetch from database
        // For now, returning a sample course
        $course = [
            'id' => $id,
            'title' => 'Développement Web',
            'price' => 29.00,
            'image' => asset('img/course-1.jpg'),
            'instructor' => 'John Doe',
            'duration' => '1.49 Hrs',
            'students' => 30,
            'rating' => 5,
            'reviews' => 123,
            'description' => 'Un cours complet sur le développement web moderne.',
        ];

        return view('front.pages.course-detail', compact('course'));
    }

    /**
     * Display instructor profile
     */
    public function instructor($id)
    {
        // Fetch instructor from database
        $instructor = [
            'id' => $id,
            'name' => 'John Doe',
            'title' => 'Développeur Full-Stack',
            'image' => asset('img/team-1.jpg'),
            'bio' => 'Expert en développement web avec plus de 10 ans d\'expérience.',
            'courses' => 5,
            'students' => 150,
        ];

        return view('front.pages.instructor', compact('instructor'));
    }
}
