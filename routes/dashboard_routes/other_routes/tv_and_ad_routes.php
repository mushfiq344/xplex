<?php
Route::group(['middleware' => ['checkSession']], function () {
    Route::post('/insert_tv_channel', 'dashboard\DashboardController@insert_tv_channel');
    Route::get('/delete_channel', 'dashboard\DeleteController@delete_channel');


    Route::get('/delete_ad', 'dashboard\DeleteController@delete_ad');
});