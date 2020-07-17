<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

use Illuminate\Support\Facades\Paginator;

class ShowDataController extends Controller
{
    //
    var $pagination = 30;


    public function index()
    {
        $agent = new Agent();
        $limit = 6;

        $result = DB::table('movie')->where('poster_url_value', "!=", "/default_images/Tv_Series.jpg")->orderByDesc('created_at')->limit(12)->get();

        $game = DB::table('pc_games')->where('poster_url_value', "!=", "/default_images/Tv_Series.jpg")->orderByDesc('created_at')->limit(12)->get();

        $tv = DB::table('tv_show')->where('poster_url_value', "!=", "/default_images/Tv_Series.jpg")->orderByDesc('created_at')->limit(12)->get();

        $tv_anim = DB::table('tv_show')->where('poster_url_value', "!=", "/default_images/Tv_Series.jpg")->where('genre', 'like', '%Animation%')->orderByDesc('created_at')->orderByDesc('created_at')->limit($limit)->get();

        if ($agent->isMobile()) {
            $ads = DB::table('tv_ads_list')->get();
            if (count($ads) != 0) {
                $ads_no = (rand(1, count($ads)));
                $single_ad = $ads[$ads_no - 1]->name;
            } else {
                $single_ad = "N/A";
            }

            return view('Mobile.index_mobile', compact('result', 'game', 'tv', 'tv_anim', 'single_ad'));
            //return view('index', compact('result', 'game', 'tv'));
        } else {
            return view('index', compact('result', 'game', 'tv'));
            //return view('Mobile.index_mobile',compact('result','game','tv','tv_anim'));
        }
    }

    /*   This method is for single_movie_show     */
    public function single_movie_page(Request $request, $id)
    {

        DB::table('movie')->where('id', $id)->increment('total_view', 1);

        $most_popular = DB::table('movie')->orderByDesc('total_view')->get(); //retreiving most popular movies by                                                                                                    descending order

        $genre = DB::table('movie_genre')->get();

        $ads = DB::table('tv_ads_list')->get();
        if (count($ads) != 0) {
            $ads_no = (rand(1, count($ads)));
            $single_ad = $ads[$ads_no - 1]->name;
        } else {
            $single_ad = "N/A";
        }

        $comments = DB::table('ftp_comments')->where('post_id', $id)->where('type', 'movie')->orderBy('id', 'desc')->get();

        /* finding the single movie by id from most_popular dataset */
        foreach ($most_popular as $value) {
            if ($value->id == $request->id) {
                $result = $value;
                $genre = $value->genre;
                $genre_list = explode(",", $genre);
                $count = count($genre_list);

                if ($count == 1 && $genre_list[0] != "N/A") {
                    $movie_suggestions = DB::table('movie')
                        ->where('genre', 'like', '%' . $genre_list[0] . '%')->get();
                };
                if ($count == 2) {
                    $movie_suggestions = DB::table('movie')
                        ->where('genre', 'like', '%' . $genre_list[0] . '%')->orWhere('genre', 'like', '%' . $genre_list[1] . '%')->get();
                };
                if ($count >= 3) {
                    $movie_suggestions = DB::table('movie')
                        ->where('genre', 'like', '%' . $genre_list[0] . '%')->orWhere('genre', 'like', '%' . $genre_list[1] . '%')->orWhere('genre', 'like', '%' . $genre_list[2] . '%')->get();
                };

                //$links = movie_links($result->download_link);
                $links = ["http://127.0.0.1/Undergraduate%20Projects/Xplex%20Projects/FTP/Movies/Aladdin%20_%20Starplex.mp4"];
                //$first_copy = first_link($links);
                $first_copy = "http://127.0.0.1/Undergraduate%20Projects/Xplex%20Projects/FTP/Movies/Aladdin%20_%20Starplex.mp4";

                return view('Movie.single_movie_page', compact('result', 'genre', 'most_popular', 'comments', 'movie_suggestions', 'ads', 'single_ad', 'first_copy',  'links'));
            }
        }

        return "Sorry,Not Found";
    }

    public function findActor(Request $request, $actor)
    {

        $actor = urldecode($actor);

        $result = DB::table('movie')->where('actors', 'like', '%' . $actor . '%')->get();

        return view('Movie.galleryForActor', compact('result', 'actor'));
    }

