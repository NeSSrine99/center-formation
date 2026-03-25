<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'formation_sessions';

    protected $fillable = ['nom', 'debut', 'fin', 'capacite', 'etat'];

    protected $casts = [
        'debut' => 'date',
        'fin' => 'date',
    ];

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'session_formation')
            ->withPivot(['debut', 'fin'])
            ->withTimestamps();
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function apprenants()
    {
        return $this->belongsToMany(Apprenant::class, 'inscriptions')->withPivot('statut', 'date_inscription')->withTimestamps();
    }
}
