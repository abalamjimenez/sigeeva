<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_tutor', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('solicitud_id')->nullable();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('curp',18)->nullable();
            $table->string('email')->nullable();
            $table->string('telefono',10)->nullable();


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
        Schema::dropIfExists('solicitud_tutor');
    }
}
