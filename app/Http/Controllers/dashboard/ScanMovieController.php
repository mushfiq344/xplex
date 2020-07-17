<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;
use Session;
use Carbon\Carbon;
use App\Services\PayUService\Exception;
ini_set('max_execution_time',25200); //3 minutes
class ScanMovieController extends Controller
{


	public function __construct()
	{

	}

    public function scan_movie($type){

    	if (empty(Session::get('password'))) {
            return  redirect('login')->with('alert', 'Session Expired!');
    	}

    	if($type=="all"){
    		$json = file_get_contents('http://103.55.146.165/FTP/XplexScanner/MediaScanner.php?type=Movies');
    	}
    	
		$obj=json_decode($json);
		$movies=$obj[0]->send_data;
//		return $movies;
		foreach ($movies as $movie) {

//           return get_prints($movie->path);
     		$check=check_data($movie->title,$movie->year,$movie->path,'movie');
     		
     		if($check==0){
     			// return $movie->title;     			
	 			$data=$this->get_movie_data($movie->title,$movie->year);
	 			// return $data;	 			 			
	 			$data['download_links']=$movie->path;
	 			// return $data;
	 			// save poster
	 			if($data['poster']!="N/A" && $data['poster']!="https://image.tmdb.org/t/p/w500/"){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['poster']);
					file_put_contents(public_path('movie_poster/'.$timestamp.'_image.jpg'), $image);
					$data['poster']='/movie_poster/'.$timestamp.'_image.jpg';
	 			}
	 			// save cover
	 			if($data['cover']!="N/A" && $data['cover']!="https://image.tmdb.org/t/p/w1280/"){
	 				$timestamp = now()->timestamp;
	 				$image = file_get_contents($data['cover']);
					file_put_contents(public_path('movie_cover/'.$timestamp.'_image.jpg'), $image);
					$data['cover']='/movie_cover/'.$timestamp.'_image.jpg';
	 			}




	 			$this->insert_data($data);
	 			// return $data;
	 		}
	 		else{
	 		// echo $movie->title." Already Exists!";
	 		}

		}

