<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@index',
        'as'   => 'periodicidades.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@create',
        'as'   => 'periodicidades.create',
    ]);

    Route::get('/{periodicidad}',[
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@edit',
        'as'   => 'periodicidades.edit',
    ]);

    Route::put('/{periodicidad}', [
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@update',
        'as'   => 'periodicidades.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@store',
        'as'   => 'periodicidades.store',
    ]);

    Route::get('/confirmDelete/{periodicidad}',[
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@confirmDelete',
        'as'   => 'periodicidades.confirmDelete',
    ]);

    Route::delete('/delete/{periodicidad}',[
        'uses' => 'ServiciosEscolares\Periodicidades\PeriodicidadController@delete',
        'as'   => 'periodicidades.delete',
    ]);
});
