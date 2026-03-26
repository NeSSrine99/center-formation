<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'role_id',
    ];

    public function roleInfo()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }

    public function apprenant()
    {
        return $this->hasOne(Apprenant::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        if ($this->role === $role) {
            return true;
        }

        return Schema::hasTable('roles') && $this->roleInfo && $this->roleInfo->name === $role;
    }

    public function setRoleAttribute(string $value): void
    {
        $this->attributes['role'] = $value;

        if (Schema::hasTable('roles')) {
            $role = Role::where('name', $value)->first();
            if ($role) {
                $this->attributes['role_id'] = $role->id;
            }
        }
    }

    /**
     * Check if user is formateur
     */
    public function isFormateur(): bool
    {
        return $this->hasRole('formateur');
    }

    /**
     * Check if user is apprenant
     */
    public function isApprenant(): bool
    {
        return $this->hasRole('apprenant');
    }

    /**
     * Check if user is administrateur
     */
    public function isAdministrateur(): bool
    {
        return $this->hasRole('administrateur');
    }
}
