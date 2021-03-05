<?php

use App\Models\Grupo;
use App\Models\Persona;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;


// PROCEDIMIENTO PARA CREAR UN EXPEDIENTE INDIVIDUAL
// CREAMOS EL EXPEDIENTE Y ASIGNAMOS MATERIAS, TENEMOS QUE INICIALIZAR
// UNOS PARAMETROS EN EL METODO CREAR DEL CONTROLADOR EXPEDIENTE
# Route::get('/crea-expediente','ExpedienteController@crear')->name('expediente.crear');

/*
Route::get('/expediente',function (){
        $expediente = new \App\Models\Expediente;
        $expediente->alumno_id = 565;
        $expediente->uuid = Uuid::uuid4()->toString();
        $expediente->periodo_escolar_id = 3;
        $expediente->grupo_id = 45;
        $expediente->carrera_id = 2;
        $expediente->turno_id = 2;
        $expediente->grado_id = 5;
        $expediente->es_readmision = 'S';
        $expediente->es_cedar = 'N';
        $expediente->vigente = 'S';
        $expediente->save();

        $data = [
            ['asignatura_grupo_id'=>291, 'expediente_id'=> $expediente->id,'uuid'=>Uuid::uuid4()->toString(),'es_adicional'=>'S','created_at'=>'2020-10-20 04:33:01','updated_at'=>'2020-10-20 04:33:01'],
            ['asignatura_grupo_id'=>293, 'expediente_id'=> $expediente->id,'uuid'=>Uuid::uuid4()->toString(),'es_adicional'=>'S','created_at'=>'2020-10-20 04:33:01','updated_at'=>'2020-10-20 04:33:01'],
        ];

        \App\Models\AsignaturaGrupoExpediente::insert($data);

        echo 'FINALIZADO EXPEDIENTE';
});
*/

/*
Route::get('/repetidores',function (){

    $data = [
        ['asignatura_grupo_id'=>224, 'expediente_id'=> 1445,'uuid'=>Uuid::uuid4()->toString(),'es_adicional'=>'S','created_at'=>'2020-10-19 17:50:01','updated_at'=>'2020-10-19 17:50:01'],
        ['asignatura_grupo_id'=>229, 'expediente_id'=> 1445,'uuid'=>Uuid::uuid4()->toString(),'es_adicional'=>'S','created_at'=>'2020-10-19 17:50:01','updated_at'=>'2020-10-19 17:50:01'],
    ];

    \App\Models\AsignaturaGrupoExpediente::insert($data);

    echo 'FINALIZADO REPETIDORES';
});
*/

/*
Route::group([ 'prefix' => '/correo'], function () {
    require __DIR__ . '/Routes/correo/usuario.php';
});
*/


Route::get('/mail', function () {

    /*
    $qry = Persona::query();

    $datosAlumnos = $qry->selectRaw("
        users.id AS user_id,users.username, substr(md5(users.username) FROM 1 FOR 8) AS clave_acceso,
        personas.nombre, personas.email
    ")
    ->join('sigeeva.users', function ($join) {
        $join->on('users.userable_id','=','personas.id')
            ->where('users.userable_type','LIKE','%Persona');
    })
    ->whereNotNull('personas.email')
    ->where('users.correo_automatico_enviado','N')
    ->where('users.cuenta_validada','N')
    ->limit(150)
    ->get();

    foreach ($datosAlumnos AS $alumno)
    {
        // MANDAMOS CORREO

        $datosCorreo = [
            'title'       => 'SIGEEVA - DATOS DE ACCESO',
            'username'    => $alumno->username,
            'claveAcceso' => $alumno->clave_acceso,
            'nombre'      => $alumno->nombre,
        ];

        $correo = trim($alumno->email);

        Mail::to($correo)->send(new \App\Mail\TestMail($datosCorreo));

        $user = User::find($alumno->user_id);
        $user->correo_automatico_enviado = 'S';
        $user->save();

        sleep(2);
    }

    echo 'CORREOS ENVIADOS';
    */
});

// P A G I N A S   E S T A T I C A S
//HORARIOS
Route::get('/horario-matutino','RacoonController@horarioMatutino')->name('public.horarioMatutino');
Route::get('/horario-vespertino','RacoonController@horarioVespertino')->name('public.horarioVespertino');
//VARIAS
Route::view('/ampliacion-inscripcion', 'public.ampliacionInscripcion')->name('public.ampliacionInscripcion');
Route::view('/calendario-escolar', 'public.calendarioEscolar')->name('public.calendarioEscolar');
Route::view('/lista-admision-ni', 'public.listaAdmisionNi')->name('public.listaAdmisionNi');




Route::get('/starterpage', function () {
    return view('starterpage');
});



Route::get('/', function () {
    return redirect('/login');
});