		return redirect('/dashboard_backup');
    }
	function get_movie_data($movie_name,$movie_year)
	{	

   		$data = array();
		$data['title']=trim($movie_name);
		$data['year']=trim($movie_year);	
		try{
			$url='http://www.omdbapi.com/?t='.urlencode(trim($movie_name)).'&y='.urlencode(trim($movie_year)).'&apikey='.omdb_api_key;
			$json = file_get_contents($url);
			$obj = json_decode($json);
			$data['released']=$obj->Released;
			$data['genre']=$obj->Genre;
			$data['country']=$obj->Country;
			$data['director']=$obj->Director;
			$data['actors']=$obj->Actors;
			$data['plot']=$obj->Plot;
			$data['language']=$obj->Language;

			//fetch rating
			$ratings = $obj->{'Ratings'};
			$rating_values = array();
			$total_ratings= count($ratings);
			for($i=0;$i<$total_ratings;$i++)
			{
				if($ratings[$i]->{'Source'}=='Internet Movie Database') {
					$data['imdb']=str_replace("/10","",$ratings[$i]->{'Value'});
				}
				if($ratings[$i]->{'Source'}=='Rotten Tomatoes') {
					$data['rt']= str_replace("%","",$ratings[$i]->{'Value'});
				}
				if($ratings[$i]->{'Source'}=='Metacritic') {
					$data['metacritic']= str_replace("/100","",$ratings[$i]->{'Value'});
				}
			}
			if(empty($data['imdb']))
			{
				$data['imdb']=0;
			}	
			if(empty($data['rt']))
			{
				$data['rt']=0;
			}
			if(empty($data['metacritic']))
			{
				$data['metacritic']=0;
			}
			$data['imdb_id']=$obj->imdbID;
		}
		catch(\Exception $e)
		{	
			$data['released']="N/A";
			$data['genre']="N/A";
			$data['country']="N/A";
			$data['director']="N/A";
			$data['actors']="N/A";
			$data['plot']="N/A";
			$data['language']="N/A";
			$data['imdb']="N/A";
			$data['rt']="N/A";
			$data['metacritic']="N/A";
			$data['imdb_id']="N/A";
		}
		// use tmdb for production company		
		$url='http://api.themoviedb.org/3/movie/'.$data['imdb_id'].'?api_key='.tmdb_api_key;
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
		catch (\Exception $e) {
			$production_list="N/A";
		};
		$data['production']= rtrim($production_list,',');	
		// use tmdb for trailer 
		$url= 'http://api.themoviedb.org/3/movie/'.$data['imdb_id'].'/videos?api_key='.tmdb_api_key;
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
		catch (\Exception $e) {
			$data['trailer']="N/A";
		}
		// use tmdb for poster
		
			$url='http://api.themoviedb.org/3/movie/'.$data['imdb_id'].'?api_key='.tmdb_api_key;
				$json = @file_get_contents($url);
				if (strpos($http_response_header[0], "200")) {
					$obj = json_decode($json);
					$data['poster']='https://image.tmdb.org/t/p/w500/'.$obj->poster_path;
				}
			else{
    			$data['poster']='N/A';
			}
			
		// use tmdb for cover photo
		
			$url='http://api.themoviedb.org/3/movie/'.$data['imdb_id'].'?api_key='.tmdb_api_key;
			$json = @file_get_contents($url);

				if (strpos($http_response_header[0], "200")) {
					$obj = json_decode($json);
					$data['cover']='https://image.tmdb.org/t/p/w1280/'.$obj->backdrop_path;
				}else{
					$data['cover']='N/A';
				}
			
									
			return $data;
	}


	// get the q parameter from URL
	function insert_data($movie)
	{
    	// $q["title"] = str_replace("'", "''",$movie["title"]);	
    	$q["title"] = str_replace("#", ":",$movie["title"]);	
		
		$q["released"]=  date('y-m-d',strtotime($movie["released"]));
		$q["year"] = $movie["year"];

		// $q["director"]= str_replace("'", "''",$movie["director"]);
		$q["director"]=$movie["director"];
		
		// $q["actors"] = str_replace("'", "''",$movie["actors"]);
		$q["actors"] = $movie["actors"];


		// $q["production"] = str_replace("'", "''",$movie["production"]);
		$q["production"] =$movie["production"];


		if(strlen(trim($q["production"]))==0){
			$q["production"]="N/A";
		}

		$q["genre"] = $movie["genre"];
		$q["plot"] = str_replace("'", "''",$movie["plot"]);

		// $q["country"] = str_replace("'", "''",$movie["country"]);
		$q["country"] = $movie["country"];


		// $q["language"] = str_replace("'", "''",$movie["language"]);
		$q["language"] = $movie["language"];


		$q["imdb"] = $movie["imdb"];
		$q["metacritic"] = $movie["metacritic"];
		$q["rt"] = $movie["rt"];

		if(!is_numeric($movie["imdb"])){
	    	$q["imdb"]=0;
		}
		if(!is_numeric($movie["metacritic"])){
	    	$q["metacritic"]=0;
		}
		if(!is_numeric($movie["rt"])){
	   	 	$q["rt"]=0;
		}
		$q["imdb_id"] = $movie["imdb_id"];
		// poster
		$q["poster"] = $movie["poster"];
		if($q["poster"]=="N/A" || $q["poster"]=="https://image.tmdb.org/t/p/w500/"){
			$q["poster"]=default_poster;
		}
		// cover
		$q["cover"] = $movie["cover"];
		if($q["cover"]=="N/A" || $q["cover"]=="https://image.tmdb.org/t/p/w1280/"){
			$q["cover"]=default_cover;
		}

		if($movie["trailer"]!="N/A"){
		
			$q["trailer"] = 'https://www.youtube.com/watch?v='.$movie["trailer"];
		}
		else{
			$q["trailer"] = default_trailer;
		}
		// $q["download_links"] = str_replace("'","\'",$movie["download_links"]);
		 $q["download_links"] =$movie["download_links"];


		 $q['print_type']=get_prints($movie["download_links"]);
		// type of movie
		$q['type']=get_show_type($q['genre'],$q["download_links"],explode(',',$q['language'])[0],
			explode(',',$q['country'])[0]);

		// fetching Cover photo
    	$cover_url_value = "N/A";


		DB::insert('insert into movie (title,imdb_title,released,production,year,country,language,genre,director,actors,plot,imdbrating,rottentomatoesrating,metacriticrating,trailer_value,poster_url_value,cover_url_value,imdb_id,download_link,print_type,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
      	[ $q["title"],$q["title"],$q["released"],$q["production"],$q["year"],$q["country"],$q["language"],$q["genre"],$q["director"],$q["actors"],$q["plot"], $q["imdb"],$q["rt"],$q["metacritic"],$q["trailer"],$q["poster"],$q['cover'],$q['imdb_id'],$q['download_links'],$q['print_type'],$q['type']]);
  	}




  	function scan_single_movie(Request $request){
  		if($request->ajax())
		{
			$movies=DB::table($request->scan_table)->where('id',$request->scan_id)->get();


			$data=$this->get_movie_data($movies[0]->imdb_title,$movies[0]->year);	



			if($data["trailer"]!="N/A"){
		
				$data["trailer"] = 'https://www.youtube.com/watch?v='.$data["trailer"];
			}else{
					$q["trailer"] = default_trailer;
			}
			// poster
			if($data['poster']!="N/A" && $data['poster']!="https://image.tmdb.org/t/p/w500/"
				&& strpos($movies[0]->poster_url_value,'_image.jpg') == false
				){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['poster']);
					file_put_contents(public_path('movie_poster/'.$timestamp.'_image.jpg'), $image);
					$data['poster']='/movie_poster/'.$timestamp.'_image.jpg';
	 		}else{

	 				$data['poster']=$movies[0]->poster_url_value;
	 		}
	 		// cover
			if($data['cover']!="N/A" && $data['cover']!="https://image.tmdb.org/t/p/w1280/"
				&& strpos($movies[0]->cover_url_value,'_image.jpg') == false
				){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['cover']);
					file_put_contents(public_path('movie_cover/'.$timestamp.'_image.jpg'), $image);
					$data['cover']='/movie_cover/'.$timestamp.'_image.jpg';
	 		}else{

	 				$data['cover']=$movies[0]->cover_url_value;
	 		}
	 		$data["released"]=  date('Y-m-d',strtotime($data["released"]));	


			        \DB::table($request->scan_table)->where('id',$request->scan_id)->update(
        	[
        		'released'	=>	$data["released"],
        		'country' => $data['country'],
        		'language' => $data['language'],
        		'genre' => $data['genre'],
        		
        		'actors' =>$data['actors'],
        		'plot' =>$data['plot'],
        		'production' =>$data['production'],
        		'director' =>$data['director'],
        		
        		'imdbrating' => $data['imdb'],
        		'rottentomatoesrating'	=> $data['rt'],
        		'metacriticrating' =>  $data['metacritic'],
        		'imdb_id' => $data['imdb_id'],
        		'trailer_value' => $data["trailer"],
        		'poster_url_value'=>$data["poster"],
        		'cover_url_value'=>$data["cover"]


        	]);
			
			 return Response($data);       
		}
  	}
}