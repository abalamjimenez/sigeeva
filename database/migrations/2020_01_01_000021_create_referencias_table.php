<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('curp',18)->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();
            $table->string('nombre_completo',150)->nullable()->comment('concatenar nombre + primer apellido + segundo apellido al guardar');
            $table->string('telefono',10)->nullable();
            $table->string('centro_trabajo',10)->nullable()->comment('Centro de trabajo donde labora');
            $table->string('ocupacion',10)->nullable()->comment('Ocupación en el centro de trabajo donde labora');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('referencias');
    }
}
