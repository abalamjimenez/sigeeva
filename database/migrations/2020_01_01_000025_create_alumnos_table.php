<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas');

            $table->uuid('uuid')->nullable();
            $table->string('numero_control')->nullable();

            $table->unsignedTinyInteger('necesidad_educativa_id')->nullable();
            $table->foreign('necesidad_educativa_id')->references('id')->on('necesidades_educativas');

            $table->unsignedBigInteger('secundaria_procedencia_id')->nullable();
            $table->foreign('secundaria_procedencia_id')->references('id')->on('secundaria_procedencias');

            $table->decimal('secundaria_procedencia_promedio', 3, 1)->nullable();

            $table->enum('vigente',['S','N'])->default('S');
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
        Schema::dropIfExists('alumnos');
    }
}
