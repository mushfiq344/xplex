<?php

Route::group(['middleware' => ['checkSession']], function () {
    Route::get('/show_ads', 'dashboard\ListDataController@show_ads');

    Route::get('/show_movies', 'dashboard\ListDataController@show_movies');



    Route::get('/show_tv_shows', 'dashboard\ListDataController@show_tv_shows');
    Route::get('/show_tv_shows_search/{title}', 'dashboard\ListDataController@show_tv_shows_search');
    Route::get('/show_tv_shows_search/', 'dashboard\ListDataController@show_tv_shows');


    Route::get('/show_pc_games', 'dashboard\ListDataController@show_pc_games');
    Route::get('/show_pc_games_search/{title}', 'dashboard\ListDataController@show_pc_games_search');
    Route::get('/show_pc_games_search/', 'dashboard\ListDataController@show_pc_games');


});

Route::group(['middleware' => ['checkUploader']], function () {
    Route::get('/show_requested_movies', 'dashboard\ListDataController@show_requested_movies');
});
