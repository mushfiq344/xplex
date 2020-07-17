<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class MobileController extends Controller
{
    var $pagination = 12;

    public function movieGallery(Request $request, $category)
    {
        $genre_type = 'All';
        if ($category == 'English' || $category == 'Hindi' || $category == 'South Indian') {
            $result = DB::table('movie')->where('type', strtolower($category))->orderBy('title')->paginate($this->pagination);
            $genre_list = DB::table('movie_genre')->get();
        } else {
            $result = DB::table('movie')->where('type', 'others')->orWhere('type', 'korean')->orderBy('title')->paginate($this->pagination);
            $genre_list = DB::table('movie_genre')->get();
        }
        return view('Mobile.movie_gallery', compact('result', 'genre_list', 'category', 'genre_type'));
    }

    public function movieGenreGallery(Request $request, $genre_type, $category)
    {

        if ($category == 'English' || $category == 'Hindi' || $category == 'South Indian') {
            $result = DB::table('movie')->where('type', strtolower($category))->where('genre', 'like', '%' . $genre_type . '%')->orderBy('title')->paginate($this->pagination);
            $genre_list = DB::table('movie_genre')->get();
        } else {
            $result = DB::table('movie')->where('type', 'others')->orWhere('type', 'korean')->where('genre', 'like', '%' . $genre_type . '%')->orderBy('title')->paginate($this->pagination);
            $genre_list = DB::table('movie_genre')->get();
        }
        return view('Mobile.movie_gallery', compact('result', 'genre_list', 'category', 'genre_type'));
    }

    public function single_movie(Request $request, $id)
    {
            $result = DB::table('movie')->where('id', $id)->first();
            $popular = DB::table('movie')->orderByDesc('total_view')->limit(10)->get();
            $links=movie_links($result->download_link);

            $first_copy=first_link($links);

            $video_format = substr($first_copy, -3);
            $src = $video_format;
            if ($video_format == "mkv") {
                $src = "x-matroska";
            }
            return view('Mobile.single_movie', compact('result', 'popular', 'src', 'links',
                'first_copy'));
    }

    public function tvGallery(Request $request, $category)
    {
        if ($category == 'english') {
            $result = DB::table('tv_show')->orderBy('title')->paginate($this->pagination);
            $genre = DB::table('tv_show_genre')->get();
        }
        $total=count($result);
        return view('Mobile.tv_gallery', compact('result', 'genre','total'));
    }

    public function single_tv(Request $request, $id)
    {

            $result = DB::table('tv_show')->where('id', $id)->first();
            $seasons = get_seasons($result->base_url);
            $episodes = get_episodes($seasons[0]->path);
            $episode_0 = get_first_episode($episodes);
            $video_format = substr($episode_0, -3);
            $src = $video_format;
            if ($video_format == "mkv") {
                $src = "x-matroska";
            }
            $popular = DB::table('tv_show')->orderByDesc('total_view')->limit(10)->get();
            return view('Mobile.single_tv', compact('result', 'popular', 'src', 'episode_0','seasons'));

    }


    public function galleryCartoon(Request $request)
    {

        $result = DB::table('tv_show')->orderBy('title')->where('genre', 'like', '%' . 'Animation' . '%')->paginate($this->pagination);
        $genre = DB::table('tv_show_genre')->get();
        return view('Mobile.tv_gallery', compact('result', 'genre'));
    }

    public function galleryGames(Request $request)
    {
        $result = DB::table('pc_games')->orderByDesc('title')->paginate($this->pagination);
        $genre_list = DB::table('game_genre')->get();
        $genre_type = 'All';
        return view('Mobile.games_gallery', compact('result', 'genre_list', 'genre_type'));
    }

    public function galleryGamesGenre(Request $request, $genre_type)
    {
        $result = DB::table('pc_games')->orderByDesc('title')->where('genre', 'like', '%' . $genre_type . '%')->paginate($this->pagination);
        $genre_list = DB::table('game_genre')->get();
        return view('Mobile.games_gallery', compact('result', 'genre_list', 'genre_type'));
    }

    public function single_game(Request $request, $id)
    {
            $result = DB::table('pc_games')->where('id', $id)->first();
            $popular = DB::table('pc_games')->orderByDesc('total_view')->limit(10)->get();
            return view('Mobile.single_game', compact('result', 'popular'));
    }

    public function others(Request $request)
    {
        return view('Mobile.others');
    }

    function mobile_search(Request $request, $category, $id)
    {

        if ($category == 'movie') {
            return redirect('/mobile/single_movie/' . $id);
        } else if ($category == 'tv_series' || $category == 'cartoon') {
            return redirect('/mobile/single_tv/' . $id);
        } else if ($category == 'pc_games') {
            return redirect('/mobile/single_game/' . $id);
        }
    }










}
