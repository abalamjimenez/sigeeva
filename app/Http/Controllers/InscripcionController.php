<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\ConceptoPago;
use App\Models\FichaPago;
use App\Models\FichaPagoDetalle;
use App\Models\Nacionalidad;
use App\Models\Paenms;
use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\SolicitudCt;
use App\Models\SolicitudTutor;
use App\Models\TipoSangre;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InscripcionController extends Controller
{
    public function listadoPaenms(Request $request)
    {
        try
        {
            $paenms = Paenms::all();

            return view('public.listadoPaenms',compact('paenms'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function inscripcionPaenmsBuscar(Request $request)
    {
        try
        {
            return view('public.inscripcionPaenmsBuscar');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function inscripcionPaenmsCargar(Request $request)
    {
        try
        {
            // Estas variables nos servirán para identificar los campos que deseamos
            // sean requeridos porque así lo pide la base de datos, y los datos que deseamos
            // sean requeridos porque sería de utilidad
            $required          = "required";
            $optional_required = "required";

            $tipo_sangre = TipoSangre::all()->pluck('descripcion', 'id');
            $nacionalidades = Nacionalidad::all()->pluck('descripcion', 'id')->where('id','<>',110);
            $paenms = Paenms::where('folio',$request->input('folio'))->first();

            if (empty($paenms))
            {
                return redirect()->route('public.inscripcionPaenmsBuscar')->with('msgError','El número de folio '.$request->input('folio').' no se encontró en la base de datos');
            }

            $solicitud = Solicitud::with('solicitudTutor','solicitudCt')->where('curp','=',$paenms->curp)->firstOrNew();

            // Si no hay una solicitud registrada entonces cargamos los datos de paenms
            if (empty($solicitud->id))
            {
                $solicitud->carrera_id                          = $paenms->carrera_id;
                $solicitud->carrera_descripcion                 = $paenms->carrera_descripcion;
                $solicitud->grado_id                            = 1;
                //$solicitud->turno_descripcion                 = 'Matutino'; // El turno es asignado
                //$solicitud->turno_id                          = 1;          // por el plantel

                $secundaria_procedencia_nombre = $paenms->procedencia_nombre_centro_trabajo;
                if (!empty($paenms->procedencia_modalidad))
                    $secundaria_procedencia_nombre = $paenms->procedencia_modalidad.' - '.$paenms->procedencia_nombre_centro_trabajo;

                $solicitud->secundaria_procedencia_descripcion  = $secundaria_procedencia_nombre;

                $solicitud->secundaria_procedencia_cct          = $paenms->procedencia_cct;
                $solicitud->secundaria_procedencia_fecha_egreso = $paenms->procedencia_fecha_egreso;

                $solicitud->primer_apellido                     = $paenms->primer_apellido;
                $solicitud->segundo_apellido                    = $paenms->segundo_apellido;
                $solicitud->nombre                              = $paenms->nombre;
                $solicitud->curp                                = $paenms->curp;
                $solicitud->fecha_nacimiento                    = $paenms->fecha_nacimiento;
                $solicitud->sexo                                = $paenms->sexo;
                $solicitud->email                               = $paenms->email;
                $solicitud->telefono                            = $paenms->telefono;
            }

            $imprime_solicitud = 'N';
            if ($solicitud->estatus_solicitud_id == 3)
                $imprime_solicitud = 'S';

            return view('solicitudes.inscripcionPaenms',
                compact(
                    'solicitud',
                    'paenms',
                    'tipo_sangre',
                    'nacionalidades',
                    'required',
                    'optional_required',
                    'imprime_solicitud'
                )
            );

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }


    public function inscripcionPaenmsGuardar(Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                'curp' => 'required',
            ],
            [
                'curp.required' => 'La curp es requerida',
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(!is_numeric($request->get('secundaria_procedencia_fecha_egreso')) AND !empty($request->get('secundaria_procedencia_fecha_egreso')))
            {
                return back()
                    ->withErrors(['secundaria_procedencia_fecha_egreso' => ['La fecha de egreso debe ser un año']])
                    ->withInput();
            }

            if (strlen($request->get('secundaria_procedencia_cct')) != 10)
            {
                return back()
                    ->withErrors(['secundaria_procedencia_cct' => ['La clave de centro de trabajo de la secundaria de procedencia (CCT) debe ser de 10 caracteres.']])
                    ->withInput();
            }

            if (!preg_match("/^23/",$request->get('secundaria_procedencia_cct')))
            {
                return back()
                    ->withErrors(['secundaria_procedencia_cct' => ['Los primeros 2 caracteres de la clave de centro de trabajo (CCT) deben ser 23']])
                    ->withInput();
            }

            $paenms = Paenms::where('folio',$request->input('folio'))->where('periodo_escolar_id',3)->first();

            $solicitud = Solicitud::firstOrNew([
                'curp' => $paenms->curp
            ]);

            $periodo_escolar_id       = 3;
            $conceptoPago             = ConceptoPago::where('id',25)->first();
            $carrera                  = Carrera::where('id',$paenms->carrera_id)->first();





            $nacionalidad_id          = null;
            $nacionalidad_descripcion = null;
            if (!empty($request->get('nacionalidad_id')))
            {
                $nacionalidad = Nacionalidad::where('id','=',$request->get('nacionalidad_id'))->first();

                $nacionalidad_id          = $nacionalidad->id;
                $nacionalidad_descripcion = $nacionalidad->descripcion;
            }

            $secundaria_procedencia_nombre = $paenms->procedencia_nombre_centro_trabajo;
            if (!empty($paenms->procedencia_modalidad))
                $secundaria_procedencia_nombre = $paenms->procedencia_modalidad.' - '.$paenms->procedencia_nombre_centro_trabajo;

            $solicitud->periodo_escolar_id                  = $periodo_escolar_id;

            $solicitud->secundaria_procedencia_cct          = $request->input('secundaria_procedencia_cct');
            $solicitud->secundaria_procedencia_descripcion  = $secundaria_procedencia_nombre;
            $solicitud->secundaria_procedencia_fecha_egreso = $request->input('secundaria_procedencia_fecha_egreso');
            $solicitud->secundaria_procedencia_promedio     = $request->input('secundaria_procedencia_promedio');

            $solicitud->carrera_id                          = $paenms->carrera_id;
            $solicitud->carrera_descripcion                 = $paenms->carrera_descripcion;
            $solicitud->grado_id                            = 1;
            $solicitud->primer_apellido                     = $paenms->primer_apellido;
            $solicitud->segundo_apellido                    = $paenms->segundo_apellido;
            $solicitud->nombre                              = $paenms->nombre;
            $solicitud->curp                                = $paenms->curp;
            $solicitud->fecha_nacimiento                    = $paenms->fecha_nacimiento;
            $solicitud->sexo                                = $paenms->sexo;
            $solicitud->email                               = $request->input('email');
            $solicitud->telefono                            = $request->input('telefono');
            $solicitud->tipo_sangre_id                      = $request->input('tipo_sangre_id');
            $solicitud->nacionalidad_tipo                   = $request->input('nacionalidad_tipo');
            $solicitud->nacionalidad_id                     = $nacionalidad_id;
            $solicitud->nacionalidad_descripcion            = $nacionalidad_descripcion;
            $solicitud->beca                                = $request->input('beca');
            $solicitud->enfermedad                          = $request->input('enfermedad');
            $solicitud->servicio_medico                     = $request->input('servicio_medico');
            $solicitud->numero_seguridad_social             = $request->input('numero_seguridad_social');
            $solicitud->domicilio_calle                     = $request->input('domicilio_calle');
            $solicitud->domicilio_numero                    = $request->input('domicilio_numero');
            $solicitud->domicilio_cruzamientos              = $request->input('domicilio_cruzamientos');
            $solicitud->domicilio_codigo_postal             = $request->input('domicilio_codigo_postal');
            $solicitud->domicilio_colonia                   = $request->input('domicilio_colonia');
            $solicitud->tipo_solicitud                      = 'NUEVO_INGRESO_PAENMS';

            if (!empty($request->get('guardar')) AND $request->get('guardar') == true)
                $solicitud->estatus_solicitud_id = 1; // Estatus pendiente
            else if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
            {
                $solicitud->estatus_solicitud_id = 3; // Estatus finalizada

                $referenciaBancaria = $this->generarReferencia($solicitud);
                $solicitud->referencia_bancaria = $referenciaBancaria;
            }

            $solicitud->save();

            // G U A R D A D O   D E   L O S   D A T O S   D E L   T U T O R

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

            // G U A R D A D O   D E   L O S   D A T O S   D E L   C E N T R O   D E   T R A B A J O

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

            // C R E A C I Ó N   D E   L A   F I C H A   D E   P A G O
            /*
            if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
            {
                $fichaPago = new FichaPago();
                $fichaPago->solicitud_id          = $solicitud->id;
                $fichaPago->periodo_escolar_id    = $solicitud->periodo_escolar_id;
                $fichaPago->estatus_ficha_pago_id = 1;
                $fichaPago->save();

                $referencia = $solicitud->curp;
                $referencia.= $conceptoPago->clave;
                $referencia.= substr($carrera->abreviacion,0,3);
                $referencia.= 'NA';
                $referencia.= '1';
                $referencia.= date('md');

                $fichaPagoDetalle                   = new FichaPagoDetalle();
                $fichaPagoDetalle->ficha_pago_id    = $fichaPago->id;
                $fichaPagoDetalle->concepto_pago_id = $conceptoPago->id;
                $fichaPagoDetalle->monto_pago        = $conceptoPago->costo;
                $fichaPagoDetalle->referencia_pago   = $referencia;
                $fichaPagoDetalle->save();
            }
            */

            \DB::commit();

            $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente.';
            if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
                $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente, ya está habilitado el botón para descargar la solicitud en la parte inferior de la pantalla';

            return redirect()->back()->with(['msgExito'=>$mensajeExito]);

        }
        catch (\Exception $e)
        {
            \DB::rollback();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function inscripcionBuscar(Request $request)
    {
        try
        {
            return view('public.inscripcionBuscar');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function inscripcionCargar(Request $request)
    {
        try
        {
            // Estas variables nos servirán para identificar los campos que deseamos
            // sean requeridos porque así lo pide la base de datos, y los datos que deseamos
            // sean requeridos porque sería de utilidad
            $required          = "required";
            $optional_required = "required";

            $tipo_sangre    = TipoSangre::all()->pluck('descripcion', 'id');
            $nacionalidades = Nacionalidad::where('id','<>',110)->pluck('descripcion', 'id');
            $carreras       = Carrera::where('id','<>',3)->pluck('descripcion', 'id');

            $solicitud = Solicitud::with('solicitudTutor','solicitudCt')->where('curp','=',$request->input('curp'))->firstOrNew();

            // Si no hay una solicitud registrada entonces cargamos los datos de paenms
            if (empty($solicitud->id))
            {
                //$solicitud->grado_id = 1;
                $solicitud->curp     = $request->input('curp');
            }

            $imprime_solicitud = 'N';
            if ($solicitud->estatus_solicitud_id == 3)
                $imprime_solicitud = 'S';

            return view('solicitudes.inscripcion',
                compact(
                    'solicitud',
                    'tipo_sangre',
                    'nacionalidades',
                    'carreras',
                    'required',
                    'optional_required',
                    'imprime_solicitud'
                )
            );

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }


    public function inscripcionGuardar(Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                'carrera_id'                             => 'required',
                'curp'                                   => 'required',
                'semestre'                               => 'required',
                'primer_apellido'                        => 'required',
                'nombre'                                 => 'required',
                'fecha_nacimiento'                       => 'required',
                'sexo'                                   => 'required',
                'email'                                  => 'required|email',
                'telefono'                               => 'required',
                'tipo_sangre_id'                         => 'required',
                'enfermedad'                             => 'required',
                'nacionalidad_tipo'                      => 'required',
                'domicilio_calle'                        => 'required',
                'domicilio_numero'                       => 'required',
                'domicilio_cruzamientos'                 => 'required',
                'domicilio_codigo_postal'                => 'required',
                'domicilio_colonia'                      => 'required',
                'tutor_primer_apellido'                  => 'required',
                'tutor_nombre'                           => 'required',
                'tutor_telefono'                         => 'required',
                'tutor_domicilio_calle'                  => 'required',
                'tutor_domicilio_numero'                 => 'required',
                'tutor_domicilio_cruzamientos'           => 'required',
                'tutor_domicilio_codigo_postal'          => 'required',
                'tutor_domicilio_colonia'                => 'required',

                'ct'                                     => 'required',
                'ct_ocupacion'                           => 'required',
                'ct_telefono'                            => 'required',

                'ct_domicilio_calle'                     => 'required',
                'ct_domicilio_numero'                    => 'required',
                'ct_domicilio_cruzamientos'              => 'required',
                'ct_domicilio_codigo_postal'             => 'required',
                'ct_domicilio_colonia'                   => 'required',
            ],
            [
                'carrera_id.required'                    => 'La carrera es requerida',
                'curp.required'                          => 'La curp es requerida',
                'enfermedad.required'                    => 'Necesita especificar si padece alguna enfermedad, en caso contrario ponga NO',
                'nacionalidad_tipo.required'             => 'Indique su tipo de nacionalidad',
                'domicilio_calle.required'               => 'Especifique la calle del domicilio solicitante',
                'domicilio_numero.required'              => 'Especifique el número del domicilio solicitante',
                'domicilio_cruzamientos.required'        => 'Especifique los cruzamientos del domicilio del solicitante',
                'domicilio_codigo_postal.required'       => 'Especifique el codigo postal del domicilio del solicitante',

                'tutor_primer_apellido.required'         => 'Especifique el apellido paterno del tutor',
                'tutor_nombre.required'                  => 'Especifique el nombre del tutor',
                'tutor_telefono.required'                => 'Especifique el telefono del tutor',

                'tutor_domicilio_calle.required'         => 'Especifique la calle del domicilio del tutor',
                'tutor_domicilio_numero.required'        => 'Especifique el número exterior del domicilio del tutor',
                'tutor_domicilio_cruzamientos.required'  => 'Especifique los cruzamientos del domicilio del tutor',
                'tutor_domicilio_codigo_postal.required' => 'Especifique el código postal del domicilio del tutor',
                'tutor_domicilio_colonia.required'       => 'Especifique la colonia del domicilio del tutor',

                'ct.required'                            => 'Especifique el centro de trabajo del tutor',
                'ct_ocupacion.required'                  => 'Especifique la ocupación laboral del tutor',
                'ct_telefono.required'                   => 'Especifique el telefono laboral del tutor',

                'ct_domicilio_calle.required'            => 'Especifique la calle del domicilio del centro de trabajo',
                'ct_domicilio_numero.required'           => 'Especifique el número exterior del domicilio del centro de trabajo',
                'ct_domicilio_cruzamientos.required'     => 'Especifique los cruzamientos del domicilio del centro de trabajo',
                'ct_domicilio_codigo_postal.required'    => 'Especifique el código postal del domicilio del centro de trabajo',
                'ct_domicilio_colonia.required'          => 'Especifique la colonia del domicilio del centro de trabajo',
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(!is_numeric($request->get('secundaria_procedencia_fecha_egreso')) AND !empty($request->get('secundaria_procedencia_fecha_egreso')))
            {
                return back()
                    ->withErrors(['secundaria_procedencia_fecha_egreso' => ['La fecha de egreso debe ser un año']])
                    ->withInput();
            }

            if (!empty($request->get('secundaria_procedencia_cct')))
            {
                if (strlen($request->get('secundaria_procedencia_cct')) != 10)
                {
                    return back()
                        ->withErrors(['secundaria_procedencia_cct' => ['La clave de centro de trabajo de la secundaria de procedencia (CCT) debe ser de 10 caracteres.']])
                        ->withInput();
                }

                if (!preg_match("/^23/",$request->get('secundaria_procedencia_cct')))
                {
                    return back()
                        ->withErrors(['secundaria_procedencia_cct' => ['Los primeros 2 caracteres de la clave de centro de trabajo (CCT) deben ser 23']])
                        ->withInput();
                }
            }

            // Todo: Obtener de forma dinamica el periodo_escolar_id correspondiente a la creación de solicitudes de inscripción

            $solicitud = Solicitud::firstOrNew([
                'curp'               => $request->input('curp'),
                'periodo_escolar_id' => 4
            ]);

            $conceptoPago = ConceptoPago::where('id',25)->first();


            $nacionalidad_id          = null;
            $nacionalidad_descripcion = null;
            if (!empty($request->get('nacionalidad_id')))
            {
                $nacionalidad = Nacionalidad::where('id','=',$request->get('nacionalidad_id'))->first();

                $nacionalidad_id          = $nacionalidad->id;
                $nacionalidad_descripcion = $nacionalidad->descripcion;
            }

            $carrera_id          = null;
            $carrera_descripcion = null;
            if (!empty($request->get('carrera_id')))
            {
                $carrera = Carrera::where('id','=',$request->get('carrera_id'))->first();

                $carrera_id          = $carrera->id;
                $carrera_descripcion = $carrera->descripcion;
            }

            // Todo: Obtener de forma dinamica el periodo_escolar_id correspondiente a la creación de solicitudes de inscripción

            $solicitud->periodo_escolar_id                   = 4;
            $solicitud->bachillerato_procedencia_descripcion = $request->input('bachillerato_procedencia_descripcion');
            $solicitud->secundaria_procedencia_cct           = $request->input('secundaria_procedencia_cct');
            $solicitud->secundaria_procedencia_descripcion   = $request->input('secundaria_procedencia_descripcion');
            $solicitud->secundaria_procedencia_fecha_egreso  = $request->input('secundaria_procedencia_fecha_egreso');
            $solicitud->secundaria_procedencia_promedio      = $request->input('secundaria_procedencia_promedio');

            $solicitud->carrera_id                          = $carrera_id;
            $solicitud->carrera_descripcion                 = $carrera_descripcion;
            $solicitud->grado_id                            = $request->input('semestre');
            $solicitud->primer_apellido                     = $request->input('primer_apellido');
            $solicitud->segundo_apellido                    = $request->input('segundo_apellido');
            $solicitud->nombre                              = $request->input('nombre');
            $solicitud->curp                                = $request->input('curp');
            $solicitud->fecha_nacimiento                    = $request->input('fecha_nacimiento');
            $solicitud->sexo                                = $request->input('sexo');
            $solicitud->email                               = $request->input('email');
            $solicitud->telefono                            = $request->input('telefono');
            $solicitud->tipo_sangre_id                      = $request->input('tipo_sangre_id');
            $solicitud->nacionalidad_tipo                   = $request->input('nacionalidad_tipo');
            $solicitud->nacionalidad_id                     = $nacionalidad_id;
            $solicitud->nacionalidad_descripcion            = $nacionalidad_descripcion;
            $solicitud->beca                                = $request->input('beca');
            $solicitud->enfermedad                          = $request->input('enfermedad');
            $solicitud->servicio_medico                     = $request->input('servicio_medico');
            $solicitud->numero_seguridad_social             = $request->input('numero_seguridad_social');
            $solicitud->domicilio_calle                     = $request->input('domicilio_calle');
            $solicitud->domicilio_numero                    = $request->input('domicilio_numero');
            $solicitud->domicilio_cruzamientos              = $request->input('domicilio_cruzamientos');
            $solicitud->domicilio_codigo_postal             = $request->input('domicilio_codigo_postal');
            $solicitud->domicilio_colonia                   = $request->input('domicilio_colonia');
            $solicitud->tipo_solicitud                      = 'NUEVO_INGRESO';

            if (!empty($request->get('guardar')) AND $request->get('guardar') == true)
                $solicitud->estatus_solicitud_id = 1; // Estatus pendiente
            else if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
            {
                $solicitud->estatus_solicitud_id = 3; // Estatus finalizada

                $referenciaBancaria = $this->generarReferencia($solicitud);

                $solicitud->referencia_bancaria = $referenciaBancaria;
            }

            $solicitud->save();

            // G U A R D A D O   D E   L O S   D A T O S   D E L   T U T O R

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

            // G U A R D A D O   D E   L O S   D A T O S   D E L   C E N T R O   D E   T R A B A J O

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

            // C R E A C I Ó N   D E   L A   F I C H A   D E   P A G O
            /*
            if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
            {
                $fichaPago = new FichaPago();
                $fichaPago->solicitud_id          = $solicitud->id;
                $fichaPago->periodo_escolar_id    = $solicitud->periodo_escolar_id;
                $fichaPago->estatus_ficha_pago_id = 1;
                $fichaPago->save();

                $referencia = $solicitud->curp;
                $referencia.= $conceptoPago->clave;
                $referencia.= substr($carrera->abreviacion,0,3);
                $referencia.= 'NA';
                $referencia.= '1';
                $referencia.= date('md');

                $fichaPagoDetalle                   = new FichaPagoDetalle();
                $fichaPagoDetalle->ficha_pago_id    = $fichaPago->id;
                $fichaPagoDetalle->concepto_pago_id = $conceptoPago->id;
                $fichaPagoDetalle->monto_pago        = $conceptoPago->costo;
                $fichaPagoDetalle->referencia_pago   = $referencia;
                $fichaPagoDetalle->save();
            }
            */

            \DB::commit();

            $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente.';
            if (!empty($request->get('guardarFinalizar')) AND $request->get('guardarFinalizar') == true)
                $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente, ya está habilitado el botón para descargar la solicitud en la parte inferior de la pantalla';

            return redirect()->back()->with(['msgExito'=>$mensajeExito]);

        }
        catch (\Exception $e)
        {
            \DB::rollback();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarSolicitudPaenms(Request $request,Solicitud $solicitud)
    {
        try
        {

            $solicitud = Solicitud::with('periodoEscolar')->where('id',$solicitud->id)->first();

            $pdf = PDF::loadView('pdf.solicitudes.solicitudInscripcionPaenms',
                compact(
                    'solicitud'
                )
            );

            return $pdf->download('formato_nuevo_ingreso_paenms.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarSolicitud(Request $request,Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::with('periodoEscolar')->where('id',$solicitud->id)->first();

            $pdf = PDF::loadView('pdf.solicitudes.solicitudInscripcion',
                compact(
                    'solicitud'
                )
            );

            return $pdf->download('formato_nuevo_ingreso.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function generarReferencia(Solicitud $solicitud)
    {
        $carrera = Carrera::where('id',$solicitud->carrera_id)->first();

        $segmentoRaiz = strtoupper($solicitud->curp);
        $segmentoRaiz.= $carrera->siglas;
        $segmentoRaiz.= $solicitud->grado_id;
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

        return $referenciaBancaria;
    }
}
