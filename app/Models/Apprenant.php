<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'niveau',
        'telephone',
        'statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(FormationSession::class, 'inscriptions', 'apprenant_id', 'session_formation_id')
            ->withPivot('statut', 'paiement')
            ->withTimestamps();
    }
}
