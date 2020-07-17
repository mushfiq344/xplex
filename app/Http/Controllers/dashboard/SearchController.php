<?php
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use IGDB;
class SearchController extends Controller
{	

	// search movie from igdb
	public function search_movie(Request $request)
	{
		
		if($request->ajax())
		{   
		    /*
		    use omdb api to fetch title,year,release date,genre,country,director,
		    actors,plot,language,ratings
		    */
			$url='http://www.omdbapi.com/?i='.$request->search.'&apikey='.omdb_api_key;
			$json = file_get_contents($url);
			$obj = json_decode($json);
			$data = array();
			$data['title']=$obj->Title;
			$data['year']=$obj->Year;
			$data['imdb_id']=$obj->imdbID;
			$data['released']=date('Y-m-d',strtotime($obj->Released));
			$data['genre']=$obj->Genre;
			$data['country']=$obj->Country;
			$data['director']=$obj->Director;
			$data['actors']=$obj->Actors;
			$data['plot']=$obj->Plot;
			$data['language']=$obj->Language;
			$ratings = $obj->{'Ratings'};
			$rating_values = array();
			$total_ratings= count($ratings);
			// fetching and processing movie ratings
			for($i=0;$i<$total_ratings;$i++)
			{
				if($ratings[$i]->{'Source'}=='Internet Movie Database'){
					$data['imdb']=str_replace("/10","",$ratings[$i]->{'Value'});
				}
				if($ratings[$i]->{'Source'}=='Rotten Tomatoes'){
					$data['rt']= str_replace("%","",$ratings[$i]->{'Value'});
				}
				if($ratings[$i]->{'Source'}=='Metacritic'){
					$data['metacritic']= str_replace("/100","",$ratings[$i]->{'Value'});
				}
			}
			if(empty($data['imdb'])){
				$data['imdb']=0;
			}
			if(empty($data['rt'])){
				$data['rt']=0;
			}
			if(empty($data['metacritic']))
			{
				$data['metacritic']=0;
			}
			// use tmdb for production company		
			$url='http://api.themoviedb.org/3/movie/'.$request->search.'?api_key='.tmdb_api_key;
			// fetching production companies list
			try {
				if ($json = file_get_contents($url)) {
					$obj = json_decode($json);
					$production = $obj->{'production_companies'};
					$production_list="";
					for($i=0;$i<count($production);$i++)
					{
						$production_list.=$production[$i]->{'name'}.',';
					}
				}
			}
			// if production company could not be found
			catch (Exception $e) {
				$production_list="N/A";
			};
			$data['production']= rtrim($production_list,',');
			//use tmdb for trailer 
			$url= 'http://api.themoviedb.org/3/movie/'.$request->search.'/videos?api_key='.tmdb_api_key;
			try 
			{ 
				if ($json = file_get_contents($url)) {
    				$total_trailer=0;
					$obj = json_decode($json);
					$trailer =  $obj->{'results'};
					//counting total trailer inside the fetched object
					$total_trailer= count($trailer);
					if($total_trailer==0){
						//no trrailer link found
						$data['trailer']='N/A';
					}
					else {
						//trailer link found
						$data['trailer']=$trailer[$total_trailer-1]->key;
					}
				}
			}
			// if trailer could not be found
			catch (Exception $e) {
			}
			// use tmdb for poster
			$url='http://api.themoviedb.org/3/movie/'.$request->search.'?api_key='.tmdb_api_key;
			try {
				if ($json = file_get_contents($url)) {
					$obj = json_decode($json);
					$data['poster']='https://image.tmdb.org/t/p/w500/'.$obj->poster_path;
				}
			}
			//if poster could not be found
			catch (Exception $e) {
    			$data['poster']='N/A';
			}
			// use tmdb for cover photo
			$url='http://api.themoviedb.org/3/movie/'.$request->search.'?api_key='.tmdb_api_key;
			try {
				if ($json = file_get_contents($url)) {
					$obj = json_decode($json);
					$data['cover']='https://image.tmdb.org/t/p/w1280/'.$obj->backdrop_path;
				}
			}
			//if cover could not be found
			catch (Exception $e) {
    			$data['cover']='N/A';
			}
			return Response($data);
		} 
	}
	//search tv show from api
	public function search_tv_show(Request $request)
	{
		/*
        use  omdb to get title,relased date,genre,country,actors,plot,language,rating
		*/
		if($request->ajax()){
			$url='http://www.omdbapi.com/?i='.$request->search.'&apikey='.omdb_api_key;
			$json = file_get_contents($url);
			$obj = json_decode($json);
			$data = array();
			$data['title']=$obj->Title;
			$data['released']=date('Y-m-d',strtotime($obj->Released));
			$data['genre']=$obj->Genre;
			$data['country']=$obj->Country;
			$data['actors']=$obj->Actors;
			$data['plot']=$obj->Plot;
			$data['language']=$obj->Language;
			$data['imdb_id']=$obj->imdbID;
			$data['year']=substr(preg_replace('/[^0-9]/', '',$obj->Year),0,4);

			
			$ratings = $obj->{'Ratings'};
			$rating_values = array();
			$total_ratings= count($ratings);
			for($i=0;$i<$total_ratings;$i++)
			{
				if($ratings[$i]->{'Source'}=='Internet Movie Database'){
					$data['imdb']=str_replace("/10","",$ratings[$i]->{'Value'});
				}
			}
			if(empty($data['imdb'])){
				$data['imdb']=0;
			}
            // use tmdb to fetch trailer
			$url = 'https://api.themoviedb.org/3/find/'.$request->search.'?api_key='.tmdb_api_key.'&external_source=imdb_id';
			$total_trailer=0;
			try {
				if ($json = file_get_contents($url)) {
					$json = file_get_contents($url);
					$obj = json_decode($json);
					$result =  $obj->{'tv_results'};
					//if the fetched object is not empty
					if(!empty($result)) {
						$url='https://api.themoviedb.org/3/tv/'.$result[0]->{'id'}.'/videos?api_key='.tmdb_api_key;
						$json = file_get_contents($url);
						$obj = json_decode($json);
						$trailer =  $obj->{'results'};
						// counting the total no of trailer
						$total_trailer= count($trailer);
						// if more or equal to 1 no. of trailers found 
						if($total_trailer>0){
							$data['trailer']=$trailer[$total_trailer-1]->key;
						}
						// if no trailer link found
						else {
    						$data['trailer']="N/A";
    					}
					}
					else {
						$data['trailer']="N/A";
					}
				}
			}
			catch (Exception $e) {
				// return your "Hash Not Found" response
			}
			$data['poster']='N/A';
			if(!empty($result)){
				$url='http://api.themoviedb.org/3/tv/'.$result[0]->{'id'}.'?api_key='.tmdb_api_key;
				try {
					if ($json = file_get_contents($url)) {
						$obj = json_decode($json);
						$data['poster']='https://image.tmdb.org/t/p/w500/'.$obj->poster_path;
						$data['cover']='https://image.tmdb.org/t/p/w1280/'.$obj->backdrop_path;
					}
				}
				catch (Exception $e) {
    				$data['poster']='N/A';
    				$data['cover']='N/A';
				}
			}



			return Response($data);
		} 
	}
// fetch games list from igdb api
	public function search_game(Request $request)
	{
		if($request->ajax())
		{
			$games = IGDB::searchGames($request->search); // name 
    		$output="";
			foreach ($games as $game) {
			$output.='<tr>'.'<td><button   id="'.$game->id.'"   class="clickMe btn btn-link" >'.$game->name.'</button></td>'.'</tr>';
			}
			return Response($output);
		}
	}
	//search single game from igdb api using id
	public function search_single_game(Request $request)
	{
		if($request->ajax())
		{
			try{
				if ($game = IGDB::getGame($request->search)) {
					$game_publishers =$game->{'publishers'};
					$company = IGDB::getCompany($game_publishers[0]);
					$publisher = $company->{'name'};
				}
			}
			catch (Exception $e) {
				$publisher = "N/A";
			}
			$game_data['cover']='https:'.str_replace("thumb","screenshot_huge",$game->screenshots[0]->url);
			$game_data['publisher'] =  $publisher ;
            /*
            processing the released date
            */
			try{
				if ($date = $game->{'release_dates'}) {
					$release = $date[0];
					$released=$release->{'human'};
					$released=date("Y-m-d",strtotime($released));
				}
			}
			catch (Exception $e) {
				$released = "N/A" ;
			}
			$game_data['released']= $released;
            /*
            fetch name
            */
			try{
				if ($title = $game->{'name'}) {
				}
			}
			catch (Exception $e) {
				$title = "N/A" ;
			}
			$game_data['title']= $title;
            // summary or plot
			try{
				if ($plot = $game->{'summary'}) {
				}
			}
			catch (Exception $e) {
				$plot = "N/A" ;
			}
			$game_data['plot']= $plot;
			// fetch rating
			try{
				if ($rating = $game->{'rating'}) {
				}
			}
			catch (Exception $e) {
				$rating = 0;
			}
			$game_data['rating']= round($rating, 2);
			// fetch video
			if(!empty($game->{'videos'}))
			{
				try{
					if ($trailer = $game->{'videos'}) {
						$trailer_link = $trailer[0]->video_id;
					}
				}
				catch (Exception $e) {
    				$trailer_link="N/A";
				}
			}
			else{
				$trailer_link='N/A';
			}
			$game_data['trailer']= $trailer_link;
			// fetch game cover photo
			try{
				if ($cover = $game->{'cover'}) {
					$cover_link =  $cover->{'cloudinary_id'};
				}
			}
			catch (Exception $e) {
				$cover_link="N/A";
			}
			$game_data['poster']= 'https://images.igdb.com/igdb/image/upload/t_cover_big/'.$cover_link;

			//check if image has jpg or png extension
			if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $game_data['poster'])) {
   				
			} else{
   				$game_data['poster']=$game_data['poster'].".jpg";
			}                                                  	
			//fetch genre of the game 
			try{
				if ($genres= $game->{'genres'}) {
					$total_genres= count($genres);
					$genre_list="";
					$i=0;
					for($i=0;$i<$total_genres;$i++)
					{
						$name= IGDB::getGenre($genres[$i]);
						$genre_list.=$name->{'name'}.',';
					}
					$genre_list = substr($genre_list, 0, -1);
				}
			}
			catch (Exception $e) {
				$genre_list="N/A";
			}
			$game_data['genre']= $genre_list;
			// return the response
			return Response($game_data);
		}
	}

	public function fetch_tv_show_screen_shots(Request $request){
		if($request->ajax()){
			$tv_show_id=get_tv_show_id($request->imdb_id);
			$screen_shots=get_tv_show_screenshots($tv_show_id);
			return Response($screen_shots);
		}
	}
	public function fetch_movie_screen_shots(Request $request){
		if($request->ajax()){
			
			$screen_shots=get_movie_screen_shots($request->imdb_id);
			return Response($screen_shots);
		}
	}
	public function fetch_movie_casts(Request $request){
		if($request->ajax()){
			
			$casts=get_movie_casts($request->imdb_id);
			return Response($casts);
		}
	}

	public function fetch_game_screen_shots(Request $request){
		if($request->ajax()){
			
			$game = IGDB::getGame($request->igdb_id);
			return Response($game->screenshots);
		}
	}
}