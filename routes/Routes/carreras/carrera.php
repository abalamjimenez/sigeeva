<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@index',
        'as'   => 'carreras.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@create',
        'as'   => 'carreras.create',
    ]);

    Route::get('/{carrera}',[
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@edit',
        'as'   => 'carreras.edit',
    ]);

    Route::put('/{carrera}', [
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@update',
        'as'   => 'carreras.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@store',
        'as'   => 'carreras.store',
    ]);

    Route::get('/confirmDelete/{carrera}',[
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@confirmDelete',
        'as'   => 'carreras.confirmDelete',
    ]);

    Route::delete('/delete/{carrera}',[
        'uses' => 'ServiciosEscolares\Carreras\CarreraController@delete',
        'as'   => 'carreras.delete',
    ]);
});
