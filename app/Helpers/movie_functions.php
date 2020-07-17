<?php
// Edit This
function movie_links($link)
{   
    $converted_link=get_converted_string($link);

    $json = file_get_contents($converted_link);
    $obj = json_decode($json);
    $address = get_ip_for_single_link($link);
    // return $obj->items;
    foreach ($obj->items as $item) {
        $item->path=$address.myUrlEncode(str_replace("//","/",$item->path));
        # code...
    }
    return $obj->items;
}
// Edit This
function get_prints($link){
    
    $converted_link=get_converted_string($link);
    
    $json=file_get_contents($converted_link);
    $obj=json_decode($json);
    
    $print_types=print_types($obj->items);
    return $print_types;
    
};

function print_types($download_links){ 
        
    $print_types=array();
    $i=0;
    foreach ($download_links as $download_link) {

        if (strpos($download_link->path, '4K') !== false) {
            $print_types[$i]='4k';
            $i++;
        };
        if (strpos($download_link->path, '2160p') !== false) {
            $print_types[$i]='2160p';
            $i++;
        };

        if (strpos($download_link->name, '.jpg') !== false) {
            $print_types[$i]='jpg';
        }
        else if (strpos($download_link->name, '.png') !== false) {
            $print_types[$i]='png';
        }
        else if (strpos($download_link->name, '1080p') !== false) {
            $print_types[$i]='1080p';
        }
        else if (strpos($download_link->name, '720p') !== false) {
            $print_types[$i]='720p';
        }
        else if (strpos($download_link->name, '480p') !== false) {
            $print_types[$i]='480p';
        }
        else if (strpos($download_link->name, '320p') !== false) {
            $print_types[$i]='320p';
        }       
        else if (strpos($download_link->name, 'WEB-DL') !== false) {
            $print_types[$i]='WEB-DL';
        }
        else if (strpos($download_link->name, 'HDRip') !== false) {
            $print_types[$i]='HDRip';
        }
        else if (strpos($download_link->name, 'BluRay') !== false) {
            $print_types[$i]='BluRay';
        }
        else if (strpos($download_link->name, 'PDVD') !== false) {
            $print_types[$i]='PDVD';
        }
        else if (strpos($download_link->name, 'DVDScr') !== false) {
            $print_types[$i]='DVDScr';
        }
            else if (strpos($download_link->name, 'TS/HDTS') !== false) {
            $print_types[$i]='TS/HDTS';
        }
        else if (strpos($download_link->name, 'DVDScr') !== false) {
            $print_types[$i]='DVDScr';
        }
        else if (strpos($download_link->name, 'HDTV') !== false) {
            $print_types[$i]='HDTV';
        }
        else if (strpos($download_link->name, 'DVD') !== false) {
            $print_types[$i]='DVD';
        }
        else if (strpos($download_link->name, 'TC/HDTC') !== false) {
            $print_types[$i]='TC/HDTC';
        }
        else{
            $print_types[$i]='N/A';
        }
        $i++;

    }
    $print_types=implode("$$",$print_types);
    return $print_types;
};


function get_movie_casts($imdb_id){
//    $tmdb_api_key = 'c10c3d7950cf7587458629f7c5002ae7';
    $url='http://api.themoviedb.org/3/movie/'.$imdb_id.'/credits?api_key='.tmdb_api_key;
    // fetching production companies list
    try {
                if ($json = file_get_contents($url)) {
            $obj = json_decode($json);
            $i=0;
           foreach ($obj->cast as $cast) {
                if($cast->profile_path!=""){
                    $cast->profile_path="https://image.tmdb.org/t/p/w500/".$cast->profile_path;
                }
                else{
                    unset($obj->cast[$i]);
                }
                $i++;

           }
           return $obj->cast;
        }
    }// if production company could not be found
            catch (Exception $e) {
                return "N/A";
            };

}

function get_movie_screen_shots($imdb_id){

//    $tmdb_api_key = 'c10c3d7950cf7587458629f7c5002ae7';
    $url='http://api.themoviedb.org/3/movie/'.$imdb_id.'?api_key='.tmdb_api_key.'&append_to_response=images&include_image_language=en,null&external_source=imdb_id';
    
    // fetching production companies list
    try {
            if ($json = file_get_contents($url)) {
            $obj = json_decode($json);
            foreach ($obj->images->backdrops as $backdrop) {
                    $backdrop->file_path="https://image.tmdb.org/t/p/w500/".$backdrop->file_path; 
                }    

           return $obj->images->backdrops;
        }
    }// if production company could not be found
            catch (Exception $e) {
                return "N/A";
            };

}


function first_link($links){

    foreach ($links as $link){
        if (strpos($link->path, '.mp4') !== false ||   strpos($link->path, '.mkv') !== false  ) {
                return $link->path;
        }
    }

    return "N/A";
}
?>