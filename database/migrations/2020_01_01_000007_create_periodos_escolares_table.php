<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodosEscolaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos_escolares', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ciclo_escolar_id');
            $table->foreign('ciclo_escolar_id')->references('id')->on('ciclos_escolares');

            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
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
        Schema::dropIfExists('periodos_escolares');
    }
}
