<?php

namespace App\Http\Controllers;

use App\Group;
use App\Models\Alumno;
use App\Models\AsignaturaGrupo;
use App\Models\AsignaturaGrupoExpediente;
use App\Models\Domicilio;
use App\Models\Expediente;
use App\Models\Grupo;
use App\Models\PeriodoEscolar;
use App\Models\Referencia;
use App\User;
use Auth;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Localidad;
use App\Models\Entidad;
use App\Models\NecesidadEducativa;
use App\Models\Idioma;
use App\Models\EsExtranjero;
use App\Models\EsIndigena;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;
use Validator;

class ExpedienteController extends Controller
{
    public function crear(Request $request)
    {

        try {
/*
            // CARRERAS
            // 1=>Deportes, 2=>Informática, 3=>Mercadotecnia, 4=>Recreación, 5=>Turismo alternativo

            // TURNOS
            // 1=> Matutino, 2=>Vespertino

            // DATOS QUE NECESITO
            $alumno_curp                = 'GOCG020127HQRMSBA3';
            $alumno_numero_control      = '2019';
            $alumno_email_institucional = 'gabriel.gomez@evasamano.edu.mx';
            $alumno_clave_acceso        = 'Samano2020';

            $alumno_carrera_id          = 1;
            $alumno_turno_id            = 1;
            $alumno_grado_id            = 3;
            $alumno_grupo_id            = 29;


            $persona = Persona::where('curp','=',$alumno_curp)->first();

            $query = Alumno::query();
            $datos = $query->selectRaw('
               (max(numero_control)+1) AS siguiente
            ')
            ->where('numero_control','like',$alumno_numero_control.'%')
            ->get();
            $numero_control = intval(intval($datos[0]['siguiente']));

            //$claveAcceso = md5($numero_control);
            //$claveAcceso = substr($claveAcceso,0,8);


            $miUsuario = new User([
                'username' => $numero_control,
                'email'    => $alumno_email_institucional,
                'password' => bcrypt($alumno_clave_acceso),
                'active'   => true
            ]);

            $persona->usuario()->save($miUsuario);

            $group = Group::where('descripcion','alumno')->first();

            $miUsuario->groups()->save($group);

            $miAlumno = new Alumno;
            $miAlumno->uuid           = Uuid::uuid4()->toString();
            $miAlumno->numero_control = $numero_control;
            $miAlumno->persona_id     = $persona->id;
            $miAlumno->vigente        = 'S';
            $miAlumno->save();

            $miPeriodoEscolar = PeriodoEscolar::where('vigente','=','S')->first();

            // CREAR EXPEDIENTE
            $miExpediente = new Expediente();
            $miExpediente->alumno_id          = $miAlumno->id;
            $miExpediente->uuid               = Uuid::uuid4()->toString();
            $miExpediente->periodo_escolar_id = $miPeriodoEscolar->id;
            $miExpediente->carrera_id         = $alumno_carrera_id;
            $miExpediente->turno_id           = $alumno_turno_id;
            $miExpediente->grado_id           = $alumno_grado_id;
            $miExpediente->grupo_id           = $alumno_grupo_id;
            $miExpediente->es_cedar           = 'N';
            $miExpediente->vigente            = 'S';
            $miExpediente->save();

            // Buscar materias del grupo asignado
            $asignaturasGrupo = AsignaturaGrupo::where('grupo_id','=',$alumno_grupo_id)->get();

            foreach ($asignaturasGrupo AS $asignaturaGrupo)
            {
                $asignaturaGrupoExpediente = new AsignaturaGrupoExpediente();
                $asignaturaGrupoExpediente->asignatura_grupo_id = $asignaturaGrupo->id;
                $asignaturaGrupoExpediente->expediente_id       = $miExpediente->id;
                $asignaturaGrupoExpediente->es_adicional        = 'N';
                $asignaturaGrupoExpediente->save();
            }

            echo 'FINALIZADO';
*/
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
