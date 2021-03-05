<?php

use App\models\AsignaturaHorario;
use App\Models\CalificacionGrupo;
use App\Models\CalificacionGrupoExpediente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargarListasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eliminamos los grupos creados con su detalle
        DB::statement("SET foreign_key_checks=0");
        CalificacionGrupoExpediente::truncate();
        CalificacionGrupo::truncate();
        DB::statement("SET foreign_key_checks=1");

        // Obtener todos los horarios
        $horarios = AsignaturaHorario::all();

        // Recorremos los horarios
        foreach ($horarios AS $horario)
        {
            $grupo = CalificacionGrupo::where('persona_id',$horario->persona_id)
                ->where('horario_id',$horario->horario_id)
                ->where('asignatura_id',$horario->asignatura_id)
                ->first();

            if (empty($grupo))
            {
                //Creamos el grupo
                $calificacionGrupo = new CalificacionGrupo();
                $calificacionGrupo->persona_id    = $horario->persona_id;
                $calificacionGrupo->horario_id    = $horario->horario_id;
                $calificacionGrupo->asignatura_id = $horario->asignatura_id;
                $calificacionGrupo->save();

                //Asignamos las materias al grupo
                $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente
                            (calificacion_grupo_id, expediente_id)
                            SELECT ".$calificacionGrupo->id.", id
                            FROM sigeeva.expedientes
                            WHERE horario_id = ? AND periodo_escolar_id = ?";

                DB::insert($qry, [$horario->horario_id, 2]);
            }
        }

    }
}
