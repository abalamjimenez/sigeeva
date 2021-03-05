<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/grupos-asignados', [
        'uses' => 'Docentes\DocenteController@gruposAsignados',
        'as'   => 'docente.gruposAsignados',
    ]);


    Route::get('/', [
        'uses' => 'Docentes\DocenteController@index',
        'as'   => 'docentes.index',
    ]);

    // C R E A R   D O C E N T E

    Route::get('/create', [
        'uses' => 'Docentes\DocenteController@create',
        'as'   => 'docentes.create',
    ]);

    // E D I T A R   D O C E N T E

    Route::get('/{persona:uuid}',[
        'uses' => 'Docentes\DocenteController@edit',
        'as'   => 'docentes.edit',
    ]);

    // A C T U A L I Z A R   D O C E N T E

    Route::post('/{persona:uuid}', [
        'uses' => 'Docentes\DocenteController@update',
        'as'   => 'docentes.update',
    ]);

    Route::post('/', [
        'uses' => 'Docentes\DocenteController@store',
        'as'   => 'docentes.store',
    ]);

});
