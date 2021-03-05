<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@index',
        'as'   => 'modalidades.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@create',
        'as'   => 'modalidades.create',
    ]);

    Route::get('/{modalidad}',[
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@edit',
        'as'   => 'modalidades.edit',
    ]);

    Route::put('/{modalidad}', [
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@update',
        'as'   => 'modalidades.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@store',
        'as'   => 'modalidades.store',
    ]);

    Route::get('/confirmDelete/{modalidad}',[
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@confirmDelete',
        'as'   => 'modalidades.confirmDelete',
    ]);

    Route::delete('/delete/{modalidad}',[
        'uses' => 'ServiciosEscolares\Modalidades\ModalidadController@delete',
        'as'   => 'modalidades.delete',
    ]);
});
