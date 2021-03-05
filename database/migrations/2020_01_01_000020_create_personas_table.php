<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('rfc',13)->unique()->nullable();
            $table->string('curp',18)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('email')->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();
            $table->string('nombre_completo',150)->nullable()->comment('concatenar nombre + primer apellido + segundo apellido al guardar');
            $table->enum('sexo',['H','M'])->nullable();
            $table->unsignedInteger('entidad_nacimiento_id')->nullable()->comment('entidad de nacimiento de la persona');
            $table->unsignedInteger('pais_nacimiento_id')->nullable()->comment('pais de nacimiento de la persona');

            $table->enum('nacionalidad_tipo',['MEXICANA','EXTRANJERA'])->nullable();
            $table->unsignedBigInteger('nacionalidad_id')->nullable();
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidades');
            $table->string('nacionalidad_descripcion')->nullable();

            $table->unsignedSmallInteger('idioma_id')->nullable()->comment('Referencia para el idioma o lengua.');
            $table->foreign('idioma_id')->references('id')->on('idiomas');

            $table->unsignedTinyInteger('es_indigena_id')->nullable();
            $table->foreign('es_indigena_id')->references('id')->on('es_indigena');

            $table->unsignedTinyInteger('es_extranjero_id')->nullable();
            $table->foreign('es_extranjero_id')->references('id')->on('es_extranjero');

            $table->string('numero_seguridad_social',11)->nullable();

            $table->string('enfermedad')->nullable()->comment('Indicar si padece alguna enfermedad');

            $table->string('servicio_medico')->nullable()->comment('Indicar si cuenta con algún servicio médico');

            $table->unsignedTinyInteger('tipo_sangre_id')->nullable();
            $table->foreign('tipo_sangre_id')->references('id')->on('tipo_sangre');

            $table->enum('tipo_registro',['ALUMNO','DOCENTE','ADMINISTRATIVO'])->comment('Se guardaran datos de los empleados y de los alumnos');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();

            $table->index('nombre_completo');
            $table->index('curp');
            $table->index('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
