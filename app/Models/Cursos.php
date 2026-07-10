<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Cursos extends Model
{

    protected $table='cursos';
    protected $guarded = ['created_at','updated_at'];

    public function docente(): BelongsTo
    {
        // Un curso pertenece a un usuario (docente)
        return $this->belongsTo(User::class, 'user_id');
    }
    public function alumnosMatriculados(): BelongsToMany
    {
        // "Un curso pertenece a muchos usuarios alumnos (a través de la tabla matriculas)"
        return $this->belongsToMany(User::class, 'matriculas', 'curso_id', 'user_id')
            ->withPivot('periodo_academico')
            ->withTimestamps();
    }
}
