<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'duree_jours', 'prix'];

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class, 'formation_formateur');
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'session_formation')
            ->withPivot(['debut', 'fin'])
            ->withTimestamps();
    }
}
