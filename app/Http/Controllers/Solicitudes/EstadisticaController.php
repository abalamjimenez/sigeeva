<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Expediente;
use App\Models\Nacionalidad;
use App\Models\PeriodoEscolar;
use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\SolicitudTutor;
use App\Models\SolicitudCt;
use App\Models\TipoSangre;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SolicitudesExport;
use Mockery\Exception;
use Validator;

class EstadisticaController extends Controller
{
    public function solicitudes(Request $request)
    {
        try
        {
            $qry = Expediente::query();

            $solicitudesxgrupo = $qry->selectRaw("
            expedientes.grupo_id,
            grupos.clave AS claveGrupo,
            count(*) AS inscripcionEsperada,
            SUM(CASE WHEN solicitudes.estatus_solicitud_id = 1 THEN 1 ELSE 0 END) AS inscripcionPendiente,
            SUM(CASE WHEN solicitudes.estatus_solicitud_id = 3 THEN 1 ELSE 0 END) AS inscripcionEnviada,
            SUM(CASE WHEN solicitudes.estatus_solicitud_id = 7 THEN 1 ELSE 0 END) AS inscripcionAplicada,
            expedientes.turno_id
            ")
            ->join('sigeeva.grupos','grupos.id','expedientes.grupo_id')
            ->join('sigeeva.alumnos','alumnos.id','expedientes.alumno_id')
            ->join('sigeeva.personas','personas.id','alumnos.persona_id')
            ->join('sigeeva.solicitudes', function ($join){
                $join->on('solicitudes.curp','personas.curp')
                    ->where('solicitudes.periodo_escolar_id','=',4);
            })
            ->where('expedientes.periodo_escolar_id','=',3)
            ->where('expedientes.vigente','=','S')
            ->groupBy('expedientes.grupo_id')
            ->orderBy('expedientes.turno_id')
            ->orderBy('claveGrupo')
            ->get();

            return view('solicitudes.solicitudesxgrupo',
                compact(
                    'solicitudesxgrupo'
                )
            );

        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
