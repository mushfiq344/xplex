<?php

function func1($address,$link)
    {   
        $link=str_replace('â€“','–',$link);
        $link=str_replace('http:///','',urldecode($link));
        

        $url=$address.'ScanSeriesFolder.php?a='.str_replace('%E2%80%93','–',urlencode(ltrim($link, '/')));



        $json = file_get_contents($url);
        $obj = json_decode($json);
		if ((string)gettype($obj)=="NULL"){
			$data=array();
			return $data;
		}
		else{
			return $obj->items;
		}
                    
    }


function func3($address,$link)
  	{
  		$link=str_replace('â€“','–',$link);
        $url=$address.$link;
        return $url;
  	}

?>