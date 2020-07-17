<?php

Route::group(['middleware' => ['checkSession']], function () {
    Route::get('/edit_pc_games/{id}', 'dashboard\PagesController@edit_pc_games');
    Route::get('/save_edited_pc_games/edit_pc_games/{id}', 'dashboard\EditController@edit_pc_games');
    Route::get('/show_pc_games_search/edit_pc_games/{id}', 'dashboard\EditController@edit_pc_games');
    Route::get('/delete_pc_games', 'dashboard\DeleteController@delete_pc_games');

    Route::get('/search_pc_games_from_table', 'dashboard\TableSearchController@search_pc_games_from_table');
    Route::get('/search_single_pc_games_from_table', 'dashboard\TableSearchController@search_single_pc_games_from_table');

    Route::post('/save_edited_pc_games/{id}', 'dashboard\EditController@save_edited_pc_games');
});