<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprenant_id',
        'session_formation_id',
        'statut',
        'paiement',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function session()
    {
        return $this->belongsTo(FormationSession::class, 'session_formation_id');
    }

    public function isValid()
    {
        return $this->statut === 'validée';
    }

    public function isPending()
    {
        return $this->statut === 'en_attente';
    }
}
