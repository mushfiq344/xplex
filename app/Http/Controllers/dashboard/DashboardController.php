<?php

namespace App\Http\Controllers\dashboard;
use App\Models\Admins;
use Session;
use Illuminate\Http\Request;
use App\Classes\PricesClass;

use App\companies;
use DB;
use Image;
use Hash;
////////////////////////////////////////
use App\Http\Controllers\Controller;

///////////////////////////////////////

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    //insert into movie table functions   
    public function insert_movie(Request $request)
    {

//        return var_dump(get_movie_casts('tt0120338'));
        //Retrieving Genre and Checking them for duplicate values
        if($request->input('genre_movie')!='N/A')
        {
            $genre_list = explode(',',$request->input('genre_movie'));
            for($i=0;$i<count($genre_list);$i++)
            {
                $genre_list[$i]=ltrim($genre_list[$i]);
                $genre_list[$i]=rtrim($genre_list[$i]);

                $table_row = DB::table('movie_genre')->where('genre_type', $genre_list[$i]);
                if($table_row->count()>0){
                }
                else{
                    DB::insert('insert into movie_genre (genre_type)values(?)',[$genre_list[$i]]);
                }
            }
        } 
        $title = $request->input('title_movie');
        $production =  $request->input('production_movie');
        $released = $request->input('released_movie');

        $year = $request->input('year_movie');
        $country = $request->input('country_movie');
        $language = $request->input('language_movie');
        $genre = $request->input('genre_movie');
        $director = $request->input('director_movie');
        $actors = $request->input('actors_movie');
        $plot = $request->input('plot_movie');
        $imdbrating = $request->input('imdbrating_movie');
        $rottentomatoesrating = $request->input('rottentomatoesrating_movie');
        $metacriticrating = $request->input('metacriticrating_movie');

        $trailer_value = $request->input('trailer_value_movie');
        if($trailer_value=="N/A"){
            $trailer_value=default_trailer;
        }

        $download_link = ftp_movie_path.myUrlEncode($request->type_movie).'/'.myUrlEncode($request->year_movie).'/'.myUrlEncode($request->title_movie.'('.$request->year_movie.')');

         $print_type=$request->quality.'$$'.$request->resolution;
//

      

        $poster_url_value = $request->input('poster_url_value_movie');
        $poster_url_value =set_poster($poster_url_value,'movie');
        // fetching Cover photo
        $cover_url_value = $request->input('cover_url_value_movie');
        $cover_url_value = set_cover($cover_url_value,'movie');
        // Fetching download links of movie and the copies
        // type of movie
//        $type=get_show_type($genre,$download_link,
//            explode(',',$request->input('language_movie'))[0],
//            explode(',',$request->input('country_movie'))[0]);
        // return $type;
        $type=$request->type_movie;
     
        $imdb_id= $request->input('imdb_id_movie');
        // inserting the movie
        if(Session::get('admin_type')=="admin") {

            DB::insert('insert into movie (title,imdb_title,released,production,year,country,language,genre,director,actors,plot,imdbrating,rottentomatoesrating,metacriticrating,trailer_value,poster_url_value,cover_url_value,imdb_id,download_link,print_type,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [$title, $title, $released, $production, $year, $country, $language, $genre, $director, $actors, $plot, $imdbrating, $rottentomatoesrating, $metacriticrating, $trailer_value, $poster_url_value, $cover_url_value, $imdb_id, $download_link, $print_type, $type]);
        }else{
            DB::insert('insert into movie_approval (user_name,title,imdb_title,released,production,year,country,language,genre,director,actors,plot,imdbrating,rottentomatoesrating,metacriticrating,trailer_value,poster_url_value,cover_url_value,imdb_id,download_link,print_type,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [Session::get('username'), $title,$title, $released, $production, $year, $country, $language, $genre, $director, $actors, $plot, $imdbrating, $rottentomatoesrating, $metacriticrating, $trailer_value, $poster_url_value, $cover_url_value, $imdb_id, $download_link, $print_type, $type]);
        }


        return redirect()->back()->with('alert', 'Movie uploaded!');
    }
    //insert into tv_show table functions 
      public function insert_tv_show(Request $request)
    {

      $title = $request->input('title_tv_show');
      $released = $request->input('released_tv_show');
      $year = $request->input('year_tv_show');

      
      $country = $request->input('country_tv_show');
      $language = $request->input('language_tv_show');
      $genre  = $request->input('genre_tv_show');
      

      // inserting new genre 
      if($request->input('genre_tv_show')!='N/A')
      { 
        $genre_list = explode(',',$request->input('genre_tv_show'));
        for($i=0;$i<count($genre_list);$i++)
        {
          $genre_list[$i]=ltrim($genre_list[$i]);
          $genre_list[$i]=rtrim($genre_list[$i]);
          $table_row = DB::table('tv_show_genre')->where('genre_type', $genre_list[$i]);
          if($table_row->count()>0){
          }
          else{
            DB::insert('insert into tv_show_genre (genre_type)values(?)',[$genre_list[$i]]);
          }
        }
      }
      $actors = $request->input('actors_tv_show');
      $plot = $request->input('plot_tv_show');
      $imdbrating = $request->input('imdbrating_tv_show');

      $trailer_value = $request->input('trailer_value_tv_show');
      if($trailer_value=="N/A"){
        $trailer_value=$this->default_trailer;
      }

      $poster_url_value = $request->input('poster_url_value_tv_show');
      $poster_url_value =  set_poster($poster_url_value,'tv_show');
      $cover_url_value = $request->input('cover_url_value_tv_show');
      $cover_url_value= set_cover($cover_url_value,'tv_show');
      $download_link = $request->input('base_url');      
      // set to animation type for a condition
      if($genre=="N/A" && strpos(strtolower($download_link), 'anim') !== false){
        $genre="Animation";
      }
      // checking the type of tv_show
      $type=get_show_type($genre,$download_link,
          explode(',',$request->input('language_tv_show'))[0],
          explode(',',$request->input('country_tv_show'))[0]);



       $imdb_id= $request->input('imdb_id_tv_show');
        //inserting tv show
      DB::insert('insert into tv_show(title,imdb_title,released,year,country,language,genre,actors,plot,imdb_id,imdbrating,trailer_value,poster_url_value,cover_url_value,base_url,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$title,$title,$released,$year,$country,$language,$genre,$actors,$plot,$imdb_id,$imdbrating,$trailer_value,$poster_url_value,$cover_url_value,
      $download_link,$type]);
      return redirect()->back()->with('alert', 'Tv Show uploaded!');
    }
    //insert into game table functions
    public function insert_game(Request $request)
    {
      
      $type = $request->input('type');
      $title = $request->input('title_game');
      $publisher = $request->input('publisher_game');
      $igdb_id = $request->input('igdb_id');
      $data = new PricesClass();
      $list= $data->extract_rating($title);
      json_encode($list);
      $other_ratings='';
      foreach ($list as $key => $value) {
          // $arr[3] will be updated with each value from $arr...
        $other_ratings.=$key.'='.$value.',';
      }
      $other_ratings=rtrim($other_ratings,',');
      $released = $request->input('released_game');
      $genre = $request->input('genre_game');
      if($request->input('genre_game')!='N/A')
      {   
        $genre_list = explode(',',$request->input('genre_game'));
        for($i=0;$i<count($genre_list);$i++)
        {
        
          $genre_list[$i]=ltrim($genre_list[$i]);
          $genre_list[$i]=rtrim($genre_list[$i]);
        
          $table_row = DB::table('game_genre')->where('genre_type', $genre_list[$i]);
          if($table_row->count()){
          }
          else{
            DB::insert('insert into game_genre (genre_type)values(?)',[$genre_list[$i]]);
          }
        }
      }
      $plot = $request->input('plot_game');
      $igdbrating = $request->input('rating_game');
      $trailer_value = $request->input('trailer_value_game');
      if($trailer_value=="N/A"){
        $trailer_value=$this->default_trailer;
      }
      $poster_url_value = $request->input('poster_url_value_game');
      // check url//
      $poster_url_value = set_poster($poster_url_value,'pc_games');

      $cover_url_value = $request->input('cover_url_value_game');
      // check url//
      $cover_url_value = set_cover($cover_url_value,'pc_games');


      $download_link = $request->input('download_links_game');


      DB::insert('insert into pc_games (title,released,publisher,genre,plot,igdbrating,other_ratings,trailer_value,poster_url_value,cover_url_value,download_link,igdb_id) values(?,?,?,?,?,?,?,?,?,?,?,?)',[$title,$released,$publisher,$genre,$plot,$igdbrating,$other_ratings,$trailer_value,$poster_url_value,$cover_url_value,$download_link,$igdb_id]);
      return redirect()->back()->with('alert', 'Game uploaded!');
    }

    public function upload_admin(Request $request){

        $admin=Admins::where('user_name',$request->username)->get();
        if(count($admin)!=0){
            return redirect()->back()->with('alert', 'Username already Exists!');
        }
        $admin = new Admins();
        $admin->user_name=$request->username;
        $admin->password=Hash::make($request->{'password'});
        $admin->admin_type='uploader';
        $admin->save();
        return redirect('dashboard_users');
    }
}







