<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calificaciones extends Model
{
    protected $table='calificaciones';
    protected $guarded = ['created_at','updated_at'];
    
    public function matricula(): BelongsTo
    {
        // Una calificación pertenece a una matrícula
        return $this->belongsTo(Matriculas::class, 'matricula_id');
    }
}
