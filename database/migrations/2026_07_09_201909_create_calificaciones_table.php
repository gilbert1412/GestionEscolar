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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matricula_id')->constrained(
            table: 'matriculas', indexName: 'matricula_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('descripcion_evaluacion',100);
            $table->decimal('nota', 5, 2);
            $table->decimal('ponderacion', 5, 2);
            $table->date('fecha_evaluacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
