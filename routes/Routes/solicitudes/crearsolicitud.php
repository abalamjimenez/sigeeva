<?php

use App\Models\Carrera;
use App\Models\Expediente;
use App\Models\Solicitud;
use App\Models\SolicitudCt;
use App\Models\SolicitudTutor;
use Illuminate\Support\Facades\Auth;

Route::get('/crear', function () {

    $qry = Expediente::query();

    $select = "usuario.id AS usuario_id,expedientes.carrera_id, carrera.descripcion AS carrera_descripcion,";
    $select.= "expedientes.grado_id, expedientes.turno_id, turno.descripcion as turno_descripcion,";
    $select.= "persona.primer_apellido, persona.segundo_apellido, persona.nombre,";
    $select.= "persona.curp, persona.fecha_nacimiento, persona.sexo, persona.email, persona.telefono, ";
    $select.= "persona.nacionalidad_tipo, persona.nacionalidad_id, persona.nacionalidad_descripcion,";
    $select.= "expedientes.beca,persona.enfermedad,";
    $select.= "domicilio_alumno.domicilio_calle AS domicilio_alumno_calle,";
    $select.= "domicilio_alumno.domicilio_numero_exterior AS domicilio_alumno_numero_exterior,";
    $select.= "domicilio_alumno.domicilio_cruzamientos AS domicilio_alumno_cruzamientos,";
    $select.= "domicilio_alumno.domicilio_codigo_postal AS domicilio_alumno_codigo_postal,";
    $select.= "domicilio_alumno.domicilio_colonia AS domicilio_alumno_colonia,";

    $select.= "referencia.nombre as tutor_nombre, ";
    $select.= "referencia.primer_apellido AS tutor_primer_apellido,";
    $select.= "referencia.segundo_apellido AS tutor_segundo_apellido,";
    $select.= "referencia.curp AS tutor_curp, referencia.email AS tutor_email,";
    $select.= "referencia.telefono AS tutor_telefono,";
    $select.= "referencia.centro_trabajo AS tutor_centro_trabajo,";
    $select.= "referencia.ocupacion AS tutor_centro_trabajo_ocupacion,";

    $select.= "domicilio_tutor.domicilio_calle AS domicilio_tutor_calle, ";
    $select.= "domicilio_tutor.domicilio_numero_exterior AS domicilio_tutor_numero_exterior,";
    $select.= "domicilio_tutor.domicilio_colonia AS domicilio_tutor_colonia,";
    $select.= "domicilio_tutor.domicilio_codigo_postal AS domicilio_tutor_codigo_postal,";
    $select.= "domicilio_tutor.domicilio_localidad_id AS domicilio_tutor_localidad_id,";

    $select.= "domicilio_ct.domicilio_calle AS domicilio_ct_calle,";
    $select.= "domicilio_ct.domicilio_numero_exterior AS domicilio_ct_numero_exterior,";
    $select.= "domicilio_ct.domicilio_colonia AS domicilio_ct_colonia,";
    $select.= "domicilio_ct.domicilio_codigo_postal AS domicilio_ct_codigo_postal,";
    $select.= "domicilio_ct.domicilio_localidad_id AS domicilio_ct_localidad_id";

    $expedientes = $qry->selectRaw($select)
    ->join('sigeeva.alumnos AS alumno','alumno.id','=','expedientes.alumno_id')
    ->join('sigeeva.personas AS persona','persona.id','=','alumno.persona_id')
    ->join('sigeeva.users AS usuario', function ($join){
        $join->on('usuario.userable_id','=','persona.id')
            ->where('usuario.userable_type','LIKE','%Persona');
    })
    ->join('sigeeva.carreras AS carrera','carrera.id','=','expedientes.carrera_id')
    ->join('sigeeva.turnos AS turno','turno.id','=','expedientes.turno_id')
    ->leftJoin('sigeeva.domicilios AS domicilio_alumno',function ($join){
        $join->on('domicilio_alumno.domiciliable_id','=','persona.id')
            ->where('domicilio_alumno.domiciliable_type','LIKE','%Persona');
    })
    ->leftJoin('sigeeva.persona_referencia','persona_referencia.persona_id','=','persona.id')
    ->leftJoin('sigeeva.referencias AS referencia','referencia.id','=','persona_referencia.referencia_id')
    ->leftJoin('sigeeva.domicilios AS domicilio_tutor',function ($join){
        $join->on('domicilio_tutor.domiciliable_id','=','referencia.id')
            ->where('domicilio_tutor.domiciliable_type','LIKE','%Referencia')
            ->where('domicilio_tutor.domicilio_tipo','=','PERSONAL');
    })
    ->leftJoin('sigeeva.domicilios AS domicilio_ct',function ($join){
        $join->on('domicilio_ct.domiciliable_id','=','referencia.id')
            ->where('domicilio_ct.domiciliable_type','LIKE','%Referencia')
            ->where('domicilio_ct.domicilio_tipo','=','TRABAJO');
    })
    ->where('expedientes.periodo_escolar_id','=',3)
    ->where('expedientes.vigente','=','S')
    ->where('expedientes.grado_id','!=',6)
    ->get();

    foreach ($expedientes AS $expediente)
    {
        $semestreACursar = null;
        if ($expediente->grado_id == 1)
            $semestreACursar = 2;
        else if ($expediente->grado_id == 2)
            $semestreACursar = 3;
        else if ($expediente->grado_id == 3)
            $semestreACursar = 4;
        else if ($expediente->grado_id == 4)
            $semestreACursar = 5;
        else if ($expediente->grado_id == 5)
            $semestreACursar = 6;



        // GENERAR REFERENCIA BANCARIA
        $carrera = Carrera::where('id',$expediente->carrera_id)->first();

        $segmentoRaiz = strtoupper($expediente->curp);
        $segmentoRaiz.= $carrera->siglas;
        $segmentoRaiz.= $semestreACursar;
        $segmentoRaiz.= '437572';

        $arraySegmentoRaiz = str_split($segmentoRaiz);

        //17-13-11-23-19
        $bh1 = [17,13,11,23,19,17,13,11,23,19,17,13,11,23,19,17,13,11,23,19,17,13,11,23,19,17,13,11];

        $tablaDeValores = [
            0   => 0,
            1   => 1,
            2   => 2,
            3   => 3,
            4   => 4,
            5   => 5,
            6   => 6,
            7   => 7,
            8   => 8,
            9   => 9,
            'A' => 10,
            'B' => 11,
            'C' => 12,
            'D' => 13,
            'E' => 14,
            'F' => 15,
            'G' => 16,
            'H' => 17,
            'I' => 18,
            'J' => 19,
            'K' => 20,
            'L' => 21,
            'M' => 22,
            'N' => 23,
            'O' => 24,
            'P' => 25,
            'Q' => 26,
            'R' => 27,
            'S' => 28,
            'T' => 29,
            'U' => 30,
            'V' => 31,
            'W' => 32,
            'X' => 33,
            'Y' => 34,
            'Z' => 35
        ];

        $suma = 0;
        foreach($arraySegmentoRaiz AS $key=>$value)
        {
            $producto = $bh1[$key]*$tablaDeValores[$value];

            $suma = $suma + $producto;
        }

        $residuo = fmod($suma,97);

        $masUno = $residuo+1;

        $cj7 = str_pad($masUno,2,'0',STR_PAD_LEFT);

        $referenciaBancaria = $segmentoRaiz.$cj7;



        $arregloDatos = [
            'carrera_id'               => $expediente->carrera_id,
            'carrera_descripcion'      => $expediente->carrera_descripcion,
            'curp'                     => $expediente->curp,
            'grado_id'                 => $semestreACursar,
            'turno_id'                 => $expediente->turno_id,
            'turno_descripcion'        => $expediente->turno_descripcion,
            'primer_apellido'          => $expediente->primer_apellido,
            'segundo_apellido'         => $expediente->segundo_apellido,
            'nombre'                   => $expediente->nombre,
            'fecha_nacimiento'         => $expediente->fecha_nacimiento,
            'sexo'                     => $expediente->sexo,
            'email'                    => $expediente->email,
            'telefono'                 => $expediente->telefono,
            'nacionalidad_tipo'        => $expediente->nacionalidad_tipo,
            'nacionalidad_id'          => $expediente->nacionalidad_id,
            'nacionalidad_descripcion' => $expediente->nacionalidad_descripcion,
            'enfermedad'               => $expediente->enfermedad,

            'domicilio_calle'          => $expediente->domicilio_alumno_calle,
            'domicilio_numero'         => $expediente->domicilio_alumno_numero_exterior,
            'domicilio_cruzamientos'   => $expediente->domicilio_alumno_cruzamientos,
            'domicilio_codigo_postal'  => $expediente->domicilio_alumno_codigo_postal,
            'domicilio_colonia'        => $expediente->domicilio_alumno_colonia,

            'referencia_bancaria'      => $referenciaBancaria,
            'estatus_solicitud_id'     => 1,
            'tipo_solicitud'           => 'REINSCRIPCION'
        ];

        $solicitud = Solicitud::updateOrCreate([
            'user_id' => $expediente->usuario_id,
            'periodo_escolar_id' => 4
        ],$arregloDatos);

        $solicitudTutor = SolicitudTutor::where('solicitud_id', '=',$solicitud->id)->first();

        if ($solicitudTutor == null)
        {
            $solicitudTutor = new SolicitudTutor([
                'solicitud_id'            => $solicitud->id,
                'primer_apellido'         => $expediente->tutor_primer_apellido,
                'segundo_apellido'        => $expediente->tutor_segundo_apellido,
                'nombre'                  => $expediente->tutor_nombre,
                'curp'                    => $expediente->tutor_curp,
                'email'                   => $expediente->tutor_email,
                'telefono'                => $expediente->tutor_telefono,
                'domicilio_calle'         => $expediente->domicilio_tutor_calle,
                'domicilio_numero'        => $expediente->domicilio_tutor_numero,
                'domicilio_cruzamientos'  => $expediente->domicilio_tutor_cruzamientos,
                'domicilio_codigo_postal' => $expediente->domicilio_tutor_codigo_postal,
                'domicilio_colonia'       => $expediente->domicilio_tutor_colonia,
            ]);

            $solicitud->solicitudTutor()->save($solicitudTutor);
        }
        else
        {
            $solicitudTutor->update([
                'primer_apellido'         => $expediente->tutor_primer_apellido,
                'segundo_apellido'        => $expediente->tutor_segundo_apellido,
                'nombre'                  => $expediente->tutor_nombre,
                'curp'                    => $expediente->tutor_curp,
                'email'                   => $expediente->tutor_email,
                'telefono'                => $expediente->tutor_telefono,
                'domicilio_calle'         => $expediente->domicilio_tutor_calle,
                'domicilio_numero'        => $expediente->domicilio_tutor_numero,
                'domicilio_cruzamientos'  => $expediente->domicilio_tutor_cruzamientos,
                'domicilio_codigo_postal' => $expediente->domicilio_tutor_codigo_postal,
                'domicilio_colonia'       => $expediente->domicilio_tutor_colonia,
            ]);
        }

        $solicitudCt = SolicitudCt::where('solicitud_id', '=',$solicitud->id)->first();

        if ($solicitudCt == null)
        {
            $solicitudCt = new SolicitudCt([
                'solicitud_id'            => $solicitud->id,
                'ct'                      => $expediente->tutor_centro_trabajo,
                'ocupacion'               => $expediente->tutor_centro_trabajo_ocupacion,
                //'telefono'                => $expediente->ct_telefono,
                //'telefono_extension'      => $expediente->ct_telefono_extension,
                'domicilio_calle'         => $expediente->domicilio_ct_calle,
                'domicilio_numero'        => $expediente->domicilio_ct_numero_exterior,
                'domicilio_codigo_postal' => $expediente->domicilio_ct_codigo_postal,
                'domicilio_colonia'       => $expediente->domicilio_ct_colonia,
            ]);

            $solicitud->solicitudCt()->save($solicitudCt);
        }
        else
        {
            $solicitudCt->update([
                'ct'                      => $expediente->tutor_centro_trabajo,
                'ocupacion'               => $expediente->tutor_centro_trabajo_ocupacion,
                //'telefono'                => $expediente->ct_telefono,
                //'telefono_extension'      => $expediente->ct_telefono_extension,
                'domicilio_calle'         => $expediente->domicilio_ct_calle,
                'domicilio_numero'        => $expediente->domicilio_ct_numero_exterior,
                'domicilio_codigo_postal' => $expediente->domicilio_ct_codigo_postal,
                'domicilio_colonia'       => $expediente->domicilio_ct_colonia,
            ]);
        }
    }

});
