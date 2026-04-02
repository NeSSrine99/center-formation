<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Http\Resources\FormationResource;
use App\Http\Resources\FormationCollection;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FormationController extends Controller
{
    /**
     * Get all formations
     */
    public function index(): JsonResponse
    {
        try {
            $formations = Formation::with('formateurs.user', 'sessions')
                ->orderBy('id', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Formations retrieved successfully',
                'data' => FormationResource::collection($formations),
                'count' => $formations->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving formations',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get formation by ID
     */
    public function show($id): JsonResponse
    {
        try {
            $formation = Formation::with('formateurs.user', 'sessions')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Formation retrieved successfully',
                'data' => new FormationResource($formation),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Formation not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving formation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new formation
     */
    public function store(StoreFormationRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $formation = Formation::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'] ?? null,
                'duree' => $validated['duree'] ?? null,
                'niveau' => $validated['niveau'] ?? null,
                'tarif' => $validated['tarif'] ?? null,
            ]);

            if (!empty($validated['formateur_ids'])) {
                $formation->formateurs()->sync($validated['formateur_ids']);
            }

            $formation->load('formateurs.user', 'sessions');

            return response()->json([
                'success' => true,
                'message' => 'Formation created successfully',
                'data' => new FormationResource($formation),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating formation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a formation
     */
    public function update(UpdateFormationRequest $request, $id): JsonResponse
    {
        try {
            $formation = Formation::findOrFail($id);
            $validated = $request->validated();

            $formation->update([
                'titre' => $validated['titre'] ?? $formation->titre,
                'description' => $validated['description'] ?? $formation->description,
                'duree' => $validated['duree'] ?? $formation->duree,
                'niveau' => $validated['niveau'] ?? $formation->niveau,
                'tarif' => $validated['tarif'] ?? $formation->tarif,
            ]);

            if (isset($validated['formateur_ids'])) {
                $formation->formateurs()->sync($validated['formateur_ids']);
            }

            $formation->load('formateurs.user', 'sessions');

            return response()->json([
                'success' => true,
                'message' => 'Formation updated successfully',
                'data' => new FormationResource($formation),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Formation not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating formation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a formation
     */
    public function destroy($id): JsonResponse
    {
        try {
            $formation = Formation::findOrFail($id);
            $formation->formateurs()->detach();
            $formation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Formation deleted successfully',
                'data' => new FormationResource($formation),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Formation not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting formation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
