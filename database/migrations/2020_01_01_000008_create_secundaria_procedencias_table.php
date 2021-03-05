<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecundariaProcedenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secundaria_procedencias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('descripcion');
            $table->string('email')->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('domicilio_calle');
            $table->string('domicilio_numero_exterior');
            $table->string('domicilio_colonia');
            $table->string('domicilio_codigo_postal');
            $table->integer('domicilio_localidad_id')->nullable();

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
        Schema::dropIfExists('secundaria_procedencias');
    }
}
