<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'Administrativos\AdministrativoController@index',
        'as'   => 'administrativos.index',
    ]);

    // C R E A R   A D M I N I S T R A T I V O

    Route::get('/create', [
        'uses' => 'Administrativos\AdministrativoController@create',
        'as'   => 'administrativos.create',
    ]);

    // E D I T A R   A D M I N I S T R A T I V O

    Route::get('/{persona:uuid}',[
        'uses' => 'Administrativos\AdministrativoController@edit',
        'as'   => 'administrativos.edit',
    ]);

    // A C T U A L I Z A R   A D M I N I S T R A T I V O

    Route::post('/{persona:uuid}', [
        'uses' => 'Administrativos\AdministrativoController@update',
        'as'   => 'administrativos.update',
    ]);

});
