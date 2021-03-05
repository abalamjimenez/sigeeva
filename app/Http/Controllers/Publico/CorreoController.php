<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\Paenms;
use Illuminate\Support\Facades\Mail;
use App\Mail\InscripcionPaenmsMail;

class CorreoController extends Controller
{
    public function inscripcionPaenms()
    {
        try
        {
            $qry = Paenms::query();

            $datosAlumnos = $qry->selectRaw("tmp_paenms.nombre,tmp_paenms.email,solicitudes.curp")
            ->leftJoin('sigeeva.solicitudes','solicitudes.curp','=','tmp_paenms.curp')
            ->whereNull('solicitudes.curp')
            ->get();

            $datosCorreo = [
                'title'       => 'SIGEEVA - Recordatorio de inscripción',
            ];

            $correo='abalamjimenez@gmail.com';

            return view('emails.InscripcionPaenmsMail');

            //Mail::to($correo)->send(new InscripcionPaenmsMail($datosCorreo));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
