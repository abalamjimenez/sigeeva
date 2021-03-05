<?php

namespace App\Http\Controllers\API;

use App\Models\AsignaturaGrupoExpediente;
use App\Http\Controllers\Controller;
use App\Models\Expediente;
use Illuminate\Http\Request;
use DB;

class HistorialController extends Controller
{
    public function expediente(Request $request)
    {
        $arregloExpedientes['generales'] = [];

        $qry = Expediente::query();

        $generales = $qry->selectRaw("
        expedientes.grupo_id,
        personaCE.nombre_completo AS nombreResponsableControlEscolar,
        personaTutor.nombre_completo AS nombreTutor
        ")
        ->join("sigeeva.grupo_control_escolar","grupo_control_escolar.grupo_id","=","expedientes.grupo_id")
        ->join("sigeeva.personas AS personaCE","personaCE.id","=","grupo_control_escolar.persona_id")
        ->join("sigeeva.grupo_tutor","grupo_tutor.grupo_id","=","expedientes.grupo_id")
        ->join("sigeeva.personas AS personaTutor","personaTutor.id","=","grupo_tutor.persona_id")
        ->where("expedientes.id",$request->input('expediente_id'))
        ->first();

        $nombreResponsableControlEscolar = 'No asignado';
        if (!empty($generales->nombreResponsableControlEscolar))
            $arregloExpedientes['generales']['nombreResponsableControlEscolar'] = $generales->nombreResponsableControlEscolar;

        $nombreTutor = 'No asignado';
        if (!empty($generales->nombreTutor))
            $arregloExpedientes['generales']['nombreTutor']                     = $generales->nombreTutor;


        $arregloExpedientes['generales']['nombreResponsableControlEscolar'] = $nombreResponsableControlEscolar;
        $arregloExpedientes['generales']['nombreTutor']                     = $nombreTutor;

        $query = AsignaturaGrupoExpediente::query();

        $expedientes = $query->selectRaw("
            asignaturas.abreviacion,
            asignaturas.descripcion,
            personas.primer_apellido,
            personas.segundo_apellido,
            personas.nombre,
            grupos.clave AS claveGrupo,
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
        ->join("asignatura_grupo","asignatura_grupo.id","=","asignatura_grupo_expediente.asignatura_grupo_id")
        ->join('grupos','grupos.id','=','asignatura_grupo.grupo_id')
        ->join("asignaturas","asignaturas.id","=","asignatura_grupo.asignatura_id")
        ->join("sigeeva.personas","personas.id","=","asignatura_grupo.persona_id")
        ->where("asignatura_grupo_expediente.expediente_id",$request->input('expediente_id'))
        ->get();

        $contadorRegular=0;
        $contadorEspecial=0;
        $arregloExpedientes['regular'] = [];
        $arregloExpedientes['especial'] = [];
        foreach ($expedientes AS $expediente)
        {
            if ($expediente['es_adicional'] == 'N')
            {
                $contadorRegular++;

                $arregloExpedientes['regular'][$contadorRegular]['abreviacion']        = $expediente['abreviacion'];
                $arregloExpedientes['regular'][$contadorRegular]['descripcion']        = $expediente['descripcion'];
                $arregloExpedientes['regular'][$contadorRegular]['primer_apellido']    = $expediente['primer_apellido'];
                $arregloExpedientes['regular'][$contadorRegular]['segundo_apellido']   = $expediente['segundo_apellido'];
                $arregloExpedientes['regular'][$contadorRegular]['nombre']             = $expediente['nombre'];
                $arregloExpedientes['regular'][$contadorRegular]['claveGrupo']         = $expediente['claveGrupo'];
                $arregloExpedientes['regular'][$contadorRegular]['es_adicional']       = $expediente['es_adicional'];
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

                $arregloExpedientes['especial'][$contadorEspecial]['abreviacion']        = $expediente['abreviacion'];
                $arregloExpedientes['especial'][$contadorEspecial]['descripcion']        = $expediente['descripcion'];
                $arregloExpedientes['especial'][$contadorEspecial]['primer_apellido']    = $expediente['primer_apellido'];
                $arregloExpedientes['especial'][$contadorEspecial]['segundo_apellido']   = $expediente['segundo_apellido'];
                $arregloExpedientes['especial'][$contadorEspecial]['nombre']             = $expediente['nombre'];
                $arregloExpedientes['especial'][$contadorEspecial]['claveGrupo']         = $expediente['claveGrupo'];
                $arregloExpedientes['especial'][$contadorEspecial]['es_adicional']       = $expediente['es_adicional'];
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
