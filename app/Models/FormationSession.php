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

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'session_id');
    }
}