    public function findDirector(Request $request, $director)
    {

        $result = DB::table('movie')->where('director', $director)->get();

        return view('Movie.galleryForActor', compact('result'));
    }


    /*This method is for single pc game*/

    public function pc_games(Request $request, $id)
    {


        DB::table('pc_games')->where('id', $id)->increment('total_view', 1);

        $ads = DB::table('tv_ads_list')->get();
        if (count($ads) != 0) {
            $ads_no = (rand(1, count($ads)));
            $single_ad = $ads[$ads_no - 1]->name;
        } else {
            $single_ad = "N/A";
        }

        $most_popular = DB::table('pc_games')->orderByDesc('total_view')->get(); //retreiving most popular movies by                                                                                                    descending order

        $genre = DB::table('game_genre')->get();

        $comments = DB::table('ftp_comments')->where('post_id', $id)->where('type', 'pc_games')->orderBy('id', 'desc')->get();

        /* finding the single movie by id */
        foreach ($most_popular as $value) {
            if ($value->id == $request->id) {
                $result = $value;
                $game_folder = get_game_folder($result->download_link);
                return view('PcGames.single_pc_game', compact('result', 'game_folder', 'genre', 'most_popular', 'comments', 'single_ad'));
            }
        }

        return "Sorry,Not Found";
    }

    /*This method is for movie gallery*/

    public function galleryForMovie(Request $request, $item, $type, $category)
    {
        /*here item is request type,such as movie,type means what type of movie,english or hindi etc, category means sort order,popular,recent,all etc*/
        $isgenred = "0";
        if ($item == 'movie') {
            if ($category == "all") {
                $result = DB::table('movie')->orderBy('title')->where('type', $type)->orderByDesc('year')->orderByDesc('released')->paginate($this->pagination);
            } else if ($category == "recent") {
                $result = DB::table('movie')->where('type', $type)->orderByDesc('created_at')->paginate($this->pagination);
            } else if ($category == "popular") {
                $result = DB::table('movie')->where('type', $type)->orderByDesc('total_view')->paginate($this->pagination);
            } else if ($category == "imdb") {


                $result = DB::table('movie')->where('type', $type)->orderByDesc('imdbrating')->paginate($this->pagination);
            } else if ($category == "rottentomatoes") {

                $result = DB::table('movie')->where('type', $type)->orderByDesc('rottentomatoesrating')->paginate($this->pagination);
            }
            $genre = DB::table('movie_genre')->get();
            $year = array();
            $resultByYear = DB::table('movie')->where('type', $type)->get();
            foreach ($resultByYear as $year_result) {
                $year_value = $year_result->year;
                if (!in_array($year_value, $year)) {
                    array_push($year, $year_value);
                }
            }
            rsort($year);

            return view('Movie.galleryForMovie', compact('result', 'genre', 'category', 'isgenred', 'type', 'year', 'item'));
        }
        return "Sorry,Not Found";
    }

    /*This method is for pc_game gallery*/

    public function galleryForGame(Request $request, $category)
    {
        if ($category == 'all') {
            $result = DB::table('pc_games')->orderBy('title')->paginate($this->pagination);
        } else if ($category == "new") {
            $result = DB::table('pc_games')->orderByDesc('created_at')->paginate($this->pagination);
        } else if ($category == "popular") {
            $result = DB::table('pc_games')->orderByDesc('total_view')->paginate($this->pagination);
        }

        $genre = DB::table('game_genre')->get();
        /* echo $result->sortByDesc('created_at');*/
        return view('PcGames.galleryForGame', compact('result', 'genre', 'category'));
    }

    public function galleryForTv(Request $request, $item, $type, $category)
    {

        if ($type == "animation") {
            if ($category == 'all') {
                $result = DB::table('tv_show')->orderBy('title')->where('genre', 'like', '%' . 'Animation' . '%')->paginate($this->pagination);
            } else if ($category == "popular") {
                $result = DB::table('tv_show')->orderByDesc('total_view')->where('genre', 'like', '%' . 'Animation' . '%')->paginate($this->pagination);
            } else if ($category == "new") {
                $result = DB::table('tv_show')->orderByDesc('created_at')->where('genre', 'like', '%' . 'Animation' . '%')->paginate($this->pagination);
            } else if ($category == "imdb") {
                $result = DB::table('tv_show')->orderByDesc('imdbrating')->where('genre', 'like', '%' . 'Animation' . '%')->paginate($this->pagination);
            }
        } else {
            if ($category == 'all') {
                $result = DB::table('tv_show')->orderBy('title')->paginate($this->pagination);
            } else if ($category == "popular") {
                $result = DB::table('tv_show')->orderByDesc('total_view')->paginate($this->pagination);
            } else if ($category == "new") {
                $result = DB::table('tv_show')->orderByDesc('created_at')->paginate($this->pagination);
            } else if ($category == "imdb") {
                $result = DB::table('tv_show')->orderByDesc('imdbrating')->paginate($this->pagination);
            }
        }


        $genre = DB::table('tv_show_genre')->get();
        return view('Tv.galleryForTv', compact('result', 'genre', 'item', 'category', 'type'));
    }


