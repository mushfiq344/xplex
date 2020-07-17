<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use File;
use Image;
class TableSearchController extends Controller
{
    private $default_poster;
     private $default_cover;
    private $default_trailer;   
    private $domain_name;
    private $pattern_image;
    private $pattern_url;

    public function __construct()
    {
      $this->domain_name ='http://127.0.0.1:8000/';
      $this->default_poster="/default_images/default_poster.jpg";
      $this->default_trailer='https://www.youtube.com/watch?v=Q4dfXFDctfQ';
      $this->pattern_image= '/[\w\-]+\.(jpg|png|gif|jpeg)/';
      $this->pattern_url='%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i';
      $this->default_cover="/default_images/default_cover.jpg";  
    }

    // search movie having similar substring in name
    public function search_movie_from_Table(Request $request)
    {
   	    if($request->ajax())
   	    {
            $table_row = DB::table('movie')->where('title','like','%' .$request->search.'%')->get();
            $output="";
            foreach ($table_row as $movie) 
            {
                $output.='<tr>'.'<td><button   id="'.$movie->id.'" class="clickMe btn btn-link" >'.$movie->title.'</button></td>'.'</tr>';
            } 
            return Response($output);
        }
    }
    // search a single movie
    public function search_single_movie_from_Table(Request $request)
    {
   	    if($request->ajax())
   	    {
            $movie = DB::table('movie')->where('id', '=', $request->search)->get(); 
            return Response($movie);
        }
    }


    // fetch tv show with name having substring
    public function search_tv_show_from_table(Request $request)
    {
 	      if($request->ajax())
 	      {
            $table_row = DB::table('tv_show')->where('title','like','%' .$request->search.'%')->get();;
            $output="";
            foreach ($table_row as $tv_show) {
                $output.='<tr>'.'<td><button   id="'.$tv_show->id.'"   class="clickMe btn btn-link" >'.$tv_show->title.'</button></td>'.'</tr>';
            } 
            return Response($output);
        }
    }
    // fetch a single tv show
    public function search_single_tv_show_from_table(Request $request)
    {
 	      if($request->ajax())
 	      {
            $tv_show = DB::table('tv_show')->where('id', '=', $request->search)->get(); 
            return Response($tv_show);
        }
    }


    // search pc games from table with same substring
    public function search_pc_games_from_Table(Request $request)
    {
   	    if($request->ajax())
   	    {
            $table_row = DB::table('pc_games')->where('title','like','%' .$request->search.'%')->get();
            $output="";
            foreach ($table_row as $game) {
                $output.='<tr>'.
                '<td><button   id="'.$game->id.'"   class="clickMe btn btn-link" >'.$game->title.'</button></td>'.
                  '</tr>';
            } 
            return Response($output);
        }
    }
    // search single game
    public function search_single_pc_games_from_table(Request $request)
    {
   	    if($request->ajax())
   	    {
            $pc_game = DB::table('pc_games')->where('id', '=', $request->search)->get(); 
            return Response($pc_game);
        }
    }
}