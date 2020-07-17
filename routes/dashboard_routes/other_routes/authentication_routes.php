<?php

// routes to authenticate
Route::get('/login','dashboard\PagesController@login');
route::post('/login', 'dashboard\PagesController@set_session');

Route::group(['middleware' => ['checkSession']], function () {

    Route::get('/logout', 'dashboard\PagesController@logout');
    Route::get('/signout', 'dashboard\PagesController@signout');
    route::get('/authenticate', 'dashboard\PagesController@authenticate');

    route::get('/reset_password', 'dashboard\PagesController@dashboard_movie');
    route::post('/reset_password', 'dashboard\PasswordController@reset_password');
});