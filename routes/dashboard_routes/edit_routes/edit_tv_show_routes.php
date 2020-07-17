<?php
Route::group(['middleware' => ['checkSession']], function () {
    Route::get('/edit_tv_show/{id}', 'dashboard\PagesController@edit_tv_show');
    Route::get('/save_edited_tv_show/edit_tv_show/{id}', 'dashboard\EditController@edit_tv_show');
    Route::get('/show_tv_shows_search/edit_tv_show/{id}', 'dashboard\EditController@edit_tv_show');
    Route::get('/delete_tv_show', 'dashboard\DeleteController@delete_tv_show');
    Route::get('/search_tv_show_from_table', 'dashboard\TableSearchController@search_tv_show_from_table');
    Route::get('/search_single_tv_show_from_table', 'dashboard\TableSearchController@search_single_tv_show_from_table');
    Route::post('/save_edited_tv_show/{id}', 'dashboard\EditController@save_edited_tv_show');
});