<?php

namespace App\Http\Controllers\ControlEscolar\Grupo;

use App\Http\Controllers\Controller;


use App\Exports\DatosContactoGrupoExport;
use App\Exports\GroupsExport;
use App\Exports\SabanaGrupoExport;
use App\Exports\CuentasExport;
use App\Exports\DescargarCuentasExport;
use App\Models\AsignaturaGrupo;
use App\Models\AsignaturaGrupoExpediente;
use App\Models\Grupo;
use App\Models\Asignatura;
use App\Models\CalificacionGrupo;
use App\Models\CalificacionGrupoExpediente;
use App\Models\Expediente;
use App\Models\PeriodoEscolar;
use App\Models\Persona;
use App\User;
use Barryvdh\DomPDF\Facade AS PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Maatwebsite\Excel\Concerns\FromView;

class GrupoController extends Controller
{
    public function index()
    {
        try
        {
            $qry = Grupo::query();

            $datosGrupo = $qry->selectRaw("
            grupos.clave,
            personaTutor.nombre_completo AS nombreCompletoTutor,
            personaControlEscolar.nombre_completo AS nombreCompletoResponsableControlEscolar
            ")
                ->join('sigeeva.periodos_escolares',function ($join){
                    $join->on('periodos_escolares.id','=','grupos.periodo_escolar_id')
                        ->where('periodos_escolares.vigente','=','S');
                })
                ->leftJoin('sigeeva.grupo_tutor','grupo_tutor.grupo_id','=','grupos.id')
                ->leftJoin('sigeeva.personas AS personaTutor','personaTutor.id','=','grupo_tutor.persona_id')
                ->leftJoin('sigeeva.grupo_control_escolar','grupo_control_escolar.grupo_id','=','grupos.id')
                ->leftJoin('sigeeva.personas AS personaControlEscolar','personaControlEscolar.id','=','grupo_control_escolar.persona_id')
                ->get();

            $arregloGrupos = [];
            foreach ($datosGrupo AS $key=>$datoGrupo)
            {
                $nombreCompletoTutor = 'NO ASIGNADO';
                if (!empty($datoGrupo->nombreCompletoTutor))
                    $nombreCompletoTutor = $datoGrupo->nombreCompletoTutor;

                $nombreCompletoResponsableControlEscolar = 'NO ASIGNADO';
                if (!empty($datoGrupo->nombreCompletoResponsableControlEscolar))
                    $nombreCompletoResponsableControlEscolar = $datoGrupo->nombreCompletoResponsableControlEscolar;


                $arregloGrupos[$datoGrupo->clave]['clave']                                   = $datoGrupo->clave;
                $arregloGrupos[$datoGrupo->clave]['nombreCompletoTutor']                     = $nombreCompletoTutor;
                $arregloGrupos[$datoGrupo->clave]['nombreCompletoResponsableControlEscolar'] = $nombreCompletoResponsableControlEscolar;
            }

            $query = AsignaturaGrupo::query();

            $gruposxasignaturas = $query->selectRaw("
                asignatura_grupo.id AS asignatura_grupo_id,
                asignatura_grupo.uuid AS asignatura_grupo_uuid,
                asignatura_grupo.asignatura_orden,
                grupo.id AS grupo_id,
                grupo.clave AS grupo_abreviacion,
                asignatura.abreviacion AS asignatura_abreviacion,
                asignatura.descripcion AS asignatura_descripcion,
                persona.nombre_completo AS docente_nombre_completo,
                carrera.descripcion AS carrera_descripcion,
                grupo.grado_id AS semestre,
                turno.descripcion AS turno_descripcion
            ")
           ->join('sigeeva.personas AS persona','persona.id','=','asignatura_grupo.persona_id')
            ->join('sigeeva.asignaturas AS asignatura','asignatura.id','=','asignatura_grupo.asignatura_id')
            ->join('sigeeva.grupos AS grupo','grupo.id','=','asignatura_grupo.grupo_id')
                ->join('sigeeva.periodos_escolares',function ($join){
                    $join->on('periodos_escolares.id','=','grupo.periodo_escolar_id')
                        ->where('periodos_escolares.vigente','=','S');
                })
            ->join('sigeeva.carreras AS carrera','carrera.id','=','grupo.carrera_id')
            ->join('sigeeva.turnos AS turno','turno.id','=','grupo.turno_id')
            //->where('grupo.periodo_escolar_id','=','4')
            ->orderBy('turno.id', 'ASC')
            ->orderBy('grupo.clave', 'ASC')
            ->orderBy('asignatura_grupo.asignatura_orden', 'ASC')
            ->get();

            $arregloAsignaturas = [];
            foreach ($gruposxasignaturas AS $key=>$asignaturaGrupo)
            {
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['grupo_id']                = $asignaturaGrupo->grupo_id;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_grupo_id']     = $asignaturaGrupo->asignatura_grupo_id;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_grupo_uuid']   = $asignaturaGrupo->asignatura_grupo_uuid;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_orden']        = $asignaturaGrupo->asignatura_orden;

                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_abreviacion']  = $asignaturaGrupo->asignatura_abreviacion;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_descripcion']  = $asignaturaGrupo->asignatura_descripcion;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['docente_nombre_completo'] = $asignaturaGrupo->docente_nombre_completo;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['carrera_descripcion']     = $asignaturaGrupo->carrera_descripcion;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['semestre']                = $asignaturaGrupo->semestre;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['turno_descripcion']       = $asignaturaGrupo->turno_descripcion;
            }

            return view('controlescolar.grupo.index',compact('arregloGrupos','arregloAsignaturas'));
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function historico(Request $request)
    {
        try
        {

            $periodosEscolares = PeriodoEscolar::where('vigente','=','N')->pluck('descripcion','id');

            $arregloAsignaturas = [];
            if (!empty($_GET['periodo_escolar_id']))
            {
                $query = AsignaturaGrupo::query();

                $gruposxasignaturas = $query->selectRaw("
                asignatura_grupo.id AS asignatura_grupo_id,
                asignatura_grupo.uuid AS asignatura_grupo_uuid,
                grupo.id AS grupo_id,
                grupo.clave AS grupo_abreviacion,
                asignatura.abreviacion AS asignatura_abreviacion,
                asignatura.descripcion AS asignatura_descripcion,
                persona.nombre_completo AS docente_nombre_completo,
                carrera.descripcion AS carrera_descripcion,
                grupo.grado_id AS semestre,
                turno.descripcion AS turno_descripcion
                ")
                    ->join('sigeeva.personas AS persona','persona.id','=','asignatura_grupo.persona_id')
                    ->join('sigeeva.asignaturas AS asignatura','asignatura.id','=','asignatura_grupo.asignatura_id')
                    ->join('sigeeva.grupos AS grupo','grupo.id','=','asignatura_grupo.grupo_id')
                    ->join('sigeeva.carreras AS carrera','carrera.id','=','grupo.carrera_id')
                    ->join('sigeeva.turnos AS turno','turno.id','=','grupo.turno_id')
                    ->where('grupo.periodo_escolar_id','=',$_GET['periodo_escolar_id'])
                    ->orderBy('turno.id', 'ASC')
                    ->orderBy('grupo.clave', 'ASC')
                    ->orderBy('asignatura.abreviacion', 'ASC')
                    ->get();

                foreach ($gruposxasignaturas AS $key=>$asignaturaGrupo)
                {
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['grupo_id']                = $asignaturaGrupo->grupo_id;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_grupo_id']     = $asignaturaGrupo->asignatura_grupo_id;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_grupo_uuid']   = $asignaturaGrupo->asignatura_grupo_uuid;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_abreviacion']  = $asignaturaGrupo->asignatura_abreviacion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_descripcion']  = $asignaturaGrupo->asignatura_descripcion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['docente_nombre_completo'] = $asignaturaGrupo->docente_nombre_completo;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['carrera_descripcion']     = $asignaturaGrupo->carrera_descripcion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['semestre']                = $asignaturaGrupo->semestre;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['turno_descripcion']       = $asignaturaGrupo->turno_descripcion;
                }
            }

            return view('controlescolar.grupo.historico',
                compact(
                    'periodosEscolares',
                    'arregloAsignaturas'
                )
            );
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
