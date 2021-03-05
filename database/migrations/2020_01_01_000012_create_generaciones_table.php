<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion')->comment('aqui concatenar inicio-fin, al momento de guardar');
            $table->year('inicio');
            $table->year('fin');
            $table->enum('vigente',['S','N'])->default('S');
            $table->timestamps();

            $table->index('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generaciones');
    }
}
