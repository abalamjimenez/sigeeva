<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/descargar-expedientes', [
        'uses' => 'Alumnos\AlumnoController@descargarExpedientes',
        'as'   => 'alumnos.descargarExpedientes',
    ]);

    Route::get('/descargar-concentrado-de-calificaciones', [
        'uses' => 'Alumnos\AlumnoController@descargarConcentradoDeCalificaciones',
        'as'   => 'alumnos.descargarConcentradoDeCalificaciones',
    ]);


	Route::get('/', [
		'uses' => 'Alumnos\AlumnoController@index',
		'as'   => 'alumnos.index',
	]);

	// C R E A R   A L U M N O

    Route::get('/create', [
        'uses' => 'Alumnos\AlumnoController@create',
        'as'   => 'alumnos.create',
    ]);

    // A L M A C E N A R   D A T O S   G E N E R A L E S
    Route::post('/store', [
        'uses' => 'Alumnos\AlumnoController@store',
        'as'   => 'alumnos.store',
    ]);

	// E D I T A R   A L U M N O

    Route::get('/{persona:uuid}',[
        'uses' => 'Alumnos\AlumnoController@edit',
        'as'   => 'alumnos.edit',
    ]);

    // A C T U A L I Z A R   A L U M N O

    Route::post('/{persona:uuid}', [
        'uses' => 'Alumnos\AlumnoController@update',
        'as'   => 'alumnos.update',
    ]);

    // E D I T A R   T U T O R

    Route::get('/{persona:uuid}/tutor', [
        'uses' => 'Alumnos\AlumnoController@editarTutor',
        'as'   => 'alumnos.editarTutor',
    ]);

    // A L M A C E N A R   T U T O R

    Route::post('{persona:uuid}/tutor', [
        'uses' => 'Alumnos\AlumnoController@storeTutor',
        'as'   => 'alumnos.storeTutor',
    ]);

    //

    Route::get('/{persona:uuid}/historial', [
        'uses' => 'Alumnos\AlumnoController@historial',
        'as'   => 'alumnos.historial',
    ]);


    // I M P R I M I R   B O L E T A
;
    Route::get('/{asignaturaGrupoExpediente:uuid}/imprimir-boleta', [
        'uses' => 'Alumnos\AlumnoController@imprimirBoleta',
        'as'   => 'alumnos.imprimirBoleta',
    ]);


    // VISUALIZAR FORMATO DE APOYO A LA EDUCACIÓN

    Route::get('/{persona:uuid}/descargarConceptoPago/{conceptoPago}', [
        'uses' => 'Alumnos\ConceptoPagoController@descargarConceptoPago',
        'as'   => 'alumnos.conceptoDePago.descargarConceptoPago',
    ]);

    // CONCEPTO DE PAGO - INDEX

    Route::get('/concepto-pago', [
        'uses' => 'ConceptosPago\ConceptosPago@index',
        'as'   => 'alumnos.conceptoDePago.index',
    ]);

});
