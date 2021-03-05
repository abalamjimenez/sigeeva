<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('domiciliable','ndx');
            $table->enum('domicilio_tipo',['PERSONAL','TRABAJO'])->nullable();
            $table->string('domicilio_calle')->nullable();
            $table->string('domicilio_numero_exterior')->nullable();
            $table->string('domicilio_cruzamientos')->nullable();
            $table->string('domicilio_colonia')->nullable();
            $table->string('domicilio_codigo_postal',5)->nullable();
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
        Schema::dropIfExists('domicilios');
    }
}
