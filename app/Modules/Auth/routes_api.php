<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'LoginController@login')->name('login');

    Route::group(['middleware' => 'jwt'], function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::post('me', 'UserController@me')->name('me');
    });

});
