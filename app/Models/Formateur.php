<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'phone', 'bio'];

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_formateur');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
