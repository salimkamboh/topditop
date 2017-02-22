<?php

Route::get('access', ['as' => 'access.show', 'uses' => 'Auth\AuthController@showAccessPage']);
Route::post('access', ['as' => 'access.attempt', 'uses' => 'Auth\AuthController@attemptAccess']);

Route::group(['middleware' => ['api'], 'prefix' => 'api/'], function () {
    Route::post('auth/login', ['as' => 'api.admin.login', 'uses' => 'AdminAuthController@apiAdminLogin']);
    Route::group(['middleware' => 'jwt.admin'], function () {
        Route::get('auth/check', ['as' => 'api.admin.check', 'uses' => 'AdminAuthController@apiAdminCheck']);
    });
    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('auth/check/refresh', ['as' => 'api.admin.check', 'uses' => 'AdminAuthController@apiAdminCheck']);
    });
});