<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;
use Carbon\Carbon;
use App\Services\PayUService\Exception;
use Session;
ini_set('max_execution_time', 25200); //3 minutes

class ScanTvController extends Controller
{


	public function __construct()
	{

	}

    public function scan_tv_show($type){


    	if (empty(Session::get('password'))) {
            return  redirect('login')->with('alert', 'Session Expired!');
    	}

    	if($type=="all"){
    		$json = file_get_contents('http://192.168.60.137/FTP/XplexScanner/MediaScanner.php?type=TVSeries');
    	}
    	

    	
		$obj=json_decode($json);
		$movies=$obj[0]->send_data;

		

		foreach ($movies as $movie) {
     		$check=check_data($movie->title,$movie->year,myUrlEncode($movie->path),'tv_show');
     		if($check==0){
     			     			
	 			$data=$this->get_tv_show_data($movie->title,$movie->year);
	 			// return $data;
	 			$data['path']=myUrlEncode($movie->path);
	 			// return $data;	 				 			
	 			if($data['poster']!="N/A"){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['poster']);
					file_put_contents(public_path('tv_show_poster/'.$timestamp.'_image.jpg'), $image);
					$data['poster']='/tv_show_poster/'.$timestamp.'_image.jpg';
	 			}if($data['cover']!="N/A"){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['cover']);
					file_put_contents(public_path('tv_show_cover/'.$timestamp.'_image.jpg'), $image);
					$data['cover']='/tv_show_cover/'.$timestamp.'_image.jpg';
	 			}		
	 			$this->insert_data($data);
	 			// return $data;
	 			// return $data;
	 		}
	 		else{
	 		// echo $movie->title." Already Exists!";
	 		}
		}

		return redirect('/dashboard_backup');
    }

	function get_tv_show_data($movie_name,$movie_year)
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
			$data['imdb']=$obj->imdbRating;
			$data['imdb_id']=$obj->imdbID;
			$data['poster']=$obj->Poster;
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
			$data['imdb']=0;
			$data['imdb_id']="N/A";
			$data['poster']="N/A";
		}
            // use tmdb to fetch trailer
		$url = 'https://api.themoviedb.org/3/find/'.$data['imdb_id'].'?api_key='.tmdb_api_key.'&external_source=imdb_id';
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
		catch (\Exception $e) {
				// return your "Hash Not Found" response
		}
		$data['poster']='N/A';
		$data['cover']='N/A';
		if(!empty($result)){
			$url='http://api.themoviedb.org/3/tv/'.$result[0]->{'id'}.'?api_key='.tmdb_api_key;
			try {
				if ($json = file_get_contents($url)) {
					$obj = json_decode($json);
					$data['poster']='https://image.tmdb.org/t/p/w500/'.ltrim($obj->poster_path,'/');
					$data['cover']='https://image.tmdb.org/t/p/w1280/'.ltrim($obj->backdrop_path,'/');
					if (strpos($data['poster'], '.jpg') == false && strpos($data['poster'], '.png') == false) {
    					$data['poster']="N/A";
					}
					if (strpos($data['cover'], '.jpg') == false && strpos($data['cover'], '.png') == false) {
    					$data['cover']="N/A";
					}
				}
			}
			catch (\Exception $e) {
    			$data['poster']='N/A';
    			$data['cover']='N/A';
			}
		}						
	return $data;
	}

	function insert_data($movie){
			 //Retrieving Genre and Checking them for duplicate values
      	if($movie["genre"]!='N/A')
      	{
        	$genre_list = explode(',',$movie["genre"]);
        	for($i=0;$i<count($genre_list);$i++)
        	{
          		$genre_list[$i]=ltrim($genre_list[$i]);
          		$genre_list[$i]=rtrim($genre_list[$i]);

          		$table_row = DB::table('tv_show_genre')->where('genre_type', $genre_list[$i]);
          		if($table_row->count()>0){
          		}
          		else
          		{            		
            		DB::insert('insert into tv_show_genre (genre_type)values(?)',[$genre_list[$i]]);
          		}
        	}
      	} 
    	// $q["title"] = str_replace("'", "''",$movie["title"]);
		$q["title"] = $movie["title"];	
		$q["released"]=  date('y-m-d',strtotime($movie["released"]));
		$q["year"] = $movie["year"];

		$q["director"]= $movie["director"];
		$q["actors"] = $movie["actors"];
		$q["genre"] = $movie["genre"];

		if($q["genre"]=="N/A" && strpos(strtolower($movie["path"]), 'anim') !== false){
				$q["genre"]="Animation";
		}

		$q["plot"] = $movie["plot"];
		$q["country"] = $movie["country"];
		$q["language"] = $movie["language"];

		$q["imdb"] = $movie["imdb"];


		if(!is_numeric($movie["imdb"])){
	    	$q["imdb"]=0;
		}
		$q["imdb_id"] = $movie["imdb_id"];

		$q["poster"] = $movie["poster"];
		
		if($q["poster"]=="N/A"){
			$q["poster"]=default_poster;
		}

		$q["cover"] = $movie["cover"];
		
		if($q["cover"]=="N/A"){
			$q["cover"]=default_cover;
		}

		if($movie["trailer"]!="N/A"){
		
			$q["trailer"] = 'https://www.youtube.com/watch?v='.$movie["trailer"];
		}
		else{
			$q["trailer"] = default_trailer;
		}
		$q["path"] = $movie["path"]; 


		// checking the type of tv_show
		$q['type']=get_show_type(
			$q['genre'],
			$q["path"],
			explode(',',$q['language'])[0],
			explode(',',$q['country'])[0]);

		DB::insert('insert into tv_show (title,imdb_title,released,year,country,language,genre,actors,plot,imdb_id,imdbrating,trailer_value,poster_url_value,cover_url_value,base_url,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
      	[ $q["title"],$q["title"],$q["released"],$q['year'],$q["country"],$q["language"],$q["genre"],$q["actors"],$q["plot"],$q["imdb_id"],$q["imdb"],$q["trailer"],$q["poster"],$q["cover"],$q["path"],$q["type"]]); 
	}
    function scan_single_tv_show(Request $request){
  		if($request->ajax())
		{

			$tv_shows=DB::table('tv_show')->where('id',$request->scan_id)->get();
			$data=$this->get_tv_show_data($tv_shows[0]->imdb_title,$tv_shows[0]->year);	

			$data['type']=get_show_type($data['genre'],
				$tv_shows[0]->base_url,
				explode(',',$data['language'])[0],
				explode(',',$data['country'])[0]);

			if($data["trailer"]!="N/A"){
		
				$data["trailer"] = 'https://www.youtube.com/watch?v='.$data["trailer"];
			}else{
					$data["trailer"] = default_trailer;
			}
			
			if($data['poster']!="N/A" && $data['poster']!="https://image.tmdb.org/t/p/w500/"
				&& strpos($tv_shows[0]->poster_url_value,'_image.jpg') == false
				){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['poster']);
					file_put_contents(public_path('tv_show_poster/'.$timestamp.'_image.jpg'), $image);
					$data['poster']='/tv_show_poster/'.$timestamp.'_image.jpg';
	 		}else{

	 				$data['poster']=$tv_shows[0]->poster_url_value;
	 		}
	 		// cover
	 		if($data['cover']!="N/A" && $data['cover']!="https://image.tmdb.org/t/p/w1280/"
				&& strpos($tv_shows[0]->cover_url_value,'_image.jpg') == false
				){
	 				$timestamp = now()->timestamp;
	 				 $image = file_get_contents($data['cover']);
					file_put_contents(public_path('tv_show_cover/'.$timestamp.'_image.jpg'), $image);
					$data['cover']='/tv_show_cover/'.$timestamp.'_image.jpg';
	 		}else{

	 				$data['cover']=$tv_shows[0]->cover_url_value;
	 		}


			$data["released"]=  date("Y-m-d",strtotime($data["released"]));	
	 		if($data['imdb']=="N/A"){
	 			$data['imdb']=0;
	 		}
	 		// return Response($data);   

			        \DB::table('tv_show')->where('id',$request->scan_id)->update(
        	[
        		'released'	=>	$data["released"],
        		'country' => $data['country'],
        		'language' => $data['language'],
        		'genre' => $data['genre'],
        		
        		'actors' =>$data['actors'],
        		'plot' =>$data['plot'],
        		
        		'imdbrating' => $data['imdb'],
        		'imdb_id' => $data['imdb_id'],
        		'trailer_value' => $data["trailer"],
        		'poster_url_value'=>$data["poster"],
        		'cover_url_value'=>$data["cover"],
        		'type' => $data['type']

        	]);
			return Response($data);   
			     
		}
  	}

}
