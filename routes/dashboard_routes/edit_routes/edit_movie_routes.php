<?php
Route::group(['middleware' => ['checkSession']], function () {
});
Route::group(['middleware' => ['checkUploader']], function () {
    Route::get('/edit_movie/{table}/{id}', 'dashboard\PagesController@edit_movie');
    Route::post('/save_edited_movie', 'dashboard\EditController@save_edited_movie');
    Route::get('/delete_content', 'dashboard\DeleteController@delete_content');
});

