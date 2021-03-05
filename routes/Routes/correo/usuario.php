<?php

use App\User;
use Illuminate\Support\Facades\Hash;

Route::get('/usuarios-sin-acceso', function () {

    $qry = User::query();

    $alumnos = $qry->selectRaw("
    users.id AS user_id,
    users.username,users.email AS correo_institucional,
    personas.nombre_completo,
    substr(md5(users.username) FROM 1 FOR 8) AS clave_acceso
    ")
    ->join('sigeeva.personas', function ($join) {
        $join->on('personas.id','=','users.userable_id')
            ->where('personas.tipo_registro','=','ALUMNO');
    })
    ->whereNull('users.last_login_at')
    ->where('users.userable_type','LIKE','%Persona')
    ->get();

    foreach ($alumnos AS $alumno)
    {
        /*
        $datosCorreo = [
            'title'       => 'SIGEEVA - Usuario y contraseña',
            'username'    => $alumno->username,
            'claveAcceso' => $alumno->clave_acceso,
            'nombre'      => $alumno->nombre,
        ];
        */

        //$correo = trim($alumno->correo_institucional);

        //Mail::to($correo)->send(new \App\Mail\UsuariosMail($datosCorreo));


        $user = User::find($alumno->user_id);
        $user->password                  = Hash::make($alumno->clave_acceso);
        $user->correo_automatico_enviado = 'S';
        $user->save();

        //sleep(2);
    }

    echo 'CORREOS ENVIADOS';

});
