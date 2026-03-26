<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->isFormateur() && ! $user->isAdministrateur()) {
            return redirect()->route('formateur.dashboard');
        }

        return view('admin.dashboard');
    }

    /**
     * Show the form for managing users.
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        return view('admin.create-user');
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:formateur,apprenant,administrateur',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'L\'utilisateur a été créé avec succès.');
    }

    /**
     * Show the form for editing a user.
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    /**
     * Update user information.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:formateur,apprenant,administrateur',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'L\'utilisateur a été mis à jour avec succès.');
    }

    /**
     * Delete a user.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'L\'utilisateur a été supprimé avec succès.');
    }

    /**
     * Show the form for managing settings.
     */
    public function settings()
    {
        return view('admin.settings');
    }

    // --- Formations CRUD ---

    public function formations()
    {
        $formations = Formation::with('formateurs', 'sessions')->orderBy('id', 'desc')->get();
        return view('admin.formations.index', compact('formations'));
    }

    public function createFormation()
    {
        $formateurs = Formateur::all();

        if ($formateurs->isEmpty()) {
            $users = User::where('role', 'formateur')->get();
            foreach ($users as $user) {
                Formateur::firstOrCreate(
                    ['email' => $user->email],
                    ['nom' => $user->name ?? $user->email]
                );
            }
            $formateurs = Formateur::all();
        }

        $sessions = Session::all();
        return view('admin.formations.create', compact('formateurs', 'sessions'));
    }

    public function storeFormation(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree_jours' => 'nullable|integer|min:1',
            'prix' => 'nullable|numeric|min:0',
            'formateur_ids' => 'nullable|array',
            'session_ids' => 'nullable|array',
        ]);

        $formationData = Arr::except($validated, ['formateur_ids', 'session_ids']);

        $formation = Formation::create($formationData);

        if (!empty($validated['formateur_ids'])) {
            $formation->formateurs()->sync($validated['formateur_ids']);
        }

        if (!empty($validated['session_ids'])) {
            $formation->sessions()->sync($validated['session_ids']);
        }

        return redirect()->route('admin.formations')->with('success', 'Formation créée avec succès.');
    }

    public function editFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $formateurs = Formateur::all();

        if ($formateurs->isEmpty()) {
            $users = User::where('role', 'formateur')->get();
            foreach ($users as $user) {
                Formateur::firstOrCreate(
                    ['email' => $user->email],
                    ['nom' => $user->name ?? $user->email]
                );
            }
            $formateurs = Formateur::all();
        }

        $sessions = Session::all();
        return view('admin.formations.edit', compact('formation', 'formateurs', 'sessions'));
    }

    public function updateFormation(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree_jours' => 'nullable|integer|min:1',
            'prix' => 'nullable|numeric|min:0',
            'formateur_ids' => 'nullable|array',
            'session_ids' => 'nullable|array',
        ]);

        $formationData = Arr::except($validated, ['formateur_ids', 'session_ids']);

        $formation->update($formationData);
        $formation->formateurs()->sync($validated['formateur_ids'] ?? []);
        $formation->sessions()->sync($validated['session_ids'] ?? []);

        return redirect()->route('admin.formations')->with('success', 'Formation mise à jour avec succès.');
    }

    public function deleteFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->formateurs()->detach();
        $formation->sessions()->detach();
        $formation->delete();

        return redirect()->route('admin.formations')->with('success', 'Formation supprimée avec succès.');
    }

    // --- Sessions CRUD ---

    public function sessions()
    {
        $sessions = Session::with('formations', 'apprenants')->orderBy('id', 'desc')->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function createSession()
    {
        $formations = Formation::all();
        return view('admin.sessions.create', compact('formations'));
    }

    public function storeSession(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'debut' => 'nullable|date',
            'fin' => 'nullable|date|after_or_equal:debut',
            'capacite' => 'required|integer|min:1',
            'etat' => 'required|string|in:ouverte,fermee',
            'formation_ids' => 'nullable|array',
        ]);

        $sessionData = Arr::except($validated, ['formation_ids']);

        $session = Session::create($sessionData);

        if (!empty($validated['formation_ids'])) {
            $session->formations()->sync($validated['formation_ids']);
        }

        return redirect()->route('admin.sessions')->with('success', 'Session créée avec succès.');
    }

    public function editSession($id)
    {
        $session = Session::findOrFail($id);
        $formations = Formation::all();
        return view('admin.sessions.edit', compact('session', 'formations'));
    }

    public function updateSession(Request $request, $id)
    {
        $session = Session::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'debut' => 'nullable|date',
            'fin' => 'nullable|date|after_or_equal:debut',
            'capacite' => 'required|integer|min:1',
            'etat' => 'required|string|in:ouverte,fermee',
            'formation_ids' => 'nullable|array',
        ]);

        $sessionData = Arr::except($validated, ['formation_ids']);

        $session->update($sessionData);
        $session->formations()->sync($validated['formation_ids'] ?? []);

        return redirect()->route('admin.sessions')->with('success', 'Session mise à jour avec succès.');
    }

    public function deleteSession($id)
    {
        $session = Session::findOrFail($id);
        $session->formations()->detach();
        $session->delete();

        return redirect()->route('admin.sessions')->with('success', 'Session supprimée avec succès.');
    }
}