Route::get('/pdf', function () {
    $pdf = app('dompdf.wrapper');
    $pdf->loadHTML('<h1>Styde.net</h1>');

    return $pdf->download('mi-archivo.pdf');
});

Route::get('/login-expired', function () {
    return view('auth.login-expired');
})->name('login-expired');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/informacion-cambios-de-escuela','PublicController@informacionCambiosDeEscuela')->name('public.informacionCambiosDeEscuela');

Route::get('/obtener-datos-acceso-alumno','PublicController@obtenerDatosAccesoAlumno')->name('public.obtenerDatosAccesoAlumno');
Route::post('/enviar-datos-acceso-alumno','PublicController@enviarDatosAccesoAlumno')->name('public.enviarDatosAccesoAlumno');

// E N V I A R   C O R R E O
Route::get('/correo-inscripcion-paenms','Publico\CorreoController@inscripcionPaenms')->name('public.correo-inscripcion-paenms');


// I N S C R I P C I O N   N U E V O   I N G R E S O
Route::get('/listado-paenms','InscripcionController@listadoPaenms')->name('public.listadoPaenms');
Route::get('/inscripcion-paenms-buscar','InscripcionController@inscripcionPaenmsBuscar')->name('public.inscripcionPaenmsBuscar');
Route::get('/inscripcion-paenms-cargar','InscripcionController@inscripcionPaenmsCargar')->name('public.inscripcionPaenmsCargar');
Route::post('/inscripcion-paenms-guardar','InscripcionController@inscripcionPaenmsGuardar')->name('public.inscripcionPaenmsGuardar');
Route::get('/inscripcion-buscar','InscripcionController@inscripcionBuscar')->name('public.inscripcionBuscar');
Route::get('/inscripcion-cargar','InscripcionController@inscripcionCargar')->name('public.inscripcionCargar');
Route::post('/inscripcion-guardar','InscripcionController@inscripcionGuardar')->name('public.inscripcionGuardar');
Route::get('/{solicitud:uuid}/descargar-solicitud-paenms','InscripcionController@descargarSolicitudPaenms')->name('public.descargarSolicitudPaenms');
Route::get('/{solicitud:uuid}/descargar-solicitud','InscripcionController@descargarSolicitud')->name('public.descargarSolicitud');
Route::get('/{solicitud:uuid}/descargar-formato-apoyo-educacion-reinscripcion','Alumnos\ConceptoPagoController@descargarFormatoApoyoEducacionReinscripcion')->name('alumnos.conceptoDePago.descargarFormatoApoyoEducacionReinscripcion');
Route::get('/{solicitud:uuid}/descargar-formato-apoyo-educacion-inscripcion','Alumnos\ConceptoPagoController@descargarFormatoApoyoEducacionInscripcion')->name('alumnos.conceptoDePago.descargarFormatoApoyoEducacionInscripcion');
Route::get('/{solicitud:uuid}/descargar-formato-apoyo-educacion-inscripcion-paenms','Alumnos\ConceptoPagoController@descargarFormatoApoyoEducacionInscripcionPaenms')->name('alumnos.conceptoDePago.descargarFormatoApoyoEducacionInscripcionPaenms');


    Route::get('/{persona:uuid}/descargarConceptoPago/{conceptoPago}', [
        'uses' => 'Alumnos\ConceptoPagoController@descargarConceptoPago',
        'as'   => 'alumnos.conceptoDePago.descargarConceptoPago',
    ]);

//Route::get('/{solicitud:uuid}/imprimir-solicitud-paenms', [
//    'uses' => 'Solicitudes\SolicitudController@imprimir',
//    'as'   => 'solicitudes.imprimir',
//]);




// U S U A R I O   L O G U E A D O
Route::get('/editar-mi-perfil','UsersController@editarMiPerfil')->name('usuarios.editarMiPerfil');
Route::patch('/{user}/actualizar-mi-perfil','UsersController@updateMiPerfil')->name('usuarios.updateMiPerfil');
Route::get('/editar-mi-password','UsersController@editarMiPassword')->name('usuarios.editarMiPassword');
Route::patch('/{user}/actualizar-mi-password','UsersController@updateMiPassword')->name('usuarios.updateMiPassword');


Route::get('/users-list','UsersController@usersList')->name('usersList');
Route::get('/users/destroy/{usuario}','UsersController@destroy')->name('usuarios.destroy');
Route::get('/users/{usuario}/edit','UsersController@edit');
Route::post('/users','UsersController@store')->name('usuarios.store');
Route::post('/users/update','UsersController@update')->name('usuarios.update');



