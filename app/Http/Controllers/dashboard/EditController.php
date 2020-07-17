<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use File;
use Image;
use Hash;
class EditController extends Controller
{
    public function __construct()
    {

    }
    // save edited movie
    public function save_edited_movie(Request $request)
    {
//         return $request;
        $id=$request->id;
        $table_name=$request->table_name;
        $title = $request->input('title');
        $imdb_title = $request->input('imdb_title');
        $released = $request->input('released');
        // fetching released date and converting it
        $production =  $request->input('production');
        $year = $request->input('year');
        $type = $request->input('type');
        // process the links
        $download_link=$request->input('download_link_movie');
        
        $language = $request->input('language');
        $genre = $request->input('genre');
        $country = $request->input('country');
        $language = $request->input('language');
        $genre = $request->input('genre');
        $director = $request->input('director');
        $actors = $request->input('actors');
        $plot = $request->input('plot');
        $imdbrating = $request->input('imdbrating');
        $rottentomatoesrating = $request->input('rottentomatoesrating');
        $metacriticrating = $request->input('metacriticrating');

        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        $cover_url_value = $request->input('cover_url_value');
        // check url for poster//
        $poster_url_value = edit_poster($poster_url_value,$id,$table_name);
        // end check url for poster
        // check url for cover//
        $cover_url_value = edit_cover($cover_url_value,$id,$table_name);
        // end check url for cover

        if($trailer_value=="N/A"){
            $trailer_value=default_trailer;
        }

        
        $category_list="N/A";
        \DB::table($table_name)->where('id', $id)->update(
        [
            'title'      => $title,
            'imdb_title'      => $imdb_title,
          'released'             => $released,
            'production' => $production,
            'year'      => $year,
            'country'             => $country,
            'language'       => $language,
            'genre'       => $genre,
            'director'          => $director,
              'actors'          => $actors,
                'plot'          => $plot,
                  'imdbrating'          => $imdbrating,
            'rottentomatoesrating'  => $rottentomatoesrating,
            'metacriticrating' => $metacriticrating,
             'trailer_value' => $trailer_value,
             'poster_url_value' => $poster_url_value,
             'cover_url_value' => $cover_url_value,
             'download_link' =>   $download_link,
             'type' =>   $type
        ]
        );
        if($table_name=="movie"){
            return redirect('show_movies');
        }else{
            return redirect('show_requested_movies');
        }
    }

    // save edited tv show
    public function save_edited_tv_show($id,Request $request)
    {
        // return $request;
        $title = $request->input('title');
        $imdb_title = $request->input('imdb_title');
        $released = $request->input('released');

        $year=$request->input('year');
        $language=$request->input('language');
        $country=$request->input('country');

        $released=strtotime($released);
        $released= date("Y-m-d ", $released);
        $language = $request->input('language');
        $genre = $request->input('genre');
        $genre = $request->input('genre');
        $actors = $request->input('actors');
        $plot = $request->input('plot');
        $imdbrating = $request->input('imdbrating');
        if(!is_numeric($imdbrating)){
            $imdbrating=0;
        }
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        // check url//
        $poster_url_value=edit_poster($poster_url_value,$id,'tv_show');
        // end check url
        $cover_url_value = $request->input('cover_url_value');
        $cover_url_value = edit_cover($cover_url_value,$id,'tv_show');
        if($trailer_value=="N/A"){
            $trailer_value=default_trailer;
        }
        $base_url=  $request->input('base_url');
        \DB::table('tv_show')->where('id', $id)->update(
        [
            'title'      => $title,
            'imdb_title'      => $imdb_title,
          'released'             => $released,
          'year'    => $year,
          'language' => $language,
          'country' => $country,
            'genre'       => $genre,
              'actors'          => $actors,
                'plot'          => $plot,
                  'imdbrating'          => $imdbrating,
             'trailer_value' => $trailer_value,
             'poster_url_value' => $poster_url_value,
             'cover_url_value' => $cover_url_value,
             'base_url' =>   $base_url


        ]);
        return view('show_data_list.show_tv_shows');
    }
    // save edited game
    public function save_edited_pc_games($id,Request $request)
    {
        $title = $request->input('title');
        $links =$request->input('download_links_pc_games');
        $genre = $request->input('genre');
        $plot = $request->input('plot');
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        $cover_url_value = $request->input('cover_url_value');
        if($trailer_value=="N/A"){
            $trailer_value=default_trailer;
        }
        // check url//
        $poster_url_value=edit_poster($poster_url_value,$id,'pc_games');
        // end check url
        $cover_url_value=edit_cover($cover_url_value,$id,'pc_games');
        \DB::table('pc_games')->where('id', $id)->update(
        [
          'title'      => $title,
          'genre'       => $genre,
          'plot'          => $plot,                  
          'trailer_value' => $trailer_value,
          'poster_url_value' => $poster_url_value,
          'cover_url_value' => $cover_url_value,
          'download_link' =>   $links
        ]);
        return view('show_data_list.show_pc_games');
    }


    public function edit_admin(Request $request)
    {
        if($request->ajax()){
           $admin = Admins::where('user_name',$request->username)->first();
           $admin->password=Hash::make($request->{'password'});
           $admin->save();
           return Response('done');

        }
    }



}