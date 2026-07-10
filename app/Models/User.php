<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
    ];
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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

    public function cursosDictados(): HasMany
    {
        // El segundo parámetro es la columna real en la tabla cursos ('user_id')
        return $this->hasMany(Cursos::class, 'user_id');
    }

    public function cursosMatriculados(): BelongsToMany
    {
        // "Un usuario pertenece a muchos cursos (a través de la tabla matriculas)"
        return $this->belongsToMany(Cursos::class, 'matriculas', 'user_id', 'curso_id')
            ->withPivot('periodo_academico') // Para poder leer este campo extra
            ->withTimestamps();
    }
}
