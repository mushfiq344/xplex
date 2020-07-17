<?php

Route::group(['middleware' => ['checkSession']], function () {
    Route::get('/scan_movie/{type}', 'dashboard\ScanMovieController@scan_movie');
    Route::get('/scan_single_movie', 'dashboard\ScanMovieController@scan_single_movie');
    Route::get('/scan_tv_show/{type}', 'dashboard\ScanTvController@scan_tv_show');
    Route::get('/scan_single_tv_show', 'dashboard\ScanTvController@scan_single_tv_show');

// Db backup
    Route::get('/db_backup', function () {

        if (empty(Session::get('password'))) {
            return redirect('login')->with('alert', 'Session Expired!');
        }

        $now = Carbon\Carbon::now();

        Artisan::call('backup:mysql-dump', ['filename' => time() . '_db.sql']);

        return redirect()->back()->with('alert', 'Backup Complete !');

    });

});