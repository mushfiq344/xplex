<?php

Route::group(['middleware' => ['checkSession']], function () {
    Route::get('/edit_admin', 'dashboard\EditController@edit_admin');
    Route::get('/delete_admin', 'dashboard\DeleteController@delete_admin');
});