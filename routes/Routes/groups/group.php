<?php
Route::group([ 'prefix' => '/' ], function () {

    Route::get('/', [
        'uses' => 'Groups\GroupController@index',
        'as'   => 'groups.index',
    ]);

});
