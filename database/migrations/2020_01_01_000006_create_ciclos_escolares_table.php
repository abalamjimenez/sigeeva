<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclosEscolaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclos_escolares', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('descripcion')->comment('aqui concatenar inicio-fin, al momento de guardar');
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
        Schema::dropIfExists('ciclos_escolares');
    }
}
