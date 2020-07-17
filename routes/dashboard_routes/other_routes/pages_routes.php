<?php

Route::group(['middleware' => ['checkSession']], function () {
    route::get('/dashboard_game', 'dashboard\PagesController@dashboard_game');
    route::get('/dashboard_reset_password', 'dashboard\PagesController@dashboard_reset_password');
    route::get('/dashboard_backup', 'dashboard\PagesController@dashboard_backup');
    route::get('/dashboard_users', 'dashboard\PagesController@dashboard_users');
    route::get('/dashboard_ads', 'dashboard\PagesController@dashboard_ads');
});

Route::group(['middleware' => ['checkUploader']], function () {
    route::get('/dashboard_tv_show', 'dashboard\PagesController@dashboard_tv_show');
    route::get('/dashboard_movie', 'dashboard\PagesController@dashboard_movie');
    route::get('/dashboard', 'dashboard\PagesController@dashboard_movie');
    route::get('/dashboard_explore', 'dashboard\PagesController@dashboard_explore');
});