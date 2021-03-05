<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/grupos', [
        'uses' => 'Historicos\GrupoController@index',
        'as'   => 'historicos.grupo.index',
    ]);

});
