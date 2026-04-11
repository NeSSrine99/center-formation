<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationSession extends Model
{
    use HasFactory;

    protected $table = 'sessions_formations';

    protected $fillable = [
        'formation_id',
        'date_debut',
        'date_fin',
        'lieu',
        'capacite',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'session_formation_id');
    }

    public function apprenants()
    {
        return $this->belongsToMany(Apprenant::class, 'inscriptions', 'session_formation_id', 'apprenant_id');
    }

    public function getAvailablePlacesAttribute()
    {
        $validCount = $this->inscriptions()
            ->where('statut', 'validée')
            ->count();

        return max(0, $this->capacite - $validCount);
    }
}
