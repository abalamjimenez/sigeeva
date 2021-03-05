<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaturaGrupoExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura_grupo_expediente', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();

            $table->unsignedBigInteger('asignatura_grupo_id')->nullable();
            $table->foreign('asignatura_grupo_id')->references('id')->on('asignatura_grupo');

            $table->unsignedBigInteger('expediente_id')->nullable();
            $table->foreign('expediente_id')->references('id')->on('expedientes');

            $table->enum('es_adicional',['S','N'])->default('N')->comment('Indica si el alumno se capturo de forma manual');

            $table->unsignedTinyInteger('unidad1')->nullable();
            $table->unsignedTinyInteger('unidad2')->nullable();
            $table->unsignedTinyInteger('unidad3')->nullable();
            $table->unsignedTinyInteger('unidad4')->nullable();
            $table->decimal('promedio', 3, 1)->nullable();
            $table->unsignedTinyInteger('calificacion_final')->nullable();

            $table->unsignedTinyInteger('extraordinario1')->nullable();
            $table->unsignedTinyInteger('extraordinario2')->nullable();
            $table->unsignedTinyInteger('examen_especial')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignatura_grupo_expediente');
    }
}
