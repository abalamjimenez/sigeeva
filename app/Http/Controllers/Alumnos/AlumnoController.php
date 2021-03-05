<?php

namespace App\Http\Controllers\Alumnos;

use App\Exports\DescargarExpedientesExport;
use App\Exports\DescargarConcentradoDeCalificacionesExport;
use App\Http\Controllers\Controller;

use App\Models\AsignaturaGrupoExpediente;
use App\Models\Domicilio;
use App\Models\Expediente;
use App\Models\PeriodoEscolar;
use App\Models\Referencia;
use App\Models\Solicitud;
use Auth;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Localidad;
use App\Models\Entidad;
use App\Models\NecesidadEducativa;
use App\Models\Idioma;
use App\Models\EsExtranjero;
use App\Models\EsIndigena;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;
use Validator;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        try {

            // TODO: Obtener el periodo escolar activo

            $registradas = Persona::with(['paises','entidades','alumno.expediente']);

            $registradas->where('tipo_registro','ALUMNO');

            $registradas->whereHas('alumno.expediente',function ($q){
               return $q->where('periodo_escolar_id','=',3);
            });

            if ($request->has('curp') and !empty($request->get('curp'))):
                $registradas->where('curp', 'LIKE', '%' . $request->get('curp') . '%');
            endif;

            if ($request->has('nombre') and !empty($request->get('nombre'))):
                $registradas->where('nombre_completo', 'LIKE', '%' . str_replace(' ','%',$request->get('nombre')) . '%');
            endif;

            $registradas = $registradas->orderBy('created_at', 'DESC')->paginate(100);

            return view('alumnos.index', compact('registradas'));

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function create(Request $request)
    {
        try {
            $entidades              = Entidad::all()->pluck('fullName', 'id');
            $paises                 = Pais::all()->pluck('descripcion', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas                = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array    = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array      = EsIndigena::all()->pluck('descripcion','id');

            return view('alumnos.create', compact('paises', 'entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function store(Request $request)
    {
        try {

            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                "fecha_nacimiento" => [ 'required', 'date' ],
                "curp" => [ 'required', 'regex:/([A-Z|a-z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM|hm](AS|as|BC|bc|BS|bs|CC|cc|CL|cl|CM|cm|CS|cs|CH|ch|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne)[A-Z|a-z]{3})/' ],
                "nombre"             => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "primer_apellido"    => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "segundo_apellido"   => [ 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $usuario = Auth::user()->id;

            // GUARDAMOS LOS DATOS DE LA PERSONA

            $persona = Persona::firstOrNew([
                'curp' => $request->get('curp'),
                'nombre' => $request->get('nombre'),
                'primer_apellido' => $request->get('primer_apellido'),
                'fecha_nacimiento' => $request->get('fecha_nacimiento')
            ]);

            $persona->fill($request->except('_token', 'guardar'));
            $persona->nombre_completo = sprintf('%s %s %s', $request->get('nombre'), $request->get('primer_apellido'), $request->get('segundo_apellido'));
            $persona->tipo_registro = 'ALUMNO'; // 'ALUMNO','PERSONAL'

            if (isset($persona->id) and $persona->id):
                $persona->updated_by = $usuario;
            else:
                $persona->created_by = $usuario;
            endif;

            $persona->save();

            \DB::commit();

            if ($request->get('guardar') == 'true') {
                flash('Los datos se registraron satisfactoriamente')->success();

                return redirect()->to(route('alumnos.edit',$persona));
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function edit(Request $request,Persona $persona)
    {
        try
        {
            $paises                 = Pais::all()->pluck('descripcion', 'id');
            $entidades              = Entidad::all()->pluck('fullName', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas                = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array    = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array      = EsIndigena::all()->pluck('descripcion','id');

            $arreglo_referencias = [];
            if (!empty($persona->referencia))
            {
                $contador = 1;
                foreach ($persona->referencias as $referencia)
                {
                    $arreglo_referencias[$contador] = $referencia;
                    $contador++;
                }
            }

            return view('alumnos.edit' ,compact('persona','arreglo_referencias','paises','entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Request $request, Persona $persona)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                "fecha_nacimiento" => [ 'required', 'date' ],
                "curp" => [ 'required', 'regex:/([A-Z|a-z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM|hm](AS|as|BC|bc|BS|bs|CC|cc|CL|cl|CM|cm|CS|cs|CH|ch|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne)[A-Z|a-z]{3})/' ],
                "nombre"             => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "primer_apellido"    => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "segundo_apellido"   => [ 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$persona->update($request->input())) {
                flash('Los datos no se pudieron actualizar.')->warning();
                return redirect()->back();
            }

            flash('Los datos se actualizaron correctamente')->success();

            \DB::commit();

            return redirect()->back();
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    // = = = = = = = = = = = =
    //
    // E D I T A R   T U T O R
    //
    // = = = = = = = = = = = =

    public function editarTutor(Request $request,Persona $persona)
    {
        $referencia = new Referencia();
        if ($persona->referencias()->count() > 0)
            $referencia = $persona->referencias[0];

        $localidades = Localidad::othonpblanco()->get()->pluck('descripcion','id');

        $domicilios = Domicilio::where('domiciliable_type','App\models\Referencia')
            ->where('domiciliable_id',$referencia->id)
            ->get();

        foreach ($domicilios AS $domicilio)
        {
            if ($domicilio->domicilio_tipo == 'PERSONAL')
            {
                $referencia->domicilio_calle           = $domicilio->domicilio_calle;
                $referencia->domicilio_numero_exterior = $domicilio->domicilio_numero_exterior;
                $referencia->domicilio_colonia         = $domicilio->domicilio_colonia;
                $referencia->domicilio_codigo_postal   = $domicilio->domicilio_codigo_postal;
                $referencia->domicilio_localidad_id    = $domicilio->domicilio_localidad_id;
            }
            else if ($domicilio->domicilio_tipo == 'TRABAJO')
            {
                $referencia->domicilio_trabajo_calle           = $domicilio->domicilio_calle;
                $referencia->domicilio_trabajo_numero_exterior = $domicilio->domicilio_numero_exterior;
                $referencia->domicilio_trabajo_colonia         = $domicilio->domicilio_colonia;
                $referencia->domicilio_trabajo_codigo_postal   = $domicilio->domicilio_codigo_postal;
                $referencia->domicilio_trabajo_localidad_id    = $domicilio->domicilio_localidad_id;
            }
        }

        return view('alumnos.editartutor',compact('persona','referencia','localidades'));
    }

    public function storeTutor(Request $request,Persona $persona)
    {
        try {

            \DB::beginTransaction();

            if (empty($request->input('id')))
                $referencia = new Referencia;
            else
                $referencia = Referencia::find($request->input('id'));

            $referencia->uuid             = Uuid::uuid4()->toString();
            $referencia->nombre           = $request->input('nombre');
            $referencia->primer_apellido  = $request->input('primer_apellido');
            $referencia->segundo_apellido = $request->input('segundo_apellido');
            $referencia->curp             = $request->input('curp');
            $referencia->telefono         = $request->input('telefono');
            $referencia->email            = $request->input('email');
            $referencia->save();

            //Si esta vacio el id es que es la primera vez que se esta guardando
            //Entonces hay que agregarlo en la relacion de muchos a muchos
            if (empty($request->input('id')))
            {
                $persona->referencias()->attach($referencia->id);
            }

            $existe_domicilio_personal = Domicilio::where('domiciliable_type', 'App\models\Referencia')
                ->where('domiciliable_id', $referencia->id)
                ->where('domicilio_tipo','PERSONAL')
                ->first();

            if ($existe_domicilio_personal == NULL)
            {
                $domicilio_personal = new Domicilio([
                        'domicilio_tipo'            => 'PERSONAL',
                        'domicilio_calle'           => $request->input('domicilio_calle'),
                        'domicilio_numero_exterior' => $request->input('domicilio_numero_exterior'),
                        'domicilio_colonia'         => $request->input('domicilio_colonia'),
                        'domicilio_codigo_postal'   => $request->input('domicilio_codigo_postal'),
                        'domicilio_localidad_id'    => $request->input('domicilio_localidad_id')
                    ]
                );

                $referencia->domicilios()->save($domicilio_personal);
            }
            else
            {
                $existe_domicilio_personal->update([
                    'domicilio_calle'           => $request->input('domicilio_calle'),
                    'domicilio_numero_exterior' => $request->input('domicilio_numero_exterior'),
                    'domicilio_colonia'         => $request->input('domicilio_colonia'),
                    'domicilio_codigo_postal'   => $request->input('domicilio_codigo_postal'),
                    'domicilio_localidad_id'    => $request->input('domicilio_localidad_id')
                ]);
            }

            $existe_domicilio_trabajo = Domicilio::where('domiciliable_type', 'App\models\Referencia')
                ->where('domiciliable_id', $referencia->id)
                ->where('domicilio_tipo','TRABAJO')
                ->first();

            if ($existe_domicilio_trabajo ==  NULL)
            {
                $domicilio_trabajo = new Domicilio([
                        'domicilio_tipo'            => 'TRABAJO',
                        'domicilio_calle'           => $request->input('domicilio_trabajo_calle'),
                        'domicilio_numero_exterior' => $request->input('domicilio_trabajo_numero_exterior'),
                        'domicilio_colonia'         => $request->input('domicilio_trabajo_colonia'),
                        'domicilio_codigo_postal'   => $request->input('domicilio_trabajo_codigo_postal'),
                        'domicilio_localidad_id'    => $request->input('domicilio_trabajo_localidad_id')
                    ]
                );

                $referencia->domicilios()->save($domicilio_trabajo);
            }
            else
            {
                $existe_domicilio_trabajo->update([
                    'domicilio_calle'           => $request->input('domicilio_trabajo_calle'),
                    'domicilio_numero_exterior' => $request->input('domicilio_trabajo_numero_exterior'),
                    'domicilio_colonia'         => $request->input('domicilio_trabajo_colonia'),
                    'domicilio_codigo_postal'   => $request->input('domicilio_trabajo_codigo_postal'),
                    'domicilio_localidad_id'    => $request->input('domicilio_trabajo_localidad_id')
                ]);
            }


            \DB::commit();

            if ($request->get('guardar') == 'true')
            {
                flash('Los datos se registraron satisfactoriamente')->success();

                return redirect()->to(route('alumnos.editarTutor',$persona->uuid));
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function imprimirBoleta(AsignaturaGrupoExpediente $asignaturaGrupoExpediente, Request $request)
    {
        try
        {
            // O B T E N E R   L O S   D A T O S   P A R A   E L   A R R E G L O   G E N E R A L

            $asignaturaGrupoExpediente = AsignaturaGrupoExpediente::with('expediente')->where('uuid','=',$asignaturaGrupoExpediente->uuid)->first();
            $periodo_escolar_id        = $asignaturaGrupoExpediente->expediente->periodo_escolar_id;
            $expediente_id             = $asignaturaGrupoExpediente->expediente_id;

            $periodoEscolar = PeriodoEscolar::where('id','=',$periodo_escolar_id)->first();

            $qry = Expediente::query();
            $expediente = $qry->selectRaw("
            carreras.descripcion AS carrera_descripcion,
            expedientes.grado_id,
            personas.primer_apellido,
            personas.segundo_apellido,
            personas.nombre,
            turnos.descripcion AS turno_descripcion
            ")
            ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
            ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
            ->join('sigeeva.grupos','grupos.id','=','expedientes.grupo_id')
            ->join('sigeeva.carreras','carreras.id','=','grupos.carrera_id')
            ->join('sigeeva.turnos','turnos.id','=','grupos.turno_id')
            ->where('expedientes.id','=',$expediente_id)
            ->first();

            $arregloDatosGenerales = array();
            $arregloDatosGenerales['periodo_escolar_descripcion'] = $periodoEscolar->descripcion;
            $arregloDatosGenerales['primer_apellido']             = $expediente->primer_apellido;
            $arregloDatosGenerales['segundo_apellido']            = $expediente->segundo_apellido;
            $arregloDatosGenerales['nombre']                      = $expediente->nombre;
            $arregloDatosGenerales['semestre']                    = $expediente->grado_id;
            $arregloDatosGenerales['carrera_descripcion']         = $expediente->carrera_descripcion;
            $arregloDatosGenerales['turno_descripcion']           = strtoupper($expediente->turno_descripcion);

            // O B T E N E R   L A S   M A T E R I A S   D E L   A L U M N O
            // C O N   C A L I F I C A C I O N E S
            $asignaturasqry = AsignaturaGrupoExpediente::query();

            $asignaturas = $asignaturasqry->selectRaw("
            persona_docente.nombre_completo AS nombre_completo_docente,
            asignaturas.abreviacion, asignaturas.descripcion,
            asignatura_grupo_expediente.es_adicional,
            asignatura_grupo_expediente.unidad1,asignatura_grupo_expediente.unidad2,
            asignatura_grupo_expediente.unidad3,asignatura_grupo_expediente.promedio,
            asignatura_grupo_expediente.calificacion_final,
            asignatura_grupo_expediente.extraordinario1,
            asignatura_grupo_expediente.extraordinario2,
            asignatura_grupo_expediente.examen_especial
            ")
            ->join('sigeeva.asignatura_grupo','asignatura_grupo.id','=','asignatura_grupo_expediente.asignatura_grupo_id')
            ->join('sigeeva.asignaturas','asignaturas.id','=','asignatura_grupo.asignatura_id')
            ->join('sigeeva.personas AS persona_docente','persona_docente.id','=','asignatura_grupo.persona_id')
                ->join('sigeeva.grupos', function ($join) use ($periodoEscolar){
                    $join->on('grupos.id','=','asignatura_grupo.grupo_id')
                        ->on('grupos.periodo_escolar_id','=',\DB::raw($periodoEscolar->id) );
                })
            ->where('asignatura_grupo_expediente.expediente_id','=',$expediente_id)
            ->get();

            $arregloAsignaturas = array();
            $contadorRegular    = 1;
            $contadorRepeticion = 1;
            foreach ($asignaturas AS $asignatura)
            {
                if ($asignatura['es_adicional'] == 'N')
                {
                    $arregloAsignaturas['regular'][$contadorRegular]['profesor']           = $asignatura['nombre_completo_docente'];
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
                    $arregloAsignaturas['repeticion'][$contadorRepeticion]['profesor']           = $asignatura['nombre_completo_docente'];
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

            $pdf = PDF::loadView('pdf.alumnos.boleta',compact(
                'arregloDatosGenerales',
                'arregloAsignaturas'
            ));

            return $pdf->download('boleta.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function historial(Request $request,Persona $persona)
    {
        try
        {
            $expedientes = $this->historial_expedientes($request,$persona);

            $solicitudes = $this->historial_solicitudes($request,$persona);

            return view('alumnos.historial', compact('persona','expedientes','solicitudes'));
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
                ->join("sigeeva.periodos_escolares",'periodos_escolares.id','=','expedientes.periodo_escolar_id')
                ->leftJoin("sigeeva.grupos",'grupos.id','=','expedientes.grupo_id')
                ->join("sigeeva.carreras",'carreras.id','=','expedientes.carrera_id')
                ->join("sigeeva.turnos",'turnos.id','=','expedientes.turno_id')

                ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
                ->join('sigeeva.personas', function ($join) use ($persona){
                    $join->on('personas.id','=','alumnos.persona_id')
                        ->where('personas.uuid','=',$persona->uuid );
                })
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



    public function descargarExpedientes(Request $request)
    {
        try
        {
            $periodoEscolarId = PeriodoEscolar::where('vigente','=','S')->first()->id;

            $select = 'personas.id AS persona_id, carreras.descripcion AS descripcion_carrera,';
            $select.= 'turnos.descripcion AS descripcion_turno,';
            $select.= 'expedientes.grado_id AS semestre, expedientes.vigente,';
            $select.= 'grupos.clave AS clave_grupo,';
            $select.= 'users.username AS usuario_sigeeva,';
            $select.= 'personas.curp, personas.sexo,';
            $select.= 'personas.fecha_nacimiento, personas.telefono, ';
            $select.= 'personas.email AS correo_personal, ';
            $select.= 'users.email AS correo_institucional,';
            $select.= 'personas.primer_apellido, personas.segundo_apellido, personas.nombre,';
            $select.= 'personas.numero_seguridad_social,';

            $select.= "referencias.curp AS tutor_curp,";
            $select.= "referencias.primer_apellido AS tutor_primer_apellido,";
            $select.= "referencias.segundo_apellido AS tutor_segundo_apellido,";
            $select.= "referencias.nombre AS tutor_nombre,";
            $select.= "referencias.telefono AS tutor_telefono,";
            $select.= "referencias.email AS tutor_email,";
            $select.= "referencias.centro_trabajo AS tutor_centro_trabajo,";
            $select.= "referencias.ocupacion AS tutor_ocupacion,";


            $select.= "CONCAT_WS(' ',domicilio_personal.domicilio_calle,domicilio_personal.domicilio_cruzamientos) AS tutor_domicilio_calle,";
            $select.= "domicilio_personal.domicilio_numero_exterior AS tutor_domicilio_numero_exterior,";
            $select.= "domicilio_personal.domicilio_colonia AS tutor_domicilio_colonia,";
            $select.= "domicilio_personal.domicilio_codigo_postal AS tutor_domicilio_codigo_postal,";

            $select.= "CONCAT_WS(' ',domicilio_trabajo.domicilio_calle,domicilio_trabajo.domicilio_cruzamientos) AS ct_domicilio_calle,";
            $select.= "domicilio_trabajo.domicilio_numero_exterior AS ct_domicilio_numero_exterior,";
            $select.= "domicilio_trabajo.domicilio_colonia AS ct_domicilio_colonia,";
            $select.= "domicilio_trabajo.domicilio_codigo_postal AS ct_domicilio_codigo_postal";

            $qry = Expediente::query();

            $expedientes = $qry->selectRaw($select)
            ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
            ->join('sigeeva.turnos','turnos.id','=','expedientes.turno_id')
            ->join('sigeeva.grupos','grupos.id','=','expedientes.grupo_id')
            ->join('sigeeva.alumnos','alumnos.id','=','expedientes.alumno_id')
            ->join('sigeeva.personas','personas.id','=','alumnos.persona_id')
            ->join('sigeeva.users', function ($join) {
                    $join->on('users.userable_id','=','personas.id')
                        ->where('users.userable_type','LIKE','%Persona');
            })

            ->leftJoin('sigeeva.persona_referencia','persona_referencia.persona_id','=','personas.id')
            ->leftJoin('sigeeva.referencias','referencias.id','=','persona_referencia.referencia_id')
            ->leftJoin('sigeeva.domicilios AS domicilio_personal', function ($join) {
                $join->on('domicilio_personal.domiciliable_id','=','referencias.id')
                    ->where('domicilio_personal.domiciliable_type','LIKE','%Referencia')
                    ->where('domicilio_personal.domicilio_tipo','=','PERSONAL');
            })
            ->leftJoin('sigeeva.domicilios AS domicilio_trabajo', function ($join) {
                $join->on('domicilio_trabajo.domiciliable_id','=','referencias.id')
                    ->where('domicilio_trabajo.domiciliable_type','LIKE','%Referencia')
                    ->where('domicilio_trabajo.domicilio_tipo','=','TRABAJO');
            })
            ->where('expedientes.periodo_escolar_id','=',$periodoEscolarId)
            ->where('expedientes.es_cedar','=','N')
            ->get();

            return Excel::download(new DescargarExpedientesExport($expedientes), 'descargar_expedientes_'.date('Ymd').'_'.date('His').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarConcentradoDeCalificaciones(Request $request)
    {
        try
        {
            $periodoEscolarId = PeriodoEscolar::where('vigente','=','S')->first()->id;

            $select = "asignatura_grupo_expediente.expediente_id,";
            $select.= "personas.primer_apellido AS ap_paterno_alumno,personas.segundo_apellido AS ap_materno_alumno,personas.nombre AS nombre_alumno,";
            $select.= "expedientes.tipo_inscripcion,asignatura_grupo_expediente.es_adicional AS es_repeticion,";
            $select.= "carreras.descripcion AS descripcion_carrera,turnos.descripcion AS descripcion_turno,expedientes.grado_id AS semestre,";
            $select.= "grupos.clave,asignaturas.descripcion AS descripcion_asignatura,";
            $select.= "docentes.primer_apellido AS ap_paterno_docente,docentes.segundo_apellido AS ap_materno_docente,docentes.nombre AS nombre_docente,";
            $select.= "asignatura_grupo_expediente.unidad1,asignatura_grupo_expediente.unidad2,asignatura_grupo_expediente.unidad3,";
            $select.= "asignatura_grupo_expediente.promedio,asignatura_grupo_expediente.calificacion_final,";
            $select.= "asignatura_grupo_expediente.extraordinario1,asignatura_grupo_expediente.extraordinario2,asignatura_grupo_expediente.examen_especial";

            $qry = AsignaturaGrupoExpediente::query();

            $expedientes = $qry->selectRaw($select)
                ->join('sigeeva.asignatura_grupo','asignatura_grupo.id','=','asignatura_grupo_expediente.asignatura_grupo_id')
                ->join("sigeeva.asignaturas","asignaturas.id","=","asignatura_grupo.asignatura_id")
                ->join("sigeeva.personas AS docentes","docentes.id","=","asignatura_grupo.persona_id")

                ->join("sigeeva.expedientes","expedientes.id","=","asignatura_grupo_expediente.expediente_id")

                ->join('sigeeva.grupos','grupos.id','=','expedientes.grupo_id')
                ->join("sigeeva.carreras","carreras.id","=","grupos.carrera_id")
                ->join("sigeeva.turnos","turnos.id","=","grupos.turno_id")
                //->join("sigeeva.grupos","grupos.id","=","expedientes.grupo_id")

                ->join("sigeeva.alumnos","alumnos.id","=","expedientes.alumno_id")
                ->join("sigeeva.personas","personas.id","=","alumnos.persona_id")

                ->where('expedientes.periodo_escolar_id','=',$periodoEscolarId)
                ->where('expedientes.es_cedar','=','N')
                ->where('expedientes.vigente','=','S')
                ->get();

            return Excel::download(new DescargarConcentradoDeCalificacionesExport($expedientes), 'descargar_concentrado_de_calificaciones_'.date('Ymd').'_'.date('His').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
