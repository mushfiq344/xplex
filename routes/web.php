<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*RASHIK DECLARED ROUTES*/

use Jenssegers\Agent\Agent;

Route::get('/', 'ShowDataController@index')->name('home');

Route::get('/test2', function (){

    return view('test2');


});

Route::get('/test','ShowDataController@Test');


Route::get('/video_pop/{video_file}','ShowDataController@video_pop');

Route::get('/movie/{id}/','ShowDataController@single_movie_page'); /*For single Movie */

Route::get('/pc_games/{id}/','ShowDataController@pc_games');     /*For single pc_games*/

Route::get('/tv_series/{id}','ShowDataController@single_tv_series_page'); /*For single tv-show*/

Route::get('/gallery/{movie}/{type}/{category}','ShowDataController@galleryForMovie');   /*For gallery for Movie*/

Route::get('/galleryForPcGame/{category}','ShowDataController@galleryForGame');         /*For gallery for game*/

Route::get('/galleryForTv/{tv_series}/{item}/{category}','ShowDataController@galleryForTv');         /*For gallery for tv*/

Route::get('/galleryGenreMovie/{movie}/{category}/{genre}','ShowDataController@galleryForGenreForMovie');   /*For gallery of Movie categories*/

Route::get('/galleryYearMovie/{movie}/{type}/{category}/{year}','ShowDataController@galleryForYearForMovie'); /*sort by Movie year*/


Route::get('/galleryForPcGameGenre/{category}/{genre}/','ShowDataController@galleryForGameForGenre');  /*For gallery for game categories*/

Route::get('/galleryForTvGenre/{category}/{genre}/','ShowDataController@galleryTvGenre');


Route::get('/movie/actors/{actor}','ShowDataController@findActor');                         /*For finding actors in single Movie page*/

Route::get('/movie/director/{director}','ShowDataController@findDirector');                /*For finding director*/

Route::get('/tv_series/{id}','ShowDataController@single_tv_series_page');              /*For tv series*/

Route::get('/tv_series_path/{base_url}','ShowDataController@get_seriesFile');          /* For file explorer */


Route::get('/wrestling',function (){

    return view('Tv.wrestling');

});


Route::get('/ajax/','ShowDataController@ajaxTest')->name('ajax');       /*   test run for ajax   */

Route::get('/ajax_search','ShowDataController@searchTerm');            /* For search */

Route::get('/ajax_all_search','ShowDataController@searchTermAll');            /* For search from all table */

Route::get('ajax_comment/{table}/{id}/{comment}','ShowDataController@postComment');   /*For ajax comment */

Route::get('list/{type}','ShowDataController@showList');                     /* For common list items*/

/*Login Route*/

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');           /*For facebook login */
/*Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');*/

Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');           /*For facebook login provider*/


Route::get('login/google', 'Auth\GoogleLoginController@redirectToProvider');           /*For facebook login */
/*Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');*/

Route::get('login/google/callback', 'Auth\GoogleLoginController@handleProviderCallback');


Route::get('sam_facebook',function (){
    return view('auth.sam_facebook');                                            /* For login facebook page*/
});

Route::get('facebook','Auth\SamFacebookController@check');                             /* for auth check  */


/* For user login */
Route::get('sam_login',function (){
    $agent = new Agent();
    if($agent->isMobile()){
        return view('auth.mobile_sam_login');
    }
    else {
        return view('auth.sam_login');
    }
});

Route::post('user_registration','Auth\SamFacebookController@register')->name('user_registration');        /* For user registration */

Route::get('/forum','Forum\ForumController@forum2');

Route::get('forum2','Forum\ForumController@forum2');

Route::get('/request','Forum\ForumController@request');

Route::get('/follow/{id}/{following}','Forum\ForumController@follow');

Route::get('live_tv',function (){
   return view('tv');

})->name('live_tv');

//ftp route

Route::get('/ftp/{type}/{any}','FtpController@ftpShow')->where('any','.*');

Route::get('/folder/{any}','FtpController@ftpAny')->where('any','.*');

Route::get('/check','FtpController@checkExtension');

Route::get('/back/{any}','FtpController@back')->where('any','.*');

Route::get('/software/{type}','ShowDataController@getSoftware');

Route::get('/galleryForNatok/{category}','ShowDataController@galleryNatok');

Route::get('/natok/{id}','ShowDataController@SingleNatok');

Route::get('gallery_music_video/{category}','ShowDataController@gallery_music_video');

Route::get('single_music_video/{id}','ShowDataController@single_music_video');


/*Mobile Code*/

Route::get('mobile/{any}/menu-find.html',function (){
    return view('Mobile.menu-find');
})->where('any','.*');

Route::get('mobile/menu-find.html',function (){
    return view('Mobile.menu-find');
});

Route::get('/menu-find.html',function (){
    return view('Mobile.menu-find');
});

Route::get('mobile/movie_gallery/{category}','Mobile\MobileController@movieGallery');

Route::get('mobile/movie_gallery/{genre}/{category}','Mobile\MobileController@movieGenreGallery');

Route::get('mobile/single_movie/{id}','Mobile\MobileController@single_movie');

Route::get('mobile/tv_gallery/{category}','Mobile\MobileController@tvGallery');

Route::get('mobile/single_tv/{id}','Mobile\MobileController@single_tv');

Route::get('mobile/Pc Games','Mobile\MobileController@galleryGames');

Route::get('mobile/Pc Games/{genre}','Mobile\MobileController@galleryGamesGenre');

Route::get('mobile/single_game/{id}','Mobile\MobileController@single_game');

Route::get('mobile/others','Mobile\MobileController@others');

Route::get('mobile/cartoon_gallery','Mobile\MobileController@galleryCartoon');

Route::get('mobile_search/{category}/{id}','Mobile\MobileController@mobile_search');

Route::get('mobile_sam_facebook',function (){
    return view('auth.mobile_sam_facebook');                                            /* For login facebook page*/
});
Route::get('mobile_sam_login',function (){
    return view('auth.mobile_sam_login');                                               /* For user login */
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});

/*  Abir Code */

////////////////////////Abir routes Starts///////////////////////
require_once "dashboard_routes/dashboard_routes.php";


//////////////////////Abir routes Ends//////////////////////////////////////////////////////
