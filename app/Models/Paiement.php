<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprenant_id',
        'formation_id',
        'amount',
        'status',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
