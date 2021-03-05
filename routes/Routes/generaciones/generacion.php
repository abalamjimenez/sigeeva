<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@index',
        'as'   => 'generaciones.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@create',
        'as'   => 'generaciones.create',
    ]);

    Route::get('/{generacion}',[
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@edit',
        'as'   => 'generaciones.edit',
    ]);

    Route::put('/{generacion}', [
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@update',
        'as'   => 'generaciones.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@store',
        'as'   => 'generaciones.store',
    ]);

    Route::get('/confirmDelete/{generacion}',[
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@confirmDelete',
        'as'   => 'generaciones.confirmDelete',
    ]);

    Route::delete('/delete/{generacion}',[
        'uses' => 'ServiciosEscolares\Generaciones\GeneracionController@delete',
        'as'   => 'generaciones.delete',
    ]);
});
