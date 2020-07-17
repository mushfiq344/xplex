<?php
route::get('/insert_movie','dashboard\ErrorController@handle_error');
route::get('/insert_tv_show','dashboard\ErrorController@handle_error');
route::get('/insert_game','dashboard\ErrorController@handle_error');


Route::get('/save_edited_movie','dashboard\ErrorController@handle_error');
Route::get('/save_edited_tv_show','dashboard\ErrorController@handle_error');
Route::get('/save_edited_pc_games','dashboard\ErrorController@handle_error');



Route::get('/save_edited_movie/{id}','dashboard\ErrorController@handle_error');
Route::get('/save_edited_tv_show/{id}','dashboard\ErrorController@handle_error');
Route::get('/save_edited_pc_games/{id}','dashboard\ErrorController@handle_error');
