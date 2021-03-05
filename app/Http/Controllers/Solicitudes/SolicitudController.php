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
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SolicitudesExport;
use Mockery\Exception;
use Validator;

class SolicitudController extends Controller
{

    public function reinscripcion(Request $request)
    {
        try
        {
            // TODO: Validar que el periodo escolar activo, sea diferente al periodo de las solicitudes



            $periodoEscolarSolicitudes = 4;
            $user_id                   = Auth::id();

            $tipo_sangre               = TipoSangre::all()->pluck('descripcion', 'id');
            $nacionalidades            = Nacionalidad::all()->pluck('descripcion', 'id')->where('id','<>',110);


            // BUSCAMOS UNA SOLICITUD QUE HAYA SIDO CREADA CON EL USUARIO LOGUEADO
            $solicitud = Solicitud::with('solicitudTutor','solicitudCt')->where('user_id','=',$user_id)->where('periodo_escolar_id','=',$periodoEscolarSolicitudes)->first();

            $imprime_solicitud = 'N';
            if ($solicitud == null)
            {
                return redirect()->route('home')->with(['msgGeneralError'=>"No tienes registrada una solicitud de reinscripción, manda un correo a sigeeva@evasamano.edu.mx con tu nombre completo e indica el problema que tienes"]);
            }
            else
            {
                $arregloSolicitud['carrera_descripcion']           = $solicitud->carrera_descripcion;
                $arregloSolicitud['turno_descripcion']             = $solicitud->turno_descripcion;
                $arregloSolicitud['grado_id']                      = $solicitud->grado_id;

                $arregloSolicitud['primer_apellido']               = $solicitud->primer_apellido;
                $arregloSolicitud['segundo_apellido']              = $solicitud->segundo_apellido;
                $arregloSolicitud['nombre']                        = $solicitud->nombre;
                $arregloSolicitud['curp']                          = $solicitud->curp;
                $arregloSolicitud['fecha_nacimiento']              = $solicitud->fecha_nacimiento;
                $arregloSolicitud['sexo']                          = $solicitud->sexo;
                $arregloSolicitud['email']                         = $solicitud->email;
                $arregloSolicitud['telefono']                      = $solicitud->telefono;
                $arregloSolicitud['tipo_sangre_id']                = $solicitud->tipo_sangre_id;
                $arregloSolicitud['nacionalidad_tipo']             = $solicitud->nacionalidad_tipo;
                $arregloSolicitud['nacionalidad_id']               = $solicitud->nacionalidad_id;

                $arregloSolicitud['beca']                          = $solicitud->beca;
                $arregloSolicitud['enfermedad']                    = $solicitud->enfermedad;
                $arregloSolicitud['servicio_medico']               = $solicitud->servicio_medico;
                $arregloSolicitud['numero_seguridad_social']       = $solicitud->numero_seguridad_social;

                $arregloSolicitud['domicilio_calle']               = $solicitud->domicilio_calle;
                $arregloSolicitud['domicilio_numero']              = $solicitud->domicilio_numero;
                $arregloSolicitud['domicilio_cruzamientos']        = $solicitud->domicilio_cruzamientos;
                $arregloSolicitud['domicilio_codigo_postal']       = $solicitud->domicilio_codigo_postal;
                $arregloSolicitud['domicilio_colonia']             = $solicitud->domicilio_colonia;

                if ($solicitud->estatus_solicitud_id == 3 || $solicitud->estatus_solicitud_id == 7)
                    $imprime_solicitud = 'S';

                $arregloSolicitud['tutor_primer_apellido']         = optional($solicitud->solicitudTutor)->primer_apellido;
                $arregloSolicitud['tutor_segundo_apellido']        = optional($solicitud->solicitudTutor)->segundo_apellido;
                $arregloSolicitud['tutor_nombre']                  = optional($solicitud->solicitudTutor)->nombre;
                $arregloSolicitud['tutor_curp']                    = optional($solicitud->solicitudTutor)->curp;
                $arregloSolicitud['tutor_email']                   = optional($solicitud->solicitudTutor)->email;
                $arregloSolicitud['tutor_telefono']                = optional($solicitud->solicitudTutor)->telefono;
                $arregloSolicitud['tutor_domicilio_calle']         = optional($solicitud->solicitudTutor)->domicilio_calle;
                $arregloSolicitud['tutor_domicilio_numero']        = optional($solicitud->solicitudTutor)->domicilio_numero;
                $arregloSolicitud['tutor_domicilio_cruzamientos']  = optional($solicitud->solicitudTutor)->domicilio_cruzamientos;
                $arregloSolicitud['tutor_domicilio_codigo_postal'] = optional($solicitud->solicitudTutor)->domicilio_codigo_postal;
                $arregloSolicitud['tutor_domicilio_colonia']       = optional($solicitud->solicitudTutor)->domicilio_colonia;


                $arregloSolicitud['ct']                            = optional($solicitud->solicitudCt)->ct;
                $arregloSolicitud['ocupacion']                     = optional($solicitud->solicitudCt)->ocupacion;
                $arregloSolicitud['ct_telefono']                   = optional($solicitud->solicitudCt)->telefono;
                $arregloSolicitud['ct_telefono_extension']         = optional($solicitud->solicitudCt)->telefono_extension;
                $arregloSolicitud['ct_domicilio_calle']            = optional($solicitud->solicitudCt)->domicilio_calle;
                $arregloSolicitud['ct_domicilio_numero']           = optional($solicitud->solicitudCt)->domicilio_numero;
                $arregloSolicitud['ct_domicilio_cruzamientos']     = optional($solicitud->solicitudCt)->domicilio_cruzamientos;
                $arregloSolicitud['ct_domicilio_codigo_postal']    = optional($solicitud->solicitudCt)->domicilio_codigo_postal;
                $arregloSolicitud['ct_domicilio_colonia']          = optional($solicitud->solicitudCt)->domicilio_colonia;
            }


            return view(
                'solicitudes.reinscripcion',
                compact(
                    'nacionalidades',
                    'tipo_sangre',
                    'imprime_solicitud',
                    'solicitud',
                    'arregloSolicitud'
                ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function storeReinscripcion(Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                'email'                                    => 'required',
                'telefono'                                 => 'required|numeric',
                'tipo_sangre_id'                           => 'required',
                'enfermedad'                               => 'required',
                'nacionalidad_tipo'                        => 'required',
                'domicilio_calle'                          => 'required',
                'domicilio_numero'                         => 'required',
                'domicilio_cruzamientos'                   => 'required',
                'domicilio_codigo_postal'                  => 'required|numeric|digits:5',
                'domicilio_colonia'                        => 'required',
                'tutor_primer_apellido'                    => 'required',
                'tutor_nombre'                             => 'required',
                'tutor_telefono'                           => 'required',
                'tutor_domicilio_calle'                    => 'required',
                'tutor_domicilio_numero'                   => 'required',
                'tutor_domicilio_cruzamientos'             => 'required',
                'tutor_domicilio_codigo_postal'            => 'required',
                'tutor_domicilio_colonia'                  => 'required',

                'ct'                                       => 'required',
                'ct_ocupacion'                             => 'required',
                'ct_telefono'                              => 'required',
                'ct_domicilio_calle'                       => 'required',
                'ct_domicilio_numero'                      => 'required',
                'ct_domicilio_cruzamientos'                => 'required',
                'ct_domicilio_codigo_postal'               => 'required',
                'ct_domicilio_colonia'                     => 'required',
            ],
            [
                'email.required'                           => 'El correo electrónico es requerido',
                'telefono.required'                        => 'El teléfono es requerido',
                'telefono.numeric'                         => 'El número de teléfono debe ser numérico',
                'tipo_sangre_id.required'                  => 'El tipo de sangre es requerido',
                'nacionalidad_tipo.required'               => 'El tipo de nacionalidad es requerido',
                'enfermedad.required'                 => 'Indique si padece o no alguna enfermedad',
                'domicilio_calle.required'                 => 'Indique la calle del solicitante',
                'domicilio_numero.required'                => 'Indique el número del domicilio del solicitante',
                'domicilio_cruzamientos.required'          => 'Indique los cruzamientos del domicilio del solicitante',
                'domicilio_codigo_postal.required'         => 'Indique el código postal del domicilio del solicitante',
                'domicilio_codigo_postal.numeric'          => 'El código postal del domicilio del solicitante debe ser un número',
                'domicilio_colonia.required'               => 'Indique la colonia del domicilio del solicitante',
                'tutor_primer_apellido.required'           => 'Es requerido especificar el primer apellido del padre o tutor',
                'tutor_nombre.required'                    => 'Es requerido especificar el nombre del padre o tutor',

                'tutor_domicilio_codigo_postal'            => 'numeric|digits:5',

                'ct.required'                              => 'Especifique su centro de trabajo o el lugar donde trabaja',
                'ct_ocupacion.required'                    => 'Especifique la ocupación laboral',
                'ct_telefono.required'                     => 'Especifique el teléfono del centro de trabajo',
                'ct_domicilio_calle.required'              => 'Especifique la calle del domicilio del centro de trabajo',
                'ct_domicilio_numero.required'             => 'Especifique el número exterior del domicilio del centro de trabajo',
                'ct_domicilio_cruzamientos.required'       => 'Especifique los cruzamientos del domicilio del centro de trabajo',
                'ct_domicilio_codigo_postal.required'      => 'Especifique el código postal del centro de trabajo',
                'ct_domicilio_colonia.required'            => 'Especifique la colonia y localidad del centro de trabajo'
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!empty( $request->get('tutor_domicilio_codigo_postal')) AND strlen($request->get('tutor_domicilio_codigo_postal')) > 5)
            {
                return back()
                    ->withErrors(['tutor_domicilio_codigo_postal' => ['El código postal del domicilio del tutor debe ser maximo de 5 caracteres']])
                    ->withInput();
            }

            if (!empty( $request->get('ct_domicilio_codigo_postal')) AND strlen($request->get('ct_domicilio_codigo_postal')) > 5)
            {
                return back()
                    ->withErrors(['tutor_domicilio_codigo_postal' => ['El código postal del domicilio de los datos laborales debe ser máximo de 5 caracteres']])
                    ->withInput();
            }

            // O B T E N E R   D A T O S

            $user_id    = Auth::id();

/*
            // O B T E N E R   E L   P E R I O D O   A C T I V O
            $periodoEscolar = PeriodoEscolar::where('vigente','=','S')->first();


            $persona    = Auth()->user()->userable;

            $query      = Persona::query();
            $expediente = $query->selectRaw("
            carreras.id AS carrera_id,
            carreras.descripcion AS carrera_descripcion,
            expedientes.grado_id, turnos.id AS turno_id,
            turnos.descripcion as turno_descripcion
            ")
            ->join('sigeeva.alumnos','alumnos.persona_id','=','personas.id')
            ->join('sigeeva.expedientes', function ($join) use ($periodoEscolar) {
                $join->on('expedientes.alumno_id','=','alumnos.id')
                    ->where('expedientes.vigente','=','S')
                    ->where('expedientes.periodo_escolar_id','=',$periodoEscolar->id);
            })
            ->join('sigeeva.carreras','carreras.id','=','expedientes.carrera_id')
            ->join('sigeeva.turnos','turnos.id','=','expedientes.turno_id')
            ->where('personas.id','=',$persona->id)
            ->first();

            $semestreACursar = null;
            if ($expediente->grado_id == 2)
                $semestreACursar = 3;
            else if ($expediente->grado_id == 4)
                $semestreACursar = 5;
*/

            $nacionalidad_id          = null;
            $nacionalidad_descripcion = null;
            if (!empty($request->get('nacionalidad_id')))
            {
                $nacionalidad = Nacionalidad::where('id','=',$request->get('nacionalidad_id'))->first();

                $nacionalidad_id          = $nacionalidad->id;
                $nacionalidad_descripcion = $nacionalidad->descripcion;
            }

            $solicitud = Solicitud::firstOrNew([
                'user_id'            => $user_id,
                'periodo_escolar_id' => 4
            ]);

            $solicitud->email                        = $request->get('email');
            $solicitud->telefono                     = $request->get('telefono');
            $solicitud->tipo_sangre_id               = $request->get('tipo_sangre_id');

            $solicitud->enfermedad                   = $request->get('enfermedad');


            $solicitud->nacionalidad_tipo            = $request->get('nacionalidad_tipo');
            $solicitud->nacionalidad_id              = $nacionalidad_id;
            $solicitud->nacionalidad_descripcion     = $nacionalidad_descripcion;


            $solicitud->domicilio_calle              = $request->get('domicilio_calle');
            $solicitud->domicilio_numero             = $request->get('domicilio_numero');
            $solicitud->domicilio_cruzamientos       = $request->get('domicilio_cruzamientos');
            $solicitud->domicilio_codigo_postal      = $request->get('domicilio_codigo_postal');
            $solicitud->domicilio_colonia            = $request->get('domicilio_colonia');
            $solicitud->tipo_solicitud               = 'REINSCRIPCION';

            if (!empty($request->get('guardar')) AND $request->get('guardar') == true)
                $solicitud->estatus_solicitud_id = 1; // Estatus pendiente
            else if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
                $solicitud->estatus_solicitud_id = 3; // Estatus finalizada
            $solicitud->save();

            $solicitudTutor = SolicitudTutor::where('solicitud_id', '=',$solicitud->id)->first();

            if ($solicitudTutor == null)
            {
                $solicitudTutor = new SolicitudTutor([
                   'solicitud_id'            => $solicitud->id,
                   'primer_apellido'         => $request->get('tutor_primer_apellido'),
                   'segundo_apellido'        => $request->get('tutor_segundo_apellido'),
                   'nombre'                  => $request->get('tutor_nombre'),
                   'curp'                    => $request->get('tutor_curp'),
                   'email'                   => $request->get('tutor_email'),
                   'telefono'                => $request->get('tutor_telefono'),
                   'domicilio_calle'         => $request->get('tutor_domicilio_calle'),
                   'domicilio_numero'        => $request->get('tutor_domicilio_numero'),
                   'domicilio_cruzamientos'  => $request->get('tutor_domicilio_cruzamientos'),
                   'domicilio_codigo_postal' => $request->get('tutor_domicilio_codigo_postal'),
                   'domicilio_colonia'       => $request->get('tutor_domicilio_colonia'),
                ]);

                $solicitud->solicitudTutor()->save($solicitudTutor);
            }
            else
            {
                $solicitudTutor->update([
                    'primer_apellido'         => $request->get('tutor_primer_apellido'),
                    'segundo_apellido'        => $request->get('tutor_segundo_apellido'),
                    'nombre'                  => $request->get('tutor_nombre'),
                    'curp'                    => $request->get('tutor_curp'),
                    'email'                   => $request->get('tutor_email'),
                    'telefono'                => $request->get('tutor_telefono'),
                    'domicilio_calle'         => $request->get('tutor_domicilio_calle'),
                    'domicilio_numero'        => $request->get('tutor_domicilio_numero'),
                    'domicilio_cruzamientos'  => $request->get('tutor_domicilio_cruzamientos'),
                    'domicilio_codigo_postal' => $request->get('tutor_domicilio_codigo_postal'),
                    'domicilio_colonia'       => $request->get('tutor_domicilio_colonia'),
                ]);
            }


            $solicitudCt = SolicitudCt::where('solicitud_id', '=',$solicitud->id)->first();

            if ($solicitudCt == null)
            {
                $solicitudCt = new SolicitudCt([
                    'solicitud_id'            => $solicitud->id,
                    'ct'                      => $request->get('ct'),
                    'ocupacion'               => $request->get('ct_ocupacion'),
                    'telefono'                => $request->get('ct_telefono'),
                    'telefono_extension'      => $request->get('ct_telefono_extension'),
                    'domicilio_calle'         => $request->get('ct_domicilio_calle'),
                    'domicilio_numero'        => $request->get('ct_domicilio_numero'),
                    'domicilio_cruzamientos'  => $request->get('ct_domicilio_cruzamientos'),
                    'domicilio_codigo_postal' => $request->get('ct_domicilio_codigo_postal'),
                    'domicilio_colonia'       => $request->get('ct_domicilio_colonia'),
                ]);

                $solicitud->solicitudCt()->save($solicitudCt);
            }
            else
            {
                $solicitudCt->update([
                    'ct'                      => $request->get('ct'),
                    'ocupacion'               => $request->get('ct_ocupacion'),
                    'telefono'                => $request->get('ct_telefono'),
                    'telefono_extension'      => $request->get('ct_telefono_extension'),
                    'domicilio_calle'         => $request->get('ct_domicilio_calle'),
                    'domicilio_numero'        => $request->get('ct_domicilio_numero'),
                    'domicilio_cruzamientos'  => $request->get('ct_domicilio_cruzamientos'),
                    'domicilio_codigo_postal' => $request->get('ct_domicilio_codigo_postal'),
                    'domicilio_colonia'       => $request->get('ct_domicilio_colonia'),
                ]);
            }

            \DB::commit();

            $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente.';
            if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
                $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente, ya está habilitado el botón para descargar la solicitud en la parte inferior de la pantalla';

            return redirect()->back()->with(['msgExito'=>$mensajeExito]);

        } catch (\Exception $e) {
            \DB::rollback();
            throw new Exception($e->getMessage());
        }
    }

    public function imprimir(Request $request,Solicitud $solicitud)
    {
        try
        {
            //TODO: Obtener el periodo escolar correspondiente al proceso de solicitudes de forma automatica

            $periodoEscolar = PeriodoEscolar::where('id','=',4)->first();

            $formato = 'solicitudInscripcion';
            if ($solicitud->tipo_solicitud == 'REINSCRIPCION')
            {
                $formato = 'solicitudReinscripcion';
            }

            $pdf = PDF::loadView('pdf.solicitudes.'.$formato,
                compact(
                'solicitud',
                    'periodoEscolar'
                )
            );

            return $pdf->download($formato.'.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }


    public function editar(Request $request,Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::with('solicitudTutor','solicitudCt')->where('id','=',$solicitud->id)->first();

            $carreras = Carrera::all()->pluck('descripcion', 'id');

            //Obtenemos todas las nacionalidades que sean diferente a mexicana
            $nacionalidades = Nacionalidad::all()->pluck('descripcion', 'id')->where('id','<>',110);

            $tipo_sangre = TipoSangre::all()->pluck('descripcion', 'id');

            return view('solicitudes.editar',
                compact(
                    'solicitud',
                    'tipo_sangre',
                    'nacionalidades',
                    'carreras'
                ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[

                'carrera_id'                   => 'required',
                'grado_id'                     => 'required',
                'turno_id'                     => 'required',
                'materias_reprobadas'          => 'required',
                'materias_reprobadas_cantidad' => 'required_if:materias_reprobadas,S|nullable|numeric',
                'primer_apellido'              => 'required',
                'nombre'                       => 'required',
                'curp'                         => 'required',
                'fecha_nacimiento'             => 'required',
                'sexo'                         => 'required',
                'email'                        => 'required',
                'telefono'                     => 'required|numeric',
                'tipo_sangre_id'               => 'required',
                'nacionalidad_tipo'            => 'required',
                'servicio_medico'              => 'required',
                'numero_seguridad_social'      => 'required',
                'domicilio_calle'              => 'required',
                'domicilio_numero'             => 'required',
                'domicilio_cruzamientos'       => 'required',
                'domicilio_codigo_postal'      => 'required|numeric|digits:5',
                'domicilio_colonia'            => 'required',
                'tutor_primer_apellido'        => 'required',
                'tutor_nombre'                 => 'required',
            ],
            [
                'carrera_id.required'                      => 'Especifique la carrera a cursar',
                'grado_id.required'                        => 'Especifique el semestre a cursar',
                'turno_id.required'                        => 'Especifique el turno a cursar',
                'materias_reprobadas.required'             => 'Es requerido especificar si adeudas una materia',
                'materias_reprobadas_cantidad.numeric'     => 'El número de materias reprobadas debe ser un número',
                'materias_reprobadas_cantidad.required_if' => 'Debe especificar el número de materias reprobadas',
                'primer_apellido.required'                 => 'El primer apellido del solicitante es requerido',
                'nombre.required'                          => 'El nombre del solicitante es requerido',
                'curp.required'                            => 'La CURP del solicitante es requerida',
                'fecha_nacimiento.required'                => 'La fecha de nacimiento del solicitante es requerido',
                'sexo.required'                            => 'El sexo del solicitante es requerido',
                'email.required'                           => 'El correo electrónico es requerido',
                'telefono.required'                        => 'El teléfono es requerido',
                'telefono.numeric'                         => 'El número de teléfono debe ser numérico',
                'tipo_sangre_id.required'                  => 'El tipo de sangre es requerido',
                'nacionalidad_tipo.required'               => 'El tipo de nacionalidad es requerido',
                'servicio_medico.required'                 => 'Indique en que dependencia cuenta con servicio médico',
                'numero_seguridad_social.required'         => 'Indique el número de seguridad social',
                'domicilio_calle.required'                 => 'Indique la calle del solicitante',
                'domicilio_numero.required'                => 'Indique el número del domicilio del solicitante',
                'domicilio_cruzamientos.required'          => 'Indique los cruzamientos del domicilio del solicitante',
                'domicilio_codigo_postal.required'         => 'Indique el código postal del domicilio del solicitante',
                'domicilio_codigo_postal.numeric'          => 'El código postal del domicilio del solicitante debe ser un número',
                'domicilio_colonia.required'               => 'Indique la colonia del domicilio del solicitante',
                'tutor_primer_apellido.required'           => 'Es requerido especificar el primer apellido del padre o tutor',
                'tutor_nombre.required'                    => 'Es requerido especificar el nombre del padre o tutor',

            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $nacionalidad_id          = null;
            $nacionalidad_descripcion = null;
            if (!empty($request->get('nacionalidad_id')))
            {
                $nacionalidad = Nacionalidad::where('id','=',$request->get('nacionalidad_id'))->first();

                $nacionalidad_id          = $nacionalidad->id;
                $nacionalidad_descripcion = $nacionalidad->descripcion;
            }

            $solicitud->carrera_id                   = $request->get('carrera_id');
            $solicitud->grado_id                     = $request->get('grado_id');
            $solicitud->turno_id                     = $request->get('turno_id');
            $solicitud->materias_reprobadas          = $request->get('materias_reprobadas');
            $solicitud->materias_reprobadas_cantidad = $request->get('materias_reprobadas_cantidad');

            $solicitud->primer_apellido              = $request->get('primer_apellido');
            $solicitud->segundo_apellido             = $request->get('segundo_apellido');
            $solicitud->nombre                       = $request->get('nombre');
            $solicitud->curp                         = $request->get('curp');
            $solicitud->fecha_nacimiento             = $request->get('fecha_nacimiento');
            $solicitud->sexo                         = $request->get('sexo');
            $solicitud->email                        = $request->get('email');
            $solicitud->telefono                     = $request->get('telefono');
            $solicitud->tipo_sangre_id               = $request->get('tipo_sangre_id');
            $solicitud->enfermedad                   = $request->get('enfermedad');
            $solicitud->servicio_medico              = $request->get('servicio_medico');
            $solicitud->numero_seguridad_social      = $request->get('numero_seguridad_social');
            $solicitud->nacionalidad_tipo            = $request->get('nacionalidad_tipo');
            $solicitud->nacionalidad_id              = $nacionalidad_id;
            $solicitud->nacionalidad_descripcion     = $nacionalidad_descripcion;
            $solicitud->beca                         = $request->get('beca');
            $solicitud->domicilio_calle              = $request->get('domicilio_calle');
            $solicitud->domicilio_numero             = $request->get('domicilio_numero');
            $solicitud->domicilio_cruzamientos       = $request->get('domicilio_cruzamientos');
            $solicitud->domicilio_cruzamientos       = $request->get('domicilio_cruzamientos');
            $solicitud->domicilio_codigo_postal      = $request->get('domicilio_codigo_postal');
            $solicitud->domicilio_colonia            = $request->get('domicilio_colonia');
            $solicitud->save();

            $solicitudTutor = SolicitudTutor::firstOrNew([
                'solicitud_id' => $solicitud->id
            ]);

            $solicitudTutor->primer_apellido         = $request->get('tutor_primer_apellido');
            $solicitudTutor->segundo_apellido        = $request->get('tutor_segundo_apellido');
            $solicitudTutor->nombre                  = $request->get('tutor_nombre');
            $solicitudTutor->curp                    = $request->get('tutor_curp');
            $solicitudTutor->email                   = $request->get('tutor_email');
            $solicitudTutor->telefono                = $request->get('tutor_telefono');
            $solicitudTutor->domicilio_calle         = $request->get('tutor_domicilio_calle');
            $solicitudTutor->domicilio_numero        = $request->get('tutor_domicilio_numero');
            $solicitudTutor->domicilio_cruzamientos  = $request->get('tutor_domicilio_cruzamientos');
            $solicitudTutor->domicilio_codigo_postal = $request->get('tutor_domicilio_codigo_postal');
            $solicitudTutor->domicilio_colonia       = $request->get('tutor_domicilio_colonia');
            $solicitudTutor->save();

            $solicitudCt = SolicitudCt::firstOrNew([
                'solicitud_id' => $solicitud->id
            ]);
            $solicitudCt->ct                         = $request->get('ct');
            $solicitudCt->ocupacion                  = $request->get('ct_ocupacion');
            $solicitudCt->telefono                   = $request->get('ct_telefono');
            $solicitudCt->telefono_extension         = $request->get('ct_telefono_extension');
            $solicitudCt->domicilio_calle            = $request->get('ct_domicilio_calle');
            $solicitudCt->domicilio_numero           = $request->get('ct_domicilio_numero');
            $solicitudCt->domicilio_cruzamientos     = $request->get('ct_domicilio_cruzamientos');
            $solicitudCt->domicilio_codigo_postal    = $request->get('ct_domicilio_codigo_postal');
            $solicitudCt->domicilio_colonia          = $request->get('ct_domicilio_colonia');
            $solicitudCt->save();

            \DB::commit();

            $msgExito = 'Los cambios fueron almacenados satisfactoriamente.';

            return redirect()->to(route('solicitudes.editar',$solicitud->uuid))->with(['msgExito'=>$msgExito]);
        }
        catch (\Exception $e) {
            \DB::rollback();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarSolicitudes(Request $request)
    {
        try
        {
            $select = "solicitudes.tipo_solicitud,";
            $select.= "estatus_solicitudes.descripcion AS estatus_solicitud_descripcion,";
            $select.= "solicitudes.carrera_descripcion,solicitudes.grado_id,solicitudes.turno_descripcion,";
            $select.= "solicitudes.materias_reprobadas, solicitudes.materias_reprobadas_cantidad,";
            $select.= "solicitudes.primer_apellido,solicitudes.segundo_apellido,solicitudes.nombre,";
            $select.= "solicitudes.curp,solicitudes.fecha_nacimiento,solicitudes.sexo,";
            $select.= "solicitudes.email,solicitudes.telefono,tipo_sangre.descripcion AS tipo_sangre_descripcion,";
            $select.= "solicitudes.enfermedad,solicitudes.servicio_medico,solicitudes.numero_seguridad_social,";
            $select.= "solicitudes.nacionalidad_tipo,nacionalidades.descripcion AS nacionalidad_descripcion,solicitudes.beca,";
            $select.= "solicitudes.domicilio_calle, solicitudes.domicilio_numero,";
            $select.= "solicitudes.domicilio_cruzamientos, solicitudes.domicilio_codigo_postal,solicitudes.domicilio_colonia,";

            $select.= "solicitud_tutor.primer_apellido AS tutor_primer_apellido,";
            $select.= "solicitud_tutor.segundo_apellido AS tutor_segundo_apellido,";
            $select.= "solicitud_tutor.nombre AS tutor_nombre,";
            $select.= "solicitud_tutor.curp AS tutor_curp,";
            $select.= "solicitud_tutor.email AS tutor_email,";
            $select.= "solicitud_tutor.telefono AS tutor_telefono,";

            $select.= "solicitud_tutor.domicilio_calle AS tutor_domicilio_calle,";
            $select.= "solicitud_tutor.domicilio_numero AS tutor_domicilio_numero,";
            $select.= "solicitud_tutor.domicilio_cruzamientos AS tutor_domicilio_cruzamientos,";
            $select.= "solicitud_tutor.domicilio_codigo_postal AS tutor_domicilio_codigo_postal,";
            $select.= "solicitud_tutor.domicilio_colonia AS tutor_domicilio_colonia,";

            $select.= "solicitud_ct.ct,solicitud_ct.ocupacion AS ct_ocupacion,solicitud_ct.telefono AS ct_telefono,";
            $select.= "solicitud_ct.telefono_extension AS ct_telefono_extension,";

            $select.= "solicitud_ct.domicilio_calle AS ct_domicilio_calle,";
            $select.= "solicitud_ct.domicilio_numero AS ct_domicilio_numero,";
            $select.= "solicitud_ct.domicilio_cruzamientos AS ct_domicilio_cruzamientos,";
            $select.= "solicitud_ct.domicilio_codigo_postal AS ct_domicilio_codigo_postal,";
            $select.= "solicitud_ct.domicilio_colonia AS ct_domicilio_colonia";

            if ($request->input('qry') == 'REINSCRIPCION')
            {
                $select.= ",grupos.clave AS claveGrupo";
            }

            if ($request->input('qry') == 'TOTALES')
            {
                $qry = Solicitud::query();

                $solicitudes = $qry->selectRaw($select)
                    ->join('sigeeva.estatus_solicitudes','estatus_solicitudes.id','=','solicitudes.estatus_solicitud_id')
                    ->leftjoin('sigeeva.tipo_sangre','tipo_sangre.id','=','solicitudes.tipo_sangre_id')
                    ->leftjoin('sigeeva.nacionalidades','nacionalidades.id','=','solicitudes.nacionalidad_id')
                    ->leftjoin('sigeeva.solicitud_tutor','solicitud_tutor.solicitud_id','=','solicitudes.id')
                    ->leftjoin('sigeeva.solicitud_ct','solicitud_ct.solicitud_id','=','solicitudes.id')
                    ->where('solicitudes.periodo_escolar_id','=',4);

                $registros = $solicitudes->get();
            }
            else if ($request->input('qry') == 'REINSCRIPCION')
            {
                $qry = Expediente::query();

                $solicitudes = $qry->selectRaw($select)
                    ->join('sigeeva.grupos','grupos.id','expedientes.grupo_id')
                    ->join('sigeeva.alumnos','alumnos.id','expedientes.alumno_id')
                    ->join('sigeeva.personas','personas.id','alumnos.persona_id')
                    ->join('sigeeva.solicitudes', function ($join){
                        $join->on('solicitudes.curp','personas.curp')
                            ->where('solicitudes.periodo_escolar_id','=',4);
                    })
                    ->join('sigeeva.estatus_solicitudes','estatus_solicitudes.id','=','solicitudes.estatus_solicitud_id')
                    ->leftjoin('sigeeva.tipo_sangre','tipo_sangre.id','=','solicitudes.tipo_sangre_id')
                    ->leftjoin('sigeeva.nacionalidades','nacionalidades.id','=','solicitudes.nacionalidad_id')
                    ->leftjoin('sigeeva.solicitud_tutor','solicitud_tutor.solicitud_id','=','solicitudes.id')
                    ->leftjoin('sigeeva.solicitud_ct','solicitud_ct.solicitud_id','=','solicitudes.id')
                    ->where('expedientes.periodo_escolar_id','=',3)
                    ->where('expedientes.vigente','=','S')
                    ->where('solicitudes.tipo_solicitud','=','REINSCRIPCION');

                if (!empty($request->input('grupo_id')))
                {
                    $solicitudes->where('expedientes.grupo_id','=',$request->input('grupo_id'))
                    ->where('solicitudes.estatus_solicitud_id','=',1);

                }

                $registros = $solicitudes->get();
            }

            return Excel::download(new SolicitudesExport($registros,array('tipo_reporte'=>'REINSCRIPCION')), 'solicitudes_'.date('YmdHis').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarSolicitudesPendientes(Request $request)
    {
        try
        {
            $qry = Solicitud::query();

            $solicitudes = $qry->selectRaw("
            estatus_solicitudes.descripcion AS estatus_solicitud_descripcion,
            solicitudes.carrera_descripcion,solicitudes.grado_id,solicitudes.turno_descripcion,
            solicitudes.materias_reprobadas, solicitudes.materias_reprobadas_cantidad,

            solicitudes.primer_apellido,solicitudes.segundo_apellido,solicitudes.nombre,
            solicitudes.curp,solicitudes.fecha_nacimiento,solicitudes.sexo,
            solicitudes.email,solicitudes.telefono,tipo_sangre.descripcion AS tipo_sangre_descripcion,
            solicitudes.enfermedad,solicitudes.servicio_medico,solicitudes.numero_seguridad_social,
            solicitudes.nacionalidad_tipo,nacionalidades.descripcion AS nacionalidad_descripcion,solicitudes.beca,

            solicitudes.domicilio_calle, solicitudes.domicilio_numero,
            solicitudes.domicilio_cruzamientos, solicitudes.domicilio_codigo_postal,
            solicitudes.domicilio_colonia,

            solicitud_tutor.primer_apellido AS tutor_primer_apellido,
            solicitud_tutor.segundo_apellido AS tutor_segundo_apellido,
            solicitud_tutor.nombre AS tutor_nombre,
            solicitud_tutor.curp AS tutor_curp,
            solicitud_tutor.email AS tutor_email,
            solicitud_tutor.telefono AS tutor_telefono,

            solicitud_tutor.domicilio_calle AS tutor_domicilio_calle,
            solicitud_tutor.domicilio_numero AS tutor_domicilio_numero,
            solicitud_tutor.domicilio_cruzamientos AS tutor_domicilio_cruzamientos,
            solicitud_tutor.domicilio_codigo_postal AS tutor_domicilio_codigo_postal,
            solicitud_tutor.domicilio_colonia AS tutor_domicilio_colonia,

            solicitud_ct.ct,
            solicitud_ct.ocupacion AS ct_ocupacion,
            solicitud_ct.telefono AS ct_telefono,
            solicitud_ct.telefono_extension AS ct_telefono_extension,

            solicitud_ct.domicilio_calle AS ct_domicilio_calle,
            solicitud_ct.domicilio_numero AS ct_domicilio_numero,
            solicitud_ct.domicilio_cruzamientos AS ct_domicilio_cruzamientos,
            solicitud_ct.domicilio_codigo_postal AS ct_domicilio_codigo_postal,
            solicitud_ct.domicilio_colonia AS ct_domicilio_colonia
            ")
                ->join('sigeeva.estatus_solicitudes','estatus_solicitudes.id','=','solicitudes.estatus_solicitud_id')
                ->leftjoin('sigeeva.tipo_sangre','tipo_sangre.id','=','solicitudes.tipo_sangre_id')
                ->leftjoin('sigeeva.nacionalidades','nacionalidades.id','=','solicitudes.nacionalidad_id')
                ->leftjoin('sigeeva.solicitud_tutor','solicitud_tutor.solicitud_id','=','solicitudes.id')
                ->leftjoin('sigeeva.solicitud_ct','solicitud_ct.solicitud_id','=','solicitudes.id')
                ->where('solicitudes.estatus_solicitud_id','1')
                ->get();

            return Excel::download(new SolicitudesExport($solicitudes), 'solicitudes_'.date('YmdHis').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarSolicitudesEnviadas(Request $request)
    {
        try
        {
            $qry = Solicitud::query();

            $solicitudes = $qry->selectRaw("
            estatus_solicitudes.descripcion AS estatus_solicitud_descripcion,
            solicitudes.carrera_descripcion,solicitudes.grado_id,solicitudes.turno_descripcion,
            solicitudes.materias_reprobadas, solicitudes.materias_reprobadas_cantidad,

            solicitudes.primer_apellido,solicitudes.segundo_apellido,solicitudes.nombre,
            solicitudes.curp,solicitudes.fecha_nacimiento,solicitudes.sexo,
            solicitudes.email,solicitudes.telefono,tipo_sangre.descripcion AS tipo_sangre_descripcion,
            solicitudes.enfermedad,solicitudes.servicio_medico,solicitudes.numero_seguridad_social,
            solicitudes.nacionalidad_tipo,nacionalidades.descripcion AS nacionalidad_descripcion,solicitudes.beca,

            solicitudes.domicilio_calle, solicitudes.domicilio_numero,
            solicitudes.domicilio_cruzamientos, solicitudes.domicilio_codigo_postal,
            solicitudes.domicilio_colonia,

            solicitud_tutor.primer_apellido AS tutor_primer_apellido,
            solicitud_tutor.segundo_apellido AS tutor_segundo_apellido,
            solicitud_tutor.nombre AS tutor_nombre,
            solicitud_tutor.curp AS tutor_curp,
            solicitud_tutor.email AS tutor_email,
            solicitud_tutor.telefono AS tutor_telefono,

            solicitud_tutor.domicilio_calle AS tutor_domicilio_calle,
            solicitud_tutor.domicilio_numero AS tutor_domicilio_numero,
            solicitud_tutor.domicilio_cruzamientos AS tutor_domicilio_cruzamientos,
            solicitud_tutor.domicilio_codigo_postal AS tutor_domicilio_codigo_postal,
            solicitud_tutor.domicilio_colonia AS tutor_domicilio_colonia,

            solicitud_ct.ct,
            solicitud_ct.ocupacion AS ct_ocupacion,
            solicitud_ct.telefono AS ct_telefono,
            solicitud_ct.telefono_extension AS ct_telefono_extension,

            solicitud_ct.domicilio_calle AS ct_domicilio_calle,
            solicitud_ct.domicilio_numero AS ct_domicilio_numero,
            solicitud_ct.domicilio_cruzamientos AS ct_domicilio_cruzamientos,
            solicitud_ct.domicilio_codigo_postal AS ct_domicilio_codigo_postal,
            solicitud_ct.domicilio_colonia AS ct_domicilio_colonia
            ")
                ->join('sigeeva.estatus_solicitudes','estatus_solicitudes.id','=','solicitudes.estatus_solicitud_id')
                ->leftjoin('sigeeva.tipo_sangre','tipo_sangre.id','=','solicitudes.tipo_sangre_id')
                ->leftjoin('sigeeva.nacionalidades','nacionalidades.id','=','solicitudes.nacionalidad_id')
                ->leftjoin('sigeeva.solicitud_tutor','solicitud_tutor.solicitud_id','=','solicitudes.id')
                ->leftjoin('sigeeva.solicitud_ct','solicitud_ct.solicitud_id','=','solicitudes.id')
                ->where('solicitudes.estatus_solicitud_id','3')
                ->get();

            return Excel::download(new SolicitudesExport($solicitudes), 'solicitudes_'.date('YmdHis').'.xlsx');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }



    public function procesar(Request $request,Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::where('id','=',$solicitud->id)->first();

            dd($solicitud);

            /*
            $carreras = Carrera::all()->pluck('descripcion', 'id');

            //Obtenemos todas las nacionalidades que sean diferente a mexicana
            $nacionalidades = Nacionalidad::all()->pluck('descripcion', 'id')->where('id','<>',110);

            $tipo_sangre = TipoSangre::all()->pluck('descripcion', 'id');

            return view('solicitudes.editar',
                compact(
                    'solicitud',
                    'tipo_sangre',
                    'nacionalidades',
                    'carreras'
                ));
            */
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    // S O L I C I T U D E S   P O R   E S T A T U S

    //CONCENTRADO
    public function concentrado(Request $request)
    {
        try
        {
            return view('solicitudes.concentrado', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,0)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function enBorrador(Request $request)
    {
        try
        {
            return view('solicitudes.enBorrador', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,1)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function rechazadas(Request $request)
    {
        try
        {
            return view('solicitudes.rechazadas', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,2)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function enviadas(Request $request)
    {
        try
        {
            return view('solicitudes.enviadas', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,3)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function validadas(Request $request)
    {
        try
        {
            return view('solicitudes.validadas', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,4)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function enRevision(Request $request)
    {
        try
        {
            return view('solicitudes.enRevision', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,5)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function procesadas(Request $request)
    {
        try
        {
            return view('solicitudes.procesadas', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,6)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function aplicadas(Request $request)
    {
        try
        {
            return view('solicitudes.aplicadas', array(
                'arregloEstatusSolicitud' => $this->obtenerEstatusSolicitud(),
                'solicitudes'             => $this->obtenerSolicitudes($request,7)
            ));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function obtenerEstatusSolicitud()
    {
        return $arreglo = [
            1=>'Pendientes',
            2=>'Rechazadas',
            3=>'Enviadas',
            4=>'Validadas',
            5=>'En revisión',
            6=>'Procesadas',
            7=>'Aplicadas'
        ];
    }

    public function obtenerSolicitudes(Request $request,$estatusSolicitudId)
    {
        // TODO: Obtener el periodo del registro de solicitudes


        $solicitudes = Solicitud::with('estatusSolicitud');

        $solicitudes->where('periodo_escolar_id','=',4);

        if ($estatusSolicitudId>0)
        {
            $solicitudes->where('estatus_solicitud_id', '=', $estatusSolicitudId);
        }

        if ($request->has('tipo_solicitud') and !empty($request->get('tipo_solicitud'))):
            $solicitudes->where('tipo_solicitud', '=', $request->get('tipo_solicitud'));
        endif;

        if ($request->has('grado_id') and !empty($request->get('grado_id'))):
            $solicitudes->where('grado_id', '=', $request->get('grado_id'));
        endif;

        if ($request->has('estatus_solicitud_id') and !empty($request->get('estatus_solicitud_id'))):
            $solicitudes->where('estatus_solicitud_id', '=', $request->get('estatus_solicitud_id'));
        endif;

        if ($request->has('curp') and !empty($request->get('curp'))):
            $solicitudes->where('curp', 'LIKE', '%' . $request->get('curp') . '%');
        endif;

        if ($request->has('nombre') and !empty($request->get('nombre'))):
            $solicitudes->where(\DB::raw('CONCAT_WS(" ",primer_apellido,segundo_apellido,nombre)'), 'LIKE', '%' . str_replace(' ','%',$request->get('nombre')) . '%');
        endif;

        return $solicitudes->orderBy('solicitudes.primer_apellido')->orderBy('solicitudes.segundo_apellido')->orderBy('solicitudes.nombre')->paginate(100);
    }

}
