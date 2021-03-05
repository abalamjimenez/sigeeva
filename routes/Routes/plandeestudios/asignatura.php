<?php
Route::group([ 'prefix' => '/' ], function () {

	Route::get('/asignaturas', [
		'uses' => 'PlanDeEstudios\AsignaturaController@index',
		'as'   => 'plandeestudios.asignaturas.index',
	]);

    Route::get('/asignaturas/create', [
        'uses' => 'PlanDeEstudios\AsignaturaController@create',
        'as'   => 'plandeestudios.asignaturas.create',
    ]);

    Route::get('/asignaturas/{asignatura}', [
        'uses' => 'PlanDeEstudios\AsignaturaController@edit',
        'as'   => 'plandeestudios.asignaturas.edit',
    ]);

    Route::post('/{asignatura}', [
        'uses' => 'PlanDeEstudios\AsignaturaController@update',
        'as'   => 'plandeestudios.asignaturas.update',
    ]);

    Route::post('/asignaturas', [
        'uses' => 'PlanDeEstudios\AsignaturaController@store',
        'as'   => 'plandeestudios.asignaturas.store',
    ]);
});
