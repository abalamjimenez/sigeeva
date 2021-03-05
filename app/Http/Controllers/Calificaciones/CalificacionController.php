<?php

namespace App\Http\Controllers\Calificaciones;

use App\Http\Controllers\Controller;
use App\Models\AsignaturaGrupoExpediente;
use App\Models\CalificacionGrupoExpediente;
use App\Models\Expediente;
use App\Models\Grupo;
use App\Models\PeriodoEscolar;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{

    public function index(Request $request)
    {
        try
        {

            // O B T E N E R   P E R I O D O   E S C O L A R   A C T I V O
            $periodoEscolar = PeriodoEscolar::where('vigente','=','S')->first();

            // D A T O S   G E N E R A L E S   D E L   A L U M N O
            $persona        = auth()->user()->userable;
            $alumno_id      = auth()->user()->userable->alumno->id;
            $expediente     = Expediente::with('carrera','turno','generacion','grupo')
                                ->where('alumno_id','=',$alumno_id)
                                ->where('periodo_escolar_id','=',$periodoEscolar->id)
                                ->first();

            if ($expediente == null)
            {
                $titulo  = 'Página no encontrada';

                $mensaje = 'No tiene calificaciones registradas para el periodo escolar activo';

                return view('errors.general',
                    compact('titulo',
                        'mensaje'
                    )
                );
            }

            if ($expediente->es_cedar == 'S')
            {
                $titulo  = 'Página no encontrada';

                $mensaje = 'Las calificaciones para alumnos CEDAR no están disponibles en el sistema,';
                $mensaje.= 'consulta con tus maestros para obtener tus calificaciones.';

                return view('errors.general',
                    compact('titulo',
                        'mensaje'
                    )
                );
            }

            // O B T E N E R   R E S P O N S A B L E   D E
            // C O N T R O L   E S C O L A R   Y   T U T O R

            $qry = Grupo::query();

            $responsables = $qry->selectRaw("
            personaTutor.nombre_completo AS nombreCompletoTutor,
            personaControlEscolar.nombre_completo AS nombreCompletoResponsableControlEscolar
            ")
                ->leftJoin('sigeeva.grupo_tutor','grupo_tutor.grupo_id','=','grupos.id')
                ->leftJoin('sigeeva.personas AS personaTutor','personaTutor.id','=','grupo_tutor.persona_id')
                ->leftJoin('sigeeva.grupo_control_escolar','grupo_control_escolar.grupo_id','=','grupos.id')
                ->leftJoin('sigeeva.personas AS personaControlEscolar','personaControlEscolar.id','=','grupo_control_escolar.persona_id')
                ->where('grupos.id','=',$expediente->grupo_id)
                ->first();


            // O B T E N E R   L A S   M A T E R I A S   D E L   A L U M N O
            // C O N   C A L I F I C A C I O N E S
            $asignaturasqry = AsignaturaGrupoExpediente::query();

            $asignaturas = $asignaturasqry->selectRaw("
            grupos.clave,
            personas.nombre_completo,
            asignaturas.abreviacion,asignaturas.descripcion,
            asignatura_grupo_expediente.uuid AS asignatura_grupo_expediente_uuid,
            asignatura_grupo_expediente.es_adicional,
            asignatura_grupo_expediente.unidad1,asignatura_grupo_expediente.unidad2,
            asignatura_grupo_expediente.unidad3,asignatura_grupo_expediente.promedio,
            asignatura_grupo_expediente.calificacion_final,
            asignatura_grupo_expediente.extraordinario1,
            asignatura_grupo_expediente.extraordinario2,
            asignatura_grupo_expediente.examen_especial
            ")
            ->join('sigeeva.asignatura_grupo','asignatura_grupo.id','=','asignatura_grupo_expediente.asignatura_grupo_id')
            ->join('sigeeva.grupos', function ($join) use ($periodoEscolar){
                    $join->on('grupos.id','=','asignatura_grupo.grupo_id')
                        ->on('grupos.periodo_escolar_id','=',\DB::raw($periodoEscolar->id) );
                })
            ->join('sigeeva.asignaturas','asignaturas.id','=','asignatura_grupo.asignatura_id')
            ->join('sigeeva.personas','personas.id','=','asignatura_grupo.persona_id')
            ->where('asignatura_grupo_expediente.expediente_id','=',$expediente->id)
            ->get();

            $arregloAsignaturas = array();
            $contadorRegular    = 1;
            $contadorRepeticion = 1;
            foreach ($asignaturas AS $asignatura)
            {
                if ($contadorRegular == 1 && $contadorRepeticion == 1)
                {
                    $asignatura_grupo_expediente_uuid = $asignatura->asignatura_grupo_expediente_uuid;
                }

                if ($asignatura['es_adicional'] == 'N')
                {
                    $arregloAsignaturas['regular'][$contadorRegular]['claveGrupo']         = $asignatura['clave'];
                    $arregloAsignaturas['regular'][$contadorRegular]['profesor']           = $asignatura['nombre_completo'];
                    $arregloAsignaturas['regular'][$contadorRegular]['abreviacion']        = $asignatura['abreviacion'];
                    $arregloAsignaturas['regular'][$contadorRegular]['descripcion']        = $asignatura['descripcion'];
                    $arregloAsignaturas['regular'][$contadorRegular]['unidad1']            = $asignatura['unidad1'];
                    $arregloAsignaturas['regular'][$contadorRegular]['unidad2']            = $asignatura['unidad2'];
                    $arregloAsignaturas['regular'][$contadorRegular]['unidad3']            = $asignatura['unidad3'];
                    $arregloAsignaturas['regular'][$contadorRegular]['promedio']           = $asignatura['promedio'];
                    $arregloAsignaturas['regular'][$contadorRegular]['calificacion_final'] = $asignatura['calificacion_final'];
                    $arregloAsignaturas['regular'][$contadorRegular]['extraordinario1']    = $asignatura['extraordinario1'];
                    $arregloAsignaturas['regular'][$contadorRegular]['extraordinario2']    = $asignatura['extraordinario2'];
                    $arregloAsignaturas['regular'][$contadorRegular]['examen_especial']    = $asignatura['examen_especial'];
                    $contadorRegular++;
                }
                else if ($asignatura['es_adicional'] == 'S')
                {
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['claveGrupo']         = $asignatura['clave'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['profesor']           = $asignatura['nombre_completo'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['abreviacion']        = $asignatura['abreviacion'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['descripcion']        = $asignatura['descripcion'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['unidad1']            = $asignatura['unidad1'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['unidad2']            = $asignatura['unidad2'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['unidad3']            = $asignatura['unidad3'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['promedio']           = $asignatura['promedio'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['calificacion_final'] = $asignatura['calificacion_final'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['extraordinario1']    = $asignatura['extraordinario1'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['extraordinario2']    = $asignatura['extraordinario2'];
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['examen_especial']    = $asignatura['examen_especial'];
                    $contadorRepeticion++;
                }
            }

            return view('calificaciones.index',
                compact(
                    'periodoEscolar',
                    'persona',
                    'expediente',
                    'responsables',
                    'asignatura_grupo_expediente_uuid',
                    'arregloAsignaturas'
                )
            );
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
