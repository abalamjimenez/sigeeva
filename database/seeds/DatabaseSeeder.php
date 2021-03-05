<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ---------------------------------------------------------------------------------------------------------
        // ----------------------------          CARGAR DATOS INICIALES        -------------------------------------
        //                                 DOCENTES, ALUMNOS Y ADMINISTRATIVOS
        // ---------------------------------------------------------------------------------------------------------

        $files = [
            'database/queries/cargar_alumnos.sql',
            'database/queries/cargar_docentes.sql',
            'database/queries/cargar_administrativos.sql',
        ];

        foreach ($files as $file) {
            \DB::unprepared(file_get_contents($file));
            $this->command->info($file . ' has been run');
        }

        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------     CARGAR DATOS VALIDACION ACCESO      -------------------------------------
        // ---------------------------------------------------------------------------------------------------------

        $this->createGroups();

        // ---------------------------------------------------------------------------------------------------------
        // ----------------------------        CARGAR CATALOGOS GENERALES      -------------------------------------
        // ---------------------------------------------------------------------------------------------------------

        $this->call(CicloEscolarTableSeeder::class);
        $this->call(PeriodoEscolarTableSeeder::class);
        $this->call(TurnoTableSeeder::class);
        $this->call(IdiomaTableSeeder::class);
        $this->call(EsExtranjeroTableSeeder::class);
        $this->call(EsIndigenaTableSeeder::class);
        $this->call(NecesidadEducativaTableSeeder::class);
        $this->call(GradoTableSeeder::class);
        $this->call(SituacionAcademicaTableSeeder::class);
        $this->call(CarreraTableSeeder::class);
        $this->call(AsignaturaTableSeeder::class);

        // ---------------------------------------------------------------------------------------------------------
        // ----------------------------             CREAMOS REGISTROS           -------------------------------------
        // ---------------------------------------------------------------------------------------------------------

        $this->call(AlumnosUsuariosTableSeeder::class);
        $this->call(AdministrativosUsuariosTableSeeder::class);
        $this->call(DocentesUsuariosTableSeeder::class);

        // ---------------------------------------------------------------------------------------------------------
        // ----------------------------           ASIGNATURA HORARIOS          -------------------------------------
        // ---------------------------------------------------------------------------------------------------------

        $this->call(HorarioAsignaturaTableSeeder::class);

        $this->call(CargarListasSeeder::class);
    }

    protected function createGroups()
    {
        $groups = [
            'superusuario',
            'administrador_del_sistema',
            'director_general',
            'director_del_plantel',
            'director_del_plantel',
            'rh',
            'servicio_escolar',
            'control_escolar',
            'coordinador_de_turno',
            'caja',
            'practica_profesional',
            'servicio_social',
            'orientacion',
            'administrativo',
            'docente',
            'alumno',
            'padre_de_familia',
        ];
        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'descripcion' => $group,
            ]);
        }
    }
}
