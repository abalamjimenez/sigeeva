<?php

namespace App\Http\Controllers\Alumnos;

use App\Models\Alumno;
use App\Models\CalificacionGrupoExpediente;
use App\Models\Carrera;
use App\Models\ConceptoPago;
use App\Models\Domicilio;
use App\Models\Expediente;
use App\Models\FichaPagoDetalle;
use App\Models\PeriodoEscolar;
use App\Models\Referencia;
use App\Models\Solicitud;
use App\Models\Turno;
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
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;
use Validator;

class ConceptoPagoController extends Controller
{
    public function index()
    {
        dd('hola');
    }

    public function descargarFormatoApoyoEducacionReinscripcion(Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::with('fichaPago')->where('id',$solicitud->id)->first();

            //$fichaPagoDetalle = FichaPagoDetalle::with('conceptoPago')->where('ficha_pago_id',$solicitud->fichaPago->id)->first();

            $conceptoPago = ConceptoPago::where('id',25)->first();

            $datosFormato = array();

            $datosFormato['periodo_escolar']        = $solicitud->periodoEscolar->descripcion;
            $datosFormato['nombre_completo']        = $solicitud->primer_apellido.' '.$solicitud->segundo_apellido.' '.$solicitud->nombre;
            $datosFormato['curp']                   = $solicitud->curp;
            $datosFormato['carrera']                = $solicitud->carrera_descripcion;
            $datosFormato['turno']                  = $solicitud->turno_descripcion;
            $datosFormato['referencia_bancaria']    = $solicitud->referencia_bancaria;

            $datosFormato['concepto_pago_convenio'] = $conceptoPago->convenio;
            $datosFormato['concepto_pago_costo']    = $conceptoPago->costo;
            $datosFormato['concepto_pago_etiqueta'] = $conceptoPago->etiqueta;
            $datosFormato['concepto_pago_mensaje']  = $conceptoPago->mensaje;


            $pdf = PDF::loadView('pdf.solicitudes.formatoApoyoEducacionReinscripcion',compact('datosFormato'));
            return $pdf->download('apoyo_educacion_'.$solicitud->curp.'.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarFormatoApoyoEducacionInscripcion(Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::with('fichaPago')->where('id',$solicitud->id)->first();

            //$fichaPagoDetalle = FichaPagoDetalle::with('conceptoPago')->where('ficha_pago_id',$solicitud->fichaPago->id)->first();

            $conceptoPago = ConceptoPago::where('id',25)->first();

            $datosFormato = array();

            $datosFormato['periodo_escolar']        = $solicitud->periodoEscolar->descripcion;
            $datosFormato['nombre_completo']        = $solicitud->primer_apellido.' '.$solicitud->segundo_apellido.' '.$solicitud->nombre;
            $datosFormato['curp']                   = $solicitud->curp;
            $datosFormato['carrera']                = $solicitud->carrera_descripcion;
            $datosFormato['turno']                  = $solicitud->turno_descripcion;
            $datosFormato['referencia_bancaria']    = $solicitud->referencia_bancaria;
            //$datosFormato['referencia_bancaria']    = $fichaPagoDetalle->referencia_pago;

            //$datosFormato['concepto_pago_convenio'] = $fichaPagoDetalle->conceptoPago->convenio;
            //$datosFormato['concepto_pago_costo']    = $fichaPagoDetalle->monto_pago;
            //$datosFormato['concepto_pago_etiqueta'] = $fichaPagoDetalle->conceptoPago->etiqueta;
            //$datosFormato['concepto_pago_mensaje']  = $fichaPagoDetalle->conceptoPago->mensaje;

            $datosFormato['concepto_pago_convenio'] = $conceptoPago->convenio;
            $datosFormato['concepto_pago_costo']    = $conceptoPago->costo;
            $datosFormato['concepto_pago_etiqueta'] = $conceptoPago->etiqueta;
            $datosFormato['concepto_pago_mensaje']  = $conceptoPago->mensaje;


            $pdf = PDF::loadView('pdf.solicitudes.formatoApoyoEducacionInscripcion',compact('datosFormato'));
            return $pdf->download('apoyo_educacion_'.$solicitud->curp.'.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarFormatoApoyoEducacionInscripcionPaenms(Solicitud $solicitud)
    {
        try
        {
            $solicitud = Solicitud::with('fichaPago')->where('id',$solicitud->id)->first();

            //$fichaPagoDetalle = FichaPagoDetalle::with('conceptoPago')->where('ficha_pago_id',$solicitud->fichaPago->id)->first();

            $conceptoPago = ConceptoPago::where('id',25)->first();

            $datosFormato = array();

            $datosFormato['periodo_escolar']        = $solicitud->periodoEscolar->descripcion;
            $datosFormato['nombre_completo']        = $solicitud->primer_apellido.' '.$solicitud->segundo_apellido.' '.$solicitud->nombre;
            $datosFormato['curp']                   = $solicitud->curp;
            $datosFormato['carrera']                = $solicitud->carrera_descripcion;
            $datosFormato['turno']                  = $solicitud->turno_descripcion;
            $datosFormato['referencia_bancaria']    = $solicitud->referencia_bancaria;
            //$datosFormato['referencia_bancaria']    = $fichaPagoDetalle->referencia_pago;

            $datosFormato['concepto_pago_convenio'] = $conceptoPago->convenio;
            //$datosFormato['concepto_pago_costo']    = $conceptoPago->monto_pago;
            $datosFormato['concepto_pago_costo']    = $conceptoPago->costo;
            $datosFormato['concepto_pago_etiqueta'] = $conceptoPago->etiqueta;
            $datosFormato['concepto_pago_mensaje']  = $conceptoPago->mensaje;


            $pdf = PDF::loadView('pdf.solicitudes.formatoApoyoEducacionInscripcionPaenms',compact('datosFormato'));
            return $pdf->download('apoyo_educacion_'.$solicitud->curp.'.pdf',$pdf->output());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function descargarConceptoPago(Request $request,Persona $persona,ConceptoPago $conceptoPago)
    {
        try
        {
            $datosFormato = $this->obtenerDatosFormato($persona,$conceptoPago);

            if (empty($datosFormato))
            {
                $this->mostrarPaginaError();
            }
            else
            {
                $pdf = PDF::loadView('pdf.alumnos.conceptopago.descargarConceptoPago',compact('datosFormato'));
                return $pdf->download($conceptoPago->etiqueta.'_'.$persona->curp.'.pdf',$pdf->output());

                //return view('pdf.alumnos.conceptopago.apoyoEducacion',compact('datosFormato'));
            }
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function mostrarPaginaError()
    {
        $titulo  = 'Página no encontrada';

        $mensaje = "Manda un correo a sigeeva@evasamano.edu.mx, enviando los siguientes datos del alumno: <br>";
        $mensaje.= "<ul>";
        $mensaje.= "<li>CURP</li>";
        $mensaje.= "<li>Nombre completo</li>";
        $mensaje.= "<li>Descripción del problema</li>";
        $mensaje.= "<li>De ser posible envía una captura del error al 9838366717</li>";
        $mensaje.= "</ul>. ";

        return view('errors.general',
            compact('titulo',
                'mensaje'
            )
        );
    }

    public function obtenerDatosFormato(Persona $persona,ConceptoPago $conceptoPago)
    {
        $alumno = Alumno::where('persona_id',$persona->id)->first();

        // Obtenemos el último expediente vigente del alumno
        $expediente = Expediente::with('carrera','turno')
            ->where('expedientes.vigente','S')
            ->where('expedientes.alumno_id',$alumno->id)
            ->orderBy('periodo_escolar_id','DESC')
            ->first();

        if (empty($expediente))
        {
            return false;
        }

        $periodoEscolar = PeriodoEscolar::where('id','=','3')->first();

        // I N I C I A  R E F E R E N C I A   B A N C A R I A
        // 18 CURP
        // 02 Concepto de pago
        // 02 Periodo escolar
        // 08 Número de control del alumno

        $periodoEscolarReferenciaPago = $periodoEscolar->id;
        if (strlen($periodoEscolar->id) == 1)
            $periodoEscolarReferenciaPago = '0'.$periodoEscolar->id;

        $referenciaBancaria = $persona->curp;
        $referenciaBancaria.= $conceptoPago->clave;
        $referenciaBancaria.= $periodoEscolarReferenciaPago;
        $referenciaBancaria.= $alumno->numero_control;

        // FIN REFERENCIA BANCARIA

        $datosFormato['periodo_escolar']        = $periodoEscolar->descripcion;
        $datosFormato['nombre_completo']        = $persona->nombre_completo;
        $datosFormato['numero_control']         = $alumno->numero_control;
        $datosFormato['carrera']                = $expediente->carrera->descripcion;
        $datosFormato['turno']                  = $expediente->turno->abreviacion;
        $datosFormato['referencia_bancaria']    = $referenciaBancaria;

        $datosFormato['concepto_pago_convenio'] = $conceptoPago->convenio;
        $datosFormato['concepto_pago_costo']    = $conceptoPago->costo;
        $datosFormato['concepto_pago_etiqueta'] = $conceptoPago->etiqueta;
        $datosFormato['concepto_pago_mensaje']  = $conceptoPago->mensaje;

        return $datosFormato;
    }
}
