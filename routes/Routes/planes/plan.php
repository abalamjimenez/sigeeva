<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@index',
        'as'   => 'planes.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@create',
        'as'   => 'planes.create',
    ]);

    Route::get('/{plan}',[
        'uses' => 'ServiciosEscolares\Planes\PlanController@edit',
        'as'   => 'planes.edit',
    ]);

    Route::put('/{plan}', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@update',
        'as'   => 'planes.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@store',
        'as'   => 'planes.store',
    ]);

    Route::get('/confirmDelete/{plan}',[
        'uses' => 'ServiciosEscolares\Planes\PlanController@confirmDelete',
        'as'   => 'planes.confirmDelete',
    ]);

    Route::delete('/delete/{plan}',[
        'uses' => 'ServiciosEscolares\Planes\PlanController@delete',
        'as'   => 'planes.delete',
    ]);

    // --------
    // PLANES - MODALIDAD
    // --------

    Route::get('/{plan}/modalidad', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@agregarModalidad',
        'as'   => 'planes.agregarModalidad',
    ]);

    Route::post('{plan}/modalidad', [
        'uses' => 'ServiciosEscolares\Planes\PlanController@storeModalidad',
        'as'   => 'planes.storeModalidad',
    ]);
});
