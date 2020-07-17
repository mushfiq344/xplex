<?php
Route::group(['middleware' => ['checkSession']], function () {

    route::post('/insert_game', 'dashboard\DashboardController@insert_game');
    Route::post('/upload_channel_ads', 'dashboard\AdsController@upload_channel_ads');
    Route::post('/upload_admin', 'dashboard\DashboardController@upload_admin');
});
Route::group(['middleware' => ['checkUploader']], function () {
    route::post('/insert_movie', 'dashboard\DashboardController@insert_movie');
    route::post('/insert_tv_show', 'dashboard\DashboardController@insert_tv_show');
});