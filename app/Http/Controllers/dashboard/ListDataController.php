<?php

namespace App\Http\Controllers\dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
class ListDataController extends Controller
{
    var $pagintaion = 50;
    public function __construct()
    {}
    //Pages Controller 
        public function show_ads(Request $request)
    {  
        $ads= DB::table('tv_ads_list')->get();        
        return view('show_data_list.show_ads',compact('ads'));  
    }

    public function show_movies(Request $request)
    {  
        $movies = DB::table('movie')->paginate($this->pagintaion);

        return view('show_data_list.show_movies')->with('movies',$movies);
    }
    public function show_tv_shows(Request $request)
    {
	    $authors = DB::table('tv_show')->paginate($this->pagintaion);
        Session::put(['tv_shows'=>$authors]);
        return view('show_data_list.show_tv_shows');
    }
    public function show_pc_games(Request $request)
    {
	    $authors = DB::table('pc_games')->paginate($this->pagintaion);
        Session::put(['pc_games'=>$authors]);
        return view('show_data_list.show_pc_games');
    }

    // Search list
    public function show_tv_shows_search($id)
    {
	    $authors = DB::table('tv_show')
            ->where('title', 'like', '%'.$id.'%')
            ->paginate($this->pagintaion);
        Session::put(['tv_shows'=>$authors]);
        return view('show_data_list.show_tv_shows');
    }
    public function show_movies_search($title)
    {
	   $authors = DB::table('movie')
                ->where('title', 'like', '%'.$title.'%')
                ->paginate($this->pagintaion);
        Session::put(['movies'=>$authors]);
        return view('show_data_list.show_movies',compact('authors'));
    }
    public function show_pc_games_search($title)
    {
	    $authors = DB::table('pc_games')
                ->where('title', 'like', '%'.$title.'%')
                ->paginate($this->pagintaion);
        Session::put(['pc_games'=>$authors]);
        return view('show_data_list.show_pc_games');
    }
//    approval

    public function show_requested_movies(){

        if(Session::get('admin_type')=="admin"){
            $movies = DB::table('movie_approval')->where('status',0)->get();
        }
        else{
//            $movies = DB::table('movie_approval')->get();
            $movies = DB::table('movie_approval')->where('user_name',Session::get('username'))->where('status',0)->get();
        }
        return view('show_data_list.show_requested_movies')->with('movies',$movies);
    }
}
