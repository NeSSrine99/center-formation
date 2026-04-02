<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'duree' => $this->duree,
            'niveau' => $this->niveau,
            'tarif' => $this->tarif,
            'formateurs_count' => optional($this->formateurs)->count() ?? 0,
            'sessions_count' => optional($this->sessions)->count() ?? 0,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
