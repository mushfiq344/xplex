<?php

function set_poster($poster_url_value,$type){

    $result1 = (string)preg_match(patten_url, $poster_url_value, $matches);
    $result2 = (string)preg_match(patten_image, $poster_url_value, $matches);
    $result=$result1*$result2;
   
    if($poster_url_value=="N/A"  || $result==0){
        $poster_url_value=default_poster;
    }
    else{
            
        $timestamp = now()->timestamp;
        $image = file_get_contents($poster_url_value);
        
        file_put_contents(public_path($type.'_poster/'.$timestamp.'_image.jpg'), $image);
        $poster_url_value=$type.'_poster/'.$timestamp.'_image.jpg';

        $img = Image::make($type.'_poster/'.$timestamp.'_image.jpg');

        $img->resize(500,750);
        
        $img->save();
        $poster_url_value='/'.$poster_url_value;
    }
    
    return $poster_url_value;
}
function edit_poster($poster_url_value,$id,$type){


    $result1 = (string)preg_match(patten_url, $poster_url_value);
    $result2 = (string)preg_match(patten_image, $poster_url_value);
    $result=$result1*$result2;
    if(is_file(ltrim($poster_url_value,"/"))){
        $cond=1;
    }
    else{
        $cond=0;
    };        
    if($result==1 && $cond==0){

        $table_rows=DB::table($type)->where('id',$id)->get();
        if($table_rows[0]->poster_url_value!=default_poster){
            File::delete(ltrim($table_rows[0]->poster_url_value,"/"));                  
        }
        $timestamp = now()->timestamp;
        $image = file_get_contents($poster_url_value);
        file_put_contents(public_path($type.'_poster/'.$timestamp.'_image.jpg'), $image);
        $poster_url_value='/'.$type.'_poster/'.$timestamp.'_image.jpg';

        $img = Image::make($type.'_poster/'.$timestamp.'_image.jpg');

        $img->resize(500,750);
       
        $img->save();
    }
    else if($poster_url_value=="N/A" || $cond==0){
        $table_rows=DB::table($type)->where('id',$id)->get();
        if($table_rows[0]->poster_url_value!=default_poster){
            File::delete(ltrim($table_rows[0]->poster_url_value,"/"));                  
        }
        $poster_url_value=default_poster;
    }
    return $poster_url_value;
}

function set_cover($poster_url_value,$type){

    // check url//
    $result1 = (string)preg_match(patten_url, $poster_url_value, $matches);
    $result2 = (string)preg_match(patten_image, $poster_url_value, $matches);
    $result=$result1*$result2;
    if($poster_url_value=="N/A"  || $result==0){
        $poster_url_value=default_cover;
    }
    else{
            
        $timestamp = now()->timestamp;

        $image = file_get_contents($poster_url_value);
        
        file_put_contents(public_path($type.'_cover/'.$timestamp.'_image.jpg'), $image);
        $poster_url_value=$type.'_cover/'.$timestamp.'_image.jpg';

        $img = Image::make($type.'_cover/'.$timestamp.'_image.jpg');

        $img->resize(1280,720);
        
        $img->save();
        $poster_url_value='/'.$poster_url_value;
    }

    return $poster_url_value;
}

function edit_cover($cover_url_value,$id,$type){


    $result1 = (string)preg_match(patten_url, $cover_url_value);
    $result2 = (string)preg_match(patten_image, $cover_url_value);
    $result=$result1*$result2;
    if(is_file(ltrim($cover_url_value,"/"))){
        $cond=1;
    }
    else{
        $cond=0;
    };        
    if($result==1 && $cond==0){

        $table_rows=DB::table($type)->where('id',$id)->get();
        if($table_rows[0]->cover_url_value!=default_cover){
            File::delete(ltrim($table_rows[0]->cover_url_value,"/"));                  
        }
        $timestamp = now()->timestamp;
        $image = file_get_contents($cover_url_value);
        file_put_contents(public_path($type.'_cover/'.$timestamp.'_image.jpg'), $image);
        $cover_url_value='/'.$type.'_cover/'.$timestamp.'_image.jpg';

        $img = Image::make($type.'_cover/'.$timestamp.'_image.jpg');
        $img->resize(1280,720);
        $img->save();
    }
    else if($cover_url_value=="N/A" || $cond==0){
        $table_rows=DB::table($type)->where('id',$id)->get();
        if($table_rows[0]->cover_url_value!=default_cover){
            File::delete(ltrim($table_rows[0]->cover_url_value,"/"));                  
        }
        $cover_url_value=default_cover;
    }
    return $cover_url_value;    
}

        // set the type of movie
function get_show_type($genre,$download_link,$language,$country){      
    // checking the type of movie
    if (strpos(strtolower($genre), 'animation') !== false ||  strpos(strtolower($download_link), 'anim') !== false) {
        $type="animation";
    }
    else
    {
        if ((strtolower($language) != 'hindi' && strtolower($language) != 
              'bengali' && strtolower($country) == 'india' && $language!="N/A")
            || strpos(strtolower($download_link), 'south indian') !== false) 
        {
            $type = 'south indian';
        }
        else if (strtolower($language) == 'hindi' ||
              strpos(strtolower($download_link), 'hindi') !== false) 
        {
              $type = 'hindi';
        }
        else if (strtolower($language) == 'english') 
        {
           	$type = 'english';
        }  
        else if (strtolower($language) == 'bengali' || strpos(strtolower($download_link), 
              'bangla') !== false) 
        {
            $type = 'bengali';
        }  
        else if (strtolower($language) == 'korean' || strpos(strtolower($download_link), 
              'korean') !== false) 
        {
            $type = 'korean';
        }
        else if (strtolower($language) == 'japanese' || 
              strpos(strtolower($download_link), 'japan') !== false || 
              strpos(strtolower($country), 'japan') !== false) 
        {
            $type = 'japanese';
        } 
        else 
        {
            $type = 'others';
        }
    }
    return $type;
}



// url encode
function myUrlEncode($string) {
	$replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%40', '%26', '%3D', '%2B', '%24', '%2C','%3F', '%23', '%5B', '%5D',"%20","/K");
	$entities = array('!', '*', "'", "(", ")", ";", "@", "&", "=", "+", "$", ",","?", "#", "[", "]"," ","//K");
	return str_replace($entities, $replacements, $string);
}


function check_data($title,$year,$path,$type){

    if($type=="tv_show"){
        $result=DB::table($type)->Where('base_url','like','%' .$path. '%')->get();
    }else{
        $result=DB::table($type)->Where('download_link', 'like', '%' .$path. '%')->get();
    
    }
    return count($result);
}


   






      
?> 