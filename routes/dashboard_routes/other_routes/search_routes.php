<?php
Route::group(['middleware' => ['checkSession']], function () {

    Route::get('/search_game', 'dashboard\SearchController@search_game');
    Route::get('/search_single_game', 'dashboard\SearchController@search_single_game');
});

Route::group(['middleware' => ['checkUploader']], function () {
    Route::get('/search_tv_show', 'dashboard\SearchController@search_tv_show');
    Route::get('/search_movie', 'dashboard\SearchController@search_movie');
});