Route::get('/users/{user:uuid}/editar-datos','UsersController@editarDatos')->name('usuarios.editarDatos');
Route::patch('/users/{user:uuid}/update-datos','UsersController@updateDatos')->name('usuarios.updateDatos');
Route::get('/users/{user:uuid}/cambiar-clave-acceso','UsersController@cambiarClaveAcceso')->name('usuarios.cambiarClaveAcceso');
Route::patch('/users/{user:uuid}/update-clave-acceso','UsersController@updateClaveAcceso')->name('usuarios.updateClaveAcceso');
Route::get('/users/{user:uuid}/editar-accesos','UsersController@editarAccesos')->name('usuarios.editarAccesos');
Route::patch('/users/{user:uuid}/actualizar-accesos','UsersController@actualizarAccesos')->name('usuarios.actualizarAccesos');

Route::group([ 'middleware' => [ 'auth' ] ], function () {
    require __DIR__ . '/Routes/usuarios/usuarios.php';
});

Route::group([ 'prefix' => '/plan', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/planes/plan.php';
});

Route::group([ 'prefix' => '/periodicidad', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/periodicidades/periodicidad.php';
});

Route::group([ 'prefix' => '/modalidad', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/modalidades/modalidad.php';
});

Route::group([ 'prefix' => '/nivelestudios', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/nivelestudios/nivelestudio.php';
});

Route::group([ 'prefix' => '/generacion', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/generaciones/generacion.php';
});

Route::group([ 'prefix' => '/carrera', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/carreras/carrera.php';
});

Route::group([ 'prefix' => '/persona', 'middleware' => [ 'auth'] ], function () {
    require __DIR__ . '/Routes/personas/persona.php';
});

Route::group(['middleware'=>['auth','escuentavalidada']],function (){

    Route::get('/alumno-historial','KioskoController@historialAlumno')->name('kiosko.alumno.historial');
    Route::get('kiosko/{persona:uuid}/alumno-detalle-historial','KioskoController@detalleHistorialAlumno')->name('kiosko.alumno.detalleHistorial');



    Route::get('/solicitudes-estadisticas','Solicitudes\EstadisticaController@solicitudes')->name('solicitudes.estadisticas');


    Route::get('/estadisticas','UsersController@estadisticas')->name('usuarios.estadisticas');

    Route::get('/accesosAlumnos','UsersController@accesosAlumnos')->name('usuarios.accesosAlumnos');
    Route::get('/accesosDocentes','UsersController@accesosDocentes')->name('usuarios.accesosDocentes');
    Route::get('/accesosAdministrativos','UsersController@accesosAdministrativos')->name('usuarios.accesosAdministrativos');

    // P L A N   D E   E S T U D I O S  -  A S I G N A T U R A S

    Route::group([ 'prefix' => '/plandeestudios' ], function () {
        require __DIR__ . '/Routes/plandeestudios/asignatura.php';
    });

    // C O N T R O L   E S C O L A R
    //
    Route::group([ 'prefix' => '/controlescolar' ], function () {

        require __DIR__ . '/Routes/controlescolar/grupo.php';
    });

    // U S U A R I O S

    Route::get('/users','UsersController@index')->name('usuarios.index');

    // G R U P O S

    Route::group([ 'prefix' => '/historicos' ], function () {
        require __DIR__ . '/Routes/historicos/historico.php';
    });

    // G R U P O S

    Route::group([ 'prefix' => '/grupo' ], function () {
        require __DIR__ . '/Routes/grupos/grupo.php';
    });




    // A L U M N O S

    Route::group([ 'prefix' => '/alumno' ], function () {
        require __DIR__ . '/Routes/alumnos/alumno.php';
    });

    // C A L I F I C A C I O N E S

    Route::group([ 'prefix' => '/calificacion' ], function () {
        require __DIR__ . '/Routes/calificaciones/calificacion.php';
    });

    // D O C E N T E S

    Route::group([ 'prefix' => '/docente', 'middleware' => [ 'auth'] ], function () {
        require __DIR__ . '/Routes/docentes/docente.php';
    });

    // A D M I N I S T R A T I V O S

    Route::group([ 'prefix' => '/administrativo', 'middleware' => [ 'auth'] ], function () {
        require __DIR__ . '/Routes/administrativos/administrativo.php';
    });

    // SOLICITUDES

    Route::group([ 'prefix' => '/solicitud', 'middleware' => [ 'auth'] ], function () {
        require __DIR__ . '/Routes/solicitudes/solicitud.php';
    });

    // GROUPS

    Route::group([ 'prefix' => '/group', 'middleware' => [ 'auth'] ], function () {
        require __DIR__ . '/Routes/groups/group.php';
    });

    // Tools

    Route::group([ 'prefix' => '/tool', 'middleware' => [ 'auth'] ], function () {
        require __DIR__ . '/Routes/tools/tool.php';
    });

});
