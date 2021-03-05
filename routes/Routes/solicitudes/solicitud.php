<?php
Route::group([ 'prefix' => '/' ], function () {


    // M O S T R A R   S O L I C I T U D   D E   R E I N S C R I P C I O N

    Route::get('/reinscripcion', [
        'uses' => 'Solicitudes\SolicitudController@reinscripcion',
        'as'   => 'solicitudes.reinscripcion',
    ]);

    // G U A R D A R   S O L I C I T U D   D E   R E I N S C R I P C I O N

    Route::post('/reinscripcion', [
        'uses' => 'Solicitudes\SolicitudController@storeReinscripcion',
        'as'   => 'solicitudes.storeReinscripcion',
    ]);

    // I M P R I M I R   S O L I C I T U D

    Route::get('/{solicitud:uuid}/imprimir', [
        'uses' => 'Solicitudes\SolicitudController@imprimir',
        'as'   => 'solicitudes.imprimir',
    ]);

    // E D I T A R   S O L I C I T U D

    Route::get('/{solicitud:uuid}/editar', [
        'uses' => 'Solicitudes\SolicitudController@editar',
        'as'   => 'solicitudes.editar',
    ]);

    // A C T U A L I Z A R   S O L I C I T U D

    Route::put('/{solicitud:uuid}', [
        'uses' => 'Solicitudes\SolicitudController@update',
        'as'   => 'solicitudes.update',
    ]);

    // P R O C E S A R   S O L I C I T U D

    Route::get('/{solicitud:uuid}/procesar', [
        'uses' => 'Solicitudes\SolicitudController@procesar',
        'as'   => 'solicitudes.procesar',
    ]);


    // S O L I C I T U D E S   P O R   E S T A T U S

    // CONCENTRADO
    Route::get('/concentrado', [
        'uses' => 'Solicitudes\SolicitudController@concentrado',
        'as'   => 'solicitudes.concentrado',
    ]);
    // PENDIENTES
    Route::get('/enBorrador', [
        'uses' => 'Solicitudes\SolicitudController@enBorrador',
        'as'   => 'solicitudes.enBorrador',
    ]);
    // RECHAZADAS
    Route::get('/rechazadas', [
        'uses' => 'Solicitudes\SolicitudController@rechazadas',
        'as'   => 'solicitudes.rechazadas',
    ]);
    // ENVIADAS
    Route::get('/enviadas', [
        'uses' => 'Solicitudes\SolicitudController@enviadas',
        'as'   => 'solicitudes.enviadas',
    ]);
    // ENVIADAS
    Route::get('/validadas', [
        'uses' => 'Solicitudes\SolicitudController@validadas',
        'as'   => 'solicitudes.validadas',
    ]);
    //EN REVISION
    Route::get('/enRevision', [
        'uses' => 'Solicitudes\SolicitudController@enRevision',
        'as'   => 'solicitudes.enRevision',
    ]);
    //PROCESADAS
    Route::get('/procesadas', [
        'uses' => 'Solicitudes\SolicitudController@procesadas',
        'as'   => 'solicitudes.procesadas',
    ]);
    //APLICADAS
    Route::get('/aplicadas', [
        'uses' => 'Solicitudes\SolicitudController@aplicadas',
        'as'   => 'solicitudes.aplicadas',
    ]);

    // D E S C A R G A R   S O L I C I T U D E S   P E N D I E N T E S

    Route::get('/descargar-solicitudes-pendientes', [
        'uses' => 'Solicitudes\SolicitudController@descargarSolicitudesPendientes',
        'as'   => 'solicitudes.descargarSolicitudesPendientes',
    ]);

    // D E S C A R G A R   S O L I C I T U D E S   F I N A L I Z A D A S

    Route::get('/descargar-solicitudes-enviadas', [
        'uses' => 'Solicitudes\SolicitudController@descargarSolicitudesEnviadas',
        'as'   => 'solicitudes.descargarSolicitudesEnviadas',
    ]);

    // D E S C A R G A R   S O L I C I T U D E S

    Route::get('/descargar-solicitudes', [
        'uses' => 'Solicitudes\SolicitudController@descargarSolicitudes',
        'as'   => 'solicitudes.descargarSolicitudes',
    ]);
});
