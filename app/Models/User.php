<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relations
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }

    public function apprenant()
    {
        return $this->hasOne(Apprenant::class);
    }

    //  Helpers
    public function hasRole(string $role): bool
    {
        return optional($this->role)->name === $role;
    }

    public function isFormateur(): bool
    {
        return $this->hasRole('formateur');
    }

    public function isApprenant(): bool
    {
        return $this->hasRole('apprenant');
    }

    public function isAdministrateur(): bool
    {
        return $this->hasRole('administrateur');
    }
}
