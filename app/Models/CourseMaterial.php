<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'formation_id', // link to the course
        'file_path',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
