<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'phone'];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'inscriptions')->withPivot('statut', 'date_inscription')->withTimestamps();
    }
}
