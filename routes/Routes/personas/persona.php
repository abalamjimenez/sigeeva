<?php
Route::group([ 'prefix' => '/' ], function () {

	Route::get('/', [
		'uses' => 'Personas\PersonaController@index',
		'as'   => 'personas.index',
	]);

	Route::get('/create', [
		'uses' => 'Personas\PersonaController@create',
		'as'   => 'personas.create',
	]);

	Route::get('/{persona:uuid}',[
        'uses' => 'Personas\PersonaController@edit',
		'as'   => 'personas.edit',
	]);

	Route::post('/store', [
		'uses' => 'Personas\PersonaController@store',
		'as'   => 'personas.store',
	]);


	Route::post('/{persona:uuid}', [
        'uses' => 'Personas\PersonaController@update',
		'as'   => 'personas.update',
    ]);

    /*
    Route::get('/delete/{grado}', [
        'uses' => 'Personas\PersonaController@destroy',
		'as'   => 'personas.destroy',
    ]);
    */

	Route::get('/{persona:uuid}/tutor', [
        'uses' => 'Personas\PersonaController@editarTutor',
		'as'   => 'personas.editarTutor',
    ]);

	Route::post('{persona:uuid}/tutor', [
        'uses' => 'Personas\PersonaController@storeTutor',
		'as'   => 'personas.storeTutor',
    ]);

    Route::get('/{persona:uuid}/alumno', [
        'uses' => 'Personas\PersonaController@editarAlumno',
        'as'   => 'personas.editarAlumno',
    ]);

    Route::post('{persona:uuid}/alumno', [
        'uses' => 'Personas\PersonaController@storeAlumno',
        'as'   => 'personas.storeAlumno',
    ]);
});
