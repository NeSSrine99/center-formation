<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'nullable|integer|min:1',
            'niveau' => 'nullable|string|max:255',
            'tarif' => 'nullable|numeric|min:0',
            'formateur_ids' => 'nullable|array',
            'formateur_ids.*' => 'integer|exists:formateurs,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la formation est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'duree.min' => 'La durée doit être au minimum 1.',
            'tarif.min' => 'Le tarif doit être positif.',
            'formateur_ids.*.exists' => 'Un des formateurs sélectionnés n\'existe pas.',
        ];
    }
}
