<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Matriculas extends Model
{
    protected $table='calificaciones';
    protected $guarded = [ 'created_at','updated_at'];

    public function calificaciones(): HasMany
    {
        // Una matrícula tiene muchas calificaciones
        return $this->hasMany(Calificaciones::class, 'matricula_id');
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencias::class, 'matricula_id');
    }
}
