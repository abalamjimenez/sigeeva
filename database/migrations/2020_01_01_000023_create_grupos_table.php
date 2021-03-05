<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();

            $table->string('clave')->nullable();
            $table->string('descripcion')->nullable();

            $table->unsignedBigInteger('periodo_escolar_id')->nullable();
            $table->foreign('periodo_escolar_id')->references('id')->on('periodos_escolares');


            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->foreign('carrera_id')->references('id')->on('carreras');

            $table->unsignedTinyInteger('grado_id')->nullable();
            $table->foreign('grado_id')->references('id')->on('grados');

            $table->unsignedTinyInteger('turno_id')->nullable();
            $table->foreign('turno_id')->references('id')->on('turnos');

            $table->unsignedBigInteger('tutor_id')->nullable()->comment('Tutor del grupo, es el ID de la persona');
            $table->foreign('tutor_id')->references('id')->on('personas');

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
        Schema::dropIfExists('grupos');
    }
}
