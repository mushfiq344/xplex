<?php
// Edit This
function get_seasons($link)
{  
    // return $link;
    $link=urldecode($link);
    $link=myUrlEncode($link);
    $converted_link=get_converted_string($link);
    // return $converted_link;
    $json = file_get_contents($converted_link);
    $obj = json_decode($json);
    $address=get_ip_for_single_link($link);
    // return $address;
    $i=0;
    foreach ($obj->items as $item) {

        if($item->type=="file"){
           unset($obj->items[$i]);
        }else{
            $item->path=$address.myUrlEncode($item->path);
        }
        $i++;
        # code...
    }
    return $obj->items;

};

// Edit this
function get_episodes($link)
{   
    // return $link;
    $converted_link=get_converted_string($link);
    $json = file_get_contents($converted_link);
    $obj = json_decode($json);
    $address=get_ip_for_single_link($link);

    $i=0;
    foreach ($obj->items as $item) {

        if($item->type=="folder"){
           unset($obj->items[$i]);
        }else{
            $item->path=$address.myUrlEncode($item->path);
        }
        $i++;
        # code...
    }
    return $obj->items;
};


function get_tv_show_id($imdb_id){
    $tmdb_api_key = 'c10c3d7950cf7587458629f7c5002ae7';
    $url='https://api.themoviedb.org/3/find/'.$imdb_id.'?api_key='.$tmdb_api_key.'&external_source=imdb_id';
    
    try {
            if ($json = file_get_contents($url)) {
                $obj = json_decode($json);

                $id=$obj->tv_results[0]->id;
                return $id;
            }
        }    
        catch (\Exception $e) {
              return "N/A";
            }
   
}

function get_tv_show_screenshots($tv_show_id){
    $tmdb_api_key = 'c10c3d7950cf7587458629f7c5002ae7';
    $url='http://api.themoviedb.org/3/tv/'.$tv_show_id.'?api_key=c10c3d7950cf7587458629f7c5002ae7&append_to_response=images&include_image_language=en,null';
    
    try {
            if ($json = file_get_contents($url)) {
                $obj = json_decode($json);

                foreach ($obj->images->backdrops as $backdrop) {
                    $backdrop->file_path="https://image.tmdb.org/t/p/w1280/".$backdrop->file_path; 
                }    

                return $obj->images->backdrops;
            }
        }    
        catch (\Exception $e) {
              return "/default_images/default_cover";
            }
   
};

function get_first_episode($episodes){   
    foreach ($episodes as $episode){
        if(strpos($episode->path, '.mp4') !== false ||   strpos($episode->path, '.mkv') !== false  ){
            return $episode->path;
        }
    }
    return "N/A";
}

function get_name(){
    return name;
}
?>