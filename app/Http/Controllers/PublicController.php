<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function informacionCambiosDeEscuela(Request $request)
    {
        try
        {
            return view('public.informacionCambiosDeEscuela');
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function obtenerDatosAccesoAlumno(Request $request)
    {
        try
        {
            return view('public.obtenerDatosAccesoAlumno');
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function enviarDatosAccesoAlumno(Request $request)
    {
        try
        {
            // Lo convertimos a minusculas
            $correo_electronico = trim(strtolower($request->input('correo_electronico')));

            //Eliminar posibles espacios
            $correo_electronico = str_replace(' ','',$correo_electronico);

            $request->merge(['correo_electronico' => $correo_electronico]);

            $rules    = [
                'correo_electronico' => 'required|email',
            ];
            $messages = [
                'correo_electronico.required' => 'El correo electrónico es requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $correo_electronico = $request->input('correo_electronico');

            // I N I C I O
            $qry = User::query();

            $datosPersona = $qry->selectRaw('users.id AS user_id, users.username, personas.nombre_completo')
            ->join('sigeeva.personas','personas.id','=','users.userable_id')
            ->where('users.email','=',$correo_electronico)
            ->where('users.userable_type','LIKE','%Persona')
            ->first();

            if ($datosPersona == null)
            {
                return back()
                    ->withErrors(['msg'=>'No se encontró la información con el correo institucional, mande un correo a sigeeva@evasamano.edu.mx reportando dicha situación por favor, anexando su nombre completo'])
                    ->withInput();
            }

            $claveAcceso = md5($datosPersona->username);
            $claveAcceso = substr($claveAcceso,0,8);

            $user = User::find($datosPersona->user_id);
            $user->password = bcrypt($claveAcceso);
            $user->save();


            // MANDAMOS CORREO
            $datosCorreo = [
                'title'       => 'SIGEEVA - Reiniciar clave de acceso',
                'username'    => $datosPersona->username,
                'claveAcceso' => $claveAcceso,
                'nombre'      => $datosPersona->nombre_completo,
            ];

            Mail::to($correo_electronico)->send(new \App\Mail\ReiniciarPasswordMail($datosCorreo));

            return back()
                ->with(['msg'=>'El correo se ha enviado. Revisa tu bandeja de correo no deseado o spam en caso de que no te aparezca en la bandeja de recibidos'])
                ->withInput();
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
