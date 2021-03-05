<?php

namespace App\Http\Controllers\Tools;

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

class ToolController extends Controller
{
    public function paseDeLista(Request $request)
    {
        try
        {
            $query = Expediente::query();

            $xValidar = $query->selectRaw("
                SUM(if (expedientes.grado_id=2,1,0)) AS cuentas_x_validar_2,
                SUM(if (expedientes.grado_id=4,1,0)) AS cuentas_x_validar_4,
                SUM(if (expedientes.grado_id=6,1,0)) AS cuentas_x_validar_6
            ")
            ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
            ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
            ->join('sigeeva.users','users.userable_id','=','personas.id')
            ->where('users.cuenta_validada','=','N')
            ->where('expedientes.es_cedar','=','N')
            ->where('expedientes.periodo_escolar_id','=','2')
            ->first();

            $query = Expediente::query();

            $totales = $query->selectRaw("
                grado_id,count(*) AS total
            ")
            ->where('expedientes.es_cedar','=','N')
            ->where('expedientes.periodo_escolar_id','=','2')
            ->groupBy('grado_id')
            ->get();

            $totalXGrado = [];
            foreach($totales AS $registro)
            {
                $totalXGrado[$registro->grado_id] = $registro->total;
            }




            $query = User::query();

            $gruposxvalidar = $query->selectRaw("
            grupos.id AS grupo_id,
            grupos.clave,
            SUM(if (users.cuenta_validada='S',1,0)) AS cuenta_validada,
            SUM(if (users.cuenta_validada='N',1,0)) AS cuenta_por_validar
            ")
            ->join('sigeeva.personas','personas.id','=','users.userable_id')
            ->join('sigeeva.alumnos','alumnos.persona_id','=','personas.id')
            ->join('sigeeva.expedientes','expedientes.alumno_id','=','alumnos.id')
            ->join('sigeeva.grupos','grupos.id','=','expedientes.grupo_id')
            ->where('users.userable_type','LIKE','%Persona')
            ->where('expedientes.periodo_escolar_id','=',2)
            ->where(\DB::Raw('length(expedientes.grupo_id)'),'>',0)
            ->groupBy('expedientes.grupo_id')
            ->orderBy('cuenta_por_validar','DESC')
            ->get();

            return view('tools.paseDeLista',
                compact(
                    'xValidar',
                    'gruposxvalidar',
                    'totalXGrado'
                )
            );

        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
