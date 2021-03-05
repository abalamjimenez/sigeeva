<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/descargar-cuentas', [
        'uses' => 'Grupos\GrupoController@descargarCuentas',
        'as'   => 'grupos.descargarCuentas',
    ]);


    Route::get('/estadisticas-captura', [
        'uses' => 'Grupos\GrupoController@estadisticasCaptura',
        'as'   => 'grupo.estadisticasCaptura',
    ]);


    Route::get('/{grupo}/descargar-datos-contacto', [
        'uses' => 'Grupos\GrupoController@descargarDatosContacto',
        'as'   => 'grupos.descargarDatosContacto',
    ]);

    Route::get('/{grupo}/imprimir-listado-grupo', [
        'uses' => 'Grupos\GrupoController@imprimirListadoGrupo',
        'as'   => 'grupos.imprimirListadoGrupo',
    ]);

    Route::get('/{grupo}/imprimir-sabana-grupo', [
        'uses' => 'Grupos\GrupoController@imprimirSabanaGrupo',
        'as'   => 'grupos.imprimirSabanaGrupo',
    ]);

    Route::get('/{grupo}/cuentas', [
        'uses' => 'Grupos\GrupoController@imprimirCuentas',
        'as'   => 'grupos.imprimirCuentas',
    ]);

    Route::get('/{asignaturaGrupo:uuid}/capturar-calificaciones-admin', [
        'uses' => 'Grupos\GrupoController@capturarCalificacionesAdmin',
        'as'   => 'grupos.capturarCalificacionesAdmin',
    ]);

    Route::post('/{asignaturaGrupo}/almacenar-calificaciones-admin', [
        'uses' => 'Grupos\GrupoController@almacenarCalificacionesAdmin',
        'as'   => 'grupos.almacenarCalificacionesAdmin',
    ]);

    Route::get('/{asignaturaGrupo:uuid}/capturar-calificaciones', [
        'uses' => 'Grupos\GrupoController@capturarCalificaciones',
        'as'   => 'grupos.capturarCalificaciones',
    ]);


    Route::post('/{asignaturaGrupo}/almacenar-calificaciones', [
        'uses' => 'Grupos\GrupoController@almacenarCalificaciones',
        'as'   => 'grupos.almacenarCalificaciones',
    ]);

    Route::get('/{asignaturaGrupo}/imprimir-listado', [
        'uses' => 'Grupos\GrupoController@imprimirListado',
        'as'   => 'grupos.imprimirListado',
    ]);

    Route::get('/', [
        'uses' => 'Grupos\GrupoController@index',
        'as'   => 'grupo.index',
    ]);

});
