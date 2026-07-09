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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
            table: 'users', indexName: 'alumno_id'
            )->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('curso_id')->constrained(
            table: 'cursos', indexName: 'curso_id'
            )->onUpdate('cascade')->onDelete('cascade');

            $table->string('periodo_academico',20);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
