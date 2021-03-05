<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos_pagos', function (Blueprint $table) {
            $table->id();

            $table->string('clave',2);
            $table->string('descripcion')->comment('Nombre del concepto para reportes contables');
            $table->string('etiqueta')->comment('Nombre del concepto para mostrar en el formato');
            $table->string('mensaje')->nullable()->comment('Este campo se utiliza por si se quiere que se visualice algun mensaje adicional abajo del nombre del formato');
            $table->string('observaciones')->nullable();
            $table->string('convenio',4);
            $table->string('costo_referencia',50)->nullable();
            $table->decimal('costo',8,2);

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
        Schema::dropIfExists('conceptos_pagos');
    }
}
