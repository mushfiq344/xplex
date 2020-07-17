<?php
namespace App\Http\Controllers;
use App\Classes\PricesClass;
use Illuminate\Http\Request;
use App\companies;
use DB;
class HomeController extends Controller
{
    public $book = "Genesis";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query='no';
        return view('home',compact('query'));
    }
    public function profile()
    {
        $products=companies::all();
        return  view('profile');
        // return "hello";
    }
    public function func($id)
    {
        return  $id;
    }
////////////////////////////////////////////////////Get functions starts /////////////////////////////////////////////////////////////////////
    public function home(Request $request)
    {
        $query = $request;
//$pricesClass = new PricesClass();
        //   $prices = $pricesClass->getPrices();
        return view('home', compact('query'));
    }
    public function tv_show(Request $request)
    {
        $url   = $request->input('imdb_url');
        $data = str_replace("https://www.imdb.com/title/","",$url);
        $query= substr($data, 0, -1);
        return view('tv_show',compact('query'));
    }
    public function documentary(Request $request)
    {
        $url   = $request->input('imdb_url');
        $data = str_replace("https://www.imdb.com/title/","",$url);
        $query= substr($data, 0, -1);
        return view('documentary',compact('query'));
    }
    public function tv_episode()
    {
        $users = DB::table('tv_show')->get();
        return view('tv_episode',compact('users'));
    }
    public function movie(Request $request)
    {
/////////////////////////////////////////////////////////////////////
        $url   = $request->input('imdb_url');
        $data = str_replace("https://www.imdb.com/title/", "",$url);
        $query= substr($data, 0, -1);
/////////////////////////////////////////////////////////////////
        return view('movie', compact('query'));
    }
////////////////////// game info retrieve //////////////////////////////////////
    public function game(Request $request)
    {
        $query = $request;
        if(empty($query->input('igdb_id'))){
            return view('game_info');
        }
        return view('game', compact('query'));
    }
    public function game_info_post($id)
    {
        return view('game_info',compact('id'));
    }
///////////////////////////////////////////////////////////////////////////////
    public function get_series($id)
    {
        return view('tv_series_parse',compact('id'));
    }
    public function post_series($id)
    {
        return view('tv_series_parse',compact('id'));
    }
