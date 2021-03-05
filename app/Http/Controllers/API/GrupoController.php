<?php

namespace App\Http\Controllers\api;

use App\Models\AsignaturaGrupoExpediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GrupoController extends Controller
{
    public function index(Request $request)
    {
        $query = AsignaturaGrupoExpediente::query();

        $expedientes = $query->selectRaw("
                asignatura_grupo_expediente.id,
                asignatura_grupo_expediente.uuid AS asignatura_grupo_expediente_uuid,
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
            ->where('asignatura_grupo_expediente.asignatura_grupo_id',$request->input('asignatura_grupo_id'))
            ->orderBy('asignatura_grupo_expediente.es_adicional','desc')
            ->orderBy('persona.nombre_completo')
            ->get();

        $contadorRegular=0;
        $contadorEspecial=0;
        $arregloExpedientes['regular'] = [];
        $arregloExpedientes['especial'] = [];
        foreach($expedientes AS $expediente)
        {
            if ($expediente['es_adicional'] == 'N')
            {
                $contadorRegular++;

                $arregloExpedientes['regular'][$contadorRegular]['url']                = route('alumnos.imprimirBoleta',$expediente['asignatura_grupo_expediente_uuid']);
                $arregloExpedientes['regular'][$contadorRegular]['persona_uuid']       = $expediente['uuid'];
                $arregloExpedientes['regular'][$contadorRegular]['nombre_completo']    = $expediente['nombre_completo'];
                $arregloExpedientes['regular'][$contadorRegular]['unidad1']            = $expediente['unidad1'];
                $arregloExpedientes['regular'][$contadorRegular]['unidad2']            = $expediente['unidad2'];
                $arregloExpedientes['regular'][$contadorRegular]['unidad3']            = $expediente['unidad3'];
                $arregloExpedientes['regular'][$contadorRegular]['promedio']           = $expediente['promedio'];
                $arregloExpedientes['regular'][$contadorRegular]['calificacion_final'] = $expediente['calificacion_final'];
                $arregloExpedientes['regular'][$contadorRegular]['extraordinario1']    = $expediente['extraordinario1'];
                $arregloExpedientes['regular'][$contadorRegular]['extraordinario2']    = $expediente['extraordinario2'];
                $arregloExpedientes['regular'][$contadorRegular]['examen_especial']    = $expediente['examen_especial'];
            }
            else if ($expediente['es_adicional'] == 'S')
            {
                $contadorEspecial++;
                $arregloExpedientes['especial'][$contadorEspecial]['url']                = route('alumnos.imprimirBoleta',$expediente['asignatura_grupo_expediente_uuid']);
                $arregloExpedientes['especial'][$contadorEspecial]['persona_uuid']       = $expediente['uuid'];
                $arregloExpedientes['especial'][$contadorEspecial]['nombre_completo']    = $expediente['nombre_completo'];
                $arregloExpedientes['especial'][$contadorEspecial]['unidad1']            = $expediente['unidad1'];
                $arregloExpedientes['especial'][$contadorEspecial]['unidad2']            = $expediente['unidad2'];
                $arregloExpedientes['especial'][$contadorEspecial]['unidad3']            = $expediente['unidad3'];
                $arregloExpedientes['especial'][$contadorEspecial]['promedio']           = $expediente['promedio'];
                $arregloExpedientes['especial'][$contadorEspecial]['calificacion_final'] = $expediente['calificacion_final'];
                $arregloExpedientes['especial'][$contadorEspecial]['extraordinario1']    = $expediente['extraordinario1'];
                $arregloExpedientes['especial'][$contadorEspecial]['extraordinario2']    = $expediente['extraordinario2'];
                $arregloExpedientes['especial'][$contadorEspecial]['examen_especial']    = $expediente['examen_especial'];
            }
        }

        return response()->json(compact('arregloExpedientes'));

    }
}
