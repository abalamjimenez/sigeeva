<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/paseDeLista', [
        'uses' => 'Tools\ToolController@paseDeLista',
        'as'   => 'tools.paseDeLista',
    ]);

});