/////////////////////////////////////////////////Get functions end ////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// post functions starts ///////////////////////////////////////////
    public function insert_movie(Request $request)
    {
        $query = $request;
        $country_list = explode(',',$request->input('country'));
        $language_list = explode(',',$request->input('language'));
///////////////////////////////////////////////////////////////////////////
        $genre_list = explode(',',$request->input('genre'));
        for($i=0;$i<count($genre_list);$i++)
        {$table_row = DB::table('movie_genre')->where('genre_type', $genre_list[$i]);
            if($table_row->count()){
            }else{
                DB::insert('insert into movie_genre (genre_type)values(?)',[$genre_list[$i]]);
            }}
///////////////////////////////////////////////////////////////////////////
        $title = $request->input('title');
        /////////////////////////////////////////////////
        $released = $request->input('released');
        $released=strtotime($released);
        $released= date("Y-m-d ", $released);
        /////////////////////////////////////////////////
        $year = $request->input('year');
        $country = $request->input('country');
        $language = $request->input('language');
        $genre = $request->input('genre');
        $director = $request->input('director');
        $actors = $request->input('actors');
        $plot = $request->input('plot');
        $imdbrating = $request->input('imdbrating');
        $rottentomatoesrating = $request->input('rottentomatoesrating');
        $metacriticrating = $request->input('metacriticrating');
        if(!is_numeric($imdbrating)){
            $imdbrating=0;
        }
        if(!is_numeric($rottentomatoesrating)){
            $rottentomatoesrating=0;
        }
        if(!is_numeric($metacriticrating)){
            $metacriticrating=0;
        }
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        $cover_url_value = $request->input('cover_url_value');
        /////////////////////////////////////////////////////////////////////////////////
        $download_link_array = $request->input('download_links');
        $download_link = implode(",", $download_link_array);
        ///////////////////////////////////////////////////////////////////////////////
        $category_list=" ";
        $i=0;
        for($i=0;$i<15;$i++)
        {$val='category'.$i;
            if(!empty($request->input($val)))
            {$category_list.=$request->input($val).',';}}
        if(strtolower($language_list[0])=='english')  {
            $type='english'; }
        else if(strtolower($language_list[0])=='bengali')  {
            $type='bengali'; }
        else if(strtolower($language_list[0])=='hindi')  {
            $type='hindi';   }
        else if (strtolower($language_list[0])=='korean')  {
            $type='korean';  }
        else if (strtolower($language_list[0])!='hindi' &&  strtolower($country_list[0])=='india'     )  {
            $tyoe = 'south indian'; }
        else  { $type='others';}
        DB::insert('insert into movie (title,released,year,country,language,genre,director,actors,plot,imdbrating,rottentomatoesrating,metacriticrating,trailer_value,poster_url_value,cover_url_value,category,download_link,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [$title,$released,$year,$country,$language,$genre,$director,$actors,$plot,$imdbrating,$rottentomatoesrating,$metacriticrating,$trailer_value,$poster_url_value,$cover_url_value,$category_list,$download_link,$type]);
        return $query;
    }
    public function insert_tv_show(Request $request)
    {
        $query = $request;
        $title = $request->input('title');
        /////////////////////////////////////////////////
        $released = $request->input('released');
        $released=strtotime($released);
        $released= date("Y-m-d ", $released);
        /////////////////////////////////////////////////////////////////////////////////
        $genre = $request->input('genre');
        $genre_list = explode(',',$request->input('genre'));
        for($i=0;$i<count($genre_list);$i++)
        {$table_row = DB::table('tv_show_genre')->where('genre_type', $genre_list[$i]);
            if($table_row->count()){
            }else{
                DB::insert('insert into tv_show_genre (genre_type)values(?)',[$genre_list[$i]]);
            }}
////////////////////////////////////////////////////////////////////////////////////////
        $actors = $request->input('actors');
        $plot = $request->input('plot');
        $imdbrating = $request->input('imdbrating');
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        //////////////////////////////////////////////////////
        $cover_url_value = $request->input('cover_url_value');
        //////////////////////////////////////////////////////
        $base_url = $request->input('base_url');
        $base_url = str_replace('F:\\Tv Series\\', '', $base_url);
        DB::insert('insert into tv_show(title,released,genre,actors,plot,imdbrating,trailer_value,poster_url_value,cover_url_value,base_url) values(?,?,?,?,?,?,?,?,?,?)',[$title,$released,$genre,$actors,$plot,$imdbrating,$trailer_value,$poster_url_value,$cover_url_value,
            $base_url]);
        return $query;
    }
    public function insert_tv_episode(Request $request)
    {
        $title = $request->input('title');
        $season = $request->input('season');
        $episode = $request->input('episode');
        $link = $request->input('link');
        DB::insert('insert into tv_episode(title,season,episode,link) values(?,?,?,?)',[$title,$season,$episode,$link]);
        return $request;
    }
    public function insert_tutorial(Request $request)
    {
        $title = $request->input('title');
        $download_link = $request->input('download_link');
        $poster_url_value = $request->input('poster_url_value');
        DB::insert('insert into tutorial_table(title,download_link,poster_url_value) values(?,?,?)',[$title,$download_link,$poster_url_value]);
        return $request;
    }
    public function insert_documentary(Request $request)
    {
        $query = $request;
        $country_list = explode(',',$request->input('country'));
        $language_list = explode(',',$request->input('language'));
///////////////////////////////////////////////////////////////////////////
        $genre_list = explode(',',$request->input('genre'));
        for($i=0;$i<count($genre_list);$i++)
        {$table_row = DB::table('movie_genre')->where('genre_type', $genre_list[$i]);
            if($table_row->count()){
            }else{
                DB::insert('insert into movie_genre (genre_type)values(?)',[$genre_list[$i]]);
            }}
///////////////////////////////////////////////////////////////////////////
        $title = $request->input('title');
        /////////////////////////////////////////////////
        $released = $request->input('released');
        $released=strtotime($released);
        $released= date("Y-m-d ", $released);
        /////////////////////////////////////////////////
        $year = $request->input('year');
        $country = $request->input('country');
        $language = $request->input('language');
        $genre = $request->input('genre');
        $director = $request->input('director');
        $actors = $request->input('actors');
        $plot = $request->input('plot');
        $imdbrating = $request->input('imdbrating');
        $rottentomatoesrating = $request->input('rottentomatoesrating');
        $metacriticrating = $request->input('metacriticrating');
        if(!is_numeric($imdbrating)){
            $imdbrating=0;
        }
        if(!is_numeric($rottentomatoesrating)){
            $rottentomatoesrating=0;
        }
        if(!is_numeric($metacriticrating)){
            $metacriticrating=0;
        }
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        $cover_url_value = $request->input('cover_url_value');
        $download_link = $request->input('download_link');
        $category_list=" ";
        $i=0;
        for($i=0;$i<15;$i++)
        {$val='category'.$i;
            if(!empty($request->input($val)))
            {$category_list.=$request->input($val).',';}}
        DB::insert('insert into documentary (title,released,year,country,language,genre,director,actors,plot,imdbrating,rottentomatoesrating,metacriticrating,trailer_value,poster_url_value,cover_url_value,category,download_link) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [$title,$released,$year,$country,$language,$genre,$director,$actors,$plot,$imdbrating,$rottentomatoesrating,$metacriticrating,$trailer_value,$poster_url_value,$cover_url_value,$category_list,$download_link]);
        return $query;
        return $request;
    }
    public function insert_game(Request $request)
    {
        $type = $request->input('type');
        $title = $request->input('title');
        $released = $request->input('released');
        $genre = $request->input('genre');
///////////////////////////////////////////////////////////////////////////
        $genre_list = explode(',',$request->input('genre'));
        for($i=0;$i<count($genre_list);$i++)
        {
            $table_row = DB::table('game_genre')->where('genre_type', $genre_list[$i]);
            if($table_row->count()){
            }else{
                DB::insert('insert into game_genre (genre_type)values(?)',[$genre_list[$i]]);
            }
        }
///////////////////////////////////////////////////////////////////////////
        $plot = $request->input('plot');
        $igdbrating = $request->input('rating');
        $trailer_value = $request->input('trailer_value');
        $poster_url_value = $request->input('poster_url_value');
        $download_link = $request->input('download_link');
///////////////////////////////////////////////////////////////////////////
        $cover_url_value = $request->input('cover_url_value');
        ///////////////////////////////////////////////////////////////////////////
        if($type=='pc_game'){
            DB::insert('insert into pc_games (title,released,genre,plot,igdbrating,trailer_value,poster_url_value,cover_url_value,download_link) values(?,?,?,?,?,?,?,?,?)',[$title,$released,$genre,$plot,$igdbrating,$trailer_value,$poster_url_value,$cover_url_value,$download_link]);
        }
        else {
            DB::insert('insert into console_games  (title,released,genre,plot,igdbrating,trailer_value,poster_url_value,cover_url_value,download_link) values(?,?,?,?,?,?,?,?,?)',[$title,$released,$genre,$plot,$igdbrating,$trailer_value,$poster_url_value,$cover_url_value,$download_link]);
        }
    }
/////////////////////////////////////////////////////////// post functions end ///////////////////////////////////////////
}