<?php

Route::get('/drawing', 'KioskController@drawing');
Route::get('/{id?}', 'KioskController@index');

Route::group(['prefix' => 'kiosk'], function(){
    Route::get('/published/{id?}', 'KioskController@published');
    Route::get('/preview/{id?}', 'KioskController@preview');
});

Route::group(['prefix' => 'publish'], function(){
    Route::get('/version', 'PublishController@getVersion');
    Route::get('/data', 'PublishController@getData');
});

Route::group(['prefix' => 'back-office', 'namespace' => 'Office'], function(){
    Route::group(['prefix' => 'publish'], function(){
        Route::post('/create', 'PublishController@postCreate');
    });

    Route::group(['prefix' => 'block'], function(){
        Route::get('/edit/{id}', 'BlockController@getEdit');
        Route::post('/edit/{id}', 'BlockController@postEdit');
    });
    Route::group(['prefix' => 'level'], function(){
        Route::get('/', 'LevelController@index');
        Route::get('/list/{block_id?}', 'LevelController@getList');
        Route::get('/edit/{id}', 'LevelController@getEdit');
        Route::post('/edit/{id}', 'LevelController@postEdit');
    });
    Route::group(['prefix' => 'category'], function(){
        Route::get('/list', 'CategoryController@getList');
        Route::post('/create', 'CategoryController@postCreate');
        Route::post('/edit', 'CategoryController@postEdit');
        Route::post('/delete', 'CategoryController@postDelete');
        Route::post('/order/{id}', 'CategoryController@postOrder');
    });
    Route::group(['prefix' => 'zone'], function(){
        Route::get('/', 'ZoneController@index');
        Route::get('/list/{level_id}', 'ZoneController@getList');
        Route::get('/create/{level_id}', 'ZoneController@getCreate');
        Route::get('/edit/{id}', 'ZoneController@getEdit');
        Route::post('/create', 'ZoneController@postCreate');
        Route::post('/edit', 'ZoneController@postEdit');
        Route::post('/delete', 'ZoneController@postDelete');
    });
    Route::group(['prefix' => 'area'], function(){
        Route::get('/', 'AreaController@index');
        Route::get('/list/{level_id}', 'AreaController@getList');
        Route::get('/create', 'AreaController@getCreate');
        Route::get('/edit/{id}', 'AreaController@getEdit');
        Route::post('/create', 'AreaController@postCreate');
        Route::post('/edit', 'AreaController@postEdit');
        Route::post('/delete', 'AreaController@postDelete');
    });
});