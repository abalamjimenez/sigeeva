<?php

namespace App\Http\Controllers\Grupos;

use App\Exports\DatosContactoGrupoExport;
use App\Exports\GroupsExport;
use App\Exports\SabanaGrupoExport;
use App\Exports\CuentasExport;
use App\Exports\DescargarCuentasExport;
use App\Http\Controllers\Controller;
use App\Models\AsignaturaGrupo;
use App\Models\AsignaturaGrupoExpediente;
use App\Models\Grupo;
use App\Models\Asignatura;
use App\Models\CalificacionGrupo;
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
            grupos.id AS grupo_id,
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
                $arregloGrupos[$datoGrupo->clave]['grupo_id']                                = $datoGrupo->grupo_id;
                $arregloGrupos[$datoGrupo->clave]['clave']                                   = $datoGrupo->clave;
                $arregloGrupos[$datoGrupo->clave]['nombreCompletoTutor']                     = $datoGrupo->nombreCompletoTutor;
                $arregloGrupos[$datoGrupo->clave]['nombreCompletoResponsableControlEscolar'] = $datoGrupo->nombreCompletoResponsableControlEscolar;
            }

            $query = AsignaturaGrupo::query();

            $gruposxasignaturas = $query->selectRaw("
                any_value(asignatura_grupo.id) AS asignatura_grupo_id,
                ANY_VALUE(asignatura_grupo.asignatura_orden) AS orden_asignatura,
                grupo.id AS grupo_id,
                grupo.clave AS grupo_abreviacion,
                asignatura.abreviacion AS asignatura_abreviacion,
                asignatura.descripcion AS asignatura_descripcion,
                ANY_VALUE(persona.nombre_completo) AS docente_nombre_completo,
                carrera.descripcion AS carrera_descripcion,
                grupo.grado_id AS semestre,
                turno.descripcion AS turno_descripcion,

                COUNT(*) AS total_alumnos,

                SUM(if (asignatura_grupo_expediente.unidad1 >= 6,1,0)) AS aprobados_unidad1,
                SUM(if (asignatura_grupo_expediente.unidad2 >= 6,1,0)) AS aprobados_unidad2,
                SUM(if (asignatura_grupo_expediente.unidad3 >= 6,1,0)) AS aprobados_unidad3,


                SUM(if (asignatura_grupo_expediente.unidad1 < 6,1,0)) AS reprobados_unidad1,
                SUM(if (asignatura_grupo_expediente.unidad2 < 6,1,0)) AS reprobados_unidad2,
                SUM(if (asignatura_grupo_expediente.unidad3 < 6,1,0)) AS reprobados_unidad3,

                SUM(if ( isnull(asignatura_grupo_expediente.unidad1) ,1,0)) AS en_blanco_unidad1,
                SUM(if ( isnull(asignatura_grupo_expediente.unidad2) ,1,0)) AS en_blanco_unidad2,
                SUM(if ( isnull(asignatura_grupo_expediente.unidad3) ,1,0)) AS en_blanco_unidad3
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
            ->join('sigeeva.asignatura_grupo_expediente','asignatura_grupo_expediente.asignatura_grupo_id','=','asignatura_grupo.id')
            ->groupBy('asignatura_grupo.grupo_id','asignatura_grupo.asignatura_id')
            ->orderBy('turno.id', 'ASC')
            ->orderBy('grupo.clave', 'ASC')
            ->orderBy('orden_asignatura', 'ASC')
            ->get();

            $arregloAsignaturas = [];
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

                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['total_alumnos']          = $asignaturaGrupo->total_alumnos;

                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['aprobados_unidad1']      = $asignaturaGrupo->aprobados_unidad1;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['aprobados_unidad2']      = $asignaturaGrupo->aprobados_unidad2;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['aprobados_unidad3']      = $asignaturaGrupo->aprobados_unidad3;

                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['reprobados_unidad1']      = $asignaturaGrupo->reprobados_unidad1;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['reprobados_unidad2']      = $asignaturaGrupo->reprobados_unidad2;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['reprobados_unidad3']      = $asignaturaGrupo->reprobados_unidad3;

                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['en_blanco_unidad1']      = $asignaturaGrupo->en_blanco_unidad1;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['en_blanco_unidad2']      = $asignaturaGrupo->en_blanco_unidad2;
                $arregloAsignaturas[$asignaturaGrupo->grupo_abreviacion][$key+1]['en_blanco_unidad3']      = $asignaturaGrupo->en_blanco_unidad3;
            }

            $arregloTotalesGrupo = [];
            foreach ($arregloAsignaturas AS $key=>$datosAsignaturas)
            {
                $aprobados_unidad1  = 0;
                $aprobados_unidad2  = 0;
                $aprobados_unidad3  = 0;
                $reprobados_unidad1 = 0;
                $reprobados_unidad2 = 0;
                $reprobados_unidad3 = 0;
                $en_blanco_unidad1  = 0;
                $en_blanco_unidad2  = 0;
                $en_blanco_unidad3  = 0;

                foreach ($datosAsignaturas AS $indice=>$datos)
                {
                    $aprobados_unidad1 = $aprobados_unidad1 + $datos['aprobados_unidad1'];
                    $aprobados_unidad2 = $aprobados_unidad2 + $datos['aprobados_unidad2'];
                    $aprobados_unidad3 = $aprobados_unidad3 + $datos['aprobados_unidad3'];

                    $reprobados_unidad1 = $reprobados_unidad1 + $datos['reprobados_unidad1'];
                    $reprobados_unidad2 = $reprobados_unidad2 + $datos['reprobados_unidad2'];
                    $reprobados_unidad3 = $reprobados_unidad3 + $datos['reprobados_unidad3'];

                    $en_blanco_unidad1 = $en_blanco_unidad1 + $datos['en_blanco_unidad1'];
                    $en_blanco_unidad2 = $en_blanco_unidad2 + $datos['en_blanco_unidad2'];
                    $en_blanco_unidad3 = $en_blanco_unidad3 + $datos['en_blanco_unidad3'];
                }

                $arregloTotalesGrupo[$key]['aprobados_unidad1'] = $aprobados_unidad1;
                $arregloTotalesGrupo[$key]['aprobados_unidad2'] = $aprobados_unidad2;
                $arregloTotalesGrupo[$key]['aprobados_unidad3'] = $aprobados_unidad3;

                $arregloTotalesGrupo[$key]['reprobados_unidad1'] = $reprobados_unidad1;
                $arregloTotalesGrupo[$key]['reprobados_unidad2'] = $reprobados_unidad2;
                $arregloTotalesGrupo[$key]['reprobados_unidad3'] = $reprobados_unidad3;

                $arregloTotalesGrupo[$key]['en_blanco_unidad1'] = $en_blanco_unidad1;
                $arregloTotalesGrupo[$key]['en_blanco_unidad2'] = $en_blanco_unidad2;
                $arregloTotalesGrupo[$key]['en_blanco_unidad3'] = $en_blanco_unidad3;
            }

            return view('grupos.index',compact('arregloAsignaturas','arregloTotalesGrupo','arregloGrupos'));
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function imprimirSabanaGrupo(Grupo $grupo, Request $request)
    {
        try
        {
            // 1. OBTENER LAS MATERIAS DEL GRUPOS
                $query = AsignaturaGrupo::query();

                $asignaturasxgrupo = $query->selectRaw("
                    asignaturas.id AS asignatura_id,
                    asignaturas.abreviacion,
                    asignaturas.descripcion,
                    CONCAT(personas.primer_apellido,' / ',personas.segundo_apellido,' * ',personas.nombre) AS docente
                ")
                ->join('sigeeva.asignaturas','asignaturas.id','=','asignatura_grupo.asignatura_id')
                ->join('sigeeva.personas','personas.id','=','asignatura_grupo.persona_id')
                ->where('asignatura_grupo.grupo_id',$grupo->id)
                ->orderBy('asignatura_grupo.asignatura_orden')
                ->get();

                $arregloAsignaturas = array();
                foreach ($asignaturasxgrupo AS $asignatura)
                {
                    $arregloAsignaturas[$asignatura->asignatura_id]['asignatura_id'] = $asignatura->asignatura_id;
                    $arregloAsignaturas[$asignatura->asignatura_id]['abreviacion']   = $asignatura->abreviacion;
                    $arregloAsignaturas[$asignatura->asignatura_id]['descripcion']   = $asignatura->descripcion;
                    $arregloAsignaturas[$asignatura->asignatura_id]['docente']       = $asignatura->docente;
                }

                //dd($arregloAsignaturas);

            // 3. OBTENER LAS CALIFICACIONES

                $query = AsignaturaGrupoExpediente::query();

                $calificacionesxgrupo = $query->selectRaw("
                    expedientes.tipo_inscripcion,
                    asignatura_grupo_expediente.expediente_id,
                    personas.curp,
                    personas.nombre_completo,
                    asignatura_grupo_expediente.expediente_id,
                    asignatura_grupo_expediente.es_adicional,
                    asignatura_grupo.asignatura_id,
                    asignatura_grupo_expediente.unidad1,
                    asignatura_grupo_expediente.unidad2,
                    asignatura_grupo_expediente.unidad3,
                    asignatura_grupo_expediente.promedio,
                    asignatura_grupo_expediente.calificacion_final,
                    asignatura_grupo_expediente.extraordinario1,
                    asignatura_grupo_expediente.extraordinario2,
                    asignatura_grupo_expediente.examen_especial

                ")
                ->join('sigeeva.asignatura_grupo', function ($join) use ($grupo){
                    $join->on('asignatura_grupo.id','=','asignatura_grupo_expediente.asignatura_grupo_id')
                        ->on('asignatura_grupo.grupo_id','=',\DB::raw($grupo->id) );
                })
                ->join('sigeeva.expedientes','expedientes.id','=','asignatura_grupo_expediente.expediente_id')
                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
                ->where('expedientes.vigente','=','S')
                ->orderBy('nombre_completo','ASC')
                ->get();

                $arregloCalificaciones = array();
                $arregloAlumnos = array();
                $arregloAlumnosEnRepeticion = array();
                foreach ($calificacionesxgrupo AS $calificacion)
                {
                    $nombreAlumno = str_replace(' ','',$calificacion->nombre_completo);

                    if ($calificacion->es_adicional == 'N')
                    {
                        $nombre_completo = $calificacion->nombre_completo;
                        if ($calificacion->tipo_inscripcion != 'ORDINARIO')
                        {
                            $nombre_completo = $nombre_completo.'['.$calificacion->tipo_inscripcion.']';
                        }

                        $arregloAlumnos[$nombreAlumno]['expediente_id']                                                   = $calificacion->expediente_id;
                        $arregloAlumnos[$nombreAlumno]['nombre_completo']                                                 = $nombre_completo;
                        $arregloAlumnos[$nombreAlumno]['curp']                                                            = $calificacion->curp;
                        $arregloAlumnos[$nombreAlumno]['tipo_inscripcion']                                                = $calificacion->tipo_inscripcion;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['asignatura_id']      = $calificacion->asignatura_id;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad1']            = $calificacion->unidad1;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad2']            = $calificacion->unidad2;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad3']            = $calificacion->unidad3;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['promedio']           = $calificacion->promedio;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['calificacion_final'] = $calificacion->calificacion_final;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['extraordinario1']    = $calificacion->extraordinario1;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['extraordinario2']    = $calificacion->extraordinario2;
                        $arregloAlumnos[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['examen_especial']    = $calificacion->examen_especial;
                    }
                    else if ($calificacion->es_adicional == 'S')
                    {
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['expediente_id']                                                   = $calificacion->expediente_id;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['nombre_completo']                                                 = $calificacion->nombre_completo;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['curp']                                                            = $calificacion->curp;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['asignatura_id']      = $calificacion->asignatura_id;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad1']            = $calificacion->unidad1;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad2']            = $calificacion->unidad2;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['unidad3']            = $calificacion->unidad3;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['promedio']           = $calificacion->promedio;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['calificacion_final'] = $calificacion->calificacion_final;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['extraordinario1']    = $calificacion->extraordinario1;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['extraordinario2']    = $calificacion->extraordinario2;
                        $arregloAlumnosEnRepeticion[$nombreAlumno]['asignaturas'][$calificacion->asignatura_id]['examen_especial']    = $calificacion->examen_especial;
                    }
                }

                foreach($arregloAlumnos AS $key=>$datosAlumno)
                {
                    if ($datosAlumno['tipo_inscripcion'] != 'ORDINARIO')
                    {
                        if (count($arregloAsignaturas) != count($datosAlumno['asignaturas']))
                        {
                            $asignaturas = '';
                            foreach ($datosAlumno['asignaturas'] AS $keyAsignatura=>$datosAsignatura)
                            {
                                if (empty($asignaturas))
                                {
                                    $asignaturas = $arregloAsignaturas[$keyAsignatura]['abreviacion'];
                                }
                                else
                                {
                                    $asignaturas = $asignaturas.','.$arregloAsignaturas[$keyAsignatura]['abreviacion'];
                                }
                            }

                            $arregloAlumnos[$key]['nombre_completo'] = $arregloAlumnos[$key]['nombre_completo'].'('.$asignaturas.')';
                        }
                    }
                }

                foreach($arregloAlumnosEnRepeticion AS $key=>$repeticion)
                {
                    $asignaturas = '';
                    foreach ($repeticion['asignaturas'] AS $keyAsignatura=>$materiaEnRepeticion)
                    {
                        if (empty($asignaturas))
                            $asignaturas = $arregloAsignaturas[$keyAsignatura]['abreviacion'];
                        else
                            $asignaturas = $asignaturas.','.$arregloAsignaturas[$keyAsignatura]['abreviacion'];
                    }

                    $arregloAlumnosEnRepeticion[$key]['nombre_completo'] = $arregloAlumnosEnRepeticion[$key]['nombre_completo'].'['.$asignaturas.']';
                }

            //return view('exports.sabanaGrupos',compact('grupo','arregloAlumnos','arregloAsignaturas','arregloCalificaciones'));
            $nombreArchivo = 'sabana_'.$grupo->clave.'_'.date('Ymd').'_'.date('His').'.xlsx';

            return Excel::download(new SabanaGrupoExport($grupo,$arregloAlumnos,$arregloAlumnosEnRepeticion,$arregloAsignaturas,$arregloCalificaciones), $nombreArchivo);
            //return Excel::download(new SabanaGrupoExport($grupo,$arregloAlumnos,$arregloAsignaturas,$arregloCalificaciones), $nombreArchivo);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function imprimirListadoGrupo(Grupo $grupo, Request $request)
    {
        try
        {
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            //  D A T O S   G E N E R A L E S   D E L   G R U P O
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            $query = Grupo::query();

            $generales = $query->selectRaw("
                carrera.descripcion AS carrera_descripcion,
                grupos.grado_id AS semestre,
                grupos.clave AS grupo,
                turno.descripcion AS turno_descripcion
            ")
            ->join('sigeeva.carreras AS carrera','carrera.id','=','grupos.carrera_id')
            ->join('sigeeva.turnos AS turno','turno.id','=','grupos.turno_id')
            ->where('grupos.id',$grupo->id)
            ->first();

            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            //               E X P E D I E N T E S
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =

            $query = AsignaturaGrupo::query();

            $alumnos = $query->selectRaw("
                asignatura_id AS asignatura_id,
                asignatura.abreviacion,
                expediente.id AS expediente_id,
                persona.nombre_completo,
                persona.email,
                persona.telefono,
                detalle.es_adicional
            ")
                ->join('sigeeva.asignaturas AS asignatura','asignatura.id','=','asignatura_grupo.asignatura_id')
                ->join('sigeeva.asignatura_grupo_expediente AS detalle','detalle.asignatura_grupo_id','=','asignatura_grupo.id')
                ->join('sigeeva.expedientes AS expediente','expediente.id','=','detalle.expediente_id')
                ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
                ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
                ->where('asignatura_grupo.grupo_id',$grupo->id)
                ->orderBy('detalle.es_adicional','DESC')
                ->orderBy('persona.nombre_completo')
                ->get();

            $arreglo_alumnos = array();
            foreach($alumnos AS $alumno)
            {
                if ($alumno->es_adicional == 'N')
                {
                    $arreglo_alumnos['normales'][$alumno->expediente_id]['nombre_completo'] = $alumno->nombre_completo;
                    $arreglo_alumnos['normales'][$alumno->expediente_id]['telefono']        = $alumno->telefono;
                    $arreglo_alumnos['normales'][$alumno->expediente_id]['email']           = $alumno->email;
                }
                else if ($alumno->es_adicional == 'S')
                {
                    $arreglo_alumnos['adicionales'][$alumno->expediente_id]['nombre_completo'] = $alumno->nombre_completo;
                    $arreglo_alumnos['adicionales'][$alumno->expediente_id]['telefono']        = $alumno->telefono;
                    $arreglo_alumnos['adicionales'][$alumno->expediente_id]['email']           = $alumno->email;
                    $arreglo_alumnos['adicionales'][$alumno->expediente_id]['materias'][$alumno->asignatura_id]['descripcion'] = $alumno->abreviacion;
                }
            }

            return Excel::download(new GroupsExport($generales, $arreglo_alumnos), $generales->grupo.'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarDatosContacto(Grupo $grupo, Request $request)
    {
        try
        {


            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            //               E X P E D I E N T E S
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =

            $qry = Expediente::query();

            $expedientes = $qry->selectRaw("
            personas.primer_apellido, personas.segundo_apellido, personas.nombre,
            personas.curp,
            users.username AS USUARIO_SIGEEVA,
            personas.telefono AS TELEFONO_CONTACTO,
            personas.email AS CORREO_PERSONAL,
            users.email AS CORREO_INSTITUCIONAL
            ")
                ->join('alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('personas','personas.id','=','alumnos.persona_id')
                ->join('sigeeva.users', function ($join) {
                    $join->on('users.userable_id','=','personas.id')
                        ->where('users.userable_type','like','%Persona');
                })
            ->where('expedientes.grupo_id','=',$grupo->id)
            ->get();

            return Excel::download(new DatosContactoGrupoExport($grupo, $expedientes), 'datos_contacto_'.$grupo->clave.'_'.date('Ymd').'_'.date('His').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function capturarCalificaciones(AsignaturaGrupo $asignaturaGrupo, Request $request)
    {
        try
        {
            //01 Verificar si existe el grupo creado para asignar
            //   calificaciones

            $calificacionGrupo = AsignaturaGrupo::with('persona','grupo','asignatura')->where('persona_id',$asignaturaGrupo->persona_id)
            ->where('grupo_id',$asignaturaGrupo->grupo_id)
            ->where('asignatura_id',$asignaturaGrupo->asignatura_id)
            ->first();

            if (empty($calificacionGrupo))
            {
                // Nuevo registro
                $calificacionGrupo = new CalificacionGrupo();
                $calificacionGrupo->persona_id    = $asignaturaGrupo->persona_id;
                $calificacionGrupo->grupo_id    = $asignaturaGrupo->grupo_id;
                $calificacionGrupo->asignatura_id = $asignaturaGrupo->asignatura_id;
                $calificacionGrupo->save();

                $qry = "INSERT INTO sigeeva.asignatura_grupo_expediente
                        (calificacion_grupo_id, expediente_id)
                        SELECT ".$calificacionGrupo->id.", id
                        FROM sigeeva.expedientes
                        WHERE grupo_id = ? AND periodo_escolar_id = ?";


                DB::insert($qry, [$asignaturaGrupo->grupo_id, $asignaturaGrupo->grupo->periodo_escolar_id]);
            }

            // Matricula activa
            $query = AsignaturaGrupoExpediente::query();

            $matriculaActiva = $query->selectRaw("
                asignatura_grupo_expediente.id,
                persona.nombre_completo,
                asignatura_grupo_expediente.expediente_id,
                asignatura_grupo_expediente.es_adicional,
                asignatura_grupo_expediente.unidad1,
                asignatura_grupo_expediente.unidad2,
                asignatura_grupo_expediente.unidad3,
                asignatura_grupo_expediente.promedio,
                asignatura_grupo_expediente.calificacion_final,
                asignatura_grupo_expediente.extraordinario1,
                asignatura_grupo_expediente.extraordinario2,
                asignatura_grupo_expediente.examen_especial
            ")
            ->join('sigeeva.expedientes AS expediente','expediente.id','=','asignatura_grupo_expediente.expediente_id')
            ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
            ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
            ->where('asignatura_grupo_expediente.asignatura_grupo_id',$calificacionGrupo->id)
            ->where('asignatura_grupo_expediente.es_adicional','N')
            ->orderBy('persona.nombre_completo')
            ->get();

            $query = AsignaturaGrupoExpediente::query();

            $alumnosCr = $query->selectRaw("
                asignatura_grupo_expediente.id,
                persona.nombre_completo,
                asignatura_grupo_expediente.expediente_id,
                asignatura_grupo_expediente.es_adicional,
                asignatura_grupo_expediente.unidad1,
                asignatura_grupo_expediente.unidad2,
                asignatura_grupo_expediente.unidad3,
                asignatura_grupo_expediente.promedio,
                asignatura_grupo_expediente.calificacion_final,
                asignatura_grupo_expediente.extraordinario1,
                asignatura_grupo_expediente.extraordinario2,
                asignatura_grupo_expediente.examen_especial
            ")
                ->join('sigeeva.expedientes AS expediente','expediente.id','=','asignatura_grupo_expediente.expediente_id')
                ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
                ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
                ->where('asignatura_grupo_expediente.asignatura_grupo_id',$calificacionGrupo->id)
                ->where('asignatura_grupo_expediente.es_adicional','S')
                ->orderBy('persona.nombre_completo')
                ->get();

            return view('grupos.capturarCalificaciones',compact('asignaturaGrupo','calificacionGrupo','matriculaActiva','alumnosCr'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function almacenarCalificaciones(AsignaturaGrupo $asignaturaGrupo, Request $request)
    {
        $calificaciones = $request->get('AsignaturaGrupoExpediente');

        foreach ($calificaciones AS $key=>$calificacion)
        {
            $promedio           = null;
            $calificacion_final = null;

            if (
                (strlen($calificacion[1])>0 OR $calificacion[1] === 0 ) AND
                (strlen($calificacion[2])>0 OR $calificacion[2] === 0 ) AND
                (strlen($calificacion[3])>0 OR $calificacion[3] === 0 ))
            {

                $promedio = bcdiv( (($calificacion[1] + $calificacion[2] + $calificacion[3]) /3),1 ,1);

                if ($promedio >= 6)
                    $calificacion_final = round( (($calificacion[1] + $calificacion[2] + $calificacion[3]) /3),0 );
                else
                    $calificacion_final = 5;
            }

            AsignaturaGrupoExpediente::where('id',$key)->update(
                array(
                    'unidad1'            => $calificacion[1],
                    'unidad2'            => $calificacion[2],
                    'unidad3'            => $calificacion[3],
                    'promedio'           => $promedio,
                    'calificacion_final' => $calificacion_final,
                    'extraordinario1'    => $calificacion['e1'],
                    'extraordinario2'    => $calificacion['e2'],
                    'examen_especial'    => $calificacion['ee']
                )
            );
        }

        flash('Los datos se registraron satisfactoriamente')->success();

        return redirect()->to(route('grupos.capturarCalificaciones',$asignaturaGrupo->uuid));
    }

    public function capturarCalificacionesAdmin(AsignaturaGrupo $asignaturaGrupo, Request $request)
    {
        try
        {
            $periodoEscolarGrupo = $asignaturaGrupo->grupo->periodo_escolar_id;

            $periodoEscolarActual = PeriodoEscolar::where('vigente','S')->first()->id;

            $moduloHistorico='N';
            if ($periodoEscolarGrupo != $periodoEscolarActual)
                $moduloHistorico='S';



            //01 Verificar si existe el grupo para asignar  calificaciones

            $miAsignaturaGrupo = AsignaturaGrupo::with('persona','grupo','asignatura')
                ->where('persona_id',$asignaturaGrupo->persona_id)
                ->where('grupo_id',$asignaturaGrupo->grupo_id)
                ->where('asignatura_id',$asignaturaGrupo->asignatura_id)
                ->first();


            if (empty($miAsignaturaGrupo))
            {
                // Nuevo registro
                $miAsignaturaGrupo = new AsignaturaGrupo();
                $miAsignaturaGrupo->persona_id    = $asignaturaGrupo->persona_id;
                $miAsignaturaGrupo->grupo_id    = $asignaturaGrupo->grupo_id;
                $miAsignaturaGrupo->asignatura_id = $asignaturaGrupo->asignatura_id;
                $miAsignaturaGrupo->save();

                $qry = "INSERT INTO sigeeva.asignatura_grupo_expediente
                        (calificacion_grupo_id, expediente_id)
                        SELECT ".$miAsignaturaGrupo->id.", id
                        FROM sigeeva.expedientes
                        WHERE grupo_id = ? ";


                DB::insert($qry, [$asignaturaGrupo->grupo_id]);

                $asignaturaGrupo = $miAsignaturaGrupo;
            }

            // Matricula activa
            $query = AsignaturaGrupoExpediente::query();

            $matriculaActiva = $query->selectRaw("
                asignatura_grupo_expediente.id,
                persona.nombre_completo,
                asignatura_grupo_expediente.expediente_id,
                asignatura_grupo_expediente.es_adicional,
                asignatura_grupo_expediente.unidad1,
                asignatura_grupo_expediente.unidad2,
                asignatura_grupo_expediente.unidad3,
                asignatura_grupo_expediente.promedio,
                asignatura_grupo_expediente.calificacion_final,
                asignatura_grupo_expediente.extraordinario1,
                asignatura_grupo_expediente.extraordinario2,
                asignatura_grupo_expediente.examen_especial
            ")
                ->join('sigeeva.expedientes AS expediente','expediente.id','=','asignatura_grupo_expediente.expediente_id')
                ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
                ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
                ->where('asignatura_grupo_expediente.asignatura_grupo_id',$asignaturaGrupo->id)
                ->where('asignatura_grupo_expediente.es_adicional','N')
                ->orderBy('persona.nombre_completo')
                ->get();



            $query = AsignaturaGrupoExpediente::query();

            $alumnosCr = $query->selectRaw("
                asignatura_grupo_expediente.id,
                persona.nombre_completo,
                asignatura_grupo_expediente.expediente_id,
                asignatura_grupo_expediente.es_adicional,
                asignatura_grupo_expediente.unidad1,
                asignatura_grupo_expediente.unidad2,
                asignatura_grupo_expediente.unidad3,
                asignatura_grupo_expediente.promedio,
                asignatura_grupo_expediente.calificacion_final,
                asignatura_grupo_expediente.extraordinario1,
                asignatura_grupo_expediente.extraordinario2,
                asignatura_grupo_expediente.examen_especial
            ")
                ->join('sigeeva.expedientes AS expediente','expediente.id','=','asignatura_grupo_expediente.expediente_id')
                ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
                ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
                ->where('asignatura_grupo_expediente.asignatura_grupo_id',$asignaturaGrupo->id)
                ->where('asignatura_grupo_expediente.es_adicional','S')
                ->orderBy('persona.nombre_completo')
                ->get();

            return view('grupos.capturarCalificacionesAdmin',
                compact(
                    'asignaturaGrupo',
                    'matriculaActiva',
                    'alumnosCr',
                    'moduloHistorico'
                )
            );
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function almacenarCalificacionesAdmin(AsignaturaGrupo $asignaturaGrupo, Request $request)
    {
        $calificaciones = $request->get('AsignaturaGrupoExpediente');

        foreach ($calificaciones AS $key=>$calificacion)
        {
            $promedio           = null;
            $calificacion_final = null;

            if (
                (strlen($calificacion[1])>0 OR $calificacion[1] === 0 ) AND
                (strlen($calificacion[2])>0 OR $calificacion[2] === 0 ) AND
                (strlen($calificacion[3])>0 OR $calificacion[3] === 0 ))
            {

                $promedio = bcdiv( (($calificacion[1] + $calificacion[2] + $calificacion[3]) /3),1 ,1);

                if ($promedio >= 6)
                    $calificacion_final = round( (($calificacion[1] + $calificacion[2] + $calificacion[3]) /3),0 );
                else
                    $calificacion_final = 5;
            }

            AsignaturaGrupoExpediente::where('id',$key)->update(
                array(
                    'unidad1'            => $calificacion[1],
                    'unidad2'            => $calificacion[2],
                    'unidad3'            => $calificacion[3],
                    'promedio'           => $promedio,
                    'calificacion_final' => $calificacion_final,
                    'extraordinario1'    => $calificacion['e1'],
                    'extraordinario2'    => $calificacion['e2'],
                    'examen_especial'    => $calificacion['ee']
                )
            );
        }

        flash('Los datos se registraron satisfactoriamente')->success();

        return redirect()->to(route('grupos.capturarCalificacionesAdmin',$asignaturaGrupo->uuid));
    }

    public function imprimirListado(AsignaturaGrupo $asignaturaGrupo, Request $request)
    {
        //$calificacionGrupo = CalificacionGrupo::with('persona','grupo','asignatura')->where('persona_id',$asignaturagrupo->persona_id)
        //    ->where('grupo_id',$asignaturagrupo->grupo_id)
        //    ->where('asignatura_id',$asignaturagrupo->asignatura_id)
        //    ->first();

        $query = AsignaturaGrupoExpediente::query();

        $expedientes = $query->selectRaw("
                asignatura_grupo_expediente.id,
                persona.nombre_completo,
                asignatura_grupo_expediente.expediente_id,
                asignatura_grupo_expediente.es_adicional,
                asignatura_grupo_expediente.unidad1,
                asignatura_grupo_expediente.unidad2,
                asignatura_grupo_expediente.unidad3,
                asignatura_grupo_expediente.promedio,
                asignatura_grupo_expediente.calificacion_final,
                asignatura_grupo_expediente.extraordinario1,
                asignatura_grupo_expediente.extraordinario2,
                asignatura_grupo_expediente.examen_especial
            ")
            ->join('sigeeva.expedientes AS expediente','expediente.id','=','asignatura_grupo_expediente.expediente_id')
            ->join('sigeeva.alumnos AS alumno','alumno.id','=','expediente.alumno_id')
            ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
            ->where('asignatura_grupo_expediente.asignatura_grupo_id',$asignaturaGrupo->id)
            ->orderBy('persona.nombre_completo')
            ->get();

        $pdf = PDF::loadView('pdf.misgrupos.listado',compact('asignaturaGrupo','expedientes'));

        //$fileName = date('Ymd').'.pdf';
        //Storage::disk('publico')->put($fileName, $pdf->output());
        //return $pdf->download( config('app.url').'/public/'.$fileName);

        return $pdf->download('migrupo.pdf',$pdf->output());
    }

    public function estadisticasCaptura()
    {
        $query = AsignaturaGrupoExpediente::query();

        $estadisticasCaptura = $query->selectRaw("
            grupo.grupo_id,grupo.clave,
            asignatura.abreviacion,asignatura.descripcion,
            ANY_VALUE(persona.nombre_completo) AS profesor,
            count(*) AS total_alumnos,
            COUNT(IF((asignatura_grupo_expediente.unidad1>=0), 1, NULL)) AS alumnos_con_unidad1,
            COUNT(IF((asignatura_grupo_expediente.unidad2>=0), 1, NULL)) AS alumnos_con_unidad2,
            COUNT(IF((asignatura_grupo_expediente.unidad3>=0), 1, NULL)) AS alumnos_con_unidad3,
            COUNT(IF((asignatura_grupo_expediente.calificacion_final>=0), 1, NULL)) AS alumnos_con_calificacion_final
            ")
        ->join('sigeeva.calificacion_grupo AS grupo','grupo.id','=','asignatura_grupo_expediente.calificacion_grupo_id')
        ->join('sigeeva.grupos AS grupo','grupo.id','=','grupo.grupo_id')
        ->join('sigeeva.asignaturas AS asignatura','asignatura.id','=','grupo.asignatura_id')
        ->join('sigeeva.personas AS persona','persona.id','=','grupo.persona_id')
        ->groupBy('grupo.grupo_id')
        ->groupBy('grupo.asignatura_id')
        ->orderBy('alumnos_con_calificacion_final')
        ->get();

        return view('grupos.estadisticasCaptura',compact('estadisticasCaptura'));
    }

    public function imprimirCuentas(Grupo $grupo, Request $request)
    {
        try
        {
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            //  D A T O S   G E N E R A L E S   D E L   G R U P O
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            $query = Grupo::query();

            $generales = $query->selectRaw("
                carrera.descripcion AS carrera_descripcion,
                grupos.grado_id AS semestre,
                grupos.clave AS grupo,
                turno.descripcion AS turno_descripcion
            ")
                ->join('sigeeva.carreras AS carrera','carrera.id','=','grupos.carrera_id')
                ->join('sigeeva.turnos AS turno','turno.id','=','grupos.turno_id')
                ->where('grupos.id',$grupo->id)
                ->first();

            // = = = = = = = = = = = = = = = = = = = = = = = = = = =
            //               D A T O S   C U E N T A
            // = = = = = = = = = = = = = = = = = = = = = = = = = = =

            $select = "users.cuenta_validada,users.username,users.last_login_at AS 'Último acceso',";
            $select.= "personas.nombre_completo, personas.curp,personas.telefono,personas.email,";
            $select.= "personas.numero_seguridad_social,";
            $select.= "carreras.descripcion AS descripcion_carrera,";
            $select.= "turnos.descripcion AS descripcion_turno,";
            $select.= "expedientes.grado_id AS semestre";

            $query = Expediente::query();

            if ($request->input('tipo') == 'VALIDADAS')
            {
                $datosCuentas = $query->selectRaw($select)
                ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
                ->join('sigeeva.turnos','turnos.id','=','expedientes.turno_id')
                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
                ->join('sigeeva.users', function ($join) {
                        $join->on('users.userable_id','=','personas.id')
                            ->where('users.userable_type','like','%Persona');
                })
                ->where('users.cuenta_validada','=','S')
                ->where('expedientes.grupo_id',$grupo->id)
                ->orderBy('personas.nombre_completo')
                ->get();
            }
            else if ($request->input('tipo') == 'XVALIDAR')
            {
                $datosCuentas = $query->selectRaw($select)
                ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
                ->join('sigeeva.turnos','turnos.id','=','expedientes.turno_id')
                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
                ->join('sigeeva.users', function ($join) {
                        $join->on('users.userable_id','=','personas.id')
                            ->where('users.userable_type','like','%Persona');
                })
                ->where('users.cuenta_validada','=','N')
                ->where('expedientes.grupo_id',$grupo->id)
                ->orderBy('personas.nombre_completo')
                ->get();
            }
            else if ($request->input('tipo') == 'TODAS')
            {
                $datosCuentas = $query->selectRaw($select)
                ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
                ->join('sigeeva.turnos','turnos.id','=','expedientes.turno_id')
                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
                ->join('sigeeva.users', function ($join) {
                        $join->on('users.userable_id','=','personas.id')
                            ->where('users.userable_type','like','%Persona');
                })
                ->where('expedientes.grupo_id',$grupo->id)
                ->orderBy('personas.nombre_completo')
                ->get();
            }

            return Excel::download(new CuentasExport($generales, $datosCuentas), $generales->grupo.'_cuentas.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarCuentas(Request $request)
    {
        try
        {
            $select = "grupos.clave AS grupo_clave,";
            $select.= "expedientes.grupo_id,";
            $select.= "carreras.descripcion AS carrera_descripcion,";
            $select.= "expedientes.grado_id AS semestre,";
            $select.= "personas.id AS persona_id,";
            $select.= "personas.nombre_completo, users.cuenta_validada,";
            $select.= "expedientes.turno_id, turnos.descripcion AS turno_descripcion,";
            $select.= "tutores.nombre_completo AS nombre_tutor";

            $qry = User::query();

            $cuentas = $qry->selectRaw($select)
            ->join('sigeeva.personas','personas.id','=','users.userable_id')
            ->join('sigeeva.alumnos', 'alumnos.persona_id','=','personas.id')
            ->join('sigeeva.expedientes', function ($join) {
                $join->on('expedientes.alumno_id','=','alumnos.id')
                    ->where('expedientes.periodo_escolar_id','=','2');
            })
            ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
            ->join('sigeeva.grupos','grupos.id','=','expedientes.grupo_id')
            ->leftjoin('sigeeva.personas AS tutores','tutores.id','grupos.tutor_id')
            ->join('sigeeva.turnos',  'turnos.id','=','expedientes.turno_id')
            ->where('users.userable_type','LIKE','%Persona')
            ->orderBy('expedientes.turno_id')
            ->orderBy('expedientes.grupo_id')
            ->get();

            $arregloCuentas = array();
            foreach ($cuentas AS $cuenta)
            {
                if ($cuenta->turno_id == 1)
                {
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['grupo_id']          = $cuenta->grupo_id;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['grupo_clave']       = $cuenta->grupo_clave;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['carrera_descripcion'] = $cuenta->carrera_descripcion;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['semestre']            = $cuenta->semestre;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['cuenta_validada']     = $cuenta->cuenta_validada;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['turno_id']            = $cuenta->turno_id;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['turno_descripcion']   = $cuenta->turno_descripcion;
                    $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['nombre_tutor']        = $cuenta->nombre_tutor;

                    if ($cuenta->cuenta_validada == 'S')
                    {
                        $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['alumnos_validados'][$cuenta->persona_id]['persona_id']      = $cuenta->persona_id;
                        $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['alumnos_validados'][$cuenta->persona_id]['nombre_completo'] = $cuenta->nombre_completo;
                    }
                    else if ($cuenta->cuenta_validada == 'N')
                    {
                        $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['alumnos_no_validados'][$cuenta->persona_id]['persona_id']      = $cuenta->persona_id;
                        $arregloCuentas['turnoMatutino'][$cuenta->grupo_id]['alumnos_no_validados'][$cuenta->persona_id]['nombre_completo'] = $cuenta->nombre_completo;
                    }
                }
                else if ($cuenta->turno_id == 2)
                {
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['grupo_id']          = $cuenta->grupo_id;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['grupo_clave']       = $cuenta->grupo_clave;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['carrera_descripcion'] = $cuenta->carrera_descripcion;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['semestre']            = $cuenta->semestre;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['cuenta_validada']     = $cuenta->cuenta_validada;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['turno_id']            = $cuenta->turno_id;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['turno_descripcion']   = $cuenta->turno_descripcion;
                    $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['nombre_tutor']        = $cuenta->nombre_tutor;

                    if ($cuenta->cuenta_validada == 'S')
                    {
                        $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['alumnos_validados'][$cuenta->persona_id]['persona_id']      = $cuenta->persona_id;
                        $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['alumnos_validados'][$cuenta->persona_id]['nombre_completo'] = $cuenta->nombre_completo;
                    }
                    else if ($cuenta->cuenta_validada == 'N')
                    {
                        $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['alumnos_no_validados'][$cuenta->persona_id]['persona_id']      = $cuenta->persona_id;
                        $arregloCuentas['turnoVespertino'][$cuenta->grupo_id]['alumnos_no_validados'][$cuenta->persona_id]['nombre_completo'] = $cuenta->nombre_completo;
                    }
                }

            }

            return Excel::download(new DescargarCuentasExport($arregloCuentas), 'descargar_cuentas_'.date('Ymd').'_'.date('His').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
