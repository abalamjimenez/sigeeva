<?php

namespace App\Http\Controllers;
use App\Models\Expediente;
use App\Models\Persona;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Validator;

class KioskoController extends Controller
{
    public function historialAlumno(Request $request)
    {
        try
        {
            $registros   = null;
            $failedRules = null;

            if (!empty($_GET['nombre']))
            {
                $failedRules = null;

                $validator = Validator::make($request->all(),[
                    "nombre"             => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                ]);

                if ($validator->fails())
                {
                    $failedRules = $validator->failed();
                }
                else
                {
                    $alumnos = Persona::where('tipo_registro','=','ALUMNO');

                    if ($request->has('nombre') and !empty($request->get('nombre'))):
                        $alumnos->where('nombre_completo', 'LIKE', '%' . str_replace(' ','%',$request->get('nombre')) . '%');
                    endif;

                    $registros = $alumnos->orderBy('created_at','DESC')->paginate(100);
                }
            }

            return view('kiosko.alumno.historial',compact('registros','failedRules'));
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function detalleHistorialAlumno(Request $request,Persona $persona)
    {
        try
        {
            $expedientes = $this->historial_expedientes($request,$persona);

            $solicitudes = $this->historial_solicitudes($request,$persona);

            return view('kiosko.alumno.detalleHistorial', compact('persona','expedientes','solicitudes'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }


    public function historial_expedientes(Request $request,Persona $persona)
    {
        try
        {
            $qry = Expediente::query();

            return $expedientes = $qry->selectRaw("
            expedientes.id AS expediente_id,
            ANY_VALUE(asignatura_grupo_expediente.uuid) AS asignatura_grupo_expediente_uuid,
            periodos_escolares.descripcion AS descripcion_periodo_escolar,
            grupos.clave,
            carreras.descripcion AS descripcion_carrera,
            expedientes.grado_id AS semestre,
            turnos.descripcion AS descripcion_turno,
            expedientes.promedio,
            expedientes.tipo_inscripcion,
            expedientes.es_cedar,
            if (expedientes.vigente='S','Activo','Baja') AS estatus_expediente
            ")
                ->join('sigeeva.asignatura_grupo_expediente','asignatura_grupo_expediente.expediente_id','=','expedientes.id')
                ->join("sigeeva.periodos_escolares",'periodos_escolares.id','=','expedientes.periodo_escolar_id')
                ->leftJoin("sigeeva.grupos",'grupos.id','=','expedientes.grupo_id')
                ->join("sigeeva.carreras",'carreras.id','=','expedientes.carrera_id')
                ->join("sigeeva.turnos",'turnos.id','=','expedientes.turno_id')

                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas', function ($join) use ($persona){
                    $join->on('personas.id','=','alumnos.persona_id')
                        ->where('personas.uuid','=',$persona->uuid );
                })
                ->groupBy('expedientes.id')
                ->orderBy('expedientes.periodo_escolar_id','DESC')
                ->get();
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function historial_solicitudes(Request $request,Persona $persona)
    {
        try
        {
            $qry = Solicitud::query();

            return $solicitudes = $qry->selectRaw("
            solicitudes.id AS solicitud_id,
            periodos_escolares.descripcion AS descripcion_periodo_escolar,
            carreras.descripcion AS descripcion_carrera,
            solicitudes.grado_id AS semestre,
            turnos.descripcion AS descripcion_turno,
            grupos.clave AS clave_grupo,
            solicitudes.tipo_solicitud,
            estatus_solicitudes.descripcion AS descripcion_estatus
            ")
                ->join("estatus_solicitudes",'estatus_solicitudes.id','=','solicitudes.estatus_solicitud_id')
                ->join("sigeeva.periodos_escolares",'periodos_escolares.id','=','solicitudes.periodo_escolar_id')
                ->join("sigeeva.carreras",'carreras.id','=','solicitudes.carrera_id')
                ->join('sigeeva.turnos','turnos.id','=','solicitudes.turno_id')
                ->leftJoin('sigeeva.grupos','grupos.id','=','solicitudes.grupo_id')
                ->where('solicitudes.curp','=',$persona->curp)
                ->get();
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
