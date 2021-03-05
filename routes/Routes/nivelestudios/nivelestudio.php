<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@index',
        'as'   => 'nivelestudios.index',
    ]);

    Route::get('/create', [
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@create',
        'as'   => 'nivelestudios.create',
    ]);

    Route::get('/{nivelestudio}',[
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@edit',
        'as'   => 'nivelestudios.edit',
    ]);

    Route::put('/{nivelestudio}', [
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@update',
        'as'   => 'nivelestudios.update',
    ]);

    Route::post('/store', [
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@store',
        'as'   => 'nivelestudios.store',
    ]);

    Route::get('/confirmDelete/{nivelestudio}',[
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@confirmDelete',
        'as'   => 'nivelestudios.confirmDelete',
    ]);

    Route::delete('/delete/{nivelestudio}',[
        'uses' => 'ServiciosEscolares\Nivelestudios\NivelEstudioController@delete',
        'as'   => 'nivelestudios.delete',
    ]);
});