    /*This method is for gallery of movie category*/

    public function galleryForGenreForMovie(Request $request, $item, $category, $genre)
    {
        if ($item == 'movie') {
            if ($category == "all") {
                $result = DB::table('movie')->where('genre', 'like', '%' . $genre . '%')->orderBy('title')->paginate($this->pagination);
            } else if ($category == "recent") {
                $result = DB::table('movie')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('created_at')->paginate($this->pagination);
            } else if ($category == "popular") {

                $result = DB::table('movie')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('total_view')->paginate($this->pagination);
            } else if ($category == "imdb") {
                $result = DB::table('movie')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('imdbrating')->paginate($this->pagination);
            } else if ($category == "rottentomatoes") {

                $result = DB::table('movie')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('rottentomatoesrating')->paginate($this->pagination);
            }

            $genrelist = DB::table('movie_genre')->get();

            return view('Movie.galleryForGenreMovie', compact('result', 'genrelist', 'item', 'category', 'genre', 'item'));
        }
        return "Sorry,Not Found";
    }


    public function galleryForYearForMovie(Request $request, $item, $type, $category, $year)
    {
        if ($item == 'movie') {
            $result = DB::table('movie')->where('type', $type)->where('year', $year)->get();
            if ($category == "all") {

                $result = DB::table('movie')->where('type', $type)->where('year', $year)->orderBy('title')->paginate($this->pagination);
            } else if ($category == "recent") {

                $result = DB::table('movie')->where('type', $type)->where('year', $year)->orderByDesc('created_at')->paginate($this->pagination);
            } else if ($category == "popular") {

                $result = DB::table('movie')->where('type', $type)->where('year', $year)->orderByDesc('total_view')->paginate($this->pagination);
            } else if ($category == "imdb") {
                $result = DB::table('movie')->where('type', $type)->where('year', $year)->orderByDesc('imdbrating')->paginate($this->pagination);
            } else if ($category == "rottentomatoes") {

                $result = DB::table('movie')->where('type', $type)->where('year', $year)->orderByDesc('rottentomatoesrating')->paginate($this->pagination);
            }

            $genrelist = DB::table('movie_genre')->get();

            $yearValue = $year;       // this yearValue will hold current year value queried
            $year = array();          // this year array will hold all the

            $resultByYear = DB::table('movie')->where('type', $type)->get();

            foreach ($resultByYear as $year_result) {
                $year_value = $year_result->year;
                if (!in_array($year_value, $year)) {
                    array_push($year, $year_value);
                }
            }

            rsort($year);

            return view('Movie.galleryYearMovie', compact('result', 'type', 'genrelist', 'item', 'category', 'year', 'yearValue'));
        }
        return "Sorry,Not Found";
    }


    /*This method is for gallery of game category*/

    public function galleryForGameForGenre(Request $request, $category, $genre)
    {
        if ($category == 'all') {

            $result = DB::table('pc_games')->where('genre', 'like', '%' . $genre . '%')->orderBy('title')->paginate($this->pagination);
        } else if ($category == "new") {

            $result = DB::table('pc_games')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('created_at')->paginate($this->pagination);
        } else if ($category == "popular") {

            $result = DB::table('pc_games')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('total_view')->paginate($this->pagination);
        }
        $genrelist = DB::table('game_genre')->get();

        return view('PcGames.galleryForGenreGame', compact('result', 'genrelist', 'item', 'category', 'genre'));
    }


    /*This method is for single tv series category*/


