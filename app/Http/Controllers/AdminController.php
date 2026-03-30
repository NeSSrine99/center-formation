<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Formateur;
use App\Models\FormationSession;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user && $user->isFormateur() && ! $user->isAdministrateur()) {
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
        $roles = Role::all();
        return view('admin.create-user', compact('roles'));
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
            'role_id' => 'required|exists:roles,id',
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
        $roles = Role::all();
        return view('admin.edit-user', compact('user', 'roles'));
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
            'role_id' => 'required|exists:roles,id',
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
        $formations = Formation::with('formateurs.user', 'sessions')->orderBy('id', 'desc')->get();
        return view('admin.formations.index', compact('formations'));
    }

    public function createFormation()
    {
        $formateurs = Formateur::with('user')->get();
        return view('admin.formations.create', compact('formateurs'));
    }

    public function storeFormation(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'nullable|integer|min:1',
            'niveau' => 'nullable|string|max:255',
            'tarif' => 'nullable|numeric|min:0',
            'formateur_ids' => 'nullable|array',
        ]);

        $formationData = Arr::except($validated, ['formateur_ids']);

        $formation = Formation::create($formationData);

        if (!empty($validated['formateur_ids'])) {
            $formation->formateurs()->sync($validated['formateur_ids']);
        }

        return redirect()->route('admin.formations')->with('success', 'Formation créée avec succès.');
    }

    public function editFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $formateurs = Formateur::with('user')->get();
        return view('admin.formations.edit', compact('formation', 'formateurs'));
    }

    public function updateFormation(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'nullable|integer|min:1',
            'niveau' => 'nullable|string|max:255',
            'tarif' => 'nullable|numeric|min:0',
            'formateur_ids' => 'nullable|array',
        ]);

        $formationData = Arr::except($validated, ['formateur_ids']);

        $formation->update($formationData);
        $formation->formateurs()->sync($validated['formateur_ids'] ?? []);

        return redirect()->route('admin.formations')->with('success', 'Formation mise à jour avec succès.');
    }

    public function deleteFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->formateurs()->detach();
        $formation->delete();

        return redirect()->route('admin.formations')->with('success', 'Formation supprimée avec succès.');
    }

    // --- Sessions CRUD ---

    public function sessions()
    {
        $sessions = FormationSession::with('formation', 'inscriptions')->orderBy('id', 'desc')->get();
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
            'formation_id' => 'required|exists:formations,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu' => 'nullable|string|max:255',
            'capacite' => 'required|integer|min:1',
            'statut' => 'required|string|in:ouverte,fermee',
        ]);

        FormationSession::create($validated);

        return redirect()->route('admin.sessions')->with('success', 'Session créée avec succès.');
    }

    public function editSession($id)
    {
        $session = FormationSession::findOrFail($id);
        $formations = Formation::all();
        return view('admin.sessions.edit', compact('session', 'formations'));
    }

    public function updateSession(Request $request, $id)
    {
        $session = FormationSession::findOrFail($id);

        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu' => 'nullable|string|max:255',
            'capacite' => 'required|integer|min:1',
            'statut' => 'required|string|in:ouverte,fermee',
        ]);

        $session->update($validated);

        return redirect()->route('admin.sessions')->with('success', 'Session mise à jour avec succès.');
    }

    public function deleteSession($id)
    {
        $session = FormationSession::findOrFail($id);
        $session->delete();

        return redirect()->route('admin.sessions')->with('success', 'Session supprimée avec succès.');
    }
}
