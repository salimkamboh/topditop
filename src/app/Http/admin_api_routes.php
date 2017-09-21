<?php

Route::group(['middleware' => ['api'], 'prefix' => 'api/'], function () {
    Route::post('auth/login', ['as' => 'api.admin.login', 'uses' => 'AdminAuthController@apiAdminLogin']);
    Route::group(['middleware' => 'jwt.admin'], function () {
        Route::get('auth/check', ['as' => 'api.admin.check', 'uses' => 'AdminAuthController@apiAdminCheck']);
        Route::post('stores', ['as' => 'api.admin.stores.fullsetup', 'uses' => 'StoreController@fullSetup']);
    });
    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('auth/check/refresh', ['as' => 'api.admin.check', 'uses' => 'AdminAuthController@apiAdminCheck']);
    });

    Route::post('geo/find', ['as' => 'geo.find', 'uses' => 'GeocodeController@find']);
});