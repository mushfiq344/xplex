<?php
function check_codec($links){
    
    foreach ($links as $link) {
    	# code...
    	$codec=shell_exec("ffprobe -v error -select_streams a:0 -show_entries stream=codec_name -of default=noprint_wrappers=1:nokey=1 '$link->path'");

    	if(strtolower(trim($codec))=='ac3'){
    		 $ch = curl_init($link->path);	
    		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 			curl_setopt($ch, CURLOPT_HEADER, TRUE);
 			curl_setopt($ch, CURLOPT_NOBODY, TRUE);

 			$data = curl_exec($ch);
 			$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

 			curl_close($ch);
 			$size=ceil($size/1000000000);

 			$result=DB::table('movie_ac3_links')->Where('link','like','%' .$link->path. '%')->get();
 			if(count($result)==0){
 				DB::insert('insert into movie_ac3_links (link,size) values(?,?)',
      			[$link->path,$size]);
 			}
 			
    	};
    }
    
};

?>