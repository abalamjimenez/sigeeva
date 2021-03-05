<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'Calificaciones\CalificacionController@index',
        'as'   => 'calificacion.index',
    ]);

});
