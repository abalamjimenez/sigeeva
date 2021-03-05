<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();

            $table->unsignedBigInteger('periodo_escolar_id')->nullable();
            $table->foreign('periodo_escolar_id')->references('id')->on('periodos_escolares');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('bachillerato_procedencia_descripcion')->nullable();
            $table->unsignedBigInteger('secundaria_procedencia_id')->nullable();
            $table->foreign('secundaria_procedencia_id')->references('id')->on('secundaria_procedencias');
            $table->string('secundaria_procedencia_cct',10)->nullable();
            $table->string('secundaria_procedencia_descripcion')->nullable();
            $table->year('secundaria_procedencia_fecha_egreso')->nullable();
            $table->decimal('secundaria_procedencia_promedio',3,1)->nullable();

            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->string('carrera_descripcion');

            $table->unsignedBigInteger('grupo_id')->nullable();

            $table->unsignedTinyInteger('grado_id')->nullable();
            $table->unsignedTinyInteger('turno_id')->nullable();
            $table->string('turno_descripcion',15)->nullable();
            $table->enum('materias_reprobadas',['S','N'])->nullable();
            $table->unsignedTinyInteger('materias_reprobadas_cantidad')->nullable();

            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('curp',18);
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo',['H','M'])->nullable();
            $table->string('email')->nullable();
            $table->string('telefono',10)->nullable();

            $table->unsignedTinyInteger('tipo_sangre_id')->nullable();
            $table->foreign('tipo_sangre_id')->references('id')->on('tipo_sangre');

            $table->enum('nacionalidad_tipo',['MEXICANA','EXTRANJERA'])->nullable();
            $table->unsignedBigInteger('nacionalidad_id')->nullable();
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidades');
            $table->string('nacionalidad_descripcion')->nullable();

            $table->string('beca')->nullable();
            $table->string('enfermedad')->nullable();
            $table->string('servicio_medico')->nullable();
            $table->string('numero_seguridad_social')->nullable();

            $table->string('domicilio_calle')->nullable();
            $table->string('domicilio_numero')->nullable();
            $table->string('domicilio_cruzamientos')->nullable();
            $table->string('domicilio_codigo_postal',5)->nullable();
            $table->string('domicilio_colonia')->nullable();




            $table->enum('tipo_solicitud',['REINSCRIPCION','NUEVO_INGRESO','NUEVO_INGRESO_PAENMS','READMISION','ADMISION'])->nullable();

            $table->unsignedTinyInteger('estatus_solicitud_id')->nullable();
            $table->foreign('estatus_solicitud_id')->references('id')->on('estatus_solicitudes');

            $table->string('observacion_revision')->nullable()->comment('Nos permite indicar porque no se ha podido dejar lista para aplicar la inscripción la solicitud');

            $table->string('referencia_bancaria')->nullable();

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
        Schema::dropIfExists('solicitudes');
    }
}
