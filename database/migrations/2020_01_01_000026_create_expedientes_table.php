<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('alumno_id')->nullable();
            $table->foreign('alumno_id')->references('id')->on('alumnos');

            $table->uuid('uuid')->nullable();

            $table->unsignedBigInteger('periodo_escolar_id')->nullable();
            $table->foreign('periodo_escolar_id')->references('id')->on('periodos_escolares');

            $table->unsignedBigInteger('generacion_id')->nullable();
            $table->foreign('generacion_id')->references('id')->on('generaciones');

            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->foreign('carrera_id')->references('id')->on('carreras');

            $table->unsignedTinyInteger('turno_id')->nullable();
            $table->foreign('turno_id')->references('id')->on('turnos');

            $table->unsignedTinyInteger('grado_id')->nullable();
            $table->foreign('grado_id')->references('id')->on('grados');

            $table->unsignedTinyInteger('situacion_academica_id')->nullable();
            $table->foreign('situacion_academica_id')->references('id')->on('situaciones_academicas');

            $table->unsignedBigInteger('horario_id')->nullable();
            $table->foreign('horario_id')->references('id')->on('horarios');

            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->decimal('promedio', 3, 1)->nullable();
            $table->string('beca')->nullable()->comment('Indicar si cuenta con alguna beca');
            $table->enum('categoria_inscripcion',['ORDINARIO','ADMISION','READMISION'])->default('ORDINARIO')->nullable();
            $table->char('es_cedar',1)->nullable();
            $table->enum('vigente',['S','N'])->default('S');
            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}
