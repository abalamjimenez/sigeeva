<?php

namespace App\Http\Controllers\Historicos;

use App\Http\Controllers\Controller;
use App\Models\AsignaturaGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PeriodoEscolar;



class GrupoController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $periodosEscolares = PeriodoEscolar::all()->pluck('descripcion','id');

            $arregloAsignaturas = [];
            if (!empty($_GET['periodo_escolar_id']))
            {
                $query = AsignaturaGrupo::query();

                $gruposxasignaturas = $query->selectRaw("
                asignatura_grupo.id AS asignatura_grupo_id,
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
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_abreviacion']  = $asignaturaGrupo->asignatura_abreviacion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['asignatura_descripcion']  = $asignaturaGrupo->asignatura_descripcion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['docente_nombre_completo'] = $asignaturaGrupo->docente_nombre_completo;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['carrera_descripcion']     = $asignaturaGrupo->carrera_descripcion;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['semestre']                = $asignaturaGrupo->semestre;
                    $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['turno_descripcion']       = $asignaturaGrupo->turno_descripcion;
                }
            }

            return view('historicos.grupo.index',
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
