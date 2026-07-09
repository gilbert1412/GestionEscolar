<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('matricula_id')->constrained(
            table: 'matriculas', indexName: 'matricula_asistencia_id'
            )->onUpdate('cascade')->onDelete('cascade');
            
            $table->date('fecha_asistencia');
            
            $table->enum('estado_asistencia', ['Presente', 'Ausente', 'Tarde', 'Justificado']);
            
            $table->string('observaciones', 255)->nullable();
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