    public function single_tv_series_page(Request $request, $id)
    {

        DB::table('tv_show')->where('id', $id)->increment('total_view', 1);

        $ads = DB::table('tv_ads_list')->get();
        if (count($ads) != 0) {
            $ads_no = (rand(1, count($ads)));
            $single_ad = $ads[$ads_no - 1]->name;
        } else {
            $single_ad = "N/A";
        }
        $most_popular = DB::table('tv_show')->orderByDesc('total_view')->get(); //retreiving most popular movies by                                                                                                    descending order
        $genre = DB::table('tv_show_genre')->get();

        $comments = DB::table('ftp_comments')->where('post_id', $id)->where('type', 'tv')->orderBy('id', 'desc')->get();
        /* finding the single movie by id */
        foreach ($most_popular as $value) {
            if ($value->id == $request->id) {
                $result = $value;
                $seasons = get_seasons($result->base_url);



                return view('Tv.single_tv_page', compact('result', 'genre', 'most_popular', 'comments', 'single_ad', 'seasons'));
            }
        }
        return "Sorry,Not Found";
    }


    public function galleryTvGenre(Request $request, $category, $genre)
    {

        if ($category == 'all') {
            $result = DB::table('tv_show')->where('genre', 'like', '%' . $genre . '%')->orderBy('title')->paginate($this->pagination);
        } else if ($category == "new") {
            $result = DB::table('tv_show')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('created_at')->paginate($this->pagination);
        } else if ($category == "popular") {
            $result = DB::table('tv_show')->where('genre', 'like', '%' . $genre . '%')->orderByDesc('total_view')->paginate($this->pagination);
        }
        $genrelist = DB::table('tv_show_genre')->get();
        return view('Tv.galleryTvGenre', compact('result', 'genrelist', 'item', 'category', 'genre'));
    }


    public function searchTerm(Request $request)
    {
        $limit = 50;
        if ($request->ajax()) {
            $table = $request->table;
            $value = $request->search_value;

            if ($table == 'cartoon') {
                $result = DB::table('tv_show')->where('genre', 'like', '%' . 'Animation' . '%')->where('title', 'like', $value . '%')->limit($limit)->get();
            } else
                $result = DB::table($table)->where('title', 'like', $value . '%')->limit($limit)->get();
            return  response()->json($result);
        }
    }


    /* This method is for comments*/

    public function postComment(Request $request, $type, $id, $comment)
    {


        if (Auth::check()) {


            $username = Auth::user()->name;


            DB::table('ftp_comments')->insert(['username' => $username, 'comment_message' => $comment, 'post_id' => $id, 'type' => $type]);

            $result = DB::table('ftp_comments')->where('post_id', $id)->where('type', $type)->orderBy('id', 'desc')->first();

            return response()->json($result);
        } else {

            $result = "unlogged";
            return response()->json($result);
        }
    }

    public function video_pop(Request $request, $id)
    {
        $result = DB::table('movie')->where('id', $id)->first();
        $video_file = $result->download_link;
        if (strpos($video_file, ',')) {
            $video_file = explode(',', $video_file);
            $video_file = $video_file[sizeof($video_file) - 1];    //get the last item of array as video file
        }
        $video_format = substr($video_file, -3);
        $src = $video_format;
        if ($video_format == "mkv") {
            $src = "x-matroska";
        }
        return view('video_pop', compact('video_file', 'src', 'result'));
    }

    public function showList(Request $request, $type)
    {

        $result = DB::table($type)->orderByDesc('created_at')->paginate($this->pagination);

        return view('listData', compact('result'));
    }

    public function ajaxTest()
    {
        $warning = 1;

        $result = DB::table('file_request')->orderByDesc('created_at')->first();

        echo json_encode(array($warning, $result));
    }

    public function Test(Request $request)
    {
        $result = DB::table('softwares')->orderBy('title')->paginate($this->pagination);
        return view('test', compact('result'));
    }

    /*This page is for music video gallery*/


    function searchTermAll(Request $request)
    {

        $limit = 20;
        $result = [];
        if ($request->ajax()) {
            $value = $request->search_value;
            $movies = DB::table('movie')->where('title', 'like', $value . '%')->limit($limit)->get();
            $tvs = DB::table('tv_show')->where('title', 'like', $value . '%')->limit($limit)->get();
            $games =  DB::table('pc_games')->where('title', 'like', $value . '%')->limit($limit)->get();

            $movies = array("Movies" => $movies);
            $tvs = array("Tv Show" => $tvs);
            $games = array("Pc Games" => $games);

            array_push($result, $movies, $tvs, $games);
            return  response()->json($result);
        }
    }
}
