<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'nom',
        'start_date',
        'end_date',
        'capacite',
        'etat',
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
