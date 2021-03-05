<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudCtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_ct', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('solicitud_id')->nullable();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->string('ct')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('telefono_extension',5)->nullable();

            $table->string('domicilio_calle')->nullable();
            $table->string('domicilio_numero')->nullable();
            $table->string('domicilio_cruzamientos')->nullable();
            $table->string('domicilio_codigo_postal',5)->nullable();
            $table->string('domicilio_colonia')->nullable();

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
        Schema::dropIfExists('solicitud_ct');
    }
}
