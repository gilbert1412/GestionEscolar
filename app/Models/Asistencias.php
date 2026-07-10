<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencias extends Model
{
    protected $table ='asistencias';
    protected $guarded = ['created_at','updated_at'];
    
    public function matricula(): BelongsTo
    {
        // Una asistencia pertenece a una matrícula específica
        return $this->belongsTo(Matriculas::class, 'matricula_id');
    }
}
