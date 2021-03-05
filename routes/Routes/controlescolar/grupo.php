<?php
Route::group([ 'prefix' => '/' ], function () {

	Route::get('/grupo/index', [
		'uses' => 'ControlEscolar\Grupo\GrupoController@index',
		'as'   => 'controlescolar.grupo.index',
	]);

    Route::get('/grupo-historico/index', [
        'uses' => 'ControlEscolar\Grupo\GrupoController@historico',
        'as'   => 'controlescolar.grupo.historico',
    ]);

});
