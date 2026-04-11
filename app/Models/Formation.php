<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'duree',
        'niveau',
        'tarif'
    ];

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class, 'formation_formateur')
            ->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(FormationSession::class, 'formation_id');
    }
}